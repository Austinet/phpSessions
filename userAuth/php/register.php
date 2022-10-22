<?php
if(isset($_POST['submit'])){
    $username = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

registerUser($username, $email, $password);
}



function registerUser($username, $email, $password){
    //Check if email exists already
    $filepath = "../storage/users.csv";
     if(($open = fopen($filepath, "r")) !== FALSE) {
   
        while(( $filename = fgetcsv($open, 1000, ",")) !==FALSE) {       
             //Checks if the email already exists
             if ($filename[1] == $email) {
                echo "<h1 class='text-center'>Email already exists</h1>";
                echo " <br><a href='../forms/login.html'>Login</a>";
                die();
            }
        }
        fclose($open);
    }
    //create user
    $new_user = array($username, $email, $password);

    //save data into the file

    $handle = fopen($filepath, "a");

    if(fputcsv($handle, $new_user)) {
        echo "<h1 class='text-center'>User Successfully registered</h1>";
        echo " <br><a href='../forms/login.html'>Login</a>";
    } else {
        echo "<h1> Error, please try again</h1>";
        die();
    }
    fclose($handle);
   
//    header("Location: ../forms/login.html");
}


// echo "HANDLE THIS PAGE";


