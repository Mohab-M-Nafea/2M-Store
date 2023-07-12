<?php include 'layout/shop_header.php' ?>

<main class="mt-5">

    <div class="my-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
        </ol>
    </div>

    <?php if (isset($data)) : ?>

        <div class="cart-heading text-center">
            <p class="lead text-muted">You have <?php echo $count ?> items in your shopping cart</p>
        </div>
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8">
                    <div class="cart">
                        <div class="cart-wrapper">
                            <div class="cart-header text-center">
                                <div class="row">
                                    <div class="col-5">Item</div>
                                    <div class="col-2">Price</div>
                                    <div class="col-2">Quantity</div>
                                    <div class="col-2">Total</div>
                                    <div class="col-1"></div>
                                </div>
                            </div>
                            <div class="cart-body">
                                <?php foreach ($data as $product_id) :
                                    $product = new Product;
                                    $product = $product->getProduct($product_id);
                                    if ($product->rowCount() > 0) :
                                        $product = $product->fetch();
                                ?>
                                        <div class="cart-item">
                                            <div class="row align-items-center text-center">
                                                <div class="col-5">
                                                    <div class="d-flex align-items-center">
                                                        <a href="<?php url('product/showProduct/' . $product["product_id"]) ?>">
                                                            <img class="cart-item-img" src="<?php url($product["image"]) ?>" alt="<?php echo $product["product_name"] ?>">
                                                        </a>
                                                        <div class="cart-title text-start">
                                                            <a class="text-uppercase text-dark" href="<?php url('product/showProduct/' . $product["product_id"]) ?>">
                                                                <strong><?php echo $product["product_name"] ?></strong>
                                                            </a>
                                                            <br>
                                                            <span class="text text-muted text-sm"><?php echo $product["product_description"] ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="price">
                                                        <span id="price-<?php echo $product["product_id"] ?>"><?php echo $product["price"] ?></span><span> EGP</span>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="btn btn-items btn-items-decrease" onclick="decreaseValue(<?php echo $product['product_id'] ?>)">-</div>
                                                        <input class="form-control text-center input-items" type="text" value="1" id="product-<?php echo $product["product_id"] ?>">
                                                        <div class="btn btn-items btn-items-increase" onclick="increaseValue(<?php echo $product['product_id'] ?>, <?php echo $product['quantity'] ?>)">+</div>
                                                    </div>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <div class="total">
                                                        <span id="total-<?php echo $product["product_id"] ?>"><?php echo $product["price"] ?></span><span> EGP</span>
                                                    </div>
                                                </div>
                                                <div class="col-1 text-center">
                                                    <a class="text-danger" href="<?php url('home/removeCart/' . $product["product_id"]) ?>">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <div class="navigate my-5 d-flex justify-content-between flex-column flex-lg-row">
                        <a class="btn btn-link text-muted" href="<?php url() ?>">
                            <i class="fa fa-chevron-left"></i> <span>Continue Shopping</span>
                        </a>
                        <a class="btn btn-dark" href="">
                            <span>Proceed to checkout</span>
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="block mb-5">
                        <div class="block-header">
                            <h6 class="text-uppercase mb-0">Order Summary</h6>
                        </div>
                        <div class="block-body bg-light pt-1">
                            <p class="text-sm">
                                Shipping and additional costs are calculated based on values you have entered.
                            </p>
                            <ul class="order-summary mb-0 list-unstyled">
                                <li class="order-summary-item">
                                    <span>Order Subtotal </span>
                                    <div>
                                        <span id="sub-total"></span>
                                        <span> EGP</span>
                                    </div>
                                </li>
                                <li class="order-summary-item">
                                    <span>Shipping and handling</span>
                                    <div>
                                        <span id="shipping">10</span>
                                        <span> EGP</span>
                                    </div>
                                </li>
                                <li class="order-summary-item">
                                    <span>Tax</span>
                                    <div>
                                        <span id="tax">0</span>
                                        <span> EGP</span>
                                    </div>
                                </li>
                                <li class="order-summary-item border-0">
                                    <span>Total</span>
                                    <strong class="order-summary-total">
                                        <div>
                                            <span id="total"></span><span> EGP</span>
                                        </div>
                                    </strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src=" <?php url('assets/js/cart.js?t=' . time()) ?>"></script>

    <?php else : ?>

        <div class="container">
            <div class="d-flex flex-column justify-content-center align-items-center fs-5 gap-4" style="height: calc(100vh - 56px);">
                <div>
                    Your shopping cart is empty!
                </div>
                <div class="fs-5">
                    <a class="btn btn-dark" href="<?php url() ?>">
                        <span>Go To Shop!</span>
                    </a>
                </div>
            </div>
        </div>

    <?php endif ?>
</main>

<?php include 'layout/shop_footer.php' ?>