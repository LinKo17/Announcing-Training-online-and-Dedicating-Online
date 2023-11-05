<!-- This page purpose is not to allow normal user or not register person to allows this page -->
<?php
include("../vendor/autoload.php");
use Helper\Auth;
session_start();
Auth::checkUserRole();