<?php
	include "controller.php";
	include "header.php";
	$key_serv = array_search($slug_sottopagina, array_column($servizi,"id")); 
	$servizio = $servizi[$key_serv];
?>
		<main>
		<div class="main">
			<div class="title">
				<h1><?php echo $pagina["titolo"] ?></h1><hr>
			</div>
			<div class="content">
				<form action="dashboard.php" method="post" enctype="multipart/form-data">
					Sei sicuro di voler eliminare il servizio "<?php echo $servizio["titolo"]; ?>"?<br><br>
					<input type="hidden" value="<?php echo $servizio["id"]; ?>" name="id">
					<input class="bg-red submit" type="submit" value="Elimina Servizio" name="elimina-servizio">
					<br><br><a href="dashboard.php" class="bg-default">Torna alla Dashboard</a>
				</form>
			</div>
		</div>
	</main>
<?php
	include "footer.php";
?>