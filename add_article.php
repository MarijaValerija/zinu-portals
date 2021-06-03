<?php
	session_start();

	if(!isset($_SESSION["role"]) || $_SESSION["role"] == 1){
		header("location: index.php");
		exit;
	}
	
	require_once "db_config.php";
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$user = $_SESSION["id"];
		$title = $_POST["title"];
		$body = str_replace('\'', '\"', $_POST["body"]);
		
		if(empty($title)) {$title_err = "Nekorekti ievadīts Virsraksts";}
		if(empty($body)) {$body_err = "Nekorekti ievadīts ieraksta teksts";}
		
		if(!isset($title_err) && !isset($body_err)) {
			mysqli_query($link, "INSERT INTO posts (created_by, post_title, body) VALUES ('$user', '$title', '$body')") or die("Invalid query: " . mysqli_error($link)); //Funkcija tiek izmantota, lai vienkāršotu vaicājuma izpildi pret datu bāzi, kuru attēlo saites parametrs.
			header("location: articles.php");
			exit;
		}
	}
?>
<html>
	<?php require_once "head.php"; ?>
	<body>
		<div class="main">
			<?php require_once "header.php"; ?>
			<div class="content">
				<div class="left">
					<div class="title">Pievienot jaunu ierakstu</div>
					<div class="login_form">
						<form action="" method="post">
							<?php if(isset($title_err)) {echo "<div class=\"error\">" . $title_err . "</div>";} ?>
							<div class="input_block"><input name="title" type="text" placeholder="Virsraksts" class="input"></div>
							<?php if(isset($body_err)) {echo "<div class=\"error\">" . $body_err . "</div>";} ?>
							<div class="input_block"><textarea name="body" class="ta"></textarea></div>
							<div class="input_block"><input type="submit" value="Saglabāt" class="btn"></div>
						</form>
					</div>
				</div>
				<div class="right">
					<?php require_once "side_albums.php"; ?>
				</div>
			</div>
		</div>
	</body>
</html>