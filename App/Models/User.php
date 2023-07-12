<?php
class User extends DB
{
    private $table = 'users';
    private $conn;

    public function __construct()
    {
        $this->conn = $this->connect();
    }

    public function insertUser($firstName, $lastName, $username, $email, $password, $gender)
    {
        $q      = "INSERT INTO 
                        $this->table (
                        first_name, 
                        last_name, 
                        username, 
                        email, 
                        pass,
                        gender,
                        date) 
                    VALUES (
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        now());";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$firstName, $lastName, $username, $email, $password, $gender]);

        return $stmt;
    }

    public function updateUserData($user_id, $firstName, $lastName, $username, $email, $phone, $address, $gender)
    {
        $q      = "UPDATE 
                        $this->table 
                    SET 
                        first_name = ?,
                        last_name = ?,
                        username = ?,
                        email = ?,
                        phone = ?,
                        address = ?,
                        gender = ?
                    WHERE 
                        user_id = ?;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$firstName, $lastName, $username, $email, $phone, $address, $gender, $user_id]);

        return $stmt;
    }

    public function updateUserPassword($user_id, $password)
    {
        $q      = "UPDATE 
                        $this->table 
                    SET 
                        pass = :pass
                    WHERE 
                        user_id = :id;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([":pass" => $password, ":id" => $user_id]);

        return $stmt;
    }

    public function getAllMembers()
    {
        $q      = "SELECT 
                        * 
                    FROM 
                        $this->table 
                    WHERE 
                        user_group != 1;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute();

        return $stmt;
    }

    public function getAllUsers()
    {
        $q      = "SELECT 
                        * 
                    FROM 
                        $this->table;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute();

        return $stmt;
    }

    public function getLastMembers()
    {
        $q      = "SELECT 
                        user_id,
                        username
                    FROM
                        $this->table
                    WHERE
                        user_group != 1;
                    ORDER BY
                        date
                    LIMIT 5";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute();

        return $stmt;
    }

    public function getUserData($user_id)
    {
        $q      = "SELECT 
                        * 
                    FROM 
                        $this->table 
                    WHERE 
                        user_id = :id;";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();

        return $stmt;
    }

    public function getUser($username, $pass, $group){
        $q      = "SELECT 
                        user_id, 
                        first_name,
                        last_name
                    FROM 
                        $this->table 
                    WHERE 
                        username = ? 
                    AND 
                        pass = ? 
                    AND 
                        user_group = ?;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$username, $pass, $group]);
        
        return $stmt;
    }

    public function getUserPassword($user_id)
    {
        $q      = "SELECT 
                        pass 
                    FROM 
                        $this->table 
                    WHERE 
                        user_id = :id;";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();

        return $stmt->fetch()['pass'];
    }

    public function deleteUser($user_id)
    {
        $q      = "DELETE FROM 
                        $this->table 
                    WHERE 
                        user_id = :id;";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();

        return $stmt;
    }

    public function checkUser($att, $value)
    {
        $q      = "SELECT 
                        user_id 
                    FROM 
                        $this->table 
                    WHERE 
                        $att = ?;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$value]);

        return $stmt->rowCount();
    }
}
