<div class="title">Jaunumi</div>
<div class="albums">
<?php
	$dbq=mysqli_query($link, "select * from posts ORDER BY updated_at DESC LIMIT 3") or die("Invalid query: " . mysqli_error($link)); //DESC LIMIT 3 - POSLEDNIJI 3 ZAPISI

	while($r = mysqli_fetch_assoc($dbq)) {
		echo "<div class=\"small_article\">";
		if(strlen($r["post_title"]) > 30) { //STRLEN - cik burti ir nosaukumā
			echo "<div class=\"small_title\">" . substr($r["post_title"], 0, 30) . " ...</div>";
		} else {
			echo "<div class=\"small_title\">" . $r["post_title"] . "</div>";
		}
		if(strlen($r["body"]) > 190) {
			echo "<div class=\"small_text\">" . substr($r["body"], 0, 190) . " ...</div>";
		} else {
			echo "<div class=\"small_text\">" . $r["body"] . "</div>";
		}
		
		echo "</div>";
	}
?>
</div>
<div class="more"><a href="articles.php" class="more_link">Vairāk jaunumu</a></div>