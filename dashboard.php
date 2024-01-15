<?php
	include "controller.php";
	include "header.php";
?>
<main>
	<div class="main">
		<div class="title">
			<h1><?php echo $pagina["titolo"]; ?></h1><hr>
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
        <div class="gestione">
            <button class="accordion"><h2>Gestione Opzioni</h2><i class="fas fa-chevron-down"></i></button>
            <div class="panel">
                <div class="tabella">
                    <table>
                        <thead>
                            <tr>
                                <th>Chiave</th>
                                <th>Valore</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($options_array as $option){ 
                            ?>
                            <tr>
                                <td><?php echo $option["titolo"];?></td>
                                <?php 
                                if ($option["formato_campo"]=="img"){
                                ?>
                                    <td><img height="30px" src="<?php echo $option["valore"];?>"></td>
                                <?php 
                                } 
                                else {
                                ?>
                                    <td><?php echo $option["valore"];?></td>
                                <?php 
                                } ?>
                                <td>
                                    <a class="button bg-green" href="option.php?id=<?php echo $option["id"];?>" title="Modifica Opzione <?php echo $option["chiave"];?>">Modifica</a>
                                </td>
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="gestione">
            <button class="accordion"><h2>Gestione Pagine</h2><i class="fas fa-chevron-down"></i></button>
            <div class="panel">
                <div class="tabella">
                    <table>
                        <thead>
                            <tr>
                                <th>Titolo</th>
                                <th>Link</th>
                                <th>Template</th>
                                <th>Icona</th>
                                <th>Ordine</th>
                                <th>Riservata</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($pages as &$page){ ?>
                            <tr>
                                <td><?php echo $page["titolo"];?></td>
                                <td><?php echo $page["link"];?></td>
                                <td><?php echo $page["template"];?></td>
                                <td><i class="<?php echo $page["icona"];?>"></i></td>
                                <td><?php echo $page["ordine"];?></td>
                                <td><?php if ($page["riservata"]) echo "SI"; else echo "NO";?></td>
                                <td>
                                    <a class="button bg-green" href="pagina.php?id=<?php echo $page["id"];?>" title="Modifica pagina <?php echo $page["titolo"];?>">Modifica</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
		<div class="gestione">
            <button class="accordion"><h2>Gestione Progetti</h2><i class="fas fa-chevron-down"></i></button>
            <div class="panel">
                <a class="button bg-dark" href="progetto.php" title="Inserisci nuovo progetto">Inserisci nuovo progetto</a>
                <div class="tabella">
                    <table>
                        <thead>
                            <tr>
                                <th>Titolo</th>
                                <th>Immagine</th>
                                <th>Sito</th>
                                <th>In Evidenza</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($progetti as $progetto){ ?>
                            <tr>
                                <td><?php echo $progetto["titolo"];?></td>
                                <td><img height="30px" src="<?php echo $progetto["url_img"];?>"></td>
                                <td><a href="<?php echo $progetto["link"];?>" title="<?php echo $progetto["titolo"];?>"><?php echo $progetto["link"];?></a></td>
                                <td><?php if ($progetto["in_evidenza"]) echo "SI"; else echo "NO";?></td>
                                <td>
                                    <a class="button bg-green" href="progetto.php?id=<?php echo $progetto["id"];?>" title="Modifica progetto <?php echo $progetto["titolo"];?>">Modifica</a>
                                    <a class="button bg-red" href="elimina-progetto.php?id=<?php echo $progetto["id"];?>" title="Elimina progetto <?php echo $progetto["titolo"];?>">Elimina</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="gestione">
            <button class="accordion"><h2>Gestione Servizi</h2><i class="fas fa-chevron-down"></i></button>
            <div class="panel">
                <a class="button bg-dark" href="servizio.php" title="Inserisci nuovo servizio">Inserisci nuovo servizio</a>
                <div class="tabella">
                    <table>
                        <thead>
                            <tr>
                                <th>Titolo</th>
                                <th>Icona</th>
                                <th>Descrizione</th>
                                <th>In Evidenza</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($servizi as $servizio){ ?>
                            <tr>
                                <td><?php echo $servizio["titolo"];?></td>
                                <td><i class="<?php echo $servizio["icona"];?>"></i></td>
                                <td><?php echo $servizio["descrizione"];?></td>
                                <td><?php if ($servizio["in_evidenza"]) echo "SI"; else echo "NO";?></td>
                                <td>
                                    <a class="button bg-green" href="servizio.php?id=<?php echo $servizio["id"];?>" title="Modifica servizio <?php echo $servizio["titolo"];?>">Modifica</a>
                                    <a class="button bg-red" href="elimina-servizio.php?id=<?php echo $servizio["id"];?>" title="Elimina servizio <?php echo $servizio["titolo"];?>">Elimina</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="gestione">
            <button class="accordion"><h2>Gestione Skills</h2><i class="fas fa-chevron-down"></i></button>
            <div class="panel">
                <a class="button bg-dark" href="skill.php" title="Inserisci nuova skill">Inserisci nuova skill</a>
                <div class="tabella">
                    <table>
                        <thead>
                            <tr>
                                <th>Titolo</th>
                                <th>Icona</th>
                                <th>Slug</th>
                                <th>Percentuale</th>
                                <th>Colore</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($skills as $skill){ ?>
                            <tr>
                                <td><?php echo $skill["titolo"];?></td>
                                <td><img height="30px" src="<?php echo $skill["url_icona"];?>"></td>
                                <td><?php echo $skill["slug"];?></td>
                                <td><?php echo $skill["percentuale"];?></td>
                                <td style="background-color:<?php echo $skill["colore"];?>;"></td>
                                <td>
                                    <a class="button bg-green" href="skill.php?id=<?php echo $skill["id"];?>" title="Modifica skill <?php echo $skill["titolo"];?>">Modifica</a>
                                    <a class="button bg-red" href="elimina-skill.php?id=<?php echo $skill["id"];?>" title="Elimina skill <?php echo $skill["titolo"];?>">Elimina</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="gestione">
            <button class="accordion"><h2>Gestione Conoscenze</h2><i class="fas fa-chevron-down"></i></button>
            <div class="panel">
                <a class="button bg-dark" href="conoscenza.php" title="Inserisci nuova conoscenza">Inserisci nuova conoscenza</a>
                <div class="tabella">
                    <table>
                        <thead>
                            <tr>
                                <th>Titolo</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($conoscenze as $conoscenza){ ?>
                            <tr>
                                <td><?php echo $conoscenza["titolo"];?></td>
                                <td>
                                    <a class="button bg-green" href="conoscenza.php?id=<?php echo $conoscenza["id"];?>" title="Modifica conoscenza <?php echo $conoscenza["titolo"];?>">Modifica</a>
                                    <a class="button bg-red" href="elimina-conoscenza.php?id=<?php echo $conoscenza["id"];?>" title="Elimina conoscenza <?php echo $conoscenza["titolo"];?>">Elimina</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
		<div class="gestione">
            <button class="accordion"><h2>Gestione Utenti</h2><i class="fas fa-chevron-down"></i></button>
            <div class="panel">
                <a class="button bg-dark" href="utente.php" title="Inserisci nuovo utente">Inserisci nuovo utente</a>
                <div class="tabella">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Cognome</th>
                                <th>Email</th>
                                <th>Admin</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($utenti as $utente){ ?>
                            <tr>
                                <td><?php echo $utente["nome"];?></td>
                                <td><?php echo $utente["cognome"];?></td>
                                <td><?php echo $utente["email"];?></td>
                                <td><?php if ($utente["admin"]) echo "SI"; else echo "NO";?></td>
                                <td>
                                    <a class="button bg-green" href="utente.php?id=<?php echo $utente['id']; ?>" title="Modifica utente <?php echo ($utente["nome"].' '.$utente["cognome"]);?>">Modifica</a>
                                    <a class="button bg-red" href="elimina-utente.php?id=<?php echo $utente['id']; ?>" title="Elimina utente <?php echo ($utente["nome"].' '.$utente["cognome"]);?>">Elimina</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="gestione">
            <button class="accordion"><h2>Gestione Messaggi "Contattaci"</h2><i class="fas fa-chevron-down"></i></button>
            <div class="panel">
                <div class="tabella">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Cognome</th>
                                <th>Email</th>
                                <th>Messaggio</th>
                                <th>Data Invio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($messaggi as $messaggio){ ?>
                            <tr>
                                <td><?php echo $messaggio["nome"];?></td>
                                <td><?php echo $messaggio["cognome"];?></td>
                                <td><?php echo $messaggio["email"];?></td>
                                <td><?php echo $messaggio["messaggio"];?></td>
                                <td><?php echo Date("d/m/Y H:i:s",strtotime($messaggio["created_at"]));?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
	include "footer.php";
?>