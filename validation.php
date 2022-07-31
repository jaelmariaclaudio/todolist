<?php
/*
IP of Divine Aguilar

Feel free to improve/customize to your needs.

Another form validation option is through js/ajax/jquery.

This code is given after the discussion of form validation and Regular Expression. 

The use of this code is optional, you can implement your own form validation code.

Description:
checks pattern and required fields
contains clean data that convents input to htmlspecialchars and cleans the data

Parameters:
custom - pass the value you want to display
input - contains value from POST/GET
pattern - is like a label pertaining to what pattern we want
isRequired - pass True if Required otherwise False
hasPattern - pass True if it needs pattern otherwise False
*/

//validateInput("First_name", $_POST['fname], "name", True, True)
function validateInput($custom, $input, $isRequired){
    $error = "";
  
    //checks if the input needs to be required
    if($isRequired){
      //checks if the input is empty
      if(empty($input)){
        $error = "please input your $custom here.";
        $_SESSION['validation_err'] = "1";
      }
    }
    
    return $error;
  }

   //used for htmlspecial chars and cleaning the data
 function cleandata($user_input){
  $user_input = trim($user_input);
  $user_input = stripslashes($user_input);
  $user_input = htmlspecialchars($user_input);
  return $user_input;
}
  ?>