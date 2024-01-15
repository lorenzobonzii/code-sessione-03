<?php
	include "controller.php";
	include "header.php";
?>
<main>
	<div class="main home">
		<div class="content">
			<?php if(isset($messaggio_errore)){ ?>
				<div class="errore">
					<p class="messaggio-errore"><?php echo $messaggio_errore; ?></p>
				</div>
			<?php } ?>
			<?php if(isset($messaggio_successo)){ ?>
				<div class="errore">
					<p class="messaggio-successo"><?php echo $messaggio_successo; ?></p>
				</div>
			<?php } ?>
			<aside class="left">
				<div class="article">
					<img class="circle" src="<?php echo $options["img_principale"] ?>" alt="Immagine <?php echo $options["titolo"] ?>">
				</div>
			</aside>
			<section class="principale article">
				<h2><?php echo $options["titolo"] ?></h2>
				<p><?php echo $options["sottotitolo"] ?></p>
				<a class="button bg-light" href="chi-sono.php" title="Vai alla pagina Chi sono">Scopri di più</a>
			</section>
		</div>
	</div>
	<div class="main">
		<div class="title">
			<h1>Progetti in evidenza</h1><hr>
			<a class="button bg-light only-pc" href="portfolio.php" title="Vai alla pagina Portfolio">Scopri di più</a>
		</div>
		<div class="content portfolio">
			<?php
			foreach($progetti_in_evidenza as $progetto){
				if (!$progetto["url_img"])
					$progetto["url_img"] = "img/progetto.png";
			?>
				<a href="portfolio.php?id=<?php echo $progetto["id"];?>" title="Vai alla pagina <?php echo $progetto["titolo"];?>">
				<article class="article bg-dark progetti">
					<img src="<?php echo $progetto["url_img"];?>" alt="<?php echo $progetto["titolo"];?>">
					<h2><?php echo $progetto["titolo"];?></h2>
				</article>
				</a>
			<?php
			}
			?>
		</div>
		<a class="button bg-light only-mobile" href="portfolio.php" title="Vai alla pagina Portfolio">Scopri di più</a>
		<div class="title">
			<h1>Servizi in evidenza</h1><hr>
			<a class="button bg-light only-pc" href="servizi.php" title="Vai alla pagina Servizi">Scopri di più</a>
		</div>
		<div class="content portfolio">
			<?php
			foreach($servizi_in_evidenza as $servizio){
			?>
				<a href="servizi.php?id=<?php echo $servizio["id"];?>" title="Vai alla pagina <?php echo $servizio["titolo"];?>">
				<article class="article bg-dark progetti">
					<i class="<?php echo $servizio["icona"]; ?> fa-4x"></i>
					<h2><?php echo $servizio["titolo"];?></h2>
				</article>
				</a>
			<?php
			}
			?>
		</div>
		<a class="button bg-light only-mobile" href="servizi.php" title="Vai alla pagina Servizi">Scopri di più</a>
	</div>
</main>
<?php
	include "footer.php";
?>