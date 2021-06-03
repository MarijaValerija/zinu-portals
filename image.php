<?php
	session_start();
	
	if(!isset($_SESSION["id"])){
		header("location: login.php");
		exit;
	}
	
	$image_id = $_GET["id"];
	
	require_once "db_config.php";
	$dbq=mysqli_query($link, "select * from images where id = $image_id") or die("Invalid query: " . mysqli_error($link));
	$r = mysqli_fetch_assoc($dbq)
?>
<html>
	<?php require_once "head.php"; ?>
	<body>
		<div class="main">
			<?php require_once "header.php"; ?>
			<div class="content">
				<div class="left">
					<div class="title">Photo</div>
					<div class="big_photo_block">
						<?php
							echo "<img src=\"uploads/" . $r["image_path"] . ".jpg\" class=\"big_photo_img\">";
						?>
					</div>
					<?php if(isset($_SESSION["role"]) && $_SESSION["role"] != 1) {?>
					<div class="upload_file">
						<?php if(isset($file_err)) {echo "<div class=\"error\">" . $file_err . "</div>";} ?>
						<form action="" method="post" enctype="multipart/form-data" class="file_form">
							<div class="input_block"><input name="file" type="file" class="input"></div>
							<div class="input_block"><input name="comment" type="text" placeholder="Album comment" class="input"></div>
							<div class="input_block"><input type="submit" value="Add" class="btn"></div>
						</form>
					</div>
					<?php }?>
				</div>
				<div class="right">
					<?php require_once "side_images.php"; ?>
					<?php require_once "side_albums.php"; ?>
				</div>
			</div>
		</div>
	</body>
</html>