<?php
session_start();
include('../connection.php');

$errors = [];

function returnErrors($errors)
{
    $message = "";
    foreach ($errors as $error) {
        $message .= $error . " ";
    }

    header("Content-Type: application/json");
    http_response_code(422);
    echo json_encode(["message" => $message]);
    die();
}

//provera imena korisnika

$reIme = "/^[A-Z][a-z]{1,11}(\s[A-Z][a-z]{1,11}){1,2}/";

$name = null;
$first_name = null;
$last_name = null;
$middle_name = null;

if (isset($_POST['full_name']) && !empty($_POST['full_name'])) {
    $name = $_POST['full_name'];

    if (!preg_match($reIme, $name)) {
        array_push($errors, "Name must be inserted correctly!");
    } else {
        $names = explode(" ", $name);
        $first_name = addslashes($names[0]);
        $last_name = addslashes($names[1]);
        $middle_name == null ? null : addslashes($names[2]);
    }
} else {
    array_push($errors, "Name must be inserted!");
}

//provera broja telefona

$reBroj = "/(^\+[\d]{10,13})|(^\+[\d]{3,5}(\s\d{2,4}){1,4})/";
$phone_number = null;

if (isset($_POST['phone_number']) && !empty($_POST['phone_number'])) {
    $phone_number = $_POST['phone_number'];

    if (!preg_match($reBroj, $phone_number)) {
        array_push($errors, "Phone must be inserted correctly, or not inserted at all!");
    } else {
        $phone_number = addslashes($phone_number);
    }
}

//provera emaila

$reMail = "/^\S{1,15}@\S{1,15}$/";
$email = null;

if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email'];

    if (!preg_match($reMail, $email)) {
        array_push($errors, "Email must be inserted correctly!");
    } {

        $email = addslashes($email);
    }
} else {
    array_push($errors, "Email must be inserted!");
}

//provera passworda

$rePassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
$password = null;

if (isset($_POST['password']) && !empty($_POST['password'])) {
    $password = $_POST['password'];

    if (!preg_match($rePassword, $password)) {
        array_push($errors, "Password must be inserted correctly!");
    } else {
        $password = addslashes(md5($password));
    }
} else {
    array_push($errors, "Password must be inserted!");
}

if (count($errors) > 0) returnErrors($errors);

//da li vec postoji takav user
$query = "SELECT id FROM users WHERE email=:email";
$prepare = $conn->prepare($query);
$prepare->bindParam(":email", $email);
$prepare->execute();
$exists = $prepare->fetch();

if ($exists != false) {
    header("Content-Type: application/json");
    http_response_code(409);
    echo json_encode(['message' => 'User with said email already exists!']);
    die();
}
$user="user";

$query="SELECT id FROM user_roles WHERE name=:name";
$prepare = $conn->prepare($query);
$prepare->bindParam(":name", $user);
$prepare->execute();
$role_id=$prepare->fetch();
$role_id=$role_id->id;


$query = "INSERT INTO users (role_id, email, password, first_name, last_name, middle_name, phone_number) VALUES(:role_id, :email, :password, :first_name, :last_name, :middle_name, :phone_number)";
$prepare = $conn->prepare($query);
$prepare->bindParam(':email', $email);
$prepare->bindParam(':password', $password);
$prepare->bindParam(':first_name', $first_name);
$prepare->bindParam(':last_name', $last_name);
$prepare->bindParam(':middle_name', $middle_name);
$prepare->bindParam(':phone_number', $phone_number);
$prepare->bindParam(':role_id', $role_id);

$prepare->execute();

header("Content-Type: application/json");
http_response_code(200);
echo json_encode(["message" => "Successfull registration!"]);
