<?php

class CustomerController
{
    private $user;
    private $group = 0;

    public function __construct()
    {
        $this->user = new User;
    }

    public function account()
    {
        $head = ['pageName' => 'Login', "nav" => ['login', 'home']];
        if (isset($_SESSION['user_id'])) {
            redirect('customer/profile');
        } elseif (isset($_COOKIE[hash('md5', 'user')]) && isset($_COOKIE[hash('md5', 'password')])) {
            $stmt = $this->user->getUser($_COOKIE[hash('md5', 'user')], $_COOKIE[hash('md5', 'password')], $this->group);

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
                setcookie(hash('md5', 'user'), $_COOKIE[hash('md5', 'user')], strtotime('+1year', time()), '/');
                setcookie(hash('md5', 'password'), $_COOKIE[hash('md5', 'password')], strtotime('+1year', time()), '/');

                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['first_name'] . ' ' . $row['last_name'];
                $_SESSION['user'] = $_COOKIE[hash('md5', 'user')];

                redirect('customer/profile');
            }
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['login'])) {
                    $err    = [];
                    $head["error_title"] = "Login Error";

                    $username   = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                    $pass       = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

                    if (empty($username)) {
                        $err[] = 'Username can\'t be empty';
                    }

                    if (empty($pass)) {
                        $err[] = 'Password can\'t be empty';
                    }

                    if (!empty($err)) {
                        $head["err"] = $err;
                        View::load('Users' . DS . 'account', $head);
                    }

                    $stmt = $this->user->getUser($username, sha1($pass), $this->group);

                    if ($stmt->rowCount() > 0) {
                        $row = $stmt->fetch();
                        if (!empty($_POST['remember-me'])) {
                            setcookie(hash('md5', 'user'), $username, strtotime('+1year', time()), '/');
                            setcookie(hash('md5', 'password'), sha1($pass), strtotime('+1year', time()), '/');
                        }

                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['user_name'] = $row['first_name'] . ' ' . $row['last_name'];
                        $_SESSION['user'] = $username;

                        isset($_SESSION["current_page"]) ? redirect($_SESSION["current_page"]) : redirect();
                    } else {
                        $err[] = 'Username or Password uncorrect';
                        $head["err"] = $err;
                        View::load('Users' . DS . 'account', $head);
                    }
                } else if (isset($_POST['register'])) {
                    $err = [];
                    $head["error_title"] = "Register Error";

                    $firstName      = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
                    $lastName       = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
                    $username       = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                    $email          = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                    $pass           = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
                    $confirmpass    = filter_var($_POST['confirm_password'], FILTER_SANITIZE_STRING);
                    $gender         = filter_var($_POST['gender'], FILTER_SANITIZE_NUMBER_INT);

                    if (empty($firstName)) {
                        $err[] = 'First Name can\'t be empty';
                    }

                    if (empty($lastName)) {
                        $err[] = 'Last Name can\'t be empty';
                    }

                    if (empty($username)) {
                        $err[] = 'Username can\'t be empty';
                    }

                    if (empty($email)) {
                        $err[] = 'Email can\'t be empty';
                    }

                    if (empty($pass)) {
                        $err[] = 'Password can\'t be empty';
                    }

                    if (empty($confirmpass)) {
                        $err[] = 'Confirm Password can\'t be empty';
                    }

                    if ($gender != 0 && $gender != 1) {
                        $err[] = 'Unknown Gender';
                    }

                    if (!$pass === $confirmpass) {
                        $err[] = 'Password and Confirm Password are not the same';
                    }

                    if ($this->user->checkUser('username', $username) > 0) {
                        $err[] = 'This Username is already exist';
                    }

                    if ($this->user->checkUser('email', $email) > 0) {
                        $err[] = 'This Email is already exist';
                    }

                    if (!empty($err)) {
                        $head["err"] = $err;
                        View::load('Users' . DS . 'account', $head);
                    } else {
                        $row = $this->user->insertUser($firstName, $lastName, $username, $email, sha1($pass), $gender);

                        if ($row->rowCount() > 0) {
                            $stmt   = $this->user->getUser($username, sha1($pass), $this->group);
                            $row    = $stmt->fetch();
                            $_SESSION['user_id'] = $row['user_id'];
                            $_SESSION['user_name'] = $row['first_name'] . ' ' . $row['last_name'];
                            $_SESSION['user'] = $username;

                            isset($_SESSION["current_page"]) ? redirect($_SESSION["current_page"]) : redirect();
                        }
                    }
                }
            }
            View::load('Users' . DS . 'account', $head);
        }
    }

    public function profile()
    {
        $head = ['pageName' => 'Profile', "nav" => ['login', 'home']];
        $data = $this->user->getUserData($_SESSION['user_id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];
            if (isset($_POST['change_password'])) {
                $head["error_title"] = "Password Error";

                $old_pass       = filter_var($_POST['old_password'], FILTER_SANITIZE_STRING);
                $new_pass       = filter_var($_POST['new_password'], FILTER_SANITIZE_STRING);
                $confirm_pass   = filter_var($_POST['confirm_new_password'], FILTER_SANITIZE_STRING);

                if (empty($old_pass)) {
                    $err[] = 'Old Password can\'t be empty';
                }

                if (empty($new_pass)) {
                    $err[] = 'New Password can\'t be empty';
                }

                if (empty($confirm_pass)) {
                    $err[] = 'Confrim New Password can\'t be empty';
                }

                if ($this->user->getUserPassword($_SESSION['user_id']) !== sha1($old_pass) && !empty($old_pass)) {
                    $err[] = 'Old Password uncorrect';
                }

                if (!empty($new_pass) && !empty($confirm_pass)) {
                    if ($new_pass !== $confirm_pass) {
                        $err[] = 'New Password and Confirm New Password are not the same';
                    }

                    if ($this->user->getUserPassword($_SESSION['user_id']) === sha1($new_pass)) {
                        $err[] = 'New Password can\'t be same with Old Password';
                    }
                }

                if (!empty($err)) {
                    $head["err"] = $err;
                    $head["data"] = $data->fetch();
                    View::load('Users' . DS . 'profile', $head);
                } else {
                    $this->user->updateUserPassword($_SESSION['user_id'], sha1($new_pass));
                    redirect('customer/profile');
                }
            } else if (isset($_POST['change_info'])) {
                $data = $data->fetch();

                $firstName  = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
                $lastName   = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
                $username   = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                $email      = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $phone    = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
                $address    = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
                $gender     = filter_var($_POST['gender'], FILTER_SANITIZE_NUMBER_INT);

                if (empty($firstName)) {
                    $err[] = 'First Name can\'t be empty';
                }

                if (empty($lastName)) {
                    $err[] = 'Last Name can\'t be empty';
                }

                if (empty($username)) {
                    $err[] = 'Username can\'t be empty';
                }

                if (empty($email)) {
                    $err[] = 'Email can\'t be empty';
                }

                if ($this->user->checkUser('username', $username) > 0 && $username !== $data["username"]) {
                    $err[] = 'This Username is already exist';
                }

                if ($this->user->checkUser('email', $email) > 0 && $email !== $data["email"]) {
                    $err[] = 'This Email is already exist';
                }

                if ($gender != 0 && $gender != 1) {
                    $err[] = 'Unknown Gender';
                }

                if (!empty($err)) {
                    $head["err"] = $err;
                    $head["data"] = $data;
                    View::load('Users' . DS . 'profile', $head);
                } else {
                    $this->user->updateUserData($_SESSION['user_id'], $firstName, $lastName, $username, $email, $phone, $address, $gender);
                    redirect('customer/profile');
                }
            }
        } else {
            if ($data->rowCount() > 0) {
                $head["data"] = $data->fetch();
                View::load('Users' . DS . 'profile', $head);
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user']);
        setcookie(hash('md5', 'user'), '', time() - 3600, '/');
        setcookie(hash('md5', 'password'), '', time() - 3600, '/');

        redirect();
    }
}
