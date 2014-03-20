<?php
	require('bdd.php');

	$stmt = $bdd->prepare("INSERT INTO parties VALUES('')");
	$stmt->execute() or die(var_dump($stmt->errorInfo()));

	$partie = $bdd->lastInsertId();

	header('Location: partie.php?joueur=x&partie=' . $partie);
?>