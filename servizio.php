<?php
	include "controller.php";
    include "header.php";
	if (!$slug_sottopagina){ //Non è stata indicata una sottopagina: creazione servizio
?>
		<main>
        <div class="main">
            <div class="title">
                <h1>Crea <?php echo $pagina["titolo"] ?></h1><hr>
            </div>
            <div class="content">
                <section class="<?php echo $pagina["template"] ?> singola-gestione bg-dark no-hover">
                    <form action="servizio.php" method="post" enctype="multipart/form-data">
                        <label <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> for="titolo">Titolo Servizio: *</label>
                        <input <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> type="text" id="titolo" name="titolo" placeholder="Titolo" value='<?php if(isset($_POST["titolo"])) echo $_POST["titolo"];?>' required>
                        <?php if (isset($errori["titolo"])) echo '<p class="testo-errore">'.$errori["titolo"].'</p>'; ?>
                        <i id="icona-icona"></i><br><br>
                        <label <?php if (isset($errori["icona"])) echo 'class="errore"'; ?> for="icona">Icona: *</label>
                        <input <?php if (isset($errori["icona"])) echo 'class="errore"'; ?> type="text" id="icona" name="icona" placeholder="Inserisci testo icona" value='<?php if(isset($_POST["icona"])) echo $_POST["icona"];?>' required>
                        <?php if (isset($errori["icona"])) echo '<p class="testo-errore">'.$errori["icona"].'</p>'; ?>
                        <label <?php if (isset($errori["in-evidenza"])) echo 'class="errore"'; ?> for="in-evidenza">In Evidenza nella Home:</label>
                        <input <?php if (isset($errori["in-evidenza"])) echo 'class="errore"'; ?> style="width:50px !important" type="checkbox" id="in-evidenza" name="in-evidenza" <?php if(isset($_POST["in-evidenza"])) echo "checked";?>><br>
                        <?php if (isset($errori["in-evidenza"])) echo '<p class="testo-errore">'.$errori["in-evidenza"].'</p>'; ?><br>
                        <label <?php if (isset($errori["descrizione"])) echo 'class="errore"'; ?> for="descrizione">Descrizione: *</label>
                        <textarea class="tiny <?php if (isset($errori["descrizione"])) echo 'errore'; ?>" rows="10" id="descrizione" name="descrizione" placeholder="Inserisci la Descrizione del Servizio"><?php if(isset($_POST["descrizione"])) echo $_POST["descrizione"];?></textarea>
                        <?php if (isset($errori["descrizione"])) echo '<p class="testo-errore">'.$errori["descrizione"].'</p>'; ?>
                        <input class="bg-default submit" type="submit" value="Crea Servizio" name="crea-servizio">
                    </form>
                </section>
            </div>
        </div>
        </main>
<?php
	}
	else { //E'stata indicata una sottopagina di portfolio
        $servizio = SelectFirstSql("SELECT * FROM servizi WHERE id = $slug_sottopagina");
?>
        <main>
        <div class="main">
            <div class="title">
                <h1>Modifica <?php echo $pagina["titolo"] ?></h1><hr>
            </div>
            <div class="content">
                <section class="<?php echo $pagina["template"] ?> singola-gestione bg-dark no-hover">
                    <form action="servizio.php?id=<?php echo $servizio["id"] ?>" method="post" enctype="multipart/form-data">
                        <label <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> for="titolo">Titolo Servizio: *</label>
                        <input <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> type="text" id="titolo" name="titolo" placeholder="Titolo" required value="<?php if (isset($_POST["titolo"])) echo $_POST["titolo"]; else echo $servizio["titolo"]; ?>">
                        <?php if (isset($errori["titolo"])) echo '<p class="testo-errore">'.$errori["titolo"].'</p>'; ?>
                        <i id="icona-icona" class="<?php echo $servizio["icona"]; ?> fa-4x"></i><br><br>
                        <label <?php if (isset($errori["icona"])) echo 'class="errore"'; ?> for="icona">Icona: *</label>
                        <input <?php if (isset($errori["icona"])) echo 'class="errore"'; ?> type="text" id="icona" name="icona" placeholder="Inserisci testo Icona" required value="<?php if (isset($_POST["icona"])) echo $_POST["icona"]; else echo $servizio["icona"]; ?>">
                        <?php if (isset($errori["icona"])) echo '<p class="testo-errore">'.$errori["icona"].'</p>'; ?>
                        <label <?php if (isset($errori["in-evidenza"])) echo 'class="errore"'; ?> for="in-evidenza">In Evidenza nella Home:</label>
                        <input <?php if (isset($errori["in-evidenza"])) echo 'class="errore"'; ?> style="width:50px !important" type="checkbox" id="in-evidenza" name="in-evidenza" <?php if (isset($_POST["in_evidenza"])) echo "checked"; else if ($servizio["in_evidenza"]) echo "checked";?>><br>
                        <?php if (isset($errori["in-evidenza"])) echo '<p class="testo-errore">'.$errori["in-evidenza"].'</p>'; ?><br>
                        <label <?php if (isset($errori["descrizione"])) echo 'class="errore"'; ?> for="descrizione">Descrizione: *</label>
                        <textarea class="tiny <?php if (isset($errori["descrizione"])) echo 'errore'; ?>" rows="10" id="descrizione" name="descrizione" placeholder="Inserisci la Descrizione del Servizio" ><?php if (isset($_POST["descrizione"])) echo $_POST["descrizione"]; else echo $servizio["descrizione"]; ?></textarea>
                        <?php if (isset($errori["descrizione"])) echo '<p class="testo-errore">'.$errori["descrizione"].'</p>'; ?>
                        <input type="hidden" value="<?php echo $servizio["id"]; ?>" name="id">
                        <input class="bg-default submit" type="submit" value="Modifica Servizio" name="modifica-servizio">
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