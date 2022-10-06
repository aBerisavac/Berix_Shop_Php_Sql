<?php

    try{
        require_once("credentials.php");

        $conn = new PDO("mysql:host=$dbServer;dbname=$dbName", $dbUsername, $dbPassword);

        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo("Doslo je do greske pri konekciji sa bazom. Greska je: ".$e->getmessage());
    }

?>