<?php
session_start();
session_destroy();
header("Location: ../view/auth.php");
exit;
?>