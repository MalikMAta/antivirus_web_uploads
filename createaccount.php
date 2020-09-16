<?php // Createaccount
$servername = "localhost";
$username = "malik";
$password = "mypasswd";
$database ="users";


$conn = new mysqli($servername, $username, $password, $database);if ($conn->connect_error) die($conn->connect_error);

if (isset($_POST['username'])) {
    
    
    $username = mysql_real_escape_string($_POST['username']);
    
    $sql = "INSERT INTO users(username) VALUES ($username)";
    mysqli_query($database, $sql);
    
    
}
    
    
echo <<<_END
    <html>
                <head> </head>
                <body>
                       
                        <form method ="post" action = "createaccount">
                    
                            Pick a username?
                            <input type = "text" name ="username">
                            <input type = "submit">
                    
                
                    </form>
                    
                    


</body>
<html>

_END;



?>
