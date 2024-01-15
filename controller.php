<?php
	require_once("db.php");

	session_start();
	date_default_timezone_set("Europe/Rome");
	
	$options_array = SelectArraySql('SELECT * FROM opzioni');
	$options = [];
	foreach($options_array as $option)
		$options[$option["chiave"]] = $option["valore"];
	$pages = SelectArraySql('SELECT * FROM pagine ORDER BY ordine');
	$utenti = SelectArraySql('SELECT * FROM utenti');
	$messaggi = SelectArraySql('SELECT * FROM messaggi');
	$progetti = SelectArraySql("SELECT * from progetti");
	$progetti_in_evidenza = SelectArraySql("SELECT * from progetti WHERE in_evidenza = 1");
	$servizi = SelectArraySql("SELECT * from servizi");
	$servizi_in_evidenza = SelectArraySql("SELECT * from servizi WHERE in_evidenza = 1");
	$conoscenze = SelectArraySql("SELECT * from conoscenze");
	$skills = SelectArraySql("SELECT * from skills");

	if (isset($_SESSION["messaggio-errore"])){
		$messaggio_errore = $_SESSION["messaggio-errore"];
		unset($_SESSION["messaggio-errore"]);
	}
	else {
		$messaggio_errore = null;
	}
	if (isset($_SESSION["messaggio-successo"])){
		$messaggio_successo = $_SESSION["messaggio-successo"];
		unset($_SESSION["messaggio-successo"]);
	}
	else {
		$messaggio_successo = null;
	}

	include("functions.php");
	
	/* GESTIONE DELL'URL DELLA RICHIESTA */

	if (isset($_SESSION['session_id'])){
		foreach ($pages as &$page) {
			if ($page["id"]==10) {
				$page["titolo"] = 'Log Out';
				$page["icona"] = 'fas fa-right-from-bracket';
			}
		}
	}

	$slug_pagina = getSlugPagina();
	$pagina = cercaElementoInArray($pages,'template', $slug_pagina);
	
	if (isset($_GET["id"]))
		$slug_sottopagina = $_GET["id"];
	else
		$slug_sottopagina = null;

	/* GESTIONE DELL'AREA RISERVATA E DEI RELATIVI REINDIRIZZAMENTI */

	//Se si cerca di accedere ad una pagina riservata e non si è fatto il login, si viene reindirizzati alla pagina di log-in	
	if ($pagina["riservata"]==1 && !isset($_SESSION['session_id'])){
		$_SESSION["messaggio-errore"] = "La pagina è riservata! Devi accedere per poterla visualizzare!";
		header('Location: log-in.php');
		exit;
	}
	
	//Se si cerca di accedere ad una pagina riservata e si è fatto il login, in $utente viene messo l'utente connesso.
	//Se non risulta un utente relativamente a quello salvato nella sessione php, si viene disconnessi.
	else if ($pagina["riservata"]==1 && isset($_SESSION['session_id'])){
		$email = $_SESSION['session_user'];
		$utente = cercaElementoInArray($utenti, 'email', $email);
		if (!$utente){
			logout();
			$_SESSION["messaggio-errore"] = "Devi riaccedere!";
			header('Location: log-in.php');
			exit;
		}
		else if ($utente["admin"]==0){
			$_SESSION["messaggio-errore"] = "La pagina è riservata agli amministratori! Devi essere admin per poterla visualizzare!";
			header('Location: error.php');
			exit;
		}
	}
	
	/* GESTIONE LOGIN */

	//Tenta il login: se riesce redirige alla dashboard, altrimenti restituisce l'errore
	if (isset($_POST['log-in'])) {
		$errori = login($_POST['email'], $_POST['password']);
		if (!$errori){
			$utente = cercaElementoInArray($utenti, 'email', $_POST["email"]);		
			$_SESSION["messaggio-successo"] = "Benvenuto, ".$utente["nome"]."!";
			header('Location: dashboard.php');
			exit;
		}
	}

	/* GESTIONE LOGOUT */

	//Distrugge la sessione php e redirige alla pagina di login
	if (isset($_SESSION['session_id']) && $pagina["template"]=="log-in"){
		logout();
		$_SESSION["messaggio-successo"] = "Utente disconnesso. A presto!";
		header('Location: log-in.php');
		exit;
	}
	if (isset($_SESSION['session_id']) && $pagina["template"]=="sign-up"){
		$_SESSION["messaggio-successo"] = "Utente già connesso...";
		header('Location: dashboard.php');
		exit;
	}

	/* GESTIONE REGISTRAZIONE */

	//Tenta la registrazione: se riesce redirige alla pagina di login, altrimenti restituisce l'errore
	if (isset($_POST['sign-up'])) {
		if (isset($_POST["admin"]))	
			$errori = creaUtente($_POST['nome'], $_POST['cognome'], $_POST["email"], $_POST["password"], $_POST["admin"]);
		else
			$errori = creaUtente($_POST['nome'], $_POST['cognome'], $_POST["email"], $_POST["password"], null);	
		if (!$errori){
			$_SESSION["messaggio-successo"] = "Utente creato correttamente!";
			header("Location: log-in.php");
		}
	}

	/* FUNZIONI DI GESTIONE UTENTI */
	
	if (isset($_POST["crea-utente"])){
		$errori = creaUtente($_POST['nome'], $_POST['cognome'], $_POST["email"], $_POST["password"], $_POST["admin"]);
		if (!$errori){
			$_SESSION["messaggio-successo"] = "Utente creato correttamente!";
			header("Location: dashboard.php");
		}
	}

	if (isset($_POST['modifica-utente']) && isset($_POST["id"])) {
		if (isset($_POST["password"]))	
			$errori = modificaUtente($_POST['id'], $_POST['nome'], $_POST['cognome'], $_POST["email"], $_POST["password"], $_POST["admin"]);
		else
			$errori = modificaUtente($_POST['id'], $_POST['nome'], $_POST['cognome'], $_POST["email"], null, $_POST["admin"]);
		if (!$errori){
			$_SESSION["messaggio-successo"] = "Utente modificato correttamente!";
			header("Location: dashboard.php");
		}
	}
	
	if (isset($_POST['elimina-utente']) && isset($_POST["id"])) {
		$utente = SelectFirstSql("SELECT * FROM utenti WHERE id = ".$_POST["id"]);
		if (!$utente) {
			$_SESSION["messaggio-errore"] = "Utente non trovato...";
			header("Location: dashboard.php");	
		}
		else if ($utente["superadmin"]==1) {
			$_SESSION["messaggio-errore"] = "Non è possibile eliminare l'utente selezionato...";
			header("Location: dashboard.php");	
		}
		else {
			global $mysqli;
			$cancutente_sql = "DELETE FROM utenti WHERE id = ".$utente['id'];
			$query = $mysqli->query($cancutente_sql);
			$_SESSION["messaggio-successo"] = "Utente eliminato correttamente!";
			header("Location: dashboard.php");	
		}
	}

	if (($slug_pagina == "utente" && isset($_GET["id"])) || ($slug_pagina == "elimina-utente" && isset($_GET["id"]))){
		$utente = cercaElementoInArray($utenti,"id", $_GET["id"]);
		if (!$utente) {
			$_SESSION["messaggio-errore"] = "Utente non trovato...";
			header("Location: dashboard.php");	
		}
	}

	/* FUNZIONI DI GESTIONE OPZIONE */

	if (isset($_POST['modifica-option']) && isset($_POST["id"])) {
		if (isset($_POST["valore"]))	
			$errori = modificaOpzione($_POST["id"], $_POST['valore']);
		else if (isset($_FILES["valore"]))
			$errori = modificaOpzione($_POST["id"], $_FILES["valore"]);
		else
			$errori = modificaOpzione($_POST["id"], null);
		if (!$errori){
			$_SESSION["messaggio-successo"] = "Opzione modificata correttamente!";
			header("Location: dashboard.php");
		}
	}
	
	if (($slug_pagina == "option" && isset($_GET["id"]))){
		$option = cercaElementoInArray($options_array, "id", $_GET["id"]);
		if (!$option) {
			$_SESSION["messaggio-errore"] = "Opzione non trovata...";
			header("Location: dashboard.php");	
		}
	}
	else if (($slug_pagina == "option" && !isset($_GET["id"]))){
		$_SESSION["messaggio-errore"] = "Opzione non trovata...";
		header("Location: dashboard.php");
	}

	/* FUNZIONI DI GESTIONE PAGINA */

	if (isset($_POST['modifica-pagina']) && isset($_POST["id"])) {
		if (isset($_POST["riservata"]))
			$riservata = 1;
		else
			$riservata = 0;
		
		if (isset($_POST["ordine"]) && $_POST["ordine"]!=null)
			$errori = modificaPagina($_POST["id"], $_POST['titolo'], $_POST['link'], $_POST['template'], $_POST['icona'], $_POST['ordine'], $riservata);
		else
			$errori = modificaPagina($_POST["id"], $_POST['titolo'], $_POST['link'], $_POST['template'], $_POST['icona'], 'null', $riservata);
		if (!$errori){
			$_SESSION["messaggio-successo"] = "Pagina modificata correttamente!";
			header("Location: dashboard.php");
		}
	}
	
	if (($slug_pagina == "pagina" && isset($_GET["id"]))){
		$page = cercaElementoInArray($pages, "id", $_GET["id"]);
		if (!$page) {
			$_SESSION["messaggio-errore"] = "Pagina non trovata...";
			header("Location: dashboard.php");
		}
	}
	else if (($slug_pagina == "pagina" && !isset($_GET["id"]))){
		$_SESSION["messaggio-errore"] = "Pagina non trovata...";
		header("Location: dashboard.php");
	}

	/* FUNZIONI DI GESTIONE PROGETTO */
	
	if (isset($_POST['crea-progetto'])) {
		if (isset($_POST["in-evidenza"]))
			$in_evidenza = 1;
		else
			$in_evidenza = 0;
		
		$errori = creaProgetto($_POST['titolo'], $_POST['link'], $in_evidenza, $_POST["descrizione"], $_FILES["immagine"]);
		if (!$errori){
			$_SESSION["messaggio-successo"] = "Progetto creato correttamente!";
			header("Location: dashboard.php");
		}
	}

	if (isset($_POST['modifica-progetto']) && isset($_POST["id"])) {
		if (isset($_POST["in-evidenza"]))
			$in_evidenza = 1;
		else
			$in_evidenza = 0;
		if (isset($_FILES["immagine"]) && isset($_FILES["immagine"]["name"]) && $_FILES["immagine"]["name"])	
			$errori = modificaProgetto($_POST["id"], $_POST['titolo'], $_POST['link'], $in_evidenza, $_POST["descrizione"], $_FILES["immagine"]);
		else
			$errori = modificaProgetto($_POST["id"], $_POST['titolo'], $_POST['link'], $in_evidenza, $_POST["descrizione"], null);
		if (!$errori){
			$_SESSION["messaggio-successo"] = "Progetto modificato correttamente!";
			header("Location: dashboard.php");
		}
	}
	
	if (isset($_POST['elimina-progetto']) && isset($_POST["id"])) {
		$progetto = SelectFirstSql("SELECT * FROM progetti WHERE id = ".$_POST['id']);
		if (!$progetto) {
			$_SESSION["messaggio-errore"] = "Progetto non trovato...";
			header('Location: dashboard.php');
		}
		else {
			if (is_file($progetto["url_img"]))
				unlink($progetto["url_img"]);
			global $mysqli;
			$cancprogetto_sql = "DELETE FROM progetti WHERE id = ".$progetto['id'];
			$query = $mysqli->query($cancprogetto_sql);
			if (!$errori){
				$_SESSION["messaggio-successo"] = "Progetto eliminato correttamente!";
				header("Location: dashboard.php");
			}
		}
	}
	if (($slug_pagina == "progetto" && isset($_GET["id"]))||($slug_pagina == "elimina-progetto" && isset($_GET["id"]))){
		$progetto = cercaElementoInArray($progetti, "id", $_GET["id"]);
		if (!$progetto) {
			$_SESSION["messaggio-errore"] = "Progetto non trovato...";
			header("Location: dashboard.php");	
		}
	}

	/* FUNZIONI DI GESTIONE SERVIZIO */
	
	if (isset($_POST['crea-servizio'])) {
		if (isset($_POST["in-evidenza"]))
			$in_evidenza = 1;
		else
			$in_evidenza = 0;
		
		$errori = creaServizio($_POST['titolo'], $_POST['icona'], $in_evidenza, $_POST["descrizione"]);
		if (!$errori){
			$_SESSION["messaggio-successo"] = "Servizio creato correttamente!";
			header("Location: dashboard.php");
		}
	}

	if (isset($_POST['modifica-servizio']) && isset($_POST["id"])) {
		if (isset($_POST["in-evidenza"]))
			$in_evidenza = 1;
		else
			$in_evidenza = 0;
		
		$errori = modificaServizio($_POST["id"], $_POST['titolo'], $_POST['icona'], $in_evidenza, $_POST["descrizione"]);
		if (!$errori){
			$_SESSION["messaggio-successo"] = "Servizio modificato correttamente!";
			header("Location: dashboard.php");
		}
	}
	
	if (isset($_POST['elimina-servizio']) && isset($_POST["id"])) {
		$servizio = SelectFirstSql("SELECT * FROM servizi WHERE id = ".$_POST['id']);

		if (!$servizio) {
			$_SESSION["messaggio-errore"] = "Servizio non trovato...";
			header('Location: dashboard.php');
		}
		else {
			global $mysqli;
			$cancservizio_sql = "DELETE FROM servizi WHERE id = ".$servizio['id'];
			$query = $mysqli->query($cancservizio_sql);
			if (!$errori){
				$_SESSION["messaggio-successo"] = "Servizio eliminato correttamente!";
				header("Location: dashboard.php");
			}
		}
	}
	if (($slug_pagina == "servizio" && isset($_GET["id"]))||($slug_pagina == "elimina-servizio" && isset($_GET["id"]))){
		$servizio = cercaElementoInArray($servizi, "id", $_GET["id"]);
		if (!$servizio) {
			$_SESSION["messaggio-errore"] = "Servizio non trovato...";
			header("Location: dashboard.php");	
		}
	}

	/* FUNZIONI DI GESTIONE SKILL */
	
	if (isset($_POST['crea-skill'])) {
		$errori = creaSkill($_POST['titolo'], $_FILES["immagine"], $_POST['slug'], $_POST["percentuale"], $_POST['colore']);
		if (!$errori){
			$_SESSION["messaggio-successo"] = "Skill creata correttamente!";
			header("Location: dashboard.php");
		}
	}

	if (isset($_POST['modifica-skill']) && isset($_POST["id"])) {
		if (isset($_FILES["immagine"]) && isset($_FILES["immagine"]["name"]) && $_FILES["immagine"]["name"])	
			$errori = modificaSkill($_POST["id"], $_POST['titolo'], $_FILES["immagine"], $_POST['slug'], $_POST["percentuale"], $_POST['colore']);
		else
			$errori = modificaSkill($_POST["id"], $_POST['titolo'], null, $_POST['slug'], $_POST["percentuale"], $_POST['colore']);
		if (!$errori){
			$_SESSION["messaggio-successo"] = "Skill modificata correttamente!";
			header("Location: dashboard.php");
		}
	}
	
	if (isset($_POST['elimina-skill']) && isset($_POST["id"])) {
		$skill = SelectFirstSql("SELECT * FROM skills WHERE id = ".$_POST['id']);
		if (!$skill) {
			$_SESSION["messaggio-errore"] = "Skill non trovata...";
			header('Location: dashboard.php');
		}
		else {
			if (is_file($skill["url_icona"]))
				unlink($skill['url_icona']);
			global $mysqli;
			$cancskill_sql = "DELETE FROM skills WHERE id = ".$skill['id'];
			$query = $mysqli->query($cancskill_sql);
			if (!$errori){
				$_SESSION["messaggio-successo"] = "Skill eliminata correttamente!";
				header("Location: dashboard.php");
			}
		}
	}
	if (($slug_pagina == "skill" && isset($_GET["id"]))||($slug_pagina == "elimina-skill" && isset($_GET["id"]))){
		$skill = cercaElementoInArray($skills, "id", $_GET["id"]);
		if (!$skill) {
			$_SESSION["messaggio-errore"] = "Skill non trovata...";
			header("Location: dashboard.php");	
		}
	}

	/* FUNZIONI DI GESTIONE CONOSCENZA */
	
	if (isset($_POST['crea-conoscenza'])) {
		$errori = creaConoscenza($_POST['titolo']);
		if (!$errori){
			$_SESSION["messaggio-successo"] = "Conoscenza creata correttamente!";
			header("Location: dashboard.php");
		}
	}

	if (isset($_POST['modifica-conoscenza']) && isset($_POST["id"])) {
		$errori = modificaConoscenza($_POST["id"], $_POST['titolo']);
		if (!$errori){
			$_SESSION["messaggio-successo"] = "Conoscenza modificata correttamente!";
			header("Location: dashboard.php");
		}
	}
	
	if (isset($_POST['elimina-conoscenza']) && isset($_POST["id"])) {
		$conoscenza = SelectFirstSql("SELECT * FROM conoscenze WHERE id = ".$_POST['id']);

		if (!$conoscenza) {
			$_SESSION["messaggio-errore"] = "Conoscenza non trovata...";
			header('Location: dashboard.php');
		}
		else {
			global $mysqli;
			$cancconoscenza_sql = "DELETE FROM conoscenze WHERE id = ".$conoscenza['id'];
			$query = $mysqli->query($cancconoscenza_sql);
			if (!$errori){
				$_SESSION["messaggio-successo"] = "Conoscenza eliminata correttamente!";
				header("Location: dashboard.php");
			}
		}
	}
	if (($slug_pagina == "conoscenza" && isset($_GET["id"]))||($slug_pagina == "elimina-conoscenza" && isset($_GET["id"]))){
		$conoscenza = cercaElementoInArray($conoscenze, "id", $_GET["id"]);
		if (!$conoscenza) {
			$_SESSION["messaggio-errore"] = "Conoscenza non trovata...";
			header("Location: dashboard.php");	
		}
	}
	
	/* GESTIONE CONTATTI */

	if (isset($_POST["contatti"])){
		$errori = salvaMessaggio($_POST["nome"],$_POST["cognome"],$_POST["telefono"],$_POST["email"],$_POST["oggetto"],$_POST["messaggio"]);
	}

	/* GESTIONE TEMPLATE */

	if (!isset($_SESSION["template"]))
		$_SESSION["template"] = $options["template_default"];
	if (isset($_POST['cambia-template'])) {
		$_SESSION["template"] = $_POST["cambia-template"];
	}
	$template = $_SESSION["template"];

?>