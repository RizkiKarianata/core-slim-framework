<?php

$container['db'] = function() {
	return new PDO('mysql:host=localhost;dbname=database_name', 'username', 'password');	
};

?>