<?php
//agar tidak bisa langsung ke timeline
session_start();
if(!isset($_SESSION["user"])) header("Location: login.php");