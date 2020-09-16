<?php

$conn =  mysqli_connect('localhost', 'root', '','user_registration');




if ($conn->connect_error) die ($conn->connect_error);


if(isset($_POST['add']) && [$_FILES]) {
    
    $name = get_post($conn, 'name');
   

    
$query = "INSERT INTO fileupload (name) VALUES
   ('$name' )";
    
$result = mysqli_query($conn, $query);
 
                     
}



function get_post($conn, $var){return $conn->real_escape_string($_POST[$var]);}




echo <<<_END

<form action="test.php" method="post ">

    Enter the name of the file
    <input type = "text" name = "name">
    
    <input type="submit" name="add" value="add">
    
</form>

_END
    
?>
