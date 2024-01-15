<?php
	include "controller.php";
	include "header.php";
	$key_skill = array_search($slug_sottopagina, array_column($skills,"id")); 
	$skill = $skills[$key_skill];
?>
		<main>
		<div class="main">
			<div class="title">
				<h1><?php echo $pagina["titolo"] ?></h1><hr>
			</div>
			<div class="content">
				<form action="dashboard.php" method="post" enctype="multipart/form-data">
					Sei sicuro di voler eliminare il skill "<?php echo $skill["titolo"]; ?>"?<br><br>
					<input type="hidden" value="<?php echo $skill["id"]; ?>" name="id">
					<input class="bg-red submit" type="submit" value="Elimina Skill" name="elimina-skill">
					<br><br><a href="dashboard.php" class="bg-default">Torna alla Dashboard</a>
				</form>
			</div>
		</div>
	</main>
<?php
	include "footer.php";
?>