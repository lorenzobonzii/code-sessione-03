<?php
	include "controller.php";
	include "header.php";

	if(isset($messaggio_errore) || isset($messaggio_successo)){
		$pagina["titolo"] = '307 Temporary Redirect';
	}	
	else
		$pagina["titolo"] = "404 Not Found";
?>
<main>
	<div class="main">
		<div class="title">
			<h1><?php echo $pagina["titolo"]; ?></h1><hr>
		</div>
		<div class="content">
			<div class="errore">
				<?php 
				if(isset($messaggio_errore)){ ?>
						<p class="messaggio-errore"><?php echo $messaggio_errore; ?></p>
				<?php } 
				else if(isset($messaggio_successo)){ ?>
						<p class="messaggio-successo"><?php echo $messaggio_successo; ?></p>
				<?php } 
				else { ?>
						<p>Non è stata trovata la pagina richiesta...</p>
				<?php } ?>
				<a class="button bg-dark" href="index.php" title="Vai alla pagina Home"><i class="icon fas fa-home"></i>&nbsp;<span> Vai alla Home</span></a>
			</div>
		</div>
	</div>
</main>
<?php
	include "footer.php";
?>