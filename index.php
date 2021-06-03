<?php
	session_start();
	require_once "db_config.php"; //ja kods no faila jau bija iekļauts, tas vairs netiks pieslēgts vēlreiz
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
					<?php
						$dbq=mysqli_query($link, "select * from posts ORDER BY updated_at DESC LIMIT 3") or die("Invalid query: " . mysqli_error($link)); //Funkcija tiek izmantota, lai vienkāršotu vaicājuma izpildi pret datu bāzi, kuru attēlo saites parametrs.

						while($r = mysqli_fetch_assoc($dbq)) {
							echo "<div class=\"article\">";
							echo "<div class=\"article_header\">";
							echo "<div class=\"article_title\">" . $r["post_title"] . "</div>";
							echo "<div class=\"article_date\">" . $r["updated_at"] . "</div>";
							echo "</div>";
							
							echo "<div class=\"article_text\">" . nl2br($r["body"]) . "</div></div>";
						}
					?>
					<div class="more"><a href="articles.php" class="more_link">Lasīt vairāk</a></div>
				</div>
				<div class="right">
					<?php require_once "side_albums.php"; ?>
				</div>
			</div>
		</div>
	</body>
</html>