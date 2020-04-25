<?PHP
include_once 'DBConnector.php';
include_once 'city.php';
// print_r($_POST);
if(isset($_POST['btn-get'])){//When you click get execyte this
    $id = $_POST['id'];

    $city = new City($id);
    $result = $city -> read();//calls the function read in the city page

    $rowData = array();
    if (mysqli_num_rows($result) > 0) {//check if result return number of rows greater than zero
        while ($row = $result->fetch_assoc()) {
            $rowData[] = $row;//Put the data in an array
        }
    }
    echo "<pre>";

    print_r($rowData);//Print the data gotten
    
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label for="id">Select your id no of choice</label>
        <select name="id" id="xxx">
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12++</option>
        </select>
        <button type="submit" name="btn-get">GET</button>
    </form>
</body>

</html>