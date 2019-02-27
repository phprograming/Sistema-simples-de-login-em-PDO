<?php
session_start();

if ($_SESSION["logado"] != 1)
	header("Location: ../index.php");

?>