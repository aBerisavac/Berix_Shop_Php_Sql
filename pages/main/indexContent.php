<!DOCTYPE html>

<html>

<head>
    <?php
    $title="Welcome To Berix";
    $keywords="berix shop survey clothes programming";
    $description="Index page for the beginning of your amasing experience!";

    require_once('../fixed/head.php');
    ?>
</head>

<body>
    <!-- Survey -->
    <?php 
    if (isset($_SESSION["user"])) {
        require_once('../fixed/surveyShow.php'); 
    }
    ?>
    
    <!-- nav -->
    <?php require_once('../fixed/navigation.php'); ?>
   
    <header>
        <?php require_once('../fixed/carousel.php'); ?>
    </header>

    <main>
    <?php require_once('../fixed/survey.php'); ?>
    <div id="indexContent">
        <h3>From rustic vests to slim jeans, you will immerse yourself in our clothing for hours.</h3>
        <p>Berix is the #1 shop for all your outfitting needs. Keep your track with the times with our help, and in no time you will shine like a star.</p>
        <a href="shopContent.php"><p>Start now!</p></a>
    </div>
    </main>
    <?php require_once('../fixed/scripts.php'); ?>

    <footer id="contact" class="width">
        <?php require_once('../fixed/footer.php'); ?>
    </footer>
</body>

</html>