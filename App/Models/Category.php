<?php
class Category extends DB
{
    private $table = "categories";
    private $conn;

    public function __construct()
    {
        $this->conn = $this->connect();
        $this->table;
    }

    public function insertCategory($category_name, $description, $ordering, $visibility, $allow_ads)
    {
        $q      = "INSERT INTO 
                        $this->table(
                            category_name,
                            description,
                            ordering,
                            visibility,
                            allow_ads)
                    VALUES(
                            ?,
                            ?,
                            ?,
                            ?,
                            ?);";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$category_name, $description, $ordering, $visibility, $allow_ads]);

        return $stmt;
    }

    public function updateCategory($category_id, $category_name, $description, $ordering, $visibility, $allow_ads)
    {
        $q      = "UPDATE
                        $this->table
                    SET
                        category_name   = ?,
                        description     = ?,
                        ordering        = ?,
                        visibility      = ?,
                        allow_ads       = ?
                    WHERE
                        category_id     = ?;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$category_name, $description, $ordering, $visibility, $allow_ads, $category_id]);

        return $stmt;
    }

    public function getAllCategories()
    {
        $q      = "SELECT 
                        *
                    FROM
                        $this->table";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute();

        return $stmt;
    }

    public function getCategory($category_id)
    {
        $q      =  "SELECT 
                        *
                    FROM
                        $this->table
                    WHERE
                        category_id = :id";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(":id", $category_id);
        $stmt->execute();

        return $stmt;
    }

    public function deleteCategory($category_id)
    {
        $q      =  "DELETE FROM
                        $this->table
                    WHERE
                        category_id = :id";

        $stmt   = $this->conn->prepare($q);
        $stmt->bindParam(":id", $category_id);
        $stmt->execute();

        return $stmt;
    }

    public function checkCategory($attr, $value)
    {
        $q      = "SELECT 
                        category_id
                    FROM
                        $this->table
                    WHERE
                        ? = ?;";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([$attr, $value]);

        return $stmt;
    }

    public function getCategoryProducts($category_id, $filter = '')
    {
        $q      = "SELECT 
                        $this->table.category_name,
                        products.product_id, 
                        products.image, 
                        products.product_name,
                        products.product_description,
                        products.price
                    FROM
                        $this->table
                    LEFT JOIN
                        products
                    ON
                        $this->table.category_id = products.category_id
                    WHERE
                        $this->table.category_id = :id";

        $stmt   = $this->conn->prepare($q);
        $stmt->execute([":id" => $category_id]);

        return $stmt;
    }
}
