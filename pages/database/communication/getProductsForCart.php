<?php

include("../connection.php");

$productIds=$_GET['productIds'];
$inStatement = "";

for($i=0;$i<count($productIds);$i++){
    $i==0?$inStatement.=$productIds[$i]:$inStatement.=", ".$productIds[$i];
}

$query="SELECT *, p.name AS product_name, c.name AS category_name, b.name AS brand_name FROM 
((((
    products p INNER JOIN 
    categories c ON p.category_id=c.id) INNER JOIN 
    brands b ON p.brand_id=b.id) INNER JOIN 
    prices pr ON p.price_id=pr.id) INNER JOIN 
    images i ON p.image_id=i.id)
    WHERE p.id IN (".$inStatement.")
    ";

$result = $conn->query($query);
$products=$result->fetchAll();

header("Content-Type: application/json");
echo json_encode(["products"=>$products]);
?>