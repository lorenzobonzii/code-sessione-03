<?php
	include "controller.php";
    include "header.php";
	if (!$slug_sottopagina){ //Non è stata indicata una sottopagina: creazione conoscenza
?>
		<main>
        <div class="main">
            <div class="title">
                <h1>Crea <?php echo $pagina["titolo"] ?></h1><hr>
            </div>
            <div class="content">
                <section class="<?php echo $pagina["template"] ?> singola-gestione bg-dark no-hover">
                    <form action="conoscenza.php" method="post" enctype="multipart/form-data">
                        <label <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> for="titolo">Titolo Conoscenza: *</label>
                        <input <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> type="text" id="titolo" name="titolo" placeholder="Titolo Conoscenza" value='<?php if(isset($_POST["titolo"])) echo $_POST["titolo"];?>' required>
                        <?php if (isset($errori["titolo"])) echo '<p class="testo-errore">'.$errori["titolo"].'</p>'; ?>
                        <input class="bg-default submit" type="submit" value="Crea Conoscenza" name="crea-conoscenza">
                    </form>
                </section>
            </div>
        </div>
        </main>
<?php
	}
	else { //E'stata indicata una sottopagina di portfolio
        $conoscenza = SelectFirstSql("SELECT * FROM conoscenze WHERE id = $slug_sottopagina");
?>
        <main>
        <div class="main">
            <div class="title">
                <h1>Modifica <?php echo $pagina["titolo"] ?></h1><hr>
            </div>
            <div class="content">
                <section class="<?php echo $pagina["template"] ?> singola-gestione bg-dark no-hover">
                    <form action="conoscenza.php?id=<?php echo $conoscenza["id"] ?>" method="post" enctype="multipart/form-data">
                        <label <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> for="titolo">Titolo Conoscenza: *</label>
                        <input <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> type="text" id="titolo" name="titolo" placeholder="Titolo Conoscenza" required value="<?php if (isset($_POST["titolo"])) echo $_POST["titolo"]; else echo $conoscenza["titolo"]; ?>">
                        <?php if (isset($errori["titolo"])) echo '<p class="testo-errore">'.$errori["titolo"].'</p>'; ?>
                        <input type="hidden" value="<?php echo $conoscenza["id"]; ?>" name="id">
                        <input class="bg-default submit" type="submit" value="Modifica Conoscenza" name="modifica-conoscenza">
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