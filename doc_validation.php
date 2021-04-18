<?php

include_once('connection.php');
session_start();
function test_input($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"]== "POST") {

    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $stmt = $conn->prepare("SELECT * FROM doctor");
    $stmt->execute();
    $users = $stmt->fetchAll();

    foreach($users as $user) {

        if(($user['username'] == $username) &&
            ($user['password'] == $password)) {
              $_SESSION["username"] = $user["username"];
              header("Location: index.php");
        }
    }
        echo "<script language='javascript'>";
        echo "alert('WRONG PASSWORD')";
        echo "</script>";
        die();
}

?>
