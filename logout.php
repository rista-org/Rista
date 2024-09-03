<?php
require_once('header.php');
ob_end_flush();
session_abort();
header("location:index.php");
?>