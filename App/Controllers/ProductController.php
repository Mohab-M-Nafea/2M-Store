<?php
class ProductController
{
    private $product;

    public function __construct()
    {
        $this->product = new Product;
    }

    public function index()
    {
        $head       = ['pageName' => 'Products', 'nav' => ['members', 'categories', 'products', 'comments']];
        $products   = $this->product->getAllProducts();

        if ($products->rowCount() > 0) {
            $head["products"] = $products->fetchAll();
            View::load('Admin' . DS . 'Products' . DS . 'products', $head);
        }

        View::load('Admin' . DS . 'Products' . DS . 'products', $head);
    }

    public function addProduct()
    {
        $categories = $this->product->requirements('Category', 'getAllCategories')->fetchAll();

        $head       = ['pageName' => 'Add Product', 'nav' => ['members', 'categories', 'products', 'comments'], "categories" => $categories];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["add_product"])) {
                $err = [];
                $base_dir = 'Uploads/Products/';

                $product_name        = filter_var($_POST["product_name"], FILTER_SANITIZE_STRING);
                $product_description = filter_var($_POST["product_description"], FILTER_SANITIZE_STRING);
                $price               = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_INT);
                $quantity            = filter_var($_POST["quantity"], FILTER_SANITIZE_NUMBER_INT);
                $made_in             = filter_var($_POST["country"], FILTER_SANITIZE_STRING);
                $image               = filter_var($_FILES["image"]["name"], FILTER_SANITIZE_STRING);
                // $image_target = "Uploads/Products/$image";
                echo $_FILES["image"]["size"];
                // // print_r(getimagesize($_FILES["image"]["tmp_name"]));
                $category_id         = filter_var($_POST["category"], FILTER_SANITIZE_NUMBER_INT);

                if (empty($product_name)) {
                    $err[] = "Product Name can\'t be empty";
                }

                if (empty($price)) {
                    $err[] = "Price can\'t be empty";
                }

                if (empty($quantity)) {
                    $err[] = "Quantity can\'t be empty";
                }

                if (empty($made_in)) {
                    $err[] = "Country can\'t be empty";
                }

                if (empty($category_id)) {
                    $err[] = "Category can\'t be empty";
                } else {
                    $category = $this->product->requirements('Category', 'getCategory', $category_id);
                    if ($category->rowCount() > 0) {
                        $category_name = $category->fetch()['category_name'];

                        $flag = is_dir($base_dir . $category_name) ? true : (mkdir($base_dir . $category_name) ? true : false);
                        if ($flag) {
                            $image_target = $base_dir . $category_name . '/' . $image;

                            if (getimagesize($_FILES["image"]["tmp_name"])) {
                                if (!file_exists($image_target)) {
                                    if ($_FILES["image"]["size"] <= 0) {
                                        $err[] = "File is corrupted";
                                    } else if ($_FILES["image"]["size"] > 5242880) {
                                        $err[] = "File size is too large";
                                    }
                                }
                            } else {
                                $err[] = "File is not an image";
                            }
                        } else {
                            $err[] = "Sorry something happen while uploading image";
                        }
                    } else {
                        $err[] = "Unknown Category";
                    }
                }

                if ($this->product->checkProduct('product_name', $product_name)->rowCount() > 0) {
                    $err[] = "This Product Name is already exit";
                }

                if (!empty($err)) {
                    $head["err"] = $err;
                    View::load('Admin' . DS . 'Products' . DS . 'add', $head);
                }

                if (!move_uploaded_file($_FILES["image"]["tmp_name"], $image_target)) {
                    $head["err"] = ["Sorry something happen while uploading image"];
                    View::load('Admin' . DS . 'Products' . DS . 'add', $head);
                }

                $product = $this->product->insertProduct($product_name, $product_description, $price, $quantity, $made_in, $image_target, $_SESSION["admin_id"], $category_id);
                if ($product->rowCount() > 0) {
                    redirect('dashboard' . DS . 'products');
                } else {
                    $err[] = "Sorry somthing happen, please try again";
                    $head["err"] = $err;
                    View::load('Admin' . DS . 'Products' . DS . 'add', $head);
                }
            }
        } else {
            View::load('Admin' . DS . 'Products' . DS . 'add', $head);
        }
    }

    public function editProduct($product_id)
    {
        $categories = $this->product->requirements('Category', 'getAllCategories')->fetchAll();

        $product = $this->product->getProduct($product_id);

        $head = ['pageName' => 'Edit Product', 'nav' => ['members', 'categories', 'products', 'comments'], "categories" => $categories];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["edit_product"])) {
                $err = [];
                $product = $this->product->getProduct($product_id);

                $product_name        = filter_var($_POST["product_name"], FILTER_SANITIZE_STRING);
                $product_description = filter_var($_POST["product_description"], FILTER_SANITIZE_STRING);
                $price               = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_INT);
                $quantity            = filter_var($_POST["quantity"], FILTER_SANITIZE_NUMBER_INT);
                $made_in             = filter_var($_POST["country"], FILTER_SANITIZE_STRING);
                // $image            = filter_var($_POST["ordering"], FILTER_SANITIZE_STRING);
                $category_id         = filter_var($_POST["category"], FILTER_SANITIZE_NUMBER_INT);

                if (empty($product_name)) {
                    $err[] = "Product Name can\'t be empty";
                }

                if (empty($price)) {
                    $err[] = "Price can\'t be empty";
                }

                if (empty($quantity)) {
                    $err[] = "Quantity can\'t be empty";
                }

                if (empty($made_in)) {
                    $err[] = "Country can\'t be empty";
                }

                if (empty($category_id)) {
                    $err[] = "Category can\'t be empty";
                }

                $id = $this->product->checkProduct('product_name', $product_name);

                if ($id->rowCount() > 0 && $id->fetch()['product_id'] !== $product->fetch()['product_id']) {
                    $err[] = "This Product Name is already exit";
                }

                if (!empty($err)) {
                    $head["err"] = $err;
                    $product = $product->fetch();
                    $head["product"] = $product;
                    View::load('Admin' . DS . 'Products' . DS . 'edit', $head);
                }

                $product = $this->product->updateProduct($product_id, $product_name, $product_description, $price, $quantity, $made_in, '', $category_id);
                redirect('dashboard/products');
            }
        } else {
            if ($product->rowCount() > 0) {
                $product = $product->fetch();
                $head["product"] = $product;
                View::load('Admin' . DS . 'Products' . DS . 'edit', $head);
            }
        }
    }

    public function deleteProduct($product_id)
    {
        $product = $this->product->deleteProduct($product_id);
        if ($product->rowCount() > 0) {
            redirect('dashboard' . DS . 'products');
        } else {
            View::load('error', ['pageName' => 'Error', 'nav' => ['members', 'categories', 'products', 'comments']]);
        }
    }

    public function showProduct($product_id)
    {
        if (!isset($_SESSION["cart-list"])) {
            $_SESSION["cart-list"] = [];
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["add_to_cart"])) {
                $_SESSION["cart-list"][$product_id] = $product_id;
            }

            if (isset($_POST["make-comment"])) {
                if (isset($_SESSION['user_id'])) {
                    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

                    if (!empty($comment)) {
                        $new_comment = new Comment;
                        $new_comment->insertComment($comment, $product_id, $_SESSION['user_id']);
                    }
                } else {
                    redirect('customer/account');
                }
            }
        }
        $comments   = $this->product->requirements('Comment', 'getPrdouctComments', $product_id);

        $categories = $this->product->requirements('Category', 'getAllCategories')->fetchAll();

        $product    = $this->product->getProductWithRating($product_id);
        if ($product->rowCount() > 0) {
            $product    = $product->fetch();
            $product["comments"] = $comments->fetchAll();
            $_SESSION["current_page"] = $_SERVER['QUERY_STRING'];
            View::load('product', ['pageName' => $product["product_name"], 'nav' => ['members', 'categories', 'products', 'comments'], 'data' => $product, "categories" => $categories]);
        }
    }
}
