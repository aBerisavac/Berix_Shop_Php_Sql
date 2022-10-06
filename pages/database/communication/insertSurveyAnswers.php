<?php
    session_start();
    include('../connection.php');
    
    function returnError($message, $status){
        header("Content-Type: application/json");
        http_response_code($status);
        echo json_encode(['message' => $message]);
    die();
    }

    
    if (checkIfUserSentNoChoiceAndArray()){
        returnError("You did not send any vote for any surveys!", 422);
    };

    $surveys = $_GET["array"];
    $userId = $_SESSION['user']->id;

    function checkIfUserSentNoChoiceAndArray(){
        if( !isset($_GET["array"]) || empty($_GET["array"] ))
        {
            return true;
        } else{
            return false;
        }
    };

    function checkIfSurveyExistsInDb($surveyId, $conn){

        $query="SELECT * FROM surveys WHERE id=$surveyId";
        $result = $conn->query($query);
        $survey = $result->fetch();

        if($survey) return true; else return false;

    }

    function checkIfChoiceExistsInDb($choiceId, $conn){
        $query="SELECT * FROM choices WHERE id=$choiceId";
        $result = $conn->query($query);
        $choice = $result->fetch();

        if($choice) return true; else return false;
    }

    function checkIfChoiceIsConnectedToSurvey($surveyId, $choiceId, $conn){
        $query="SELECT * FROM choices WHERE id=$choiceId AND survey_id=$surveyId";
        $result = $conn->query($query);
        $connection = $result->fetch();

        if($connection) return true; else return false;
    }

    function checkIfUserAlreadyVoted($userId, $choiceId, $conn){
        $query="SELECT * FROM votes WHERE id=$userId AND choice_id=$choiceId";
        $result = $conn->query($query);
        $connection = $result->fetch();
        
        if(!$connection) return true; else return false;
    }

    foreach($surveys as $survey){
        if (!checkIfSurveyExistsInDb($survey[0], $conn)){
            returnError("You tried to answer a survey that does not exist!", 404);
        };
        if (!checkIfChoiceExistsInDb($survey[1], $conn)){
            returnError("You have chosen something that does not exist!", 404);
        };
        if (!checkIfChoiceIsConnectedToSurvey($survey[0], $survey[1], $conn)){
            returnError("Choice you chose does not correspond to the survey you answered. Please contact administrator.", 422);
        };
        if (!checkIfUserAlreadyVoted($userId, $survey[1], $conn)){
            returnError("You have already voted for one of the surveys!", 422);
        };

        $query="INSERT INTO votes (user_id, choice_id) VALUES (:user_id, :choice_id)";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":user_id", $userId);
        $prepare->bindParam(":choice_id", $survey[1]);
        $prepare->execute();
    }

    header("Content-Type: application/json");
    http_response_code(200);
    echo json_encode(['message' => "You have succesfully voted!"]);
    
?>