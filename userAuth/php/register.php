<?php
if(isset($_POST['submit'])){
    $username = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

registerUser($username, $email, $password);
}

function registerUser($username, $email, $password){
    //create user
    $new_user = array($username, $email, $password);

    //save data into the file
    $filepath = "../storage/users.csv";
    $handle = fopen($filepath, "a");

    if(fputcsv($handle, $new_user)) {
        echo "<h1>User Successfully registered</h1>";
    } else {
        echo "<h1> Error, please try again</h1>";
        die();
    }
    fclose($handle);
   
   header("Location: ../forms/login.html");
}


// echo "HANDLE THIS PAGE";


