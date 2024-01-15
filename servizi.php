<?php
	include "controller.php";
	include "header.php";
	if (!$slug_sottopagina){ //Non è stata indicata una sottopagina: pagina principale del portfolio
?>
		<main>
		<div class="main">
			<div class="title">
				<h1><?php echo $pagina["titolo"] ?></h1><hr>
			</div>
			<div class="content <?php echo $pagina["template"] ?>">
				<?php
				foreach($servizi as $servizio){ ?>
					<a href="<?php echo $pagina["link"].'?id='.$servizio["id"]; ?>" title="Vai alla pagina <?php echo $servizio["titolo"]; ?>">
						<article class="article bg-dark progetti">
							<i class="<?php echo $servizio["icona"]; ?> fa-4x"></i>
							<h2><?php echo $servizio["titolo"]; ?></h2>
							<p><?php echo $servizio["descrizione"]; ?></p>
						</article>
					</a>
				<?php
				} ?>
			</div>
		</div>
		</main>
<?php
	}
	else { //E'stata indicata una sottopagina di portfolio
		$servizio = SelectFirstSql("SELECT * FROM servizi WHERE id = $slug_sottopagina");
		if (!$servizio){ //Se non è stata trovato un servizio relativo allo slug della sottopagina visualizzo messaggio di errore
?>
			<main>
				<div class="main">
					<div class="title">
						<h1>Servizio non trovato</h1><hr>
					</div>
					<div class="content">
						<p>Non è stato trovato il servizio richiesto...<br/><br/>
							<a style="width:inherit" class="button bg-dark" href="servizi.php" title="Vai alla pagina Servizi"><i class="icon fas fa-home"></i>&nbsp;<span> Vai alla Pagina Servizi</span></a>
						</p>
					</div>
				</div>
			</main>
<?php
		}
		else{ //Se è stata trovato un servizio relativo allo slug della sottopagina visualizzo la pagina di quel singolo servizio
?>
			<main>
				<div class="main">
					<div class="title">
						<h1><?php echo $servizio["titolo"]; ?></h1><hr>
					</div>
					<div class="singolo-progetto">
						<i class="<?php echo $servizio["icona"]; ?> fa-4x"></i>
						<p><?php echo $servizio["descrizione"]; ?></p>
					</div>
				</div>
			</main>
<?php
		}
	}
?>
<?php
	include "footer.php";
?>