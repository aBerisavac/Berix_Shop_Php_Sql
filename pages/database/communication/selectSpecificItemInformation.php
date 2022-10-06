<?php

$table = $_GET["table"];
$id = $_GET["id"];

include('../connection.php');

//za tabele koje nisu povezane sa drugima
$query = "SELECT * FROM" . $table;

//za proizvode

try {

    if ($table == "products") {
        $query = "SELECT p.id, p.name AS product_name, pr.new_price, pr.old_price, c.id, c.name AS category_name, b.id, b.name AS brand_name, i.id, i.src, i.alt, p.rating, p.gender FROM 
        ((((
            products p INNER JOIN 
            categories c ON p.category_id=c.id) INNER JOIN 
            brands b ON p.brand_id=b.id) INNER JOIN 
            prices pr ON p.price_id=pr.id) INNER JOIN 
            images i ON p.image_id=i.id)
            WHERE p.id=" . $id . "
            ";

        try {
            $prepare = $conn->query($query);
            $item = $prepare->fetch();

            $query = "SELECT c.name FROM categories c";

            //kategorije za ispis
            try {
                $prepare = $conn->query($query);
                $categories = $prepare->fetchAll();
            } catch (Exception $e) {
                header("Content-Type: application/json");
                http_response_code(404);
                echo json_encode(["message" => "There was an error with your request."]);
            }

            $query = "SELECT b.name FROM brands b";

            //brendovi za ispis
            try {
                $prepare = $conn->query($query);
                $brands = $prepare->fetchAll();
            } catch (Exception $e) {
                header("Content-Type: application/json");
                http_response_code(404);
                echo json_encode(["message" => "There was an error with your request."]);
            }


            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode(["item" => $item, "categories" => $categories, "brands" => $brands,]);
        } catch (Exception $e) {
            header("Content-Type: application/json");
            http_response_code(404);
            echo json_encode(["message" => "There was an error with your request."]);
        }
    }else

    if ($table == "choices") {
        $query = "SELECT c.id, s.name AS survey_name, c.name AS choice_name FROM
            (choices c INNER JOIN surveys s ON c.survey_id=s.id )
            ";
    } else

    if ($table == "votes") {
        $query = " SELECT v.id, u.email, c.name AS vote, s.name AS survey FROM
            (((votes v INNER JOIN
            users u ON v.user_id=u.id) INNER JOIN
            choices c ON v.choice_id=c.id) INNER JOIN
            surveys s ON c.survey_id=s.id)
            ";
    } else{



    $prepare = $conn->query($query);
    $tableInformation = $prepare->fetchAll();

    if (count($tableInformation) == 0) $tableInformation = false;

    header("Content-Type: application/json");
    echo json_encode(["item" => $tableInformation]);
}
} catch (Exception $e) {
    header("Content-Type: application/json");
    http_response_code(404);
    echo json_encode(["message" => "There was an error with your request."]);
}
