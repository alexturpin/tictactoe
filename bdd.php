<?php
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=tictactoe', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND =>  'SET NAMES utf8')); //En plus d'utiliser la collation utf8_general_ci
	}
	catch(Exception $e) {
		die($e->getMessage());
	}
?>