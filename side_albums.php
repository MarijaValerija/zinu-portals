<div class="title">Visi fotoalbumi</div>
<div class="albums">
<?php
	$dbq=mysqli_query($link, "select a.id, a.cover, a.album_title, a.comment, i.image_path from albums a left outer join images i on a.cover = i.id ORDER BY a.updated_at DESC LIMIT 9") or die("Invalid query: " . mysqli_error($link));

	while($r = mysqli_fetch_assoc($dbq)) {
		echo "<a href=\"album.php?id=" . $r["id"] . "\"><div class=\"album\">";
		echo "<div class=\"album_img\">";
		if($r["cover"] == NULL) {
			echo "<img src=\"img/no_image.png\" class=\"album_prev\">";
		} else {
			echo "<img src=\"uploads/" . $r["image_path"] . ".jpg\" class=\"album_prev\">";
		}
		echo "</a></div>";
		
		echo "<div><a href=\"album.php?id=" . $r["id"] . "\" class=\"album_title\">" . $r["album_title"] . "</a></div>";
		echo "</div>";
	}
?>
</div>
<div class="more"><a href="albums.php" class="more_link">Vairāk fotoalbumu</a></div>