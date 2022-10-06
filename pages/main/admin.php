<!DOCTYPE html>
<!DOCTYPE html>

<html>

<head>
    <?php
    $title="Admin Panel";
    $keywords="berix shop programming web school project admin insert update delete";
    $description="Edit database.";
    require_once('../fixed/head.php');
    ?>
</head>

<body>
    <!-- nav -->
    <?php require_once('../fixed/navigation.php'); ?>
   
    <header>
    </header>
<main id="adminMain" class="width">
    <div id="userMessages">
    </div>

    <div id="tablesWrapper">
        <div id="selectTableToShow">
            <select>
                <option value="default">Select table to show:</option>
                <?php
                    $tables = ["users", "products", "messages", "surveys", "choices", "categories", "brands", "nav_items", "images", "prices", "user_roles", "votes", "footer_pic_elements", "carousel_pics"];

                    foreach($tables as $table):
                ?>
                <option value="<?= $table?>"><?= ucfirst($table)?></option>
                <?php endforeach ?>
            </select>
        </div>

        <span id="isDeleted"></span>
        <div id="tableInformationWrapper">
        </div>

    </div>
</main>
    <?php require_once('../fixed/scripts.php'); ?>

    <footer id="contact" class="width">
        <?php require_once('../fixed/footer.php'); ?>
    </footer>
</body>