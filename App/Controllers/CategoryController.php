<?php
class CategoryController
{
    private $category;

    public function __construct()
    {
        $this->category = new Category;
    }

    public function index()
    {
        $head = ['pageName' => 'Categories', 'nav' => ['members', 'categories', 'products', 'comments']];

        $categories = $this->category->getAllCategories();

        if ($categories->rowCount() > 0) {
            $head["categories"] = $categories->fetchAll();
            View::load('Admin' . DS . 'Categories' . DS . 'categories', $head);
        }

        View::load('Admin' . DS . 'Categories' . DS . 'categories', $head);
    }

    public function addCategory()
    {
        $head = ['pageName' => 'Add Category', 'nav' => ['members', 'categories', 'products', 'comments']];
        $head["error_title"] = "Add Category Error";
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["add_category"])) {
                $err = [];

                $category_name  = filter_var($_POST["category_name"], FILTER_SANITIZE_STRING);
                $description    = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
                $ordering       = filter_var($_POST["ordering"], FILTER_SANITIZE_NUMBER_INT);
                $visibility     = isset($_POST["visibility"]) ? 1 : 0;
                $allow_ads      = isset($_POST["allow_ads"]) ? 1 : 0;

                if (empty($category_name)) {
                    $err[] = "Category Name can\'t be empty";
                }

                if (empty($ordering)) {
                    $err[] = "Ordering can\'t be empty";
                }

                if ($this->category->checkCategory('category_name', $category_name)->rowCount() > 0) {
                    $err[] = "This Category Name is already exit";
                }

                if (!empty($err)) {
                    $head["err"] = $err;
                    View::load('Admin' . DS . 'Categories' . DS . 'add', $head);
                }

                $category = $this->category->insertCategory($category_name, $description, $ordering, $visibility, $allow_ads);
                if ($category->rowCount() > 0) {
                    redirect('dashboard' . DS . 'categories');
                } else {
                    $err[] = ["Sorry somthing happen, please try again"];
                    $head["err"] = $err;
                    View::load('Admin' . DS . 'Categories' . DS . 'add', $head);
                }
            }
        } else {
            View::load('Admin' . DS . 'Categories' . DS . 'add', $head);
        }
    }

    public function editCategory($category_id)
    {
        $head = ['pageName' => 'Add Category', 'nav' => ['members', 'categories', 'products', 'comments']];
        $head["error_title"] = "Edit Category Error";

        $category = $this->category->getCategory($category_id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["edit_category"])) {
                $err = [];
                $category = $this->category->getCategory($category_id);

                $category_name  = filter_var($_POST["category"], FILTER_SANITIZE_STRING);
                $description    = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
                $ordering       = filter_var($_POST["ordering"], FILTER_SANITIZE_NUMBER_INT);
                $visibility     = isset($_POST["visibility"]) ? 1 : 0;
                $allow_ads      = isset($_POST["allow_ads"]) ? 1 : 0;

                if (empty($category_name)) {
                    $err[] = "Category Name can\'t be empty";
                }

                if (empty($ordering)) {
                    $err[] = "Ordering can\'t be empty";
                }

                $id = $this->category->checkCategory('category_name', $category_name);

                if ($id->rowCount() > 0 && $id->fetch()['category_id'] !== $category->fetch()['category_id']) {
                    $err[] = "This Category Name is already exit";
                }

                if (!empty($err)) {
                    $head["err"] = $err;
                    $head["category"] = $category->fetch();
                    View::load('Admin' . DS . 'Categories' . DS . 'edit', $head);
                }

                $category = $this->category->updateCategory($category_id, $category_name, $description, $ordering, $visibility, $allow_ads);
                redirect('dashboard' . DS . 'categories');
            }
        } else {
            if ($category->rowCount() > 0) {
                $head["category"] = $category->fetch();
                View::load('Admin' . DS . 'Categories' . DS . 'edit', $head);
            }
        }
    }

    public function deleteCategory($category_id)
    {
        $category = $this->category->deleteCategory($category_id);
        if ($category->rowCount() > 0) {
            redirect('dashboard' . DS . 'categories');
        } else {
            View::load('error', ['pageName' => 'Error', 'nav' => ['login', 'sign up', 'home']]);
        }
    }

    public function showCategory($category_id, ...$filters){
        $categories = $this->category->requirements('Category', 'getAllCategories')->fetchAll();

        $products = $this->category->getCategoryProducts($category_id);
        if ($products->rowCount() > 0){
            $products = $products->fetchAll();

            $head = ['pageName' => $products[0]['category_name'], 'nav' => ['login', 'sign up', 'home']];
            $head["data"] = $products;
            $head["categories"] = $categories;
            
            View::load('category', $head);
        }
    }
}
