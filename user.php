<?php
	session_start();
	require_once "db_config.php";
	
	if(!isset($_SESSION["id"])){ //isset pārbauda iestatīto mainīgo
		header("location: login.php");
		exit;
	}
	
	if(isset($_SESSION["role"]) && $_SESSION["role"] != 3){ //ne admin
		header("location: index.php");
		exit;
	}
	
	$user_id = $_GET["id"];
	
	$dbq = mysqli_query($link, "select * from users where id=$user_id") or die("Invalid query: " . mysqli_error($link));

	$r = mysqli_fetch_assoc($dbq);
	$user_role = $r["role_id"];
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$first_name = $_POST["first_name"];
		$last_name = $_POST["last_name"];
		$email = $_POST["email"];
		$role_id = $_POST["role"];
		
		$upd = mysqli_query($link, "update users set first_name='$first_name', last_name='$last_name', email='$email', role_id='$role_id' where id=$user_id") or die("Invalid query: " . mysqli_error($link));
		
		header("location: users.php");
	}
?>
<html>
	<?php require_once "head.php"; ?>
	<body>
		<div class="main">
			<?php require_once "header.php"; ?>
			<div class="content">
				<div class="left">
					<div class="title">Rediģēt lietotāju</div>
					<div class="login_form">
						<form action="" method="post">
							<div class="input_block"><input name="first_name" value="<?php echo $r["first_name"]; ?>" type="text" placeholder="First name" class="input"></div>
							<div class="input_block"><input name="last_name" value="<?php echo $r["last_name"]; ?>" type="text" placeholder="Last name" class="input"></div>
							<div class="input_block"><input name="email" value="<?php echo $r["email"]; ?>" type="text" placeholder="E-mail" class="input"></div>
							<div class="input_block">
								<select name="role" class="select">
									<?php
										$dbq=mysqli_query($link, "select * from roles") or die("Invalid query: " . mysqli_error($link));

										while($r = mysqli_fetch_assoc($dbq)) {
											if($r["id"] == $user_role){
												echo "<option value=\"" . $r["id"] . "\" selected>" . $r["name"] . "</option>";
											} else {
												echo "<option value=\"" . $r["id"] . "\">" . $r["name"] . "</option>";
											}
										}
									?>
								</select>
							</div>		
							<div class="input_block"><input type="submit" value="Atjaunot" class="btn"></div>
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