<!DOCTYPE html>

<html>

<head>
    <?php
    $title="Berix - AUTHOR";
    $keywords="berix shop programming author web school project";
    $description="A little something about the author.";
    require_once('../fixed/head.php');
    ?>
</head>

<body>
    <!-- nav -->
    <?php require_once('../fixed/navigation.php'); ?>
   
    <header>
        <?php require_once('../fixed/carousel.php'); ?>
    </header>

    <main id="authorMain" class="width">
        <h3>All you need to know about me</h3>
        <img src="../../assets/images/profile.jpg" alt="profil"/>
        <div id="info">
            <p>My name is Aleksa Berisavac. I am currently attending the ICT Academy in Belgrade, orientation internet technologies. I am aspiring to be an accomplished web developer, and am working towards that goal. If you are wondering about my works, you can find them in the <a href="http://beri-portfolio-js-jquery.synergize.co/?i=2#about">Projects</a> section of my portfolio. </p>
        </div>
    </main>
    <?php require_once('../fixed/scripts.php'); ?>

    <footer id="contact" class="width">
        <?php require_once('../fixed/footer.php'); ?>
    </footer>
</body>

</html>