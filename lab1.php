<?php
include_once 'DBConnector.php';
include_once 'user.php';
$con = new DBConnector;

if(isset($_POST['btn-save'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city = $_POST['city_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];


$user = new User($first_name,$last_name,$city, $username, $password);
if(!$user->validateForm()){
    $user->createFormErrorSessions();
    header("Refresh:0");
    die();
}
//!IsUserExist comes here
$res = $user->save();

if($res){
    echo "Save operation successful";
    
}
else{
    echo "An error ocurred";
}
$con -> closeDatabase();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My WebApp</title>
    <script type="javascript" src="validate.js"></script>
    <link rel="stylesheet" href="validate.css">
</head>

<body>
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>" name="user_details" id="user_details"
        onsubmit="return validateForm()">
        <table align="center">
            <tr>
                <td>
                    <div id="form-errors">
                        <?php
                    session_start();
                    if(!empty($_SESSION['form_errors'])){
                        echo " ".$_SESSION['form_errors'];
                        unset($_SESSION['form_errors']);
                    }
                ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td><input type="text" name="first_name" placeholder="First Name" required></td>
            </tr>
            <tr>
                <td><input type="text" name="last_name" placeholder="Last Name"></td>
            </tr>
            <tr>
                <td><input type="text" name="city_name" placeholder="City "></td>
            </tr>
            <tr>
                <td><input type="text" name="username" placeholder="Username"></td>
            </tr>
            <tr>
                <td><input type="password" name="password" placeholder="Password"></td>
            </tr>
            <tr>
                <td><button type="submit" name="btn-save">SAVE</button></td>
            </tr>
        </table>
    </form>
</body>

</html>