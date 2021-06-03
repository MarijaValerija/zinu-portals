<div class="header">
	<div class="logo_block">
		<div class="logo"><a href="index.php" class="no_link">ZP</a></div>
		<div class="moto"><a href="index.php" class="no_link">ZIŅU PORTĀLS</a></div>
	</div>
	<div class="menu">
		<a href="articles.php" class="menu_link">Jaunumi</a>
		<a href="albums.php" class="menu_link">Visi fotoalbumi</a>
		<?php
			if (isset($_SESSION["role"]) && $_SESSION["role"] == 3) { //pārbauda vai tāda vērtība IR && pārbauda lomu
				echo "<a href=\"users.php\" class=\"menu_link\">Lietotāju pārvaldība</a>";
			}
		?>
	</div>
	<div class="reg">
		<?php
			if(isset($_SESSION["id"])){
				echo "<div class=\"hello\">Sveiki, " . $_SESSION["first_name"] . " </div><a href=\"logout.php\" class=\"no_link\"><i class=\"fas fa-sign-out-alt\"></i></a>";
			} else {
				echo "<a href=\"registration.php\" class=\"reg_link\">Reģisterējies</a>";
				echo "<a href=\"login.php\"  class=\"reg_link\">Pieslēgties</a>";
			}
		?>
	</div>
</div>