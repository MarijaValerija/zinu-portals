<?php
	session_start();
	
	if(!isset($_SESSION["id"])){
		header("location: login.php");
		exit;
	}
	
	$album_id = $_GET["id"];
	
	require_once "db_config.php";
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(empty($_FILES["file"]["tmp_name"])) {$file_err = "Lūdzu, izvēlieties failu";}
		
		if(!isset($file_err)) {
			$filename = uniqid();
			$path = "/var/www/html/qaguru/zp/uploads/" . $filename . ".jpg";
			
			move_uploaded_file($_FILES["file"]["tmp_name"], $path);
			
			$comment = $_POST["comment"];
			$user_id = $_SESSION["id"];
			
			mysqli_query($link, "INSERT INTO images (created_by, album_id, image_comment, image_path) VALUES ('$user_id', '$album_id', '$comment', '$filename')") or die("Invalid query: " . mysqli_error($link));
			
			header("location: album.php?id=" . $album_id);
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
					<div class="title">Fotoalbums</div>
					<div class="big_album">
						<?php
							$dbq=mysqli_query($link, "select * from images where album_id = $album_id") or die("Invalid query: " . mysqli_error($link));
								//Funkcija tiek izmantota, lai vienkāršotu vaicājuma izpildi pret datu bāzi, kuru attēlo saites parametrs.
							if (mysqli_num_rows($dbq) == 0) {
								echo "<div class=\"nothing\">Pašlaik šeit nav nekā! Atvainojiet :(</div>";
							}

							while($r = mysqli_fetch_assoc($dbq)) {
								echo "<div class=\"album_img_big\">";
								echo "<div class=\"image_block\"><a href=\"image.php?id=" . $r["id"] . "\"><img src=\"uploads/" . $r["image_path"] . ".jpg\" class=\"image\"></a></div>";
								echo "<div class=\"image_comment\">" . $r["image_comment"] . " ";
								if($_SESSION["role"] && $_SESSION["role"] != 1) {
									echo "<a href=\"set_cover.php?id=" . $album_id . "&image=" . $r["id"] . "\" class=\"cover_link\">Iestatīt kā vāku</a> or <a href=\"delete_image.php?id=" . $album_id . "&image=" . $r["id"] . "\" class=\"cover_link\">dzēst</a>";
								}
								echo "</div></div>";
							}
						?>
					</div>
					<?php if(isset($_SESSION["role"]) && $_SESSION["role"] != 1) {?> 
					<div class="upload_file">
						<?php if(isset($file_err)) {echo "<div class=\"error\">" . $file_err . "</div>";} ?>
						<form action="" method="post" enctype="multipart/form-data" class="file_form">
							<div class="input_block"><input name="file" type="file" class="input"></div>
							<div class="input_block"><input name="comment" type="text" placeholder="Komentārs" class="input"></div>
							<div class="input_block"><input type="submit" value="Pievienot" class="btn"></div>
						</form>
					</div>
					<?php }?>
				</div>
				<div class="right">
					<?php require_once "side_albums.php"; ?>
				</div>
			</div>
		</div>
	</body>
</html>