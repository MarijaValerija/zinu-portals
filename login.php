<?php
	require_once "db_config.php";
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$email = $_POST["email"];
		$password = md5($_POST["password"]);
		
		if(empty($email)) {$email_err = "Lauks “E-pasts” ir obligāts";}
		if(empty($_POST["password"])) {$password_err = ". Lauks “Parole” ir obligāts";}
		
		if(!isset($email_err) && !isset($password_err)) {
			$dbq = mysqli_query($link, "select id, password, role_id, first_name from users where email='$email'") or die("Invalid query: " . mysqli_error($link));
				//Funkcija tiek izmantota, lai vienkāršotu vaicājuma izpildi pret datu bāzi, kuru attēlo saites parametrs.
			
			$row = mysqli_fetch_row($dbq);//Iegūst vienu datu rindu no rezultātu kopas un atgriež to kā uzskaitītu masīvu
		
			if($password === $row[1]){ //pārbauda, ​​vai pa e-pastu atrastā lietotāja parole ir vienāda, un, ja tā, izveidojam sesiju un ievadam datus sesijā
				session_start();
				$_SESSION["id"] = $row[0];
				$_SESSION["role"] = $row[2];
				$_SESSION["first_name"] = $row[3];
			}
			
			if(isset($_SESSION["id"])) {
				header("location: index.php");
				exit;
			} else {
				$err = "Nepareizi ievadīts e-pasts vai parole";
			}
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
						<?php if(isset($err)) {echo "<div class=\"error\">" . $err . "</div>";} ?>
						<form action="" method="post">
							<?php if(isset($email_err)) {echo "<div class=\"error\">" . $email_err . "</div>";} ?>
							<div class="input_block"><input name="email" type="text" placeholder="E-pasts" class="input"></div>
							<?php if(isset($password_err)) {echo "<div class=\"error\">" . $password_err . "</div>";} ?>
							<div class="input_block"><input name="password" type="password" placeholder="Parole" class="input"></div>
							<div class="input_block"><input type="submit" value="Ienākt" class="btn"></div>
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