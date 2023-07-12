<?php
class Comment extends DB
{
    private $table = "comments";
    private $conn;

    public function __construct()
    {
        $this->conn = $this->connect();
        $this->table;
    }

    public function insertComment($comment, $product_id, $user_id)
    {
        $q      = "INSERT INTO 
                        $this->table(
                            comment,
                            comment_date,
                            product_id,
                            user_id)
                    VALUES(
                            ?,
                            NOW(),
                            ?,
                            ?);";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$comment, $product_id, $user_id]);

        return $stmt;
    }

    public function updateComment($comment_id, $comment)
    {
        $q      = "UPDATE
                        $this->table
                    SET
                        comment     = ?
                    WHERE
                        comment_id  = ?;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$comment, $comment_id]);

        return $stmt;
    }

    public function getAllComments()
    {
        $q      = "SELECT 
                        $this->table.*,
                        products.product_name,
                        users.username
                    FROM
                        $this->table
                    
                    INNER JOIN
                        products
                    ON
                        products.product_id = $this->table.product_id
                    
                    INNER JOIN
                        users
                    ON
                        users.user_id = $this->table.user_id";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute();

        return $stmt;
    }

    public function getComment($comment_id)
    {
        $q      =  "SELECT 
                        $this->table.comment,
                        users.username
                    FROM
                        $this->table

                    INNER JOIN
                        users
                    ON users.user_id = comments.user_id

                    WHERE
                        comment_id = :id";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(":id", $comment_id);
        $stmt->execute();

        return $stmt;
    }

    public function getPrdouctComments($product_id)
    {
        $q      = "SELECT 
                        comments.comment,
                        comments.comment_date,
                        users.username,
                        users.gender
                    FROM
                        comments

                    INNER JOIN
                        users
                    ON users.user_id = comments.user_id
                    
                    WHERE
                        comments.product_id = :id;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([":id" => $product_id]);

        return $stmt;
    }

    public function deleteComment($comment_id)
    {
        $q      =  "DELETE FROM
                        $this->table
                    WHERE
                        comment_id = :id";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(":id", $comment_id);
        $stmt->execute();

        return $stmt;
    }
}
