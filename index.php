<?php
session_start();

require "vendor/autoload.php";

require "config/function.php";

require "bootstrap/app.php";

require "config/database.php";

require "routes/web.php";

$app->run();
?>