<?php
    include "controller.php";
    include "header.php";
	if (!$slug_sottopagina){ //Non è stata indicata una sottopagina: creazione utente
?>
		<main>
            <div class="main">
                <div class="title">
                    <h1>Crea <?php echo $pagina["titolo"] ?></h1><hr>
                </div>
                <div class="content">
                    <section class="<?php echo $pagina["template"] ?> singola-gestione bg-dark no-hover">
                        <form action="utente.php" method="post" enctype="multipart/form-data">
                            <label <?php if (isset($errori["nome"])) echo 'class="errore"'; ?> for="nome">Nome: *</label>
                            <input <?php if (isset($errori["nome"])) echo 'class="errore"'; ?> type="text" id="nome" name="nome" placeholder="Nome" value='<?php if(isset($_POST["nome"])) echo $_POST["nome"];?>' required>
                            <?php if (isset($errori["nome"])) echo '<p class="testo-errore">'.$errori["nome"].'</p>'; ?>
                            <label <?php if (isset($errori["cognome"])) echo 'class="errore"'; ?> for="cognome">Cognome: *</label>
                            <input <?php if (isset($errori["cognome"])) echo 'class="errore"'; ?> type="text" id="cognome" name="cognome" placeholder="Cognome" value='<?php if(isset($_POST["cognome"])) echo $_POST["cognome"];?>' required>
                            <?php if (isset($errori["cognome"])) echo '<p class="testo-errore">'.$errori["cognome"].'</p>'; ?>
                            <label <?php if (isset($errori["email"])) echo 'class="errore"'; ?> for="email">Email: *</label>
                            <input <?php if (isset($errori["email"])) echo 'class="errore"'; ?> type="email" id="email" name="email" placeholder="Email" value='<?php if(isset($_POST["email"])) echo $_POST["email"];?>' required>
                            <?php if (isset($errori["email"])) echo '<p class="testo-errore">'.$errori["email"].'</p>'; ?>
                            <label <?php if (isset($errori["password"])) echo 'class="errore"'; ?> for="password">Password: *<br/></label>
                            <input <?php if (isset($errori["password"])) echo 'class="errore"'; ?> type="password" id="password" name="password" placeholder="Password" value='<?php if(isset($_POST["password"])) echo $_POST["password"];?>' required>
                            <?php if (isset($errori["password"])) echo '<p class="testo-errore">'.$errori["password"].'</p>'; ?>
                            <label <?php if (isset($errori["admin"])) echo 'class="errore"'; ?> for="admin">Admin:</label>
                            <input <?php if (isset($errori["admin"])) echo 'class="errore"'; ?> style="width:50px !important" type="checkbox" id="admin" name="admin" <?php if (isset($_POST["admin"])) echo "checked"; else if ($utente["admin"]) echo "checked";?>>
                            <?php if (isset($errori["admin"])) echo '<p class="testo-errore">'.$errori["admin"].'</p>'; ?><br><br>
					        <label <?php if (isset($errori["privacy"])) echo 'class="errore"'; ?> for="privacy">Consenso privacy: *</label><br>
					        <input type="checkbox" id="privacy" name="privacy" required><small><i> Dichiaro di aver preso visione dell'informativa sulla <a href="privacy.php">Privacy</a> e di accettare termini e condizioni di utilizzo dei servizi del sito.</i></small>
					        <?php if (isset($errori["privacy"])) echo '<p class="testo-errore">'.$errori["privacy"].'</p>'; ?><br><br>
                            <input class="bg-default submit" type="submit" value="Crea utente" name="crea-utente">
                        </form>
                    </section>
                </div>
            </div>
        </main>
<?php
	}
	else { //E'stata indicata una sottopagina: modifica utente
		$key_ut = array_search($slug_sottopagina, array_column($utenti,"id")); 
		$utente = $utenti[$key_ut];
?>
        <main>
        <div class="main">
            <div class="title">
                <h1>Modifica <?php echo $pagina["titolo"] ?></h1><hr>
            </div>
            <div class="content">
                <section class="<?php echo $pagina["template"] ?> singola-gestione bg-dark no-hover">
                    <form action="utente.php?id=<?php echo $utente["id"] ?>" method="post" enctype="multipart/form-data">
                        <label <?php if (isset($errori["nome"])) echo 'class="errore"'; ?> for="nome">Nome: *</label>
                        <input <?php if (isset($errori["nome"])) echo 'class="errore"'; ?> type="text" id="nome" name="nome" placeholder="Nome" value='<?php if(isset($_POST["nome"])) echo $_POST["nome"]; else echo $utente["nome"];?>' required>
                        <?php if (isset($errori["nome"])) echo '<p class="testo-errore">'.$errori["nome"].'</p>'; ?>
                        <label <?php if (isset($errori["cognome"])) echo 'class="errore"'; ?> for="cognome">Cognome: *</label>
                        <input <?php if (isset($errori["cognome"])) echo 'class="errore"'; ?> type="text" id="cognome" name="cognome" placeholder="Cognome" value='<?php if(isset($_POST["cognome"])) echo $_POST["cognome"]; else echo $utente["cognome"];?>' required>
                        <?php if (isset($errori["cognome"])) echo '<p class="testo-errore">'.$errori["cognome"].'</p>'; ?>
                        <label <?php if (isset($errori["email"])) echo 'class="errore"'; ?> for="email">Email: *</label>
                        <input <?php if (isset($errori["email"])) echo 'class="errore"'; ?> type="email" id="email" name="email" placeholder="Email" value='<?php if(isset($_POST["email"])) echo $_POST["email"]; else echo $utente["email"];?>' required>
                        <?php if (isset($errori["email"])) echo '<p class="testo-errore">'.$errori["email"].'</p>'; ?>
                        <label <?php if (isset($errori["password"])) echo 'class="errore"'; ?> for="password">Password: *<br/><small>Compilare solo se si vuole cambiare la password attuale</small></label>
                        <input <?php if (isset($errori["password"])) echo 'class="errore"'; ?> type="password" id="password" name="password" placeholder="Password">
                        <?php if (isset($errori["password"])) echo '<p class="testo-errore">'.$errori["password"].'</p>'; ?>
                        <label <?php if (isset($errori["admin"])) echo 'class="errore"'; ?> for="admin">Admin:</label>
                        <input <?php if (isset($errori["admin"])) echo 'class="errore"'; ?> style="width:50px !important" type="checkbox" id="admin" name="admin" <?php if (isset($_POST["admin"])) echo "checked"; else if ($utente["admin"]) echo "checked";?>>
                        <?php if (isset($errori["admin"])) echo '<p class="testo-errore">'.$errori["admin"].'</p>'; ?><br><br>
                        <input type="hidden" id="id" name="id" value="<?php echo $utente["id"]; ?>" required>
                        <input class="bg-default submit" type="submit" value="Modifica utente" name="modifica-utente">
                    </form>
                </section>
            </div>
        </div>
        </main>
<?php
    }
?>
<?php
	include "footer.php";
?>