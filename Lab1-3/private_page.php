<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Page</title>
</head>

<body>
    <p>This is a pricate page</p>
    <p>We want to protect it</p>
    <p><a href="logout.php">Logout.php</a></p>

</body>

</html>
