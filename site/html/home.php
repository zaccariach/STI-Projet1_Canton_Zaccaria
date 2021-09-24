<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 24.09.2021
Filename    : home.php
Description : Homepage for user, display received messages
*/
?>

<?php
//Start the session
session_start();

//Display sessions variables (for information purpose only)
/*
echo "Id       : ".$_SESSION['idUser']."<br/>";
echo "Username : ".$_SESSION['username']."<br/>";
echo "Password : ".$_SESSION['password']."<br/>";
echo "Valide   : ".$_SESSION['isValid']."<br/>";
echo "Admin    : ".$_SESSION['isAdmin']."<br/>";
*/

//Connect to BDD
try{
    $pdo = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage();
    die();
}

//Execute query to get messages
$query = $pdo->prepare('SELECT * FROM Message WHERE receiver = ?');
$query->execute(array($_SESSION['username']));
$messageList = $query->fetchAll();
?>

<html>
<head>
    <style>
        body {
            margin: 0; padding: 0;
        }

        table {
            margin-top: 3%;
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
<?php include 'common/header.php';?>

<table>
    <tr>
        <th>Date</th>
        <th>Expediteur</th>
        <th>Sujet</th>
        <th>Action</th>
    </tr>
    <?php foreach($messageList as $message){?>
    <tr>
        <td><?php echo $message['dateReception'];?></td>
        <td><?php echo $message['sender'];?></td>
        <td><?php echo $message['subject'];?></td>
        <td>
            <p>Repondre</p>
            <p>Supprimer</p>
            <p>Lire</p>
        </td>

    </tr>
    <?php } ?>

</table>
</body>
</html>


