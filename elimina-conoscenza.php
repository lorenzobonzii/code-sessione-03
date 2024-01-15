<?php
	include "controller.php";
	include "header.php";
	$key_conoscenza = array_search($slug_sottopagina, array_column($conoscenze,"id")); 
	$conoscenza = $conoscenze[$key_conoscenza];
?>
		<main>
		<div class="main">
			<div class="title">
				<h1><?php echo $pagina["titolo"] ?></h1><hr>
			</div>
			<div class="content">
				<form action="dashboard.php" method="post" enctype="multipart/form-data">
					Sei sicuro di voler eliminare la conoscenza "<?php echo $conoscenza["titolo"]; ?>"?<br><br>
					<input type="hidden" value="<?php echo $conoscenza["id"]; ?>" name="id">
					<input class="bg-red submit" type="submit" value="Elimina Conoscenza" name="elimina-conoscenza">
					<br><br><a href="dashboard.php" class="bg-default">Torna alla Dashboard</a>
				</form>
			</div>
		</div>
	</main>
<?php
	include "footer.php";
?>