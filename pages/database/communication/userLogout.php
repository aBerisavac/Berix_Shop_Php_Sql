<?php
    session_start();

    session_unset();
    session_destroy();
    
    $index="../../main/indexContent.php";
    header('Location: '.$index);

?>