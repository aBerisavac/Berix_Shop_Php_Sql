<?php

$table=$_GET["table"];
$id=$_GET["id"];


include("../connection.php");

$query="DELETE FROM ".$table." WHERE id=:id";
$prepare=$conn->prepare($query);
$prepare->bindParam(":id",  $id);

try{
    $prepare->execute();
    
    header("Content-Type: application/json");
    echo json_encode(["message"=>"Success!"]);
}
catch(PDOException $e){
    
    header("Content-Type: application/json");
    http_response_code(404);
    echo json_encode(["message"=>"There was an error with your request. This item might be referenced by another from different table or the item might not exist in database."]);

}

?>