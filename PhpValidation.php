<?php
      
      
          





// The username can contain English letters (capitalized or not), digits, and the charaters '_' (underscore) and '-' (dash). Nothing else. Also, it cannot be empty or just "empty spaces".
function validate_username($field)
                           {
                              
    if($field == "") return "No username was entered <br> : ";
        else if (strlen($field) < 5)
            return "Username must be at least 5 characters long <br>";
else if(preg_match("/[^a-zA_Z0-9_-]/" $field))
        return "Only letters, numbers, - and _ in username <br. ";
return "";   
                           }

// The email must be well formatted, not allowing multiple '@', for example.

function validate_password($field)
                           {
                              
    if($field == "") return "No password was entered <br> : ";
        else if (strlen($field) < 6)
            return "Password must be at least 6 characters long <br>";
else if
    
    ( !preg_match ("/[a-z]/" $field) ||
      !preg_match ("/[A_Z]/" $field) ||
      !preg_match ("/[0-9]/" $field))
    return "Passwrods require 1 each of a-z, A-Z and 0-9 >br> ";
    return "";

                        }
// The password can have limitations of your choice, like minimal length or the use of special characters, but, if longer than 12 characters, it should not enforce any limitation.


function validate_email($field)
                           {
                              
    if($field == "") return "No Email was entered <br> : ";
        
else if
    
    ( !((strpos($field, ".") > 0) &&
      !(strpos($field, "@") > 0)) ||
      preg_match("/[^a-zA_Z0-9_-]/" $field))
    
    return "The email adress is invalid >br> ";
    return "";

                        }





echo <<<_END

<form method = "post" action = "validation.php" onsubmit="return validate(this)">

Enter you username: 
<input type="text" name="username" maxlength ="32">

Enter you email: 
<input type="text" name="username" maxlength ="32">

Enter you password: 
<input type="text" name="username" maxlength ="32">


<input type="submit" name="submit">


</form>

_END
      
?>