<?php
class MembersController extends DashboardController
{

    public function index()
    {
        $data = $this->user->getAllMembers();
        $head = ['pageName' => 'Members', 'nav' => ['members', 'categories', 'products', 'comments']];
        if ($data->rowCount() > 0) {
            $head["data"] = $data->fetchAll();
            View::load('Admin' . DS . 'Members' . DS . 'members', $head);
        } else {
            View::load('Admin' . DS . 'Members' . DS . 'members', $head);
        }
    }

    public function addMember()
    {
        $head = ['pageName' => "Add Member", 'nav' => ['members', 'categories', 'products', 'comments']];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['add_member'])) {
                $err = [];
                $head["error_title"] = "Add Member Error";

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
                    View::load('Admin' . DS . 'Members' . DS . 'add', $head);
                } else {
                    $row = $this->user->insertUser($firstName, $lastName, $username, $email, sha1($pass), $gender);

                    if ($row->rowCount() > 0) {
                        redirect('dashboard/members');
                    }
                }
            }
        }
        View::load('Admin' . DS . 'Members' . DS . 'add', $head);
    }

    public function editMember($user_id)
    {
        $id = $user_id;
        $data = $this->user->getUserData($id);
        $head = ['pageName' => 'Edit Member', 'nav' => ['members', 'categories', 'products', 'comments']];

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

                if ($this->user->getUserPassword($user_id) !== sha1($old_pass) && !empty($old_pass)) {
                    $err[] = 'Old Password uncorrect';
                }
                
                if(!empty($new_pass) && !empty($confirm_pass)){
                    if ($new_pass !== $confirm_pass) {
                        $err[] = 'New Password and Confirm New Password are not the same';
                    }

                    if ($this->user->getUserPassword($user_id) === sha1($new_pass)) {
                        $err[] = 'New Password can\'t be same with Old Password';
                    }
                }

                if (!empty($err)) {
                    $head["err"] = $err;
                    $head["data"] = $data->fetch();
                    View::load('Admin' . DS . 'Members' . DS . 'edit', $head);
                } else {
                    $this->user->updateUserPassword($id, sha1($new_pass));
                    redirect('dashboard/members');
                }
            } else if (isset($_POST['change_info'])) {
                $data = $data->fetch();

                $firstName  = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
                $lastName   = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
                $username   = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                $email      = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $phone      = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
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
                    View::load('Admin' . DS . 'Members' . DS . 'edit', $head);
                } else {
                    $this->user->updateUserData($id, $firstName, $lastName, $username, $email, $phone, $address, $gender);
                    redirect('dashboard/members');
                }
            }
        } else {
            if ($data->rowCount() > 0) {
                $head["data"] = $data->fetch();
                View::load('Admin' . DS . 'Members' . DS . 'edit', $head);
            }
        }
    }

    public function deleteMember($user_id)
    {
        $row = $this->user->deleteUser($user_id);
        redirect('dashboard/members');
    }
}
