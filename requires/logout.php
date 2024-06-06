<?php
session_name('novotel');
session_start();
session_destroy();
header("Location: ../index.php");
?>