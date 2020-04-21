<?php
include_once 'DBConnector.php';
include_once 'user.php';
$con = new DBConnector;

if(isset($_POST['btn-save'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city = $_POST['city_name'];


$user = new User($first_name,$last_name,$city);
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
</head>

<body>
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
        <table align="center">
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
                <td><button type="submit" name="btn-save">SAVE</button></td>
            </tr>
        </table>
    </form>
</body>

</html>