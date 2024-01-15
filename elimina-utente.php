<?php
	include "controller.php";
	include "header.php";
	$key_ut = array_search($slug_sottopagina, array_column($utenti,"id")); 
	$utente = $utenti[$key_ut];
?>
		<main>
		<div class="main">
			<div class="title">
				<h1><?php echo $pagina["titolo"] ?></h1><hr>
			</div>
			<div class="content">
				<form action="dashboard.php" method="post" enctype="multipart/form-data">
					Sei sicuro di voler eliminare l'utente "<?php echo $utente["nome"].' '.$utente["cognome"]; ?>"?<br><br>
					<input type="hidden" value="<?php echo $utente["id"]; ?>" name="id">
					<input class="bg-red submit" type="submit" value="Elimina Utente" name="elimina-utente">
					<br><br><a href="dashboard.php" class="bg-default">Torna alla Dashboard</a>
				</form>
			</div>
		</div>
	</main>
<?php
	include "footer.php";
?>