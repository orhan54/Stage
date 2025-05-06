<?php
session_start();

$user = $_SESSION['user'] ?? null;
$association = $_SESSION['association'] ?? null;
?>




<?php
$content = ob_get_clean();
include("layout.php");
?>