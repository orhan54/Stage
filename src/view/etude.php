<?php
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : false;
ob_start();
?>




<?php
$content = ob_get_clean();
include("layout.php");
?>