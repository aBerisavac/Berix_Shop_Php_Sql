<?php 

    $errors= [];

    function returnErrors($errors){
        header("Content-Type: application/json");
        echo json_encode($errors);
    }

    //provera postojanja poruke

    if(!isset($_GET['message'])||empty($_GET['message'])){
        array_push($errors, "Poruka nije setovana!");
        returnErrors($errors);
    } else{

        $message=$_GET['message'];
        if(strlen($message)>500){
            array_push($errors, "Poruka ne sme biti duza od 500 karaktera!!");
            returnErrors($errors);
        }

        $message=addslashes($message);


    }

    //provera imena posiljaoca

    $reIme = "/^[A-Z][a-z]{1,11}(\s[A-Z][a-z]{1,11}){1,2}/";

    $name=null;
    $first_name=null;
    $last_name=null;
    $middle_name=null;

    if(isset($_GET['full_name'])&&!empty($_GET['full_name'])){
        $name = $_GET['full_name'];
        
        if(!preg_match($reIme, $name)){
            array_push($errors, "Ime, ako postoji, mora biti ispravno uneto!");
            returnErrors($errors);
        }

        $names = explode(" ", $name);
        $first_name=addslashes($names[0]);
        $last_name=addslashes($names[1]);
        $middle_name==null?null:addslashes($names[2]);
    } 


    //provera broja telefona

    $reBroj = "/(^\+[\d]{10,13})|(^\+[\d]{3,5}(\s\d{2,4}){1,4})/";
    $phone_number=null;

    if(isset($_GET['phone_number'])&&!empty($_GET['phone_number'])){
        $phone_number = $_GET['phone_number'];
        
        if(!preg_match($reBroj, $phone_number)){
            array_push($errors, "Broj nije ispravno unet");
            returnErrors($errors);
        }

        $phone_number = addslashes($phone_number);
    } 

    //provera emaila

    $reMail = "/^\S{1,15}@\S{1,15}$/";
    $email=null;

    if(isset($_GET['email'])&&!empty($_GET['email'])){
        $email = $_GET['email'];
        
        if(!preg_match($reMail, $email)){
            array_push($errors, "Email nije ispravno unet");
            returnErrors($errors);
        }

        $email = addslashes($email);
    }

    include('../connection.php');

    $query = "INSERT INTO messages (email, message, first_name, last_name, middle_name, phone_number) VALUES(:email, :message, :first_name, :last_name, :middle_name, :phone_number)";
    $prepare=$conn->prepare($query);
    $prepare->bindParam(':email', $email);
    $prepare->bindParam(':message', $message);
    $prepare->bindParam(':first_name', $first_name);
    $prepare->bindParam(':last_name', $last_name);
    $prepare->bindParam(':middle_name', $middle_name);
    $prepare->bindParam(':phone_number', $phone_number);

    $prepare->execute();

    header("Content-Type: application/json");
    echo json_encode(["poruka"=>"Uspesno uneta poruka u bazu!"]);
