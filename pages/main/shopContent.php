<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <?php
    $title = "Berix - SHOP";
    $keywords = "berix shop survey clothes programming cart buy register";
    $description = "Choose among the finest ware, fitting all your clothing needs!";
    require_once('../fixed/head.php');
    ?>
</head>

<body>
    <!-- nav -->
    <div id="shoppingPopUp">
        <p>New fancy item added!</p>
    </div>
    <div id="back-to-top"><a href="#"><i class="fas fa-chevron-up"></i></a></div>

    <?php require_once('../fixed/navigation.php'); ?>

    <header>
        <?php require_once('../fixed/carousel.php'); ?>
    </header>
    <main id="shopMain" class="container-fluid">
        <div class="row">

            <aside id="filtersAside" class="col-sm-2 ">
                <form method="get" action="obrada.php" name="filterForma">

                    <div class="filterProducts" id="resetFilter">
                        <h2>Reset</h2>
                        <div class="inputHolder">
                            <div class="col-sm-12"><input type="button" id="reset" name="reset" value="Reset" /></div>
                        </div>
                    </div>

                    <div class="filterProducts" id="priceRange">
                        <h2>Price</h2>
                        <div class="inputHolder">
                            <input type="text" id="amount" readonly>
                        </div>
                        <div class="inputHolder">
                            <div id="slider-range"></div>
                        </div>
                        <div class="inputHolder">
                            <div class="col-sm-10"><label for="onDiscount">On Discount</label></div>
                            <div class="col-sm-2"><input type="checkbox" id="onDiscount" name="onDiscount" value="1" /></div>
                        </div>
                    </div>

                    <div class="filterProducts" id="sort">
                        <h2>Sort By:</h2>
                        <div class="inputHolder">
                            <div class="col-sm-10"><label for="priceAsc">Price Ascending</label></div>
                            <div class="col-sm-2"><input type="radio" id="priceAsc" name="sort" value="priceAsc" /></div>
                        </div>
                        <div class="inputHolder">
                            <div class="col-sm-10"><label for="priceDesc">Price Descending</label></div>
                            <div class="col-sm-2"><input type="radio" id="priceDesc" name="sort" value="priceDesc" /></div>
                        </div>
                        <div class="inputHolder">
                            <div class="col-sm-10"><label for="brandAsc">Brand Name Ascending</label></div>
                            <div class="col-sm-2"><input type="radio" id="brandAsc" name="sort" value="brandAsc" /></div>
                        </div>
                        <div class="inputHolder">
                            <div class="col-sm-10"><label for="brandDesc">Brand Name Descending</label></div>
                            <div class="col-sm-2"><input type="radio" id="brandDesc" name="sort" value="brandDesc" /></div>
                        </div>
                        <div class="inputHolder">
                            <div class="col-sm-10"><label for="ratingAsc">Rating Ascending</label></div>
                            <div class="col-sm-2"><input type="radio" id="ratingAsc" name="sort" value="ratingAsc" /></div>
                        </div>
                        <div class="inputHolder">
                            <div class="col-sm-10"><label for="ratingDesc">Rating Descending</label></div>
                            <div class="col-sm-2"><input type="radio" id="ratingDesc" name="sort" value="ratingDesc" /></div>
                        </div>
                        <div class="inputHolder">
                            <div class="col-sm-10"><label for="default">Default</label></div>
                            <div class="col-sm-2"><input type="radio" id="default" name="sort" checked="checked" value="default" /></div>
                        </div>
                    </div>

                    <div class="filterProducts" id="search">
                        <h2>Search</h2>
                        <div class="inputHolder">
                            <input type="text" id="term">
                        </div>

                    </div>

                    <!-- CATEGORIES -->
                    <div class="filterProducts" id="filterCategories">

                        <div class="row">
                            <h2>Categories:</h2>
                        </div>
                        <?php

                        $query = "SELECT * FROM categories";
                        $result = $conn->query($query);
                        $categories = $result->fetchAll();

                        foreach ($categories as $category) :
                        ?>
                            <div class="inputHolder">
                                <div class="col-sm-10"><label for="<?= $category->id ?>"><?= $category->name ?></label></div>
                                <div class="col-sm-2"><input type="checkbox" id="<?= $category->id ?>" name="<?= $category->id ?>" value="<?= $category->id ?>" /></div>
                            </div>
                        <?php endforeach ?>
                    </div>


                    <!-- BRANDS -->
                    <div class="filterProducts" id="filterBrands">

                        <div class="row">
                            <h2>Brands:</h2>
                        </div>
                        <?php

                        $query = "SELECT * FROM brands";
                        $result = $conn->query($query);
                        $brands = $result->fetchAll();

                        foreach ($brands as $brand) :
                        ?>
                            <div class="inputHolder">
                                <div class="col-sm-10"><label for="<?= $brand->id ?>"><?= $brand->name ?></label></div>
                                <div class="col-sm-2"><input type="checkbox" id="<?= $brand->id ?>" name="<?= $brand->id ?>" value="<?= $brand->id ?>" /></div>
                            </div>
                        <?php endforeach ?>

                    </div>
                </form>
            </aside>

            <div class=col-sm-8>
                <div id="prSize" class="row">
                    <ul>
                        <li data-Id="1">
                            <p>Display size ~</p>
                        </li>
                        <li data-Id="2"><i class="fa-solid fa-bars"></i></li>
                        <li data-Id="3"><i class="fa fa-grip"></i></li>
                    </ul>
                </div>


                <!-- PRODUCTS -->
                <div id="products" class="row">
                    <?php

                    function srcImage($product)
                    {
                        $src = "../../assets/images/Products/" . ($product->gender == "M" ? "Man" : "Woman") . "/" . $product->category_name . "/" . $product->src;
                        return $src;
                        var_dump($src);
                    }

                    function writeStars($stars)
                    {
                        $text = "";
                        for ($i = 0; $i < $stars; $i++) {
                            $text .= '<i class="fa fa-star" aria-hidden="true"></i>';
                        }
                        return $text;
                    }

                    $query = "SELECT *, p.name AS product_name, c.name AS category_name, b.name AS brand_name FROM 
                    ((((
                        products p INNER JOIN 
                        categories c ON p.category_id=c.id) INNER JOIN 
                            brands b ON p.brand_id=b.id) INNER JOIN 
                            prices pr ON p.price_id=pr.id) INNER JOIN 
                            images i ON p.image_id=i.id) 
                            ORDER BY p.id ASC LIMIT 15";

                    $result = $conn->query($query);
                    $products = $result->fetchAll();

                    foreach ($products as $product) :
                    ?>

                            <div class='row'>
                            <div class="col-sm-6">
                                <img src="<?= srcImage($product) ?>" alt="<?= $product->alt ?>" />
                            </div>
                            <div class="col-sm-6">
                                <p class="zvezde"><?= writeStars($product->rating)?></p>
                                <h3><?= $product->brand_name?></h3>
                                <h4><?= $product->product_name?></h4>
                                <h6><?= $product->category_name?></h6>
                                <p><?= $product->new_price?></p>
                                <s><?= $product->old_price != null ? ($product->old_price."$"):""?></s>
                                <input type="button" class="productButton" data-id="<?= $product->id ?>" name="productButton" value="Buy this item" />
                            </div>
                            </div>

                             <?php
                        endforeach;
                        ?>


            </div>

            <div id="pagination" class="row">
                <div>
                    <ul>
                        <?php
                        $query = "SELECT COUNT(*) AS product_number FROM products";
                        $result = $conn->query($query);
                        $numberOfProducts = $result->fetch();

                        $iterations = ceil($numberOfProducts->product_number / 15);

                        for ($i = 0; $i < $iterations; $i++) :
                        ?>
                            <li <?php if ($i == 0) : ?> class="active-pagination" <?php endif ?>><i data-id="<?= $i + 1 ?>" class="fa-solid fa-<?= $i + 1 ?>"></i></li>
                        <?php endfor ?>
                    </ul>
                </div>
            </div>
        </div>

        <aside id="cartAside" class="col-sm-2">



        </aside>

        </div>
    </main>

    <?php require_once('../fixed/scripts.php'); ?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <footer id="contact" class="width">
        <?php require_once('../fixed/footer.php'); ?>
    </footer>
</body>

</html>