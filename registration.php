<?php
	require_once "db_config.php";
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$first_name = $_POST["first_name"];
		$last_name = $_POST["last_name"];
		$email = $_POST["email"];
		$password = md5($_POST["password"]);
		
		if(empty($first_name)) {$first_name_err = "Lauks “Vārds” ir obligāts";}
		if(empty($last_name)) {$last_name_err = "Lauks “Uzvārds” ir obligāts";}
		if(empty($email)) {$email_err = "Lauks “E-pasts” ir obligāts";}
		if(empty($_POST["password"])) {$password_err = "Lauks “Parole” ir obligāts";}
		
		if(!isset($first_name_err) && !isset($last_name_err) && !isset($email_err) && !isset($password_err)) {
			mysqli_query($link, "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')") or die("Invalid query: " . mysqli_error($link));
			header("location: login.php");
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
					<div class="login_info">Lai redzētu vairāk, lūdzu, pieteicaties vai reģistrējieties:</div>
					<div class="login_form">
						<form action="" method="post">
							<?php if(isset($first_name_err)) {echo "<div class=\"error\">" . $first_name_err . "</div>";} ?>
							<div class="input_block"><input name="first_name" type="text" placeholder="Vārds" class="input"></div>
							<?php if(isset($last_name_err)) {echo "<div class=\"error\">" . $last_name_err . "</div>";} ?>
							<div class="input_block"><input name="last_name" type="text" placeholder="Uzvārds" class="input"></div>
							<?php if(isset($email_err)) {echo "<div class=\"error\">" . $email_err . "</div>";} ?>
							<div class="input_block"><input name="email" type="text" placeholder="E-pasts" class="input"></div>
							<?php if(isset($password_err)) {echo "<div class=\"error\">" . $password_err . "</div>";} ?>
							<div class="input_block"><input name="password" type="password" placeholder="Parole" class="input"></div>
							<div class="input_block"><input type="submit" value="Registrēties" class="btn"></div>
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