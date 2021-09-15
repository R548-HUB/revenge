<?php
session_start();
echo 'please wait ..it logging you out';
session_destroy();
header("Location:index.php");
