<div id="showsurvey" class="allScreenPopUp">
    <div class="credentialWrapper">

        <h4>Here are some questions for you: </h4>
        <div id="surveysHolder">
            <?php

                $query = "SELECT * FROM surveys WHERE active=true";
                $result = $conn->query($query);
                $surveys = $result->fetchAll();

                $query = "SELECT * FROM surveys s INNER JOIN choices c ON s.id=c.survey_id WHERE s.active=true";
                $result = $conn->query($query);
                $choices = $result->fetchAll();

                $query = "SELECT * FROM votes WHERE user_id=".$_SESSION['user']->id;
                $result = $conn->query($query);
                $votes = $result->fetchAll();

                foreach($surveys as $survey){

                    $didNotVote=true;
                    if(count($votes)>0){
                        foreach($votes as $vote){
                            
                            if ($vote->user_id==$_SESSION['user']->id){
                                $voteSurvey=null;
                                foreach($choices as $choice){
                                    if($choice->id==$vote->choice_id) $voteSurvey=$choice->survey_id;
                                }
                                if($survey->id==$voteSurvey){
                                    $didNotVote=false;
                                    break;
                                }
                            } 
                        }
                    }

                    if(!$didNotVote) continue;
                    $idsurvey=$survey->id;
                    $namesurvey=$survey->name;

                    echo("<label for='$idsurvey'>$namesurvey</label>");
                    echo("<select name='$idsurvey'>");
                    echo("<option value='0'>Choose  </option>");

                        foreach($choices as $choice){

                            $idChoice=$choice->id;
                            if($survey->id!=$choice->survey_id) continue;

                            $nameChoice=$choice->name;
                            echo("<option value='$idChoice'>$nameChoice</option>");
                        }
                    echo("</select><hr/>");
                }

            ?>
        </div>
        
        <div class="buttonContainer"><span id="isSurveyDataValid"></span>
                <button type="button" id="submitSurveyAnswers">Submit</button>
            </div>
        <div class="buttonContainer">
                <button type="button" class="backToMain">Return</button>
            </div>
        </div>
</div>