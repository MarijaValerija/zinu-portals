<?php
	session_start();
	require_once "db_config.php";
	
	if(!isset($_SESSION["id"])){
		header("location: login.php");
		exit;
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$user = $_SESSION["id"];
		$title = $_POST["title"];
		$comment = $_POST["comment"];
		
		if(empty($title)) {$err = "Lauks ir obligāts";}
		
		if(!isset($err)) {
			mysqli_query($link, "INSERT INTO albums (created_by, album_title, comment) VALUES ('$user', '$title', '$comment')") or die("Invalid query: " . mysqli_error($link));
			header("location: albums.php");//redirect
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
					<div class="title">Visi fotoalbumi</div>
					<div class="albums_big">
						<?php
							$dbq=mysqli_query($link, "select a.id, a.cover, a.album_title, a.comment, a.created_by, i.image_path, u.first_name from albums a left outer join images i on a.cover = i.id left outer join users u on u.id = a.created_by order by a.updated_at DESC") or die("Invalid query: " . mysqli_error($link));
								//sarežģīts vaicājums no divām tabulām, vienlaicīgi iegūstot ceļu uz attēlu uz vāka no otras tabulas
							while($r = mysqli_fetch_assoc($dbq)) {
								echo "<div class=\"album_big\">";
								echo "<div class=\"big_photo\">";
								if($r["cover"] == NULL) {
									echo "<img src=\"img/no_image.png\" class=\"album_img_prev\">"; //no_image - tukšas bildes ikona
								} else {
									echo "<img src=\"uploads/" . $r["image_path"] . ".jpg\" class=\"album_img_prev\">";
								}
								echo "</div>";
								echo "<div class=\"big_descr\">";
								echo "<div class=\"album_big_title\"><a href=\"album.php?id=" . $r["id"] . "\" class=\"album_link\">" . $r["album_title"] . "</a>";
								if((isset($_SESSION["role"]) && $_SESSION["role"] == 3) || ($_SESSION["role"] == 2 && $r["created_by"] == $_SESSION["id"])) {	//pārbauda vai tāda vērtība IR UN pārbauda lomu	2x					
									echo "<a href=\"delete_album.php?id=" . $r["id"] . "\" class=\"no_link\"><i class=\"far fa-trash-alt\"></i></a>";
								}
								echo "</div>";
								echo "<div class=\"album_big_txt\">" . $r["comment"] . "</div>";
								echo "<span class=\"article_date\">Autors: " . $r["first_name"] . "</span>";
								echo "</div>";
								echo "</div>";
							}
						?>
					</div>
					<?php if(isset($_SESSION["role"]) && $_SESSION["role"] != 1) {?>
					<div class="upload_file">
						<?php if(isset($err)) {echo "<div class=\"error\">" . $err . "</div>";} ?>
						<form action="" method="post" class="file_form">
							<div class="input_block"><input name="title" type="text" placeholder="Galerijas nosaukums" class="input"></div>
							<div class="input_block"><input name="comment" type="text" placeholder="Galerijas komentārs" class="input"></div>
							<div class="input_block"><input type="submit" value="Saglabāt" class="btn"></div>
						</form>
					</div>
					<?php }?>
				</div>
				<div class="right">
					<?php require_once "side_articles.php"; ?>
				</div>
			</div>
		</div>
	</body>
</html>