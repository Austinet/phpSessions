<?php
session_start();

function logout(){
    /*
Check if the existing user has a session
if it does
destroy the session and redirect to login page
*/
if( $_SESSION['username']) {
    session_destroy();
    header("Location: ../");

}
}
logout();

echo "HANDLE THIS PAGE";
