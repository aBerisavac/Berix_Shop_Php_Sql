<?php

include("../connection.php");

$productsToShowOnPage= $_GET["displayMethod"]==2?6:15;
if($_GET["pagination"]>4&&$productsToShowOnPage==15) $_GET["pagination"]=1;

function getAllProductsSorted()
{

    global $conn;
    $sortType=$_GET['sort'];
    $value = null;
    $type =null;

    $query = "SELECT *, p.name AS product_name, c.name AS category_name, b.name AS brand_name FROM 
        ((((
            products p INNER JOIN 
            categories c ON p.category_id=c.id) INNER JOIN 
            brands b ON p.brand_id=b.id) INNER JOIN 
            prices pr ON p.price_id=pr.id) INNER JOIN 
            images i ON p.image_id=i.id)";


    $prepare = $conn->prepare($query);

    
    $prepare->execute();
    $products = $prepare->fetchAll();

    function strCmpGreater($a, $b) {
        return strcmp($a->name, $b->name);
    }

    function strCmpLesser($a, $b) {
        return -strcmp($a->name, $b->name);
    }

    function valueGreater($a, $b){
        return $a->new_price>$b->new_price?1:-1;
    }

    function valueLesser($a, $b){
        return $a->new_price<$b->new_price?1:-1;
    }

    function ratingGreater($a, $b){
        return $a->rating>$b->rating?1:-1;
    }

    function ratingLesser($a, $b){
        return $a->rating<$b->rating?1:-1;
    }

    if ($sortType=="default"){
        $products=$products;
    } else if($sortType=="priceAsc"){
        usort($products, "valueGreater");
    }else if($sortType=="priceDesc"){
        usort($products, "valueLesser");
    }else if($sortType=="brandAsc"){
        usort($products, "strCmpGreater");
    }else if($sortType=="brandDesc"){
        usort($products, "strCmpLesser");
    }else if($sortType=="ratingAsc"){
        usort($products, "ratingGreater");
    }else if($sortType=="ratingDesc"){
        usort($products, "ratingLesser");
    };

    return $products;
}

$products = getAllProductsSorted();


//FILTRIRANJE PO KATEGORIJAMA

function filterProductsByCategories($products){
    $arrOfCategoriesToFilter = explode(",", $_GET["categories"]);
    
    $helpingArray=[];

    foreach($products as $product){
        if(in_array($product->category_id, $arrOfCategoriesToFilter)){
            array_push($helpingArray, $product);
        }
    }

    return $helpingArray;
    
}

if($_GET["categories"]!=""){
    $products = filterProductsByCategories($products);
}

//FILTRIRANJE PO BRENDOVIMA

function filterProductsByBrands($products){
    $arrOfBrandsToFilter = explode(",", $_GET["brands"]);
    
    $helpingArray=[];

    foreach($products as $product){
        if(in_array($product->brand_id, $arrOfBrandsToFilter)){
            array_push($helpingArray, $product);
        }
    }

    return $helpingArray;
    
}

if($_GET["brands"]!=""){
    $products = filterProductsByBrands($products);
}

//FILTRIRANJE PO TERMINU PRETRAGE

function filterProductsByTerm($products){
    $helpingArray=[];
    $searchTerm = $_GET["searchTerm"];

    foreach($products as $product){
        if(strpos(strtolower($product->product_name) , strtolower($searchTerm))){
            array_push($helpingArray, $product);
        }
    }

    return $helpingArray;
}

if($_GET["searchTerm"]!=""){
    $products = filterProductsByTerm($products);
}

//FILTRIRANJE PO POPUSTU (samo oni na popustu se prikazuju)

function filterProductsByDiscount($products){
    $helpingArray=[];

    foreach($products as $product){
        if($product->old_price){
            array_push($helpingArray, $product);
        }
    }

    return $helpingArray;
}

if($_GET['onDiscount']=="true"){
    $products=filterProductsByDiscount($products);
}

//FILTRIRANJE PO SLAJDERU

function filterProductsBySlider($products){
    $values = explode(",", $_GET['slider']);
    $helpingArray=[];

    foreach($products as $product){
        if($product->new_price>$values[0] && $product->new_price<$values[1]){
            array_push($helpingArray, $product);
        }
    }

    return $helpingArray;
}

if($_GET['slider']!=""){
    $products = filterProductsBySlider($products);
}



//PAGINATION - RADI SE NA KRAJU POSLE SVIH FILTERA!

function paginateProducts($products)
{
    global $productsToShowOnPage;
    $page = $_GET["pagination"];
    $startingProductToShow = $page * $productsToShowOnPage -$productsToShowOnPage;
    $helpingArray = [];
    $lastProductToShow = ((count($products) - $productsToShowOnPage * ($page-1)) > $productsToShowOnPage) ? $page * $productsToShowOnPage : count($products);

    for ($i = $startingProductToShow; $i < $lastProductToShow; $i++) {
        array_push($helpingArray, $products[$i]);
    }

    return $helpingArray;
}


$totalNumberOfProducts = count($products);
if($products){
    $products = paginateProducts($products);
}
header("Content-Type: application/json");
echo json_encode(["products" => $products, "numberOfProducts"=> $totalNumberOfProducts]);
