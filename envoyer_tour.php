<?php
	require('bdd.php');

	$stmt = $bdd->prepare("INSERT INTO tours VALUES('', :x, :y, :partie, :joueur)");
	$stmt->execute(array(
		'x' => $_POST['x'],
		'y' => $_POST['y'],
		'partie' => $_POST['partie'],
		'joueur' => $_POST['joueur']
	)) or die(var_dump($stmt->errorInfo()));
	
	echo $bdd->lastInsertId();
?>