<?php //authenticateAdmin.php

//phpinfo();

include 'fatalerror.php';
require_once 'server.php';

$conn =  mysqli_connect($servername, $user,$password, $database);

//custom error message "error_connect_error"

if($conn->connect_error)die($conn->error_connect_error);


//admin credentials
$username = "admin";
$password = "password";





//Authenticate Admin
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))

{
        if ($_SERVER['PHP_AUTH_USER'] == $username && $_SERVER['PHP_AUTH_PW'] == $password)
            
            
            
            echo "You are now logged in";
    
    
            else die("Invalid username / password combination");
}


            else
        
{
            header('WWW-Authenticate: Basic realm="Restricted Section"');
            header('HTTP/1.0 401 Unauthorized');
            die ("Please enter your username and password");


}
setcookie('username', "Admin", time() + 60 * 60 * 24 * 7, '/');



//file upload
// save name of file, and save content of the file
if(isset($_POST['upload']) &&($_FILES)) {
    
    
$filecontent = $_FILES['filename']['name'];
   $name = get_post($conn, 'name');
    
     $content = fopen($filecontent, 'r') or die("File does not exist or you lack permission to open it.");

  $text = fread($content, 20);//request to read first 20 characters in the file
    
    
        
   
//$queries = explode(";" , $content); 

//If statemnt if the file is malware do the next line
$query = "INSERT INTO fileupload (name, content) VALUES ('$name', '$text')";
    
$result = mysqli_query($conn, $query);
    echo "<br>";
    echo "File Uploaded Succesfuly";
    
    if(!file_exists($_FILES['filename']['name']) || !is_uploaded_file($_FILES['filename']['name'])) 
    {
return false ;   }   
    


     if (flock($content, LOCK_EX)){
        
        fseek($content, 0, SEEK_END);
        
            fwrite($content, "$text") or die("Could not write to file");
        
              fflush($fp);
                  
                  flock($content, LOCK_UN);
    
    }
    
    
}
    










$conn->close();




function mysql_entities_fix_string($conn, $string) 
{
    
    return htmlentities(mysql_fix_string($conn, $string));

}


function mysql_fix_string($conn, $string) 
{
if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return $conn->real_escape_string($string);
}


function get_post($conn, $var){return $conn->real_escape_string($_POST[$var]);}




function destroy_session_and_data() {
    
    $_SESSION = array();
    setcookie(session_name(), '', time() - 2592000, '/');
    
    
    }









//form html
echo <<<_END



<form action="authenticateAdmin.php" method="post" enctype="multipart/form-data">

    Enter the name of the file
<input type = "text" name = "name" pattern="[A-Za-z0-9]{1,20}"
        title="File Name should only contain enlgish letters" >
    
    <input type ="file"  name="filename">
    
    <input type="submit" name="upload" value="upload">

    
</form>
    

_END
    
    

?>
