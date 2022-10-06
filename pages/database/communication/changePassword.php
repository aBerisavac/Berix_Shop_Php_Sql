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

//da li postoji takav user
$query = "SELECT id, role_id FROM users WHERE email=:email";
$prepare = $conn->prepare($query);
$prepare->bindParam(":email", $email);
$prepare->execute();
$user = $prepare->fetch();


if ($user == false) {
    header("Content-Type: application/json");
    http_response_code(404);
    echo json_encode(['message' => 'User with said email does not exist!']);
    die();
}

$admin="admin";
$query = "SELECT id FROM user_roles WHERE name=:name";
$prepare = $conn->prepare($query);
$prepare->bindParam(":name", $admin);
$prepare->execute();
$adminId = $prepare->fetch();

if ($user->role_id == $adminId->id) {
    header("Content-Type: application/json");
    http_response_code(403);
    echo json_encode(['message' => 'User with said email is an administrator!']);
    die();
}

// $query = "UPDATE users SET password=:password WHERE email=:email";
// $prepare = $conn->prepare($query);
// $prepare->bindParam(":password", $password);
// $prepare->bindParam(":email", $email);
// $prepare->execute();

header("Content-Type: application/json");
http_response_code(200);
echo json_encode(['message' => 'You have changed your password! You can now go back to login. ']);
