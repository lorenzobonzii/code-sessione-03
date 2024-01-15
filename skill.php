<?php
	include "controller.php";
    include "header.php";
	if (!$slug_sottopagina){ //Non è stata indicata una sottopagina: creazione skill
?>
		<main>
        <div class="main">
            <div class="title">
                <h1>Crea <?php echo $pagina["titolo"] ?></h1><hr>
            </div>
            <div class="content">
                <section class="<?php echo $pagina["template"] ?> singola-gestione bg-dark no-hover">
                    <form action="skill.php" method="post" enctype="multipart/form-data">
                        <label <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> for="titolo">Titolo Skill: *</label>
                        <input <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> type="text" id="titolo" name="titolo" placeholder="Titolo Skill" value='<?php if(isset($_POST["titolo"])) echo $_POST["titolo"];?>' required>
                        <?php if (isset($errori["titolo"])) echo '<p class="testo-errore">'.$errori["titolo"].'</p>'; ?>
                        <label <?php if (isset($errori["immagine"])) echo 'class="errore"'; ?> for="immagine">Immagine: *</label>
                        <input <?php if (isset($errori["immagine"])) echo 'class="errore"'; ?> type="file" id="immagine" name="immagine" placeholder="Caricare l'immagine" required>
                        <?php if (isset($errori["immagine"])) echo '<p class="testo-errore">'.$errori["immagine"].'</p>'; ?>
                        <label <?php if (isset($errori["slug"])) echo 'class="errore"'; ?> for="slug">Slug: *</label>
                        <input <?php if (isset($errori["slug"])) echo 'class="errore"'; ?> type="text" id="slug" name="slug" placeholder="Inserisci lo slug" value='<?php if(isset($_POST["slug"])) echo $_POST["slug"];?>' required>
                        <?php if (isset($errori["slug"])) echo '<p class="testo-errore">'.$errori["slug"].'</p>'; ?>
                        <label <?php if (isset($errori["percentuale"])) echo 'class="errore"'; ?> for="percentuale">Percentuale: *</label>
                        <input <?php if (isset($errori["percentuale"])) echo 'class="errore"'; ?> type="number" min="1" max="100" id="percentuale" name="percentuale" placeholder="Inserisci numero percentuale" value='<?php if(isset($_POST["percentuale"])) echo $_POST["percentuale"];?>' required>
                        <?php if (isset($errori["percentuale"])) echo '<p class="testo-errore">'.$errori["percentuale"].'</p>'; ?>
                        <label <?php if (isset($errori["colore"])) echo 'class="errore"'; ?> for="colore">Colore: *</label><br>
                        <input <?php if (isset($errori["colore"])) echo 'class="errore"'; ?> type="color" id="colore" name="colore" placeholder="Inserisci codice colore" value='<?php if(isset($_POST["colore"])) echo $_POST["colore"];?>' required>
                        <?php if (isset($errori["colore"])) echo '<p class="testo-errore">'.$errori["colore"].'</p>'; ?><br>
                        <input class="bg-default submit" type="submit" value="Crea Skill" name="crea-skill">
                    </form>
                </section>
            </div>
        </div>
        </main>
<?php
	}
	else { //E'stata indicata una sottopagina di portfolio
        $skill = SelectFirstSql("SELECT * FROM skills WHERE id = $slug_sottopagina");
?>
        <main>
        <div class="main">
            <div class="title">
                <h1>Modifica <?php echo $pagina["titolo"] ?></h1><hr>
            </div>
            <div class="content">
                <section class="<?php echo $pagina["template"] ?> singola-gestione bg-dark no-hover">
                    <form action="skill.php?id=<?php echo $skill["id"] ?>" method="post" enctype="multipart/form-data">
                        <label <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> for="titolo">Titolo Skill: *</label>
                        <input <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> type="text" id="titolo" name="titolo" placeholder="Titolo Skill" required value="<?php if (isset($_POST["titolo"])) echo $_POST["titolo"]; else echo $skill["titolo"]; ?>">
                        <?php if (isset($errori["titolo"])) echo '<p class="testo-errore">'.$errori["titolo"].'</p>'; ?>
                        <img height="100px" src="<?php echo $skill["url_icona"];?>"><br>
                        <label <?php if (isset($errori["immagine"])) echo 'class="errore"'; ?> for="immagine">Immagine:</label><br>
                        <input <?php if (isset($errori["immagine"])) echo 'class="errore"'; ?> type="file" id="immagine" name="immagine" placeholder="Caricare l'immagine">
                        <?php if (isset($errori["immagine"])) echo '<p class="testo-errore">'.$errori["immagine"].'</p>'; ?>
                        <label <?php if (isset($errori["slug"])) echo 'class="errore"'; ?> for="slug">Slug: *</label>
                        <input <?php if (isset($errori["slug"])) echo 'class="errore"'; ?> type="text" id="slug" name="slug" placeholder="Inserisci lo slug" required value="<?php if (isset($_POST["slug"])) echo $_POST["slug"]; else echo $skill["slug"]; ?>">
                        <?php if (isset($errori["slug"])) echo '<p class="testo-errore">'.$errori["slug"].'</p>'; ?>
                        <label <?php if (isset($errori["percentuale"])) echo 'class="errore"'; ?> for="percentuale">Percentuale: *</label>
                        <input <?php if (isset($errori["percentuale"])) echo 'class="errore"'; ?> type="number" min="1" max="100" id="percentuale" name="percentuale" placeholder="Inserisci numero percentuale" required value="<?php if (isset($_POST["percentuale"])) echo $_POST["percentuale"]; else echo $skill["percentuale"]; ?>">
                        <?php if (isset($errori["percentuale"])) echo '<p class="testo-errore">'.$errori["percentuale"].'</p>'; ?>
                        <label <?php if (isset($errori["colore"])) echo 'class="errore"'; ?> for="colore">Colore: *</label><br>
                        <input <?php if (isset($errori["colore"])) echo 'class="errore"'; ?> type="color" id="colore" name="colore" placeholder="Inserisci codice colore" required value="<?php if (isset($_POST["colore"])) echo $_POST["colore"]; else echo $skill["colore"]; ?>">
                        <?php if (isset($errori["colore"])) echo '<p class="testo-errore">'.$errori["colore"].'</p>'; ?><br>
                        <input type="hidden" value="<?php echo $skill["id"]; ?>" name="id">
                        <input class="bg-default submit" type="submit" value="Modifica Skill" name="modifica-skill">
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