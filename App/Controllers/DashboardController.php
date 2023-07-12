<?php
class DashboardController extends AdminController
{

    public function index()
    {
        $members = new User;
        $total_members = $members->getAllMembers()->rowCount();
        
        $total_categories = $members->requirements('Category', 'getAllCategories')->rowCount();

        $total_products = $members->requirements('Product', 'getAllProducts')->rowCount();

        $total_comments = $members->requirements('Comment', 'getAllComments')->rowCount();

        $data = ["total_members" => $total_members, "total_categories" => $total_categories, "total_products" => $total_products, "total_comments" => $total_comments];

        $last_members = $members->getLastMembers()->fetchAll();
        $last_products = $members->requirements('Product', 'getLastProducts')->fetchAll();

        View::load('Admin' . DS . 'dashboard', ['pageName' => 'Dashboard', 'nav' => ['members', 'categories', 'products', 'comments'], "data"=> $data, "last_members" => $last_members, "last_products" => $last_products]);
    }

    public function members(...$params)
    {
        $controller = new MembersController;

        if (empty($params)) {
            $controller->index();
        } else {
            $method = $params[0];
            unset($params[0]);

            empty($params) ? $controller->$method() : $controller->$method($params[1]);
        }
    }

    public function categories(...$params)
    {
        $controller = new CategoryController;

        if (empty($params)) {
            $controller->index();
        } else {
            $method = $params[0];
            unset($params[0]);

            empty($params) ? $controller->$method() : $controller->$method($params[1]);
        }
    }

    public function products(...$params)
    {
        $controller = new ProductController;

        if (empty($params)) {
            $controller->index();
        } else {
            $method = $params[0];
            unset($params[0]);

            empty($params) ? $controller->$method() : $controller->$method($params[1]);
        }
    }

    public function comments(...$params)
    {
        $controller = new CommentController;

        if (empty($params)) {
            $controller->index();
        } else {
            $method = $params[0];
            unset($params[0]);

            empty($params) ? $controller->$method() : $controller->$method($params[1]);
        }
    }
}
