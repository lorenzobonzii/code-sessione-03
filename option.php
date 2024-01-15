<?php
	include "controller.php";
    include "header.php";
	if ($slug_sottopagina){ //è stata indicata una sottopagina: creazione option
        $option = SelectFirstSql("SELECT * FROM opzioni WHERE id = $slug_sottopagina");
?>
        <main>
        <div class="main">
            <div class="title">
                <h1>Modifica <?php echo $pagina["titolo"] ?></h1><hr>
            </div>
            <div class="content">
                <section class="<?php echo $pagina["template"] ?> singola-gestione bg-dark no-hover">
                    <form action="option.php?id=<?php echo $option["id"] ?>" method="post" enctype="multipart/form-data">
                        <h2><?php echo $option["titolo"];?></h2><br>
                        <?php if($option["formato_campo"]=="img"){ ?>
                        <img height="100px" src="<?php echo $option["valore"];?>"><br>
                        <input <?php if (isset($errori["valore"])) echo 'class="errore"'; ?> type="file" id="valore" name="valore" placeholder="Caricare l'immagine">
                        <?php if (isset($errori["valore"])) echo '<p class="testo-errore">'.$errori["valore"].'</p>'; ?>
                        <?php } ?>
                        <?php if($option["formato_campo"]=="textarea"){ ?>
                        <textarea class="tiny <?php if (isset($errori["valore"])) echo 'errore'; ?>" rows="10" id="valore" name="valore" placeholder="Inserire il valore"><?php if (isset($_POST["valore"])) echo $_POST["valore"]; else echo $option["valore"]; ?></textarea>
                        <?php if (isset($errori["valore"])) echo '<p class="testo-errore">'.$errori["valore"].'</p>'; ?>
                        <?php } ?>
                        <?php if($option["formato_campo"]=="email"){ ?>
                        <input <?php if (isset($errori["valore"])) echo 'class="errore"'; ?> type="email" id="valore" name="valore" placeholder="Email" value='<?php if(isset($_POST["valore"])) echo $_POST["valore"]; else echo $option["valore"];?>'>
                        <?php if (isset($errori["valore"])) echo '<p class="testo-errore">'.$errori["valore"].'</p>'; ?>
                        <?php } ?>
                        <?php if($option["formato_campo"]=="select"){ ?>
                        <select <?php if (isset($errori["valore"])) echo 'class="errore"'; ?> name="valore">
                            <option value="light" <?php if($option["valore"]=="light") echo "selected"; ?>>Light</option>
                            <option value="dark" <?php if($option["valore"]=="dark") echo "selected"; ?>>Dark</option>
                        </select><br><br>
                        <?php if (isset($errori["valore"])) echo '<p class="testo-errore">'.$errori["valore"].'</p>'; ?>
                        <?php } ?>
                        <?php if($option["formato_campo"]=="text"){ ?>
                        <input <?php if (isset($errori["valore"])) echo 'class="errore"'; ?> type="text" id="valore" name="valore" placeholder="Valore" value='<?php if(isset($_POST["valore"])) echo $_POST["valore"]; else echo $option["valore"];?>'>
                        <?php if (isset($errori["valore"])) echo '<p class="testo-errore">'.$errori["valore"].'</p>'; ?>
                        <?php } ?>
                        <input type="hidden" value="<?php echo $option["id"]; ?>" name="id">
                        <input class="bg-default submit" type="submit" value="Modifica Opzione" name="modifica-option">
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