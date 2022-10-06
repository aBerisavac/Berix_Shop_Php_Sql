<?php
$getNavItemsQuery = "SELECT * FROM nav_items";
$prepare = $conn->prepare($getNavItemsQuery);
$prepare->execute();
$navItems = $prepare->fetchAll();
if (!isset($_SESSION["user"])) {
    require_once('../fixed/registration/login.php');
    require_once('../fixed/registration/register.php');
    require_once('../fixed/registration/recoverPassword.php');
} else{
        $path=explode("/", $_SERVER["REQUEST_URI"]);
   if(($path[count($path)-1]=="shopContent.php")) require_once('../main/checkout.php');
   if(($path[count($path)-1]=="admin.php")) require_once('../main/insertItemIntoTable.php');
} 
?>
<nav>
    <a href="indexContent.php">
        <div id="logo"><img src="../../assets/images/navLogo.png" /></div>
    </a>
    <div id="navMenu">
        <button id="btnMenu"><i class="fa fa-bars"></i> Menu</button>
        <ul>
            <?php
                $path=explode("/", $_SERVER["REQUEST_URI"]);
            foreach ($navItems as $navItem) :
            ?>

                <?php
                if (isset($_SESSION["user"]) && $navItem->name == "Login") continue;
                if (!isset($_SESSION["user"]) && $navItem->name == "Logout") continue;
                if ((!isset($_SESSION["user"]) || $_SESSION["user"]->role_id!=4) && $navItem->name == "Admin") continue;
                ?>

                <?php 

                if($path[count($path)-1]!=$navItem->href):

                ?>
                <a href="<?= $navItem->href ?>">
                    <li><?= $navItem->name ?></li>
                </a>
            <?php else: ?>

                
                <a href="#">
                    <li><?= $navItem->name ?></li>
                </a>
                
            <?php endif; endforeach ?>
        </ul>
    </div>
</nav>