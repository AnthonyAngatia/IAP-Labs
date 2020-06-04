<?php
include_once 'DBConnector.php';
include_once 'user.php';
include_once 'FileUploader.php';
$con = new DBConnector;

if(isset($_POST['btn-save'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city = $_POST['city_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
//Object for uploading the file
$uploader = new FileUploader;
// $target_directory = $uploader->getTargetDirectory();
$file_type = $_FILES["fileToUpload"]["type"];
$original_name = $_FILES["fileToUpload"]["name"];
$file_size = $_FILES["fileToUpload"]["size"];
$tmp_name =$_FILES["fileToUpload"]["tmp_name"];
$uploader->setOriginalName($original_name);
$uploader->setFileType($original_name);
$uploader->setFileSize($file_size);
$uploader->setTmp_name($tmp_name);

//We should only upload the file if 
$error = "";
$file_upload_response = $uploader->uploadFile();
if($file_upload_response){
    $file_path = $uploader->saveFilePathTo();//File path is taken to the user class to the query statement
    $uploader->moveFile();
    saveToDatabase();
}
else{
    $error = $uploader->getErr_message();
    // echo "Error uploading file.Please ensure the file is an image and of 50KB";
    // echo $error;
    
}
function saveToDatabase(){
    $user = new User($first_name,$last_name,$city, $username,$file_path, $password);
    if(!$user->validateForm()){
        $user->createFormErrorSessions();
        header("Refresh:0");
        die();
    }
    //!IsUserExist comes here
    $res = $user->save();
    //Check if save operation was successful
    if($res){//!This method needs to be altered.
        echo "Save operation successful";   
    }
    else{
        //The file can't be uploaded.
        echo "An error ocurred";
    }
    $con -> closeDatabase();
    }

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
    <p style="color:red "><?php echo $error ?></p>
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>" name="user_details" id="user_details"
        onsubmit="return validateForm()" enctype="multipart/form-data">
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
                <p>Profile image:</p>
                <td> <input type="file" name="fileToUpload" id="fileToUpload"></td>
            </tr>
            <tr>
                <td><button type="submit" name="btn-save">SAVE</button></td>
            </tr>
        </table>
    </form>
</body>

</html>