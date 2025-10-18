<?php
session_start();
session_destroy();
header("Location: /proyecto-TOO/index.php");
exit;
