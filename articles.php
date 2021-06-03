<?php
	session_start();
	
	if(!isset($_SESSION["id"])){
		header("location: login.php");
		exit;
	}
	
	require_once "db_config.php";
?>
<html>
	<?php require_once "head.php"; ?>
	<body>
		<div class="main">
			<?php require_once "header.php"; ?>
			<div class="content">
				<div class="left">
					<div class="title">
						<div>Jaunumi</div>
						<div>
							<?php
								if(isset($_SESSION["role"]) && $_SESSION["role"] != 1) { //pārbauda vai tāda vērtība IR && pārbauda lomu
									echo "<a href=\"add_article.php\" class=\"no_link\"><i class=\"fas fa-plus\"></i></a>";
								}
							?>
						</div>
					</div>
					<div class="articles_big">
						<?php
							$dbq=mysqli_query($link, "select * from posts ORDER BY updated_at DESC") or die("Invalid query: " . mysqli_error($link)); //Funkcija tiek izmantota, lai vienkāršotu vaicājuma izpildi pret datu bāzi, kuru attēlo saites parametrs.

							while($r = mysqli_fetch_assoc($dbq)) {
								echo "<div class=\"article\">";
							echo "<div class=\"article_header\">";
							echo "<div class=\"article_title\">" . $r["post_title"] . "</div>";
							echo "<div class=\"article_date\">" . $r["updated_at"] . " ";
							if((isset($_SESSION["role"]) && $_SESSION["role"] == 3) || ($_SESSION["role"] == 2 && $r["created_by"] == $_SESSION["id"])) {	//pārbauda vai tāda vērtība IR && pārbauda lomu VAI ...						
								echo "<a href=\"delete_article.php?id=" . $r["id"] . "\" class=\"no_link\"><i class=\"far fa-trash-alt\"></i></a>";
							}
							echo "</div></div>";
							
							echo "<div class=\"article_text\">" . nl2br($r["body"]) . "</div></div>";
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