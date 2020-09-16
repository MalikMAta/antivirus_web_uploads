<?php //antivirus file upload

include("server.php"); 


// set credentials for authentication 
$username = 'admin';
$password = 'letmein'; 



$conn =  mysqli_connect('localhost', 'root', '','user_registration');

if ($conn->connect_error) die ($conn->connect_error);





// save name of file, and save content of the file
if(isset($_POST['upload']) &&($_FILES)) {
    
$name = get_post($conn, 'name');  
$filecontent = $_FILES['filename']['name'];

    
$content = fopen($filecontent, 'r') 
    
    or die
    
    ("File does not exist or you lack permission to open it.");

$text = fread($content, 20);//request to read first 20 characters in the file
    
//$queries = explode(";" , $content); 

//If statemnt if the file is malware do the next line
$query = "INSERT INTO fileupload (name, content) VALUES ('$name', '$text')";
    
$result = mysqli_query($conn, $query);
    
    echo "File Uploaded Succesfuly";
    
    if(!file_exists($_FILES['filename']['name']) || !is_uploaded_file($_FILES['filename']['name'])) 
    {
return false ;   }   
    


    
    
}




function get_post($conn, $var){return $conn->real_escape_string($_POST[$var]);}



echo <<<_END



<form action="antivirus.php" method="post" enctype="multipart/form-data">

    Enter the name of the file
<input type = "text" name = "name" pattern="[A-Za-z0-9]{1,20}"
        title="File Name should only contain enlgish letters" >
    
    <input type ="file"  name="filename">
    
    <input type="submit" name="upload" value="upload">

    
</form>


_END

    
    
    



/*
//Checking whether the file already exists in the destination folder 



$query = "SELECT filename FROM fileupload WHERE filename='$fileName'";	
	$result = $conn->query($query) or die("Error : ".mysqli_error($conn));
	while($row = mysqli_fetch_array($result)) {
		if($row['filename'] == $fileName) {
			$fileExistsFlag = 1;
		}		
	}


//If file is not present in the destination folder

if($fileExistsFlag == 0) { 
		$target = "files/";		
		$fileTarget = $target.$fileName;	
		$tempFileName = $_FILES['Filename']['tmp_name'];
		$fileDescription = $_POST['Description'];	
		$result = move_uploaded_file($tempFileName,$fileTarget);
		/*
		*	If file was successfully uploaded in the destination folder
		
		if($result) { 
			echo "Your file <html><b><i>".$fileName."</i></b></html> has been successfully uploaded";		
			$query = "INSERT INTO fileupload(filepath,filename,description) VALUES ('$fileTarget','$fileName','$fileDescription')";
			$conn->query($query) or die("Error : ".mysqli_error($conn));			
		}
		else {			
			echo "Sorry !!! There was an error in uploading your file";			
		}
		mysqli_close($conn);
	}
	/*
	* 	If file is already present in the destination folder
	
	else {
		echo "File <html><b><i>".$fileName."</i></b></html> already exists in your folder. Please rename the file and try again.";
		mysqli_close($conn);
	}	



echo <<<_END
    
<form method="post" action="Antivirus.php" enctype="multipart/form-data">
    <p>File :</p>
    <input type="file" name="Filename"> 
    <p>Description</p>
    <textarea rows="10" cols="35" name="Description"></textarea>
    <br/>
    <input TYPE="submit" name="upload" value="Submit"/>
</form>

        
_END

    
    
    
*/
/*

if($_FILES){
    
   $name = $_FILES['filename']['name'];

        move_uploaded_file($_FILES['filename']['tmp_name'], $name);
    

echo  "<br>";
    
    $sql = file_get_contents($name);
        
           $queries = explode(";" , $sql); 
    
    
    
      foreach($queries as $sql){
          
          mysqli_query($conn, $sql);
                }
   
    
           if(! $queries )
                            {
                die("Not Completed<br>");
                            }
                    else if($queries == TRUE)
                        
                            echo "Completed<br>";


    
    
    
}








echo <<<_END

<html>
<body>


<div style = "margin-left:725px; margin-top:500px" > 

<form action="" method="POST" enctype="multipart/form-data">

Select File To Upload 


<br>
<br>


<input type="file" name="filename"/>

<input type="submit"/>



</form>
</div>
</html>
</body>

_END;


*/

/*
echo <<<_END
    
<form>


Enter Your Username<br>

<input type="text" nam="username"> 
<input type="submit" name="submit">
<br>

<form>
Enter Your Password<br>

<input type="text" nam="password"> 
<input type="submit" name="submit">
<br>


</form>


_END
    
*/  
    
?>
