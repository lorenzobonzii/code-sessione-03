<?php
	include "controller.php";
	include "header.php";
	$key_prog = array_search($slug_sottopagina, array_column($progetti,"id")); 
	$progetto = $progetti[$key_prog];
?>
		<main>
		<div class="main">
			<div class="title">
				<h1><?php echo $pagina["titolo"] ?></h1><hr>
			</div>
			<div class="content">
				<form action="dashboard.php" method="post" enctype="multipart/form-data">
					Sei sicuro di voler eliminare il progetto "<?php echo $progetto["titolo"]; ?>"?<br><br>
					<input type="hidden" value="<?php echo $progetto["id"]; ?>" name="id">
					<input class="bg-red submit" type="submit" value="Elimina Progetto" name="elimina-progetto">
					<br><br><a href="dashboard.php" class="bg-default">Torna alla Dashboard</a>
				</form>
			</div>
		</div>
	</main>
<?php
	include "footer.php";
?>