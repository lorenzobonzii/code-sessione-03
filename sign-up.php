<?php
	include "controller.php";
	include "header.php";
?>
<main>
	<div class="main">
		<div class="title">
			<h1><?php echo $pagina["titolo"] ?></h1><hr>
		</div>
		<div class="content">
			<section class="<?php echo $pagina["template"] ?> bg-dark no-hover">
				<form action="sign-up.php" method="post">
					<label <?php if (isset($errori["nome"])) echo 'class="errore"'; ?> for="nome">Nome: *</label>
					<input <?php if (isset($errori["nome"])) echo 'class="errore"'; ?> type="text" id="nome" name="nome" placeholder="Nome" value='<?php if(isset($_POST["nome"])) echo $_POST["nome"];?>' required>
					<?php if (isset($errori["nome"])) echo '<p class="testo-errore">'.$errori["nome"].'</p>'; ?>
					<label <?php if (isset($errori["cognome"])) echo 'class="errore"'; ?> for="cognome">Cognome: *</label>
					<input <?php if (isset($errori["cognome"])) echo 'class="errore"'; ?> type="text" id="cognome" name="cognome" placeholder="Cognome" value='<?php if(isset($_POST["cognome"])) echo $_POST["cognome"];?>' required>
					<?php if (isset($errori["cognome"])) echo '<p class="testo-errore">'.$errori["cognome"].'</p>'; ?>
					<label <?php if (isset($errori["email"])) echo 'class="errore"'; ?> for="email">Email: *</label>
					<input <?php if (isset($errori["email"])) echo 'class="errore"'; ?> type="email" id="email" name="email" placeholder="Email" value='<?php if(isset($_POST["email"])) echo $_POST["email"];?>' required>
					<?php if (isset($errori["email"])) echo '<p class="testo-errore">'.$errori["email"].'</p>'; ?>
					<label <?php if (isset($errori["password"])) echo 'class="errore"'; ?> for="password">Password: *</label>
					<input <?php if (isset($errori["password"])) echo 'class="errore"'; ?> type="password" id="password" name="password" placeholder="Password" value='<?php if(isset($_POST["password"])) echo $_POST["password"];?>' required>
					<?php if (isset($errori["password"])) echo '<p class="testo-errore">'.$errori["password"].'</p>'; ?>
					<label <?php if (isset($errori["privacy"])) echo 'class="errore"'; ?> for="privacy">Consenso privacy: *</label><br>
					<input type="checkbox" id="privacy" name="privacy" required><small><i> Dichiaro di aver preso visione dell'informativa sulla <a href="privacy.php">Privacy</a> e di accettare termini e condizioni di utilizzo dei servizi del sito.</i></small>
					<?php if (isset($errori["privacy"])) echo '<p class="testo-errore">'.$errori["privacy"].'</p>'; ?><br><br>
					<input class="bg-default submit" type="submit" value="Registrati" name="sign-up">
				</form>
			</section>
		</div>
	</div>
</main>
<?php
	include "footer.php";
?>