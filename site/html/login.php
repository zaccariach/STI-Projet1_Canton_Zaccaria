<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 23.09.2021
Filename    : login.php
Description : Login page
*/
?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 0;}
        form {margin-left: 20%; margin-right: 20%; margin-top:5%; border: 3px solid #f1f1f1;}

        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #01579b;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.9;
        }

        .container {
            padding: 16px;
        }

        .errorMsg{
            color: red;
            text-align: center;
            margin-top: 5%;
        }
    </style>
</head>

<?php
//Start the session
//session_start();

//Connect to BDD
try{
    $pdo = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage();
    die();
}

//Variable for error message
$message = "";

//If form is submit
if (isset($_POST["login"])) {

    //Get informations from login form
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Execute query to get account's informations
    $query = $pdo->prepare('SELECT * FROM User WHERE username = ? AND password = ?');
    $query->execute(array($username,$password));
    $loginResult = $query->fetchAll();

    //Check if there is an existing account
    if (!empty($loginResult)) {
        //Check if account is active
        if($loginResult[0]['isValid'] == 0){
            $message = "Erreur : Ce compte est inactif, veuillez contacter un administrateur";
        }
        else{
            //Put user infos in sessions variables
            $_SESSION['idUser']   = $loginResult[0]['idUser'];
            $_SESSION['username'] = $loginResult[0]['username'];
            $_SESSION['password'] = $loginResult[0]['password'];
            $_SESSION['isValid']  = $loginResult[0]['isValid'];
            $_SESSION['isAdmin']  = $loginResult[0]['isAdmin'];

            //Redirect to homepage for user
            header('Location: home.php');
        }
    }
    else{
        $message = "Erreur : Nom ou mot de passe incorrect";
    }
}
?>

<body>
<?php include 'common/header.php';?>

<form method="post">
    <div class="container">
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Username" name="username" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Password" name="password" required>

        <button type="submit" name="login">Login</button>
    </div>
</form>
<div class="errorMsg"><?php echo $message;?></div>
</body>
</html>