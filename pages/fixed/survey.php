<div id="surveyIndexWrapper">
    <div id="indexsurveyImg">
        <img src="../../assets/images/survey.png" alt="survey.png"/>
    </div>
    <div id="indexsurveyDescription">
        <div>
            <h3>Help us, help you! </h3>
            <p>Your opinions matter. Tell us about your experiences so that we can better understand your needs and preferences.</p>
            <?php if(isset($_SESSION['user'])): ?> <button type="button" id="indexShowsurvey">Take a vote!</button> <?php endif ?>
            <?php if(!isset($_SESSION['user'])): ?> <button type="button" id="loginToVote">Log in first</button> <?php endif ?>
        </div>
    </div>
</div>