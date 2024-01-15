<?php
	include "controller.php";
	include "header.php";
?>
<main>
	<div class="main">
		<div class="title">
			<h1><?php echo $pagina["titolo"] ?></h1><hr>
		</div>
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
		<div class="content">
			<section class="<?php echo $pagina["template"] ?> bg-dark no-hover">
				<form action="log-in.php" method="post">
					<label <?php if (isset($errori["email"])) echo 'class="errore"'; ?> for="email">Email: *</label>
					<input <?php if (isset($errori["email"])) echo 'class="errore"'; ?> type="email" id="email" name="email" placeholder="Email" value='<?php if(isset($_POST["email"])) echo $_POST["email"];?>' required>
					<?php if (isset($errori["email"])) echo '<p class="testo-errore">'.$errori["email"].'</p>'; ?>
					<label <?php if (isset($errori["password"])) echo 'class="errore"'; ?> for="password">Password: *</label>
					<input <?php if (isset($errori["password"])) echo 'class="errore"'; ?> type="password" id="password" name="password" placeholder="Password" value='<?php if(isset($_POST["password"])) echo $_POST["password"];?>' required>
					<?php if (isset($errori["password"])) echo '<p class="testo-errore">'.$errori["password"].'</p>'; ?>
					<input class="bg-default submit" type="submit" value="Accedi" name="log-in"><br>
					<a href="sign-up.php" title="Registrati">Non hai ancora un account? <b>Registrati!</b></a>
				</form>
			</section>
		</div>
	</div>
</main>
<?php
	include "footer.php";
?>