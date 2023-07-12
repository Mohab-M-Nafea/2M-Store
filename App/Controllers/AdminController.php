<?php

class AdminController
{
    protected $user;
    private $group = 1;

    public function __construct()
    {
        $this->user = new User;
        if (!isset($_SESSION['admin']) && $_SERVER["QUERY_STRING"] !== 'admin/login') {
            $this->login();
        }
    }

    public function login()
    {
        $head   = ['pageName' => 'Login'];
        $head["error_title"] = "Login Error";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['login'])) {
                $err = [];

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
                    View::load('Admin' . DS . 'login', $head);
                }

                $stmt = $this->user->getUser($username, sha1($pass), $this->group);

                if ($stmt->rowCount() > 0) {
                    $row = $stmt->fetch();

                    $_SESSION['admin_id'] = $row['user_id'];
                    $_SESSION['admin_name'] = ucwords($row['first_name'] . ' ' . $row['last_name']);

                    $_SESSION['admin'] = $username;

                    if ($_SERVER["QUERY_STRING"] !== 'admin/login')
                        redirect($_SERVER["QUERY_STRING"]);

                    redirect('dashboard');
                } else {
                    $head["err"] = ['Username or Password uncorrect'];
                    View::load('Admin' . DS . 'login', $head);
                }
            } else {
                View::load('Admin' . DS . 'login', $head);
            }
        } else {
            View::load('Admin' . DS . 'login', $head);
        }
    }

    public function profile()
    {
        $head = ['pageName' => 'Profile', "nav" => ['members', 'categories', 'products', 'comments']];
        $data = $this->user->getUserData($_SESSION['admin_id']);

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

                if ($this->user->getUserPassword($_SESSION['admin_id']) !== sha1($old_pass) && !empty($old_pass)) {
                    $err[] = 'Old Password uncorrect';
                }

                if (!empty($new_pass) && !empty($confirm_pass)) {
                    if ($new_pass !== $confirm_pass) {
                        $err[] = 'New Password and Confirm New Password are not the same';
                    }

                    if ($this->user->getUserPassword($_SESSION['admin_id']) === sha1($new_pass)) {
                        $err[] = 'New Password can\'t be same with Old Password';
                    }
                }

                if (!empty($err)) {
                    $head["err"] = $err;
                    $head["data"] = $data->fetch();
                    View::load('Admin' . DS . 'profile', $head);
                } else {
                    $this->user->updateUserPassword($_SESSION['admin_id'], sha1($new_pass));
                    redirect('admin/profile');
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
                    View::load('Admin' . DS . 'profile', $head);
                } else {
                    $this->user->updateUserData($_SESSION['admin_id'], $firstName, $lastName, $username, $email, $phone, $address, $gender);
                    redirect('admin/profile');
                }
            }
        } else {
            if ($data->rowCount() > 0) {
                $head["data"] = $data->fetch();
                View::load('Admin' . DS . 'profile', $head);
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_name']);
        unset($_SESSION['admin']);

        redirect('admin/login');
    }
}
