<?php
	include "controller.php";
    include "header.php";
	if ($slug_sottopagina){ //è stata indicata una sottopagina: creazione page
        $page = SelectFirstSql("SELECT * FROM pagine WHERE id = $slug_sottopagina");
?>
        <main>
        <div class="main">
            <div class="title">
                <h1>Modifica <?php echo $pagina["titolo"] ?></h1><hr>
            </div>
            <div class="content">
                <section class="<?php echo $pagina["template"] ?> singola-gestione bg-dark no-hover">
                    <form action="pagina.php?id=<?php echo $page["id"] ?>" method="post" enctype="multipart/form-data">
                        <label <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> for="titolo">Titolo Pagina: *</label>
                        <input <?php if (isset($errori["titolo"])) echo 'class="errore"'; ?> type="text" id="titolo" name="titolo" placeholder="Titolo" required value="<?php if (isset($_POST["titolo"])) echo $_POST["titolo"]; else echo $page["titolo"]; ?>">
                        <?php if (isset($errori["titolo"])) echo '<p class="testo-errore">'.$errori["titolo"].'</p>'; ?>
                        <label <?php if (isset($errori["link"])) echo 'class="errore"'; ?> for="link">Link: *</label>
                        <input <?php if (isset($errori["link"])) echo 'class="errore"'; ?> type="text" id="link" name="link" placeholder="Link" required value="<?php if (isset($_POST["link"])) echo $_POST["link"]; else echo $page["link"]; ?>">
                        <?php if (isset($errori["link"])) echo '<p class="testo-errore">'.$errori["link"].'</p>'; ?>
                        <label <?php if (isset($errori["template"])) echo 'class="errore"'; ?> for="template">Nome template: *</label>
                        <input <?php if (isset($errori["template"])) echo 'class="errore"'; ?> type="text" id="template" name="template" placeholder="Template" required value="<?php if (isset($_POST["template"])) echo $_POST["template"]; else echo $page["template"]; ?>">
                        <?php if (isset($errori["template"])) echo '<p class="testo-errore">'.$errori["template"].'</p>'; ?>
                        <i id="icona-icona" class="<?php echo $page["icona"]; ?> fa-4x"></i><br><br>
                        <label <?php if (isset($errori["icona"])) echo 'class="errore"'; ?> for="icona">Icona: *</label>
                        <input <?php if (isset($errori["icona"])) echo 'class="errore"'; ?> type="text" id="icona" name="icona" placeholder="Seleziona Icona" required value="<?php if (isset($_POST["icona"])) echo $_POST["icona"]; else echo $page["icona"]; ?>">
                        <?php if (isset($errori["icona"])) echo '<p class="testo-errore">'.$errori["icona"].'</p>'; ?>
                        <label <?php if (isset($errori["ordine"])) echo 'class="errore"'; ?> for="ordine">Ordine:</label>
                        <input <?php if (isset($errori["ordine"])) echo 'class="errore"'; ?> type="number" id="ordine" name="ordine" placeholder="Ordine" value="<?php if (isset($_POST["ordine"])) echo $_POST["ordine"]; else echo $page["ordine"]; ?>">
                        <?php if (isset($errori["ordine"])) echo '<p class="testo-errore">'.$errori["ordine"].'</p>'; ?>
                        <label <?php if (isset($errori["riservata"])) echo 'class="errore"'; ?> for="riservata">Riservata:</label>
                        <input <?php if (isset($errori["riservata"])) echo 'class="errore"'; ?> style="width:50px !important" type="checkbox" id="riservata" name="riservata" <?php if (isset($_POST["riservata"])) echo "checked"; else if ($page["riservata"]) echo "checked";?>><br>
                        <?php if (isset($errori["riservata"])) echo '<p class="testo-errore">'.$errori["riservata"].'</p>'; ?><br>
                        <input type="hidden" value="<?php echo $page["id"]; ?>" name="id">
                        <input class="bg-default submit" type="submit" value="Modifica Pagina" name="modifica-pagina">
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