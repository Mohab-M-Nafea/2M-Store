<?php
class CommentController
{
    private $comment;

    public function __construct()
    {
        $this->comment = new Comment;
    }

    public function index()
    {
        $head = ['pageName' => 'Comments', 'nav' => ['members', 'categories', 'products', 'comments']];
        $comments = $this->comment->getAllComments();

        if ($comments->rowCount() > 0) {
            $comments = $comments->fetchAll();
            $head["comments"] = $comments;
            View::load('Admin' . DS . 'Comments' . DS . 'comments', $head);
        }

        View::load('Admin' . DS . 'Comments' . DS . 'comments', $head);
    }

    public function editComment($comment_id)
    {
        $head = ['pageName' => 'Edit Comment', 'nav' => ['members', 'categories', 'products', 'comments']];

        $comment = $this->comment->getComment($comment_id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["edit_comment"])) {
                $err = [];

                $user_comment = filter_var($_POST["user-comment"], FILTER_SANITIZE_STRING);

                if (empty($user_comment)) {
                    $err[] = "Comment can\'t be empty";
                }

                if (!empty($err)) {
                    $head["err"] = $err;
                    $comment = $comment->fetch();
                    $head["comment"] = $comment;

                    View::load('Admin' . DS . 'Comments' . DS . 'edit', $head);
                }

                $comment = $this->comment->updateComment($comment_id, $user_comment);
                redirect('dashboard' . DS . 'comments');
            }
        } else {
            if ($comment->rowCount() > 0) {
                $comment = $comment->fetch();
                $head["comment"] = $comment;

                View::load('Admin' . DS . 'Comments' . DS . 'edit', $head);
            }
        }
    }

    public function deleteComment($comment_id)
    {
        $comment = $this->comment->deleteComment($comment_id);
        if ($comment->rowCount() > 0) {
            redirect('dashboard' . DS . 'comments');
        } else {
            View::load('error', ['pageName' => 'Error', 'nav' => ['members', 'categories', 'products', 'comments']]);
        }
    }
}
