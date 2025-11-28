<?php
session_start();
unset($_SESSION['verify_V']);
unset($_SESSION['name_V']);
header("Location: ../index.php");
