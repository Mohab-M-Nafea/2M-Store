<?php
class Product extends DB
{
    private $table = "products";
    private $conn;

    public function __construct()
    {
        $this->conn = $this->connect();
        $this->table;
    }

    public function insertProduct($product_name, $product_description, $price, $quantity, $made_in, $image, $user_id, $category_id)
    {
        $q      = "INSERT INTO 
                        $this->table(
                            product_name,
                            product_description,
                            price,
                            quantity,
                            made_in,
                            added_date,
                            image,
                            user_id,
                            category_id)
                    VALUES(
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            NOW(),
                            ?,
                            ?,
                            ?);";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$product_name, $product_description, $price, $quantity, $made_in, $image, $user_id, $category_id]);

        return $stmt;
    }

    public function updateProduct($product_id, $product_name, $product_description, $price, $quantity, $made_in, $image, $category_id)
    {
        $q      = "UPDATE
                        $this->table
                    SET
                        product_name        = ?,
                        product_description = ?,
                        price               = ?,
                        quantity            = ?,
                        made_in             = ?,
                        image               = ?,
                        category_id         = ?
                    WHERE
                        product_id          = ?;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$product_name, $product_description, $price, $quantity, $made_in, $image, $category_id, $product_id]);

        return $stmt;
    }

    public function getAllProducts()
    {
        $q      = "SELECT 
                        $this->table.*,
                        categories.category_name,
                        users.username
                    FROM
                        $this->table
                    
                    INNER JOIN
                        categories
                    ON
                        categories.category_id = $this->table.category_id
                    
                    INNER JOIN
                        users
                    ON
                        users.user_id = $this->table.user_id";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute();

        return $stmt;
    }

    public function getLastProducts()
    {
        $q      = "SELECT 
                        product_id,
                        product_name
                    FROM
                        $this->table
                    ORDER BY
                        added_date
                    LIMIT 5";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute();

        return $stmt;
    }

    public function getProduct($product_id)
    {
        $q      =  "SELECT 
                        *
                    FROM
                        $this->table
                    WHERE
                        product_id = :id";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(":id", $product_id);
        $stmt->execute();

        return $stmt;
    }

    public function deleteProduct($product_id)
    {
        $q      =  "DELETE FROM
                        $this->table
                    WHERE
                        product_id = :id";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(":id", $product_id);
        $stmt->execute();

        return $stmt;
    }

    public function checkProduct($attr, $value)
    {
        $q      = "SELECT 
                        product_id
                    FROM
                        $this->table
                    WHERE
                        :attr = :value ;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([":attr" =>$attr, ":value" => $value]);

        return $stmt;
    }

    public function getProductWithRating($product_id){
        $q      = "SELECT 
                        $this->table.product_id,
                        $this->table.product_name,
                        $this->table.product_description,
                        $this->table.price,
                        $this->table.made_in,
                        $this->table.image,
                        $this->table.rate,
                        $this->table.category_id,
                        COUNT(rating.stars) AS count_voting,
                        categories.category_name
                    FROM
                        $this->table

                    INNER JOIN
                        rating
                    ON rating.product_id = $this->table.product_id

                    INNER JOIN
                        categories
                    ON categories.category_id = $this->table.category_id

                    WHERE
                        $this->table.product_id = :id;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([":id" => $product_id]);

        return $stmt;
    }

    public function getTopProducts($category_id){
        $q      = "SELECT 
                        $this->table.product_id,
                        $this->table.product_name,
                        $this->table.product_description,
                        $this->table.price,
                        $this->table.image,
                        $this->table.rate
                    FROM
                        $this->table

                    WHERE
                        $this->table.category_id = :id
                    ORDER BY
                        $this->table.rate
                    DESC;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([":id" => $category_id]);

        return $stmt;
    }
}
