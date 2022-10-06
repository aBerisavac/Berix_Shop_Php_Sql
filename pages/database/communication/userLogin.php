<?php

    session_start();

    $errors= [];

    function returnErrors($errors){
        $message="";
        foreach($errors as $error){
            $message.=$error." ";
        }

        header("Content-Type: application/json");
        http_response_code(422);
        echo json_encode(["message" => $message]);
        die();
    }

     //provera emaila

     $reMail = "/^\S{1,15}@\S{1,15}$/";
     $email=null;
 
     if(isset($_POST['email'])&&!empty($_POST['email'])){
         $email = $_POST['email'];
         
         if(!preg_match($reMail, $email)){
             array_push($errors,"Email must be inserted correctly!");
         } {
 
         $email = addslashes($email);
     }
     } else {
         array_push($errors, "Email must be inserted!");
     }
 
      //provera passworda
 
      $rePassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/"; 
      $password=null;
  
      if(isset($_POST['password'])&&!empty($_POST['password'])){
          $password = $_POST['password'];
          
          if(!preg_match($rePassword, $password)){
              array_push($errors, "Password must be inserted correctly!");
          }else{
             $password = addslashes(md5($password));
         }
      } else {
          array_push($errors, "Password must be inserted!");
      }
  
      if(count($errors)>0) returnErrors($errors);

    //query

    include('../connection.php');

     $query= "SELECT * FROM users WHERE email=:email AND password=:password";
     $prepare=$conn->prepare($query);
     $prepare->bindParam(":email", $email);
     $prepare->bindParam(":password", $password);
     $prepare->execute();
     $user=$prepare->fetch();

     if($user!=false){

        $_SESSION["user"]=$user;

        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode(['message' => 'Login is successfull! You will be redirected soon.  ', 'user' => $user]);
        die();
     } else{
         header("Content-Type: application/json");
         http_response_code(404);
         echo json_encode(['message' => 'Login is unsuccessfull!']);
     }

?>