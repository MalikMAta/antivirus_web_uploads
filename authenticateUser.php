<?php //authenticate.php

//phpinfo();


require_once 'server.php';
require_once 'fatalerror.php';


$conn =  mysqli_connect($servername, $user,$password, $database);

//custom error message "error_connect_error"
if($conn->connect_error)die($conn->error_connect_error);





//authenticate user
if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
{
    
    
    $un_temp = mysql_entities_fix_string($conn, $_SERVER['PHP_AUTH_USER']);
    
    $pw_temp = mysql_entities_fix_string($conn, $_SERVER['PHP_AUTH_PW']);
    
    $query = "SELECT * FROM logers WHERE username = '$un_temp'";
    
    $result = $conn->query($query);
    


if(!$result) die ($conn->error);
    elseif($result->num_rows)

{
        
        //Salt usrername and password
        $row = $result->fetch_array(MYSQLI_NUM);
        $salt1 = "qm&h*";
        $salt2 = "pg!@";
        $token = hash('ripemd128', "$salt1$pw_temp$salt2");
        
        
        if ($token == $row[3])
            session_start();
        $_SESSION['username'] = $un_temp;
        $_SESSION['password'] = $pw_temp;
        $_SESSION['forename'] = $row[0];
        $_SESSION['surname'] = $row[1];
        destroy_session_and_data();
        
            echo "$row[0] $row[1] : hi $row[1], you are now logged in";
        
        
}
    
    else die("invalid username/password combination");

}

    else
        
{  
   header('WWW-Authenticate: Basic realm="Restricted Section"');
   header('HTTP/1.0 401 Unauthorized');
   die ("Please enter your username and password");
        
        
        
}


setcookie('username', "", time() + 60 * 60 * 24 * 7, '/');











echo "<br>";

echo "<br>";

echo "<br>";





echo "<br>";

echo "<br>";

echo "<br>";

//upload file
















// save name of file, and save content of the file
if(isset($_POST['upload']) &&($_FILES)) {
    
    
    
$filecontent = $_FILES['filename']['name'];
   $name = get_post($conn, 'name');
    
       $content = fopen($filecontent, 'r') or die("File does not exist or you lack permission to open it.");

  $text = fread($content, 20);//request to read first 200 characters in the file
    
    
    
    
  echo "$text";  
    
  echo "<br>";
    
    
    
    
    
// get column data 
$compare = "SELECT content FROM fileupload";

    
//comparE data
    $compareresult = mysqli_query($conn, $compare);
        
       $fetch =mysqli_fetch_assoc($compareresult);

echo $fetch['content'];
    
    
    echo "<br>";

    echo "<br>";

    echo "<br>";


//compare and see if the string uploaded is the same as databse
//If the file contains content that is malware
//It will reuturn "This is a malware file"
    if($text === $fetch['content'] ){
        
        
        echo "Malware File";
    }
    else{
        
//If the  content is not a malware file
//upload the content of file to database
        $query = "INSERT INTO fileupload (name, content) VALUES ('$name', '$text')";
    
$result = mysqli_query($conn, $query);
        
       echo  "File Uploaded";
    }
    
    echo "<br>";
    
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


function get_post($conn, $var){
    
    return $conn->real_escape_string($_POST[$var]);
                              }


function destroy_session_and_data() {
    
    $_SESSION = array();
    setcookie(session_name(), '', time() - 2592000, '/');
    
    
    }

//custom error message









//form html
echo <<<_END



<form action="AuthenticateUser.php" method="post" enctype="multipart/form-data">

    Enter the name of the file
<input type = "text" name = "name" pattern="[A-Za-z0-9]{1,20}"
        title="File Name should only contain enlgish letters" >
    
    <input type ="file"  name="filename">
    
    <input type="submit" name="upload" value="upload">

    
</form>


_END


?>
