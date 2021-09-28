<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 28.09.2021
Filename    : addUser.php
Description : Page for adding a new user on mailbox
*/
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false){
    header('location: login.php');
}
include("common/dbConnect.php");

$user = $password = $isActive = $isAdmin = "";
$msgError = false;
/* Checking form */
if(isset($_POST['submitUser'])){
    /* Checking if user exists and add user and password on variable */
    $checkuser = $pdo->query("SELECT * FROM User WHERE username=\"".$_POST['username']."\"")->fetch();
    if(!empty($_POST['username'])){
        if(!$checkuser){
            if(!empty($_POST['password'])){
                $user = $_POST['username'];
                $password = $_POST['password'];
            } else {
                $msgError = true;
            }
        } else{
            $msgError = true;
        }
    } else{
        $msgError = true;
    }

    $isActive = $_POST['isActive'];
    $isAdmin = $_POST['isAdmin'];

    /* If all infos are insered, we try to add in db */
    if(!($msgError)){
        try{
            $pdo->query("INSERT INTO User (username, password, isValid, isAdmin) VALUES ('".$user."','".$password."','".$isActive."','".$isAdmin."')")->fetch();
            $_SESSION['userAdded'] = true;
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    else{
        $_SESSION['userAdded'] = false;
    }
    header('location: usersManager.php');
}

include('common/header.php');
?>
<br>
    <div class="text-center">
        <form class="mx-5 px-2">
            <div class="form-row">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Nom d'utilisateur">
            </div>
            <div class="form-row">
                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
            </div>
            <div class="form-row">
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="inactiveUser" name="isActive" value="0" checked>
                    <label class="form-check-label" for="validN">Compte inactif</label><br>
                    <input type="radio" class="form-check-input" id="activeUser" name="isActive" value="1">
                    <label class="form-check-label" for="validY">Compte actif</label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="roleCollaborateur" name="isAdmin" value="0" checked>
                    <label class="form-check-label" for="roleC">Collaborateur</label>
                    <input type="radio" class="form-check-input" id="roleAdministrateur" name="isAdmin" value="1">
                    <label class="form-check-label" for="roleA">Administrateur</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" formmethod="post" name="submitUser">Ajouter l'utilisateur</button>
            <a href="usersManager.php" class="btn btn-primary" role="button">Annuler</a>
        </form>
    </div>
<?php include('common/footer.php');?>