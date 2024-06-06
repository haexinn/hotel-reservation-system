<?php
session_name('novotel');
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['usertype'])){
	if($_SESSION['usertype'] == 0 || $_SESSION['usertype'] == 1){
		header("Location: ../portal/index.php");
	} else {
		header("Location: ../homepage.php");
	}
} else {
	header("Location: ../homepage.php");
}