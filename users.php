<?php
	session_start();
	require_once "db_config.php";
	
	if(!isset($_SESSION["id"])){
		header("location: login.php");
		exit;
	}
	
	if(isset($_SESSION["role"]) && $_SESSION["role"] != 3){
		header("location: index.php");
		exit;
	}
?>
<html>
	<?php require_once "head.php"; ?>
	<body>
		<div class="main">
			<?php require_once "header.php"; ?>
			<div class="content">
				<div class="left">
					<div class="users">
						<?php
							$dbq=mysqli_query($link, "select * from users where role_id = 1 or role_id = 2") or die("Invalid query: " . mysqli_error($link));

							while($r = mysqli_fetch_assoc($dbq)) {
								echo "<div class=\"user\"><div class=\"user_info\">";
								echo "<div class=\"user_txt\">" . $r["id"] . ".</div>";
								echo "<div class=\"user_txt\">" . $r["first_name"] . "</div>";
								echo "<div class=\"user_txt\">" . $r["last_name"] . "</div>";
								echo "<div class=\"user_txt\">" . $r["email"] . "</div></div>";
								echo "<div><div><a href=\"user.php?id=" . $r["id"] . "\" class=\"no_link\"><i class=\"far fa-edit\"></i></a> <a href=\"delete_user.php?id=" . $r["id"] . "\" class=\"no_link\"><i class=\"far fa-trash-alt\"></i></a></div>";
								echo "</div></div>";
							}
						?>
					</div>
				</div>
				<div class="right">
					<?php require_once "side_albums.php"; ?>
				</div>
			</div>
		</div>
	</body>
</html>