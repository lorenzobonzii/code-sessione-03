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
				foreach($progetti as $progetto){ 
					if (!$progetto["url_img"])
						$progetto["url_img"] = "img/progetto.png";
					?>
					<a href="<?php echo $pagina["link"].'?id='.$progetto["id"]; ?>" title="Vai alla pagina <?php echo $progetto["titolo"]; ?>">
						<article class="article bg-dark progetti">
							<img src="<?php echo $progetto["url_img"]; ?>" alt="<?php echo $progetto["titolo"]; ?>">
							<h2><?php echo $progetto["titolo"]; ?></h2>
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
		$progetto = SelectFirstSql("SELECT * FROM progetti WHERE id = $slug_sottopagina");
		if (!$progetto){ //Se non è stata trovato un progetto relativo allo slug della sottopagina visualizzo messaggio di errore
?>
			<main>
				<div class="main">
					<div class="title">
						<h1>Progetto non trovato</h1><hr>
					</div>
					<div class="content">
						<p>Non è stato trovato il progetto richiesto...<br/><br/>
							<a style="width:inherit" class="button bg-dark" href="portfolio.php" title="Vai alla pagina Portfolio"><i class="icon fas fa-home"></i>&nbsp;<span> Vai alla Pagina Portfolio</span></a>
						</p>
					</div>
				</div>
			</main>
<?php
}
		else{ //Se è stata trovato un progetto relativo allo slug della sottopagina visualizzo la pagina di quel singolo progetto
			if (!$progetto["url_img"])
				$progetto["url_img"] = "img/progetto.png";
?>
			<main>
				<div class="main">
					<div class="title">
						<h1><?php echo $progetto["titolo"]; ?></h1><hr>
						<a class="button bg-light only-pc" href="<?php echo $progetto["link"]; ?>" title="Vai al sito" target="_blank">Visita il sito</a>
					</div>
					<div class="singolo-progetto">
						<img src="<?php echo $progetto["url_img"]; ?>" alt="<?php echo $progetto["titolo"]; ?>">
						<p><?php echo $progetto["descrizione"]; ?></p>
					</div>
					<a class="button bg-light only-mobile" href="<?php echo $progetto["link"]; ?>" title="Vai al sito" target="_blank">Visita il sito</a>
				</div>
			</main>
<?php
		}
	}
?>
<?php
	include "footer.php";
?>