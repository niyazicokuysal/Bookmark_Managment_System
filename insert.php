<?php
	require './db.php';

	try {
	extract($_POST);
	$sqlAdd = "insert into bookmark (owner, title, url, note) values (?,?,?,?)" ;
	$stmt = $db->prepare($sqlAdd) ;
	$stmt->execute([$owner, $title, $url, $note]) ;	
	}catch(PDOException $ex) {
			
	}

	header('Location: bookmark.php');
	
	