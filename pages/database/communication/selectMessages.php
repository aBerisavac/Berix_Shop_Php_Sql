<?php

    include('../connection.php');

    $query = "SELECT * FROM messages";
    $result = $conn->query($query);
    $messages=$result->fetchAll();

    header("Content-Type: application/json");
    if(!$messages){
        http_response_code(404);
        $messages="No messages to show.";
    }
    
    echo json_encode(['messages'=>$messages]);

?>