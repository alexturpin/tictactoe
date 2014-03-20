<?php
	require('bdd.php');

	$stmt = $bdd->prepare("SELECT * FROM tours WHERE partie = :partie AND id > :derniereMiseAJour ORDER BY id ASC");
	$stmt->execute(array(
		'partie' => $_GET['partie'],
		'derniereMiseAJour' => $_GET['derniereMiseAJour']
	)) or die(var_dump($stmt->errorInfo()));
	
	echo json_encode($stmt->fetchAll());
?>