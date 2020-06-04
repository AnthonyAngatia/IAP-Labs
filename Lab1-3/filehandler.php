<?php
if(isset($_POST["submit"])){
    echo "<pre>";
    print_r($_FILES);
    print_r($_FILES["fileToUpload"]["name"]);
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    echo $target_file;
    echo " <br>";
    $path = $_FILES['fileToUpload']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);
echo  $ext;
  

}



?>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>