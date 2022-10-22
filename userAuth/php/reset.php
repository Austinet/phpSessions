<?php
if(isset($_POST['submit'])){
    $email =$_POST['email']; 
    $newpassword =  $_POST['password'];

    resetPassword($email, $newpassword);
}

function resetPassword($email, $newpassword){
    //open file and check if the username exist inside
    //if it does, replace the password
    $filepath = "../storage/users.csv";

    if(($handle = fopen($filepath, "r")) !== FALSE) {
        $i = 0;
        $reset_array = FALSE;
        while(( $filename = fgetcsv($handle, 1000, ",")) !==FALSE) {   
             //Stores the content of the file in a new array   
             $users_array[] = $filename;
             //Checks if the username exist inside and changes the password
             if ($users_array[$i][1] == $email) {
                $users_array[$i][2] = $newpassword;
                $reset_array = TRUE;     
            }
            $i++;
        }
        fclose($handle);

        if($reset_array) {
                //Resets the database
                $handle = fopen($filepath, "w");
                fwrite($handle, "");
                fclose($handle);

                //Updates the database with the data in the new array
                $handle2 = fopen($filepath, "a");
                for($i = 0; $i < count($users_array); $i++) {
                   fputcsv($handle2, $users_array[$i]);       
                }  
                fclose($handle2);
                echo "<h1 class='text-center'>Password successfully changed</h1>";
                echo " <br><a href='../forms/login.html'>Login</a>";
                // header("Location: ../forms/login.html");
        }
    }
    echo "Account not found, pls register";
}
