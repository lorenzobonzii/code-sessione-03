<?php
	include "controller.php";
	include "header.php";
?>
<main>
	<div class="main">
		<div class="title">
			<h1><?php echo $pagina["titolo"]; ?></h1><hr>
		</div>
		<div class="content <?php echo $pagina["template"]; ?>">
			<aside class="left">
				<?php 
				if ($options["telefono"]) {?>
				<a href="tel:<?php echo $options["telefono"]; ?>" title="Chiama il numero <?php echo $options["telefono"]; ?>">
					<article class="article bg-dark">
						<div>
							<i class="icon fas fa-phone"></i>
							<h2>Telefono</h2>
						</div>
						<p><?php echo $options["telefono"]; ?></p>
					</article>
				</a>
				<?php 
				}
				if ($options["email"]) {?>
				<a href="mailto:<?php echo $options["email"]; ?>" title="Scrivi all'email <?php echo $options["email"]; ?>">
					<article class="article bg-dark">
						<div>
							<i class="icon fas fa-envelope"></i>
							<h2>Email</h2>
						</div>
						<p><?php echo $options["email"]; ?></p>
					</article>
				</a>
				<?php 
				}
				if ($options["sito_web"]) {?>
				<a href="https://<?php echo $options["sito_web"]; ?>" title="Vai al sito <?php echo $options["sito_web"]; ?>">
					<article class="article bg-dark">
						<div>
							<i class="icon fas fa-globe"></i>
							<h2>Sito Web</h2>
						</div>
						<p><?php echo $options["sito_web"]; ?></p>
					</article>
				</a>
				<?php 
				}
				if ($options["indirizzo"]) {?>
				<article class="article bg-dark">
					<div>
						<i class="icon fas fa-map-marker"></i>
						<h2>Indirizzo</h2>
					</div>
					<p><?php echo $options["indirizzo"]; ?></p>
					<iframe src="https://maps.google.com/maps?q=<?php echo $options["indirizzo"]; ?>&ie=UTF8&iwloc=&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</article>
				<?php 
				} ?>
			</aside>
			<section class="principale no-hover">
				<div class="form bg-dark article">
					<form action="contatti.php" method="post" name="form">
						<h2>Contattaci</h2>
						<?php if (isset($errori) && count($errori)==0) echo "<p class='messaggio-successo'>Messaggio inviato correttamente!</p>";?>
						<label <?php if (isset($errori["nome"])) echo 'class="errore"'; ?> for="nome">Nome: *</label>
						<input <?php if (isset($errori["nome"])) echo 'class="errore"'; ?> type="text" id="nome" name="nome" placeholder="Nome" value='<?php if(isset($_POST["nome"])) echo $_POST["nome"];?>'>
						<?php if (isset($errori["nome"])) echo '<p class="testo-errore">'.$errori["nome"].'</p>'; ?>
						<label <?php if (isset($errori["cognome"])) echo 'class="errore"'; ?> for="cognome">Cognome: *</label>
						<input <?php if (isset($errori["cognome"])) echo 'class="errore"'; ?> type="text" id="cognome" name="cognome" placeholder="Cognome" value='<?php if(isset($_POST["cognome"])) echo $_POST["cognome"];?>'>
						<?php if (isset($errori["cognome"])) echo '<p class="testo-errore">'.$errori["cognome"].'</p>'; ?>
						<label <?php if (isset($errori["telefono"])) echo 'class="errore"'; ?> for="telefono">Telefono:</label>
						<input <?php if (isset($errori["telefono"])) echo 'class="errore"'; ?> type="number" id="telefono" name="telefono" placeholder="Telefono" value='<?php if(isset($_POST["telefono"])) echo $_POST["telefono"];?>'>
						<?php if (isset($errori["telefono"])) echo '<p class="testo-errore">'.$errori["telefono"].'</p>'; ?>
						<label <?php if (isset($errori["email"])) echo 'class="errore"'; ?> for="email">Email: *</label>
						<input <?php if (isset($errori["email"])) echo 'class="errore"'; ?> type="email" id="email" name="email" placeholder="Email" value='<?php if(isset($_POST["email"])) echo $_POST["email"];?>'>
						<?php if (isset($errori["email"])) echo '<p class="testo-errore">'.$errori["email"].'</p>'; ?>
						<label <?php if (isset($errori["oggetto"])) echo 'class="errore"'; ?> for="oggetto">Oggetto: *</label><span id="cont-oggetto"></span>
						<textarea <?php if (isset($errori["oggetto"])) echo 'class="errore"'; ?> id="oggetto" name="oggetto" style="resize: none;" rows="2" placeholder="Inserisci oggetto"><?php if(isset($_POST["oggetto"])) echo $_POST["oggetto"];?></textarea>
						<?php if (isset($errori["oggetto"])) echo '<p class="testo-errore">'.$errori["oggetto"].'</p>'; ?>
						<label <?php if (isset($errori["messaggio"])) echo 'class="errore"'; ?> for="messaggio">Messaggio: *</label><span id="cont-messaggio"></span>
						<textarea <?php if (isset($errori["messaggio"])) echo 'class="errore"'; ?> id="messaggio" name="messaggio" style="resize: none;" rows="4" placeholder="Inserisci testo"><?php if(isset($_POST["messaggio"])) echo $_POST["messaggio"];?></textarea>
						<?php if (isset($errori["messaggio"])) echo '<p class="testo-errore">'.$errori["messaggio"].'</p>'; ?>
						<input type="hidden" name="contatti" value="Invia">
						<input class="bg-default submit" type="submit">
					</form>
				</div>
				<div class="article social">
				<?php 
					if ($options["instagram"]) {?>
						<a href="https://www.instagram.com/<?php echo $options["instagram"];?>" title="Vai al profilo Instagram">
							<i class="icon button-i circle bg-light fa-brands fa-instagram"></i>
						</a>
					<?php 
					}
					if ($options["facebook"]) {?>
						<a href="https://www.facebook.com/<?php echo $options["facebook"];?>" title="Vai al profilo Facebook">
							<i class="icon button-i circle bg-light fa-brands fa-facebook"></i>
						</a>
					<?php 
					}
					if ($options["twitter_x"]) {?>
						<a href="https://www.twitter.com/<?php echo $options["twitter_x"];?>" title="Vai al profilo Twitter">
							<i class="icon button-i circle bg-light fa-brands fa-x-twitter"></i>
						</a>
					<?php 
					}
					if ($options["linkedin"]) {?>
						<a href="https://www.linkedin.com/in/<?php echo $options["linkedin"];?>" title="Vai al profilo LinkedIN">	
							<i class="icon button-i circle bg-light fa-brands fa-linkedin"></i>
						</a>
					<?php 
					} ?>
				</div>
			</section>
		</div>
	</div>
</main>
<script type="text/javascript" src="js/functions.js"></script>
<?php
	include "footer.php";
?>