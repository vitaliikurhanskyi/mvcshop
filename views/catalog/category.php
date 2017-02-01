<?php include ROOT . '/views/layouts/header.php'; ?>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="left-sidebar">
                            <h2>Каталог</h2>
                            <div class="panel-group category-products">
                                <?php foreach ($categories as $categoryItem): ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a href="/category/<?php echo $categoryItem['id']; ?>"
                                                    class="<?php if ($categoryId == $categoryItem['id']) echo 'active'; ?>"
                                                    >
                                                    <?php echo $categoryItem['name']; ?>
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-9 padding-right">
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center">Последние товары</h2>

                            <?php foreach ($categoryProducts as $product): ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="/template/images/home/product1.jpg" alt="" />
                                            <h2><?php echo $product['price']; ?>$</h2>
                                            <p><a href="/product/<?php echo $product['id']; ?>">
                                                <span style="color: red;"><?php echo $product['id']; ?></span>, <?php echo $product['name']; ?>
                                            </a></p>
                                            <a href="/cart/add/<?php echo $product['id']; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                            <?php if($product['is_new']): ?>
                                            <img src="/template/images/home/new.png" class="new" alt="">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>

                            <!-- Постраничная навигация -->


                        </div><!--features_items-->
                        <div class="pagination_wrap">
                            <?php echo $pagination->get(); ?>
                        </div>

                        

                    </div>
                </div>
            </div>
        </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>