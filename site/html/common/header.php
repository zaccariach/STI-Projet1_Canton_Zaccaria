<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 24.09.2021
Filename    : header.php
Description : Header
*/
?>

<?php
$connect = false;

if(session_status() != PHP_SESSION_NONE){
    $connect = true;
}
?>

<style>
    .headerBox {
        width: 100%;
        padding: 20px;
        display: flex;
        background-color: #212121;
    }

    a {
        text-decoration: none;
        color: #f1f1f1;
    }
</style>

<div class="headerBox">
    <?php
    if($connect){
        echo "<a href='common/logout.php'>Logout</a>";
    }
    ?>
</div>
