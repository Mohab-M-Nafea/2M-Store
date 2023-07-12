<?php
class HomeController
{

    public function index()
    {
        $head = ['pageName' => 'Home', "nav" => ['login', 'sign up', 'home']];
        $categories = new Category;
        $head['categories'] = $categories->getAllCategories()->fetchAll();
        $head['images'] = array_diff(scandir('Uploads/Carousel'), ['.', '..']);

        View::load('index', $head);
    }

    public function cart()
    {
        $head = ['pageName' => 'Cart', "nav" => ['login', 'sign up', 'home']];
        $categories = new Category;
        $head['categories'] = $categories->getAllCategories()->fetchAll();

        if (!empty($_SESSION['cart-list'])) {
            $head['data'] = $_SESSION['cart-list'];
            $head['count'] = count($_SESSION['cart-list']);
        }
        View::load('cart', $head);
    }

    public function removeCart($product_id){
        if(isset($_SESSION['cart-list'][$product_id])){
            unset($_SESSION['cart-list'][$product_id]);
        }
        redirect('home/cart');
    }
}
