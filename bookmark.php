<?php
	require "./db.php" ;
	
	$sortM = $_GET["sort"];

	if ($sortM == "owner")
		$sql = "select * from bookmark order by bookmark.owner";
	else if ($sortM == "title")
		$sql = "select * from bookmark order by bookmark.title";
	else if ($sortM == "note")
		$sql = "select * from bookmark order by bookmark.note";
	else if ($sortM == "created"){
		$sql = "select * from bookmark order by bookmark.created";
	}else{
		$sql = "select * from bookmark order by bookmark.created";
		$crt = "yes";
	}
		
	$sqlU = "select * from user order by id";

	try {
		$stmt = $db->query($sql) ; 
		$bookmarks = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
		$size = $stmt->rowCount() ;
		$stmtU = $db->query($sqlU);
		$users = $stmtU->fetchAll(PDO::FETCH_ASSOC) ;
	}catch(PDOException $ex) {
		echo $ex->getMessage() ;
		die("<p>There is Something Wrong!!</p>") ;
	}
	
	if( $_SERVER["REQUEST_METHOD"] == "POST") {
		require './insert.php';
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	<title>Bookmarks</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<style>
	.nav-wrapper{ margin-left: 15px; margin-right: 15px; }
	.container{ margin-top: 50px;}
	.highlight{ table-layout: fixed; }
	.add{position: fixed; right: 20px; bottom: 20px; }
	.input-field{margin-top: 30px;}
	#toast-container { top: auto !important; bottom: 10% !important; left: 40% !important; right: auto !important; }
	a{color: black; }
</style>
<script>
	$(document).ready(function(){
		$('.modal').modal();
	});
	
	$(document).ready(function(){
		$('select').formSelect();
	});
</script>
<body>
	<nav>
		<div class="nav-wrapper">
			<a href="index.php" class="brand-logo"><i class="large material-icons">home</i>BMS</a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li><a href="bookmark.php"><i class="material-icons left">bookmark_border</i>Bookmarks</a></li>
			</ul>
		</div>
	</nav>

	<div class="container">
		<table class="highlight">
			<tr>
				<th><a href="bookmark.php?sort=owner">Owner <?= $_GET["sort"] == "owner" ?  "<i class='tiny material-icons'>arrow_drop_down</i>" : ""?></a></th>
				<th><a href="bookmark.php?sort=title">Title <?= $_GET["sort"] == "title" ? "<i class='tiny material-icons'>arrow_drop_down</i>" : ""?></a></th>
				<th><a href="bookmark.php?sort=note">Note <?= $_GET["sort"] == "note" ? "<i class='tiny material-icons'>arrow_drop_down</i>" : ""?></a></th>
				<th><a href="bookmark.php?sort=created">Date <?= $crt != "yes" ? "" : "<i class='tiny material-icons'>arrow_drop_down</i>"?><?= $_GET["sort"] != "created" ? "" : "<i class='tiny material-icons'>arrow_drop_down</i>"?></a></th>
				<th>Actions</th>
			</tr>
			<?php foreach( $bookmarks as $bookmark) : ?>
				<tr>
				<?php foreach ($users as $user) {if($user["id"] == $bookmark["owner"]){$name = $user["name"];}}?>
				<td><?= $name ?></td>
				
				<td style="color: blue"><?= $bookmark["title"] ?></td>
				
				<td class="truncate"><?= $bookmark["note"] ?></td>
				
				<?php $date = new DateTime($bookmark["created"]) ?>
				<td><?= date_format($date, 'd M y')?></td>
				
				<td><a class="waves-effect waves-light btn" href="delete.php?id=<?= $bookmark["id"] ?>"><i class="material-icons">delete</i></a>
					<a class="waves-effect waves-light btn modal-trigger" data-target="modalView-<?= $bookmark["id"] ?>"><i class="material-icons">remove_red_eye</i></a>
				</td>
				</tr>
			<?php endforeach ; ?>
		</table>
    </div>

	<a class="btn-floating btn-large waves-effect waves-light red add modal-trigger" data-target="modalAdd"><i class="material-icons">add</i></a>
	
	<div id="modalAdd" class="modal">
		<div class="modal-content">
			<h4 style="text-align: center">New Bookmark</h4>
		
		<form method="post">
			<div class="input-field">
				<select name="owner">
					<option value="" disabled selected>Choose your option</option>
					<?php foreach($users as $user) : ?>
						<option value=<?= $user["id"] ?>><?= $user["name"] ?></option>
					} 
					<?php endforeach; ?>
				</select>
				<label class="active" style="font-size: 25px">Owner</label>
			</div>
		
			<div class="input-field">
				<input id="bookmark_title" type="text" name="title">
				<label for="bookmark_title">Title</label>
			</div>

			<div class="input-field">
				<input id="bookmark_url" type="text" name="url">
				<label for="bookmark_url">URL</label>
			</div>

			<div class="input-field">
				<input id="bookmark_note" type="text" name="note">
				<label for="bookmark_note">Note</label>
			</div>
		
			<div class="modal-footer">
			<button class="waves-effect waves-light btn" href="insert.php"><i class="material-icons right" type="submit" name="action">send</i>ADD</button>
			</div>
		</form>
			
		</div>
	</div>
		
	<?php foreach ($bookmarks as $bookmark) : ?>
		<div id="modalView-<?= $bookmark["id"] ?>" class="modal">
			<div class="modal-content">
				<table>
					<tr>
						<td>Owner:</td>
						<?php foreach ($users as $user) {if($user["id"] == $bookmark["owner"]){$name = $user["name"];}}?>
						<td><?= $name ?></td>
					</tr>
					<tr>
						<td>Title:</td>
						<td><?= $bookmark["title"] ?></td>
					</tr>
					<tr>
						<td>Notes:</td>
						<td><?= $bookmark["note"] ?></td>
					</tr>
					<tr>
						<td>URL:</td>
						<td><?= $bookmark["url"] ?></td>
					</tr>
					<tr>
						<td>Date:</td>
						<td><?=$bookmark["created"]?></td>
					</tr>
				</table>

				<div class="modal-footer">
					<a class="modal-close waves-effect waves-green btn-flat">CLOSE</a>
				</div>
			</div>
		</div>
	<?php endforeach;?>
</body>
</html> 