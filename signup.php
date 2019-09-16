<?php  
 $message = '';#this will be used when implementing error messages  
 $error = '';  #this will be used when implementing error messages
//this is the basic User sign up
 if(isset($_POST["submit"]))  
 {      if(file_exists('employee_data.json'))  
           {  
                $current_data = file_get_contents('employee_data.json');  
                $array_data = json_decode($current_data, true);  
                $extra = array(  
                     'Fullname'            =>     $_POST['name'],  
                     'username'          =>     $_POST["username"],  
                     'email'     =>     $_POST["email"],
                     'mobile'          =>     $_POST["mobile"], 
                     'password'          =>     $_POST["password"]
                    
                );  
                $array_data[] = $extra;  
                $final_data = json_encode($array_data);
                $final_data .= "\n";  
                if(file_put_contents('employee_data.json', $final_data))  
                {  
                     $message = "<label class='text-success'>File Appended Success fully</p>";  
                     header("Location: signup.php");
                }  
           }  
           else  
           {  
                $error = 'JSON File not exits';  
           }  
  
 }  
