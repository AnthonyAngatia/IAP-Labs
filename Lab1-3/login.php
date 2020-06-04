<?php 
include_once 'DBConnector.php';
include_once 'user.php';

$con = new DBConnector;
if(isset($_POST['btn-login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $instance = User::create();
    $instance->setPassword($password);
    $instance->setUsername($username);

    if($instance->isPasswordCorrect()){
        $instance->login();
        //close db
        $con->closeDatabase();
        //create a user session
        $instance->createUserSession();
    }
    else{
        $con->closeDatabase();
        header("Location:login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="login" id="login">
        <table align="center">
            <tr>
                <td>
                    <input type="text" name="username" placeholder="Username" required></td>
            </tr>
            <tr>
                <td><input type="password" name="password" placeholder="Password" required></td>
            </tr>
            <tr>
                <td><button type="submit" name="btn-login"><strong>LOGIN</strong></button></td>
            </tr>
        </table>
    </form>
</body>

</html>