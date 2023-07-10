<?php
if($_SESSION['validar']){
    session_destroy();
    header('Location:login');
	exit();
}else {
    header('Location:login');
    exit();
}
?>