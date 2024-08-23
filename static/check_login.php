<?php
session_start();
include("config.php");
if (isset($_SESSION['uid'])) {
    echo "loggedin";
} else {
    echo "notloggedin";
}
?>
