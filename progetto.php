<?php
	include "controller.php";
    include "header.php";
	if (!$slug_sottopagina){ //Non è stata indicata una sottopagina: creazione progetto
?>
		<main>
        <div class="main">
            <div class="title">
                <h1>Crea <?php echo $pagina["titolo"] ?></h1><hr>
            </div>
            <div class="content">
                <section class="<?php echo $pagina["template"] ?> singola-gestione bg-dark no-hover">
                    <form action="progetto.php" method="post" enctype="multipart/form-data">
                        <label <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> for="titolo">Titolo Progetto: *</label>
                        <input <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> type="text" id="titolo" name="titolo" placeholder="Titolo" value='<?php if(isset($_POST["titolo"])) echo $_POST["titolo"];?>' required>
                        <?php if (isset($errori["titolo"])) echo '<p class="testo-errore">'.$errori["titolo"].'</p>'; ?>
                        <label <?php if (isset($errori["immagine"])) echo 'class="errore"'; ?> for="immagine">Immagine: *</label>
                        <input <?php if (isset($errori["immagine"])) echo 'class="errore"'; ?> type="file" id="immagine" name="immagine" placeholder="Caricare l'immagine" required>
                        <?php if (isset($errori["immagine"])) echo '<p class="testo-errore">'.$errori["immagine"].'</p>'; ?>
                        <label <?php if (isset($errori["link"])) echo 'class="errore"'; ?> for="link">Link: *</label>
                        <input <?php if (isset($errori["link"])) echo 'class="errore"'; ?> type="text" id="link" name="link" placeholder="Inserisci URL Link" value='<?php if(isset($_POST["link"])) echo $_POST["link"];?>' required>
                        <?php if (isset($errori["link"])) echo '<p class="testo-errore">'.$errori["link"].'</p>'; ?>
                        <label <?php if (isset($errori["in-evidenza"])) echo 'class="errore"'; ?> for="in-evidenza">In Evidenza nella Home:</label>
                        <input <?php if (isset($errori["in-evidenza"])) echo 'class="errore"'; ?> style="width:50px !important" type="checkbox" id="in-evidenza" name="in-evidenza" <?php if(isset($_POST["in-evidenza"])) echo "checked";?>><br>
                        <?php if (isset($errori["in-evidenza"])) echo '<p class="testo-errore">'.$errori["in-evidenza"].'</p>'; ?><br>
                        <label <?php if (isset($errori["descrizione"])) echo 'class="errore"'; ?> for="descrizione">Descrizione: *</label>
                        <textarea class="tiny <?php if (isset($errori["descrizione"])) echo 'errore'; ?>" rows="10" id="descrizione" name="descrizione" placeholder="Inserisci la Descrizione del Progetto"><?php if(isset($_POST["descrizione"])) echo $_POST["descrizione"];?></textarea>
                        <?php if (isset($errori["descrizione"])) echo '<p class="testo-errore">'.$errori["descrizione"].'</p>'; ?>
                        <input class="bg-default submit" type="submit" value="Crea Progetto" name="crea-progetto">
                    </form>
                </section>
            </div>
        </div>
        </main>
<?php
	}
	else { //E'stata indicata una sottopagina di portfolio
        $progetto = SelectFirstSql("SELECT * FROM progetti WHERE id = $slug_sottopagina");
        if (!$progetto["url_img"])
            $progetto["url_img"] = "img/progetti/progetto.png";
?>
        <main>
        <div class="main">
            <div class="title">
                <h1>Modifica <?php echo $pagina["titolo"] ?></h1><hr>
            </div>
            <div class="content">
                <section class="<?php echo $pagina["template"] ?> singola-gestione bg-dark no-hover">
                    <form action="progetto.php?id=<?php echo $progetto["id"] ?>" method="post" enctype="multipart/form-data">
                        <label <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> for="titolo">Titolo Progetto: *</label>
                        <input <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> type="text" id="titolo" name="titolo" placeholder="Titolo" required value="<?php if (isset($_POST["titolo"])) echo $_POST["titolo"]; else echo $progetto["titolo"]; ?>">
                        <?php if (isset($errori["titolo"])) echo '<p class="testo-errore">'.$errori["titolo"].'</p>'; ?>
                        <img height="100px" src="<?php echo $progetto["url_img"];?>"><br>
                        <label <?php if (isset($errori["immagine"])) echo 'class="errore"'; ?> for="immagine">Immagine:</label><br>
                        <input <?php if (isset($errori["immagine"])) echo 'class="errore"'; ?> type="file" id="immagine" name="immagine" placeholder="Caricare l'immagine">
                        <?php if (isset($errori["immagine"])) echo '<p class="testo-errore">'.$errori["immagine"].'</p>'; ?>
                        <label <?php if (isset($errori["link"])) echo 'class="errore"'; ?> for="link">Link: *</label>
                        <input <?php if (isset($errori["link"])) echo 'class="errore"'; ?> type="text" id="link" name="link" placeholder="Inserisci URL Link" required value="<?php if (isset($_POST["link"])) echo $_POST["link"]; else echo $progetto["link"]; ?>">
                        <?php if (isset($errori["link"])) echo '<p class="testo-errore">'.$errori["link"].'</p>'; ?>
                        <label <?php if (isset($errori["in-evidenza"])) echo 'class="errore"'; ?> for="in-evidenza">In Evidenza nella Home:</label>
                        <input <?php if (isset($errori["in-evidenza"])) echo 'class="errore"'; ?> style="width:50px !important" type="checkbox" id="in-evidenza" name="in-evidenza" <?php if (isset($_POST["in_evidenza"])) echo "checked"; else if ($progetto["in_evidenza"]) echo "checked";?>><br>
                        <?php if (isset($errori["in-evidenza"])) echo '<p class="testo-errore">'.$errori["in-evidenza"].'</p>'; ?><br>
                        <label <?php if (isset($errori["descrizione"])) echo 'class="errore"'; ?> for="descrizione">Descrizione: *</label>
                        <textarea class="tiny <?php if (isset($errori["descrizione"])) echo 'errore'; ?>" rows="10" id="descrizione" name="descrizione" placeholder="Inserisci la Descrizione del Progetto"><?php if (isset($_POST["descrizione"])) echo $_POST["descrizione"]; else echo $progetto["descrizione"]; ?></textarea>
                        <?php if (isset($errori["descrizione"])) echo '<p class="testo-errore">'.$errori["descrizione"].'</p>'; ?>
                        <input type="hidden" value="<?php echo $progetto["id"]; ?>" name="id">
                        <input class="bg-default submit" type="submit" value="Modifica Progetto" name="modifica-progetto">
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