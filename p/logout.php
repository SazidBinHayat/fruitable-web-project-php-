<?php
session_start();
session_unset();
session_destroy();
echo "<script>window.open('product.php', '_self')</script>";

?>