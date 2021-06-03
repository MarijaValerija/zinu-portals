<div class="title">Vairāk attēlu</div>
<div class="albums">
<?php
	$album = $r["album_id"];
	$imagesq=mysqli_query($link, "select id, image_path from images where album_id = $album ORDER BY updated_at DESC LIMIT 30") or die("Invalid query: " . mysqli_error($link));

	while($imgs = mysqli_fetch_assoc($imagesq)) {
		echo "<a href=\"image.php?id=" . $imgs["id"] . "\"><div class=\"album\">";
		echo "<div class=\"album_img\">";
		echo "<img src=\"uploads/" . $imgs["image_path"] . ".jpg\" class=\"album_prev\">";
		
		echo "</a></div>";
		
		echo "</div>";
	}
?>
</div>