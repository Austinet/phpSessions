<?php
if(isset($_POST['submit'])){
    $email =  $_POST['email']; 
    $password =  $_POST['password'];
   
    loginUser($email, $password);
}

function loginUser($email, $password){
    /*
        Finish this function to check if username and password 
    from file match that which is passed from the form
    */
    $filepath = "../storage/users.csv";
    $handle = fopen($filepath, "r");

    if(($handle = fopen($filepath, "r")) !== FALSE) {
        while(( $filename = fgetcsv($handle, 1000, ",")) !==FALSE) {
           $users_Array[] = $filename; 
           for($i = 0; $i < count($users_Array); $i++) {
   
            if ($users_Array[$i][1] == $email) {
                if(($users_Array[$i][2] == $password)) {
                    echo"found user";
                    session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['username'] = $users_Array[$i][0];
                    header("Location: ../dashboard.php");
                    break;
                } else {
                    echo "<h1>Incorrect password</h1>";
                    echo " <br><a href='../forms/login.html'>Login</a>";
                    die();
                }
          
              }
           } 
        }
    }

    echo "<h1 class='text-center'>Account not found, pls register </h1>";
    echo " <br><a href='../forms/register.html'>Register</a>";

    // echo "<script>
    //     alert('Account not found, pls register');
    // </script>";

    fclose($handle);
}


