<?php

function verificaEmail($email){
	$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
	if (preg_match($pattern, trim($email))) 
		return true; 
	else 
		return false;
}

// Restituisce lo slug della pagina attiva
function getSlugPagina(){
	global $options;
	$path = $_SERVER["SCRIPT_NAME"];
	$paths = explode("/",$path);
	$pagina = SelectFirstSql('SELECT * FROM pagine WHERE link ="'.end($paths).'"');
	return $pagina["template"];
}

function creaPassword($password){
	$pw = sha1($password);
	return $pw;
}

function controllaPassword($password, $password_db){
	$pw = sha1($password);
	if ($pw == $password_db){
		return true;
	}
	else {
		return false;
	}
}

// In un array di oggetti, restituisce l'indice del primo oggetto che ha un determinato valore di una proprietà
function keyElementoInArray($array, $proprieta, $valore){
	return array_search($valore, array_column($array, $proprieta));
}

// In un array di oggetti, restituisce il primo oggetto che ha un determinato valore di una proprietà
function cercaElementoInArray($array, $proprieta, $valore){
	$key = keyElementoInArray($array, $proprieta, $valore);
	if ($key===false)
		return null;
	else
		return $array[$key];
}


//Tenta il login: avvia la sessione se il login riesce, altrimenti restituisce l'errore
function login($email, $password){
	global $options;
	$utente = SelectFirstSql("SELECT * FROM utenti WHERE email = '$email'");

	$errori = [];
	if (empty($email))
		$errori["email"] = 'Inserisci la mail';
	else if (!$utente)
		$errori["email"] = 'Email non trovata';
	else if (empty($password))
		$errori["password"] = 'Inserisci la password';
	else if (!controllaPassword($password, $utente["password"]))
		$errori["password"] = 'Password errata';

	if (count($errori) == 0){
		session_regenerate_id();
		$_SESSION['session_id'] = session_id();
		$_SESSION['session_user'] = $utente['email'];
	}
	return $errori;
}

//Tenta il logout: chiude la sessione se il logout riesce
function logout(){
	unset($_SESSION['session_id']);
	unset($_SESSION['session_user']);
}

//Tenta di creare un utente: salva l'utente in options se la registrazione riesce, altrimenti restituisce l'errore
function creaUtente($nome, $cognome, $email, $password, $admin){
	$utente_con_email = SelectFirstSql("SELECT * FROM utenti WHERE email = '$email'");
	
	$errori = [];
	if (empty($nome))
		$errori["nome"] = 'Inserisci il nome';
	else if (strlen($nome)>255)
		$errori["nome"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($cognome))
		$errori["cognome"] = 'Inserisci il cognome';
	else if (strlen($cognome)>255)
		$errori["cognome"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($email))
		$errori["email"] = 'Inserisci la mail';
	else if (strlen($email)>255)
		$errori["email"] = 'Il valore inserito supera i 255 caratteri';
	else if (!verificaEmail($email))
		$errori["email"] = 'La mail inserita non è valida';
	else if ($utente_con_email)
		$errori["email"] = 'La mail inserita è già registrata';
	if (empty($password))
		$errori["password"] = 'Inserisci la password';
	else if (strlen($password)>255)
		$errori["password"] = 'Il valore inserito supera i 255 caratteri';
	if (!$admin)
		$admin = 0;
	else if ($admin = "on")
		$admin = 1;

	if (count($errori) == 0){
		$password = creaPassword($password);
		global $mysqli;
		$utente_sql = "INSERT INTO utenti (nome, cognome, email, password, admin) VALUES ('$nome', '$cognome', '$email', '$password', '$admin')";
		$query = $mysqli->query($utente_sql);
	}
	return $errori;
}

//Tenta di modificare un utente: modifica l'utente in options se riesce, altrimenti restituisce l'errore
function modificaUtente($id, $nome, $cognome, $email, $password, $admin){
	$utente = SelectFirstSql("SELECT * FROM utenti WHERE id = $id");
	$utente_con_email = SelectFirstSql("SELECT * FROM utenti WHERE email = '$email'");
	
	$errori = [];
	if (empty($nome))
		$errori["nome"] = 'Inserisci il nome';
	else if (strlen($nome)>255)
		$errori["nome"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($cognome))
		$errori["cognome"] = 'Inserisci il cognome';
	else if (strlen($cognome)>255)
		$errori["cognome"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($email))
		$errori["email"] = 'Inserisci la mail';
	else if (strlen($email)>255)
		$errori["email"] = 'Il valore inserito supera i 255 caratteri';
	else if (!verificaEmail($email))
		$errori["email"] = 'La mail inserita non è valida';
	else if ($utente_con_email && $utente['email']!=$email)
		$errori["email"] = 'La mail inserita è già registrata';
	if (empty($password))
		$password = $utente["password"];
	else if (strlen($password)>255)
		$errori["password"] = 'Il valore inserito supera i 255 caratteri';
	if (!$admin)
		$admin = 0;
	else if ($admin = "on")
		$admin = 1;

	if (count($errori) == 0){
		global $mysqli;
		$editutente_sql = "UPDATE utenti SET nome = '$nome', cognome = '$cognome', email = '$email', password = '$password', admin = '$admin' WHERE id = ".$utente['id'];
		$query = $mysqli->query($editutente_sql);
	}
	return $errori;
}

//Tenta di modificare un option: restituisce null se riesce, altrimenti restituisce l'errore
function modificaOpzione($id, $valore){
	global $options;
	$option = SelectFirstSql("SELECT * FROM opzioni WHERE id = $id");
	
	$errori = [];
	if ($option["formato_campo"]=="img"){
		if ($valore){
			$ext = strtolower(pathinfo($valore["name"],PATHINFO_EXTENSION));
			$file = "img/".$valore["name"];
			$check = getimagesize($valore["tmp_name"]);
			$formati_ammessi_img = explode(", ",$options["formati_ammessi_img"]);
			if($check === false)
				$errori["valore"] = 'Il file caricato non è un\'immagine';
			else if (strlen($file)>5000)
				$errori["valore"] = 'Il nome del file supera i 5000 caratteri';
			else if (!in_array($ext, $formati_ammessi_img))
				$errori["valore"] = 'E\' possibile caricare solo jpg, png, jpeg o gif.';
			else if (move_uploaded_file($valore["tmp_name"], $file)){
				global $mysqli;
				$editoption_sql = "UPDATE opzioni SET valore = '$file' WHERE id = ".$option['id'];
				$query = $mysqli->query($editoption_sql);
			}
			else {
				$errori["valore"] = 'Errore durante il caricamento del file.';
			}
		}
	}
	else if ($option["formato_campo"]=="email"){
		if (!verificaEmail($valore)){
			$errori["valore"] = 'La mail inserita non è valida';
		}
		else if (strlen($valore)>5000)
			$errori["valore"] = 'Il valore inserito supera i 5000 caratteri';
		else {
			global $mysqli;
			$editaoption_sql = "UPDATE opzioni SET valore = '$valore' WHERE id = ".$option['id'];
			$query = $mysqli->query($editaoption_sql);
		}
	}
	else {
		if (strlen($valore)>5000)
			$errori["valore"] = 'Il valore inserito supera i 5000 caratteri';
		else {
			global $mysqli;
			$editaoption_sql = "UPDATE opzioni SET valore = '$valore' WHERE id = ".$option['id'];
			$query = $mysqli->query($editaoption_sql);
		}
	}
	return $errori;	
}

//Tenta di modificare un pagina: restituisce null se riesce, altrimenti restituisce l'errore
function modificaPagina($id, $titolo, $link, $template, $icona, $ordine, $riservata){
	$pagina = SelectFirstSql("SELECT * FROM pagine WHERE id = $id");
	
	$errori = [];
	if (empty($titolo))
		$errori["titolo"] = 'Inserisci il titolo';
	else if (strlen($titolo)>255)
		$errori["titolo"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($link))
		$errori["link"] = 'Inserisci il link';
	else if (strlen($link)>255)
		$errori["link"] = 'Il valore inserito supera i 255 caratteri';	
	if (empty($template))
		$errori["template"] = 'Inserisci il template';
	else if (strlen($template)>255)
		$errori["template"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($icona))
		$errori["icona"] = 'Inserisci l\'icona';
	else if (strlen($icona)>255)
		$errori["icona"] = 'Il valore inserito supera i 255 caratteri';
	if (!is_numeric($ordine) && $ordine!="null")
		$errori["ordine"] = 'Il valore inserito non è un numero';

	if (!$errori){
		global $mysqli;
		$editpagina_sql = "UPDATE pagine SET titolo = '$titolo', link = '$link', template = '$template', icona = '$icona', ordine = ".$ordine.", riservata = '$riservata' WHERE id = ".$pagina['id'];
		echo $editpagina_sql;
		$query = $mysqli->query($editpagina_sql);
	}
	return $errori;
}

//Tenta di creare un progetto: restituisce null se riesce, altrimenti restituisce l'errore
function creaProgetto($titolo, $link, $in_evidenza, $descrizione, $immagine){
	global $options;

	$errori = [];
	if (empty($titolo))
		$errori["titolo"] = 'Inserisci il titolo';
	else if (strlen($titolo)>255)
		$errori["titolo"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($link))
		$errori["link"] = 'Inserisci il link';
	else if (strlen($link)>255)
		$errori["link"] = 'Il valore inserito supera i 255 caratteri';
	else {
		$schema_url = parse_url($link,PHP_URL_SCHEME);
		if ($schema_url != "http" && $schema_url != "https") {
			$errori["link"] = 'Il link deve essere nel formato http://miosito.com o https://miosito.com';
		}
	}
	if (empty($descrizione))
		$errori["descrizione"] = 'Inserisci la descrizione';
	else if (strlen($descrizione)>5000)
		$errori["descrizione"] = 'Il valore inserito supera i 5000 caratteri';
	if (!$errori){
		if (empty($immagine))
			$errori["immagine"] = 'Inserisci l\'immagine';
		else {
			$ext = strtolower(pathinfo($immagine["name"],PATHINFO_EXTENSION));
			$file = "img/progetti/progetto-".$immagine["name"];
			$check = getimagesize($immagine["tmp_name"]);
			$formati_ammessi_img = explode(", ",$options["formati_ammessi_img"]);
			if($check === false)
				$errori["immagine"] = 'Il file caricato non è un\'immagine';
			else if (strlen($file)>255)
				$errori["immagine"] = 'Il nome del file supera i 255 caratteri';
			else if (!in_array($ext, $formati_ammessi_img))
				$errori["immagine"] = 'E\' possibile caricare solo jpg, png, jpeg o gif.';
			else if (move_uploaded_file($immagine["tmp_name"], $file)){
				global $mysqli;
				$progetto_sql = "INSERT INTO progetti (titolo, url_img, link, in_evidenza, descrizione) VALUES ('$titolo', '$file', '$link', '$in_evidenza', '$descrizione')";
				$query = $mysqli->query($progetto_sql);
			}
			else {
				$errori["immagine"] = 'Errore durante il caricamento del file.';
			}
		}
	}
	return $errori;
}

//Tenta di modificare un progetto: restituisce null se riesce, altrimenti restituisce l'errore
function modificaProgetto($id, $titolo, $link, $in_evidenza, $descrizione, $immagine){
	global $options;
	$progetto = SelectFirstSql("SELECT * FROM progetti WHERE id = $id");
	
	$errori = [];
	if (empty($titolo))
		$errori["titolo"] = 'Inserisci il titolo';
	else if (strlen($titolo)>255)
		$errori["titolo"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($link))
		$errori["link"] = 'Inserisci il link';
	else if (strlen($link)>255)
		$errori["link"] = 'Il valore inserito supera i 255 caratteri';
	else {
		$schema_url = parse_url($link,PHP_URL_SCHEME);
		if ($schema_url != "http" && $schema_url != "https") {
			$errori["link"] = 'Il link deve essere nel formato http://miosito.com o https://miosito.com';
		}
	}
	if (empty($descrizione))
		$errori["descrizione"] = 'Inserisci la descrizione';
	else if (strlen($descrizione)>5000)
		$errori["descrizione"] = 'Il valore inserito supera i 5000 caratteri';
	if (!$errori){
		if ($immagine){
			if (empty($immagine))
				$errori["immagine"] = 'Inserisci l\'immagine';
			else {
				$ext = strtolower(pathinfo($immagine["name"],PATHINFO_EXTENSION));
				$file = "img/progetti/progetto-".$immagine["name"];
				$check = getimagesize($immagine["tmp_name"]);
				$formati_ammessi_img = explode(", ",$options["formati_ammessi_img"]);
				if($check === false)
					$errori["immagine"] = 'Il file caricato non è un\'immagine';
				else if (strlen($file)>255)
					$errori["immagine"] = 'Il nome del file supera i 255 caratteri';
				else if (!in_array($ext, $formati_ammessi_img))
					$errori["immagine"] = 'E\' possibile caricare solo jpg, png, jpeg o gif.';
				else if (move_uploaded_file($immagine["tmp_name"], $file)){
					global $mysqli;
					$editprogetto_sql = "UPDATE progetti SET titolo = '$titolo', url_img = '$file', link = '$link', in_evidenza = '$in_evidenza', descrizione = '$descrizione' WHERE id = ".$progetto['id'];
					$query = $mysqli->query($editprogetto_sql);
				}
				else {
					$errori["immagine"] = 'Errore durante il caricamento del file.';
				}
			
			}
		}
		else {
			$file = $progetto["url_img"];
			global $mysqli;
			$editaprogetto_sql = "UPDATE progetti SET titolo = '$titolo', url_img = '$file', link = '$link', in_evidenza = '$in_evidenza', descrizione = '$descrizione' WHERE id = ".$progetto['id'];
			$query = $mysqli->query($editaprogetto_sql);
		}
	}
	return $errori;	
}

//Tenta di creare un servizio: restituisce null se riesce, altrimenti restituisce l'errore
function creaServizio($titolo, $icona, $in_evidenza, $descrizione){

	$errori = [];
	if (empty($titolo))
		$errori["titolo"] = 'Inserisci il titolo';
	else if (strlen($titolo)>255)
		$errori["titolo"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($icona))
		$errori["icona"] = 'Inserisci l\'icona';
	else if (strlen($icona)>255)
		$errori["icona"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($descrizione))
		$errori["descrizione"] = 'Inserisci la descrizione';
	else if (strlen($descrizione)>1000)
		$errori["descrizione"] = 'Il valore inserito supera i 1000 caratteri';
	if (!$errori){
		global $mysqli;
		$servizio_sql = "INSERT INTO servizi (titolo, icona, in_evidenza, descrizione) VALUES ('$titolo', '$icona', '$in_evidenza', '$descrizione')";
		$query = $mysqli->query($servizio_sql);
	}
	return $errori;
}

//Tenta di modificare un servizio: restituisce null se riesce, altrimenti restituisce l'errore
function modificaServizio($id, $titolo, $icona, $in_evidenza, $descrizione){
	$servizio = SelectFirstSql("SELECT * FROM servizi WHERE id = $id");
	
	$errori = [];
	if (empty($titolo))
		$errori["titolo"] = 'Inserisci il titolo';
	else if (strlen($titolo)>255)
		$errori["titolo"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($icona))
		$errori["icona"] = 'Inserisci l\'icona';
	else if (strlen($icona)>255)
		$errori["icona"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($descrizione))
		$errori["descrizione"] = 'Inserisci la descrizione';
	else if (strlen($descrizione)>1000)
		$errori["descrizione"] = 'Il valore inserito supera i 1000 caratteri';
	if (!$errori){
		global $mysqli;
		$editservizio_sql = "UPDATE servizi SET titolo = '$titolo', icona = '$icona', in_evidenza = '$in_evidenza', descrizione = '$descrizione' WHERE id = ".$servizio['id'];
		$query = $mysqli->query($editservizio_sql);
	}
	return $errori;	
}

//Tenta di creare un skill: restituisce null se riesce, altrimenti restituisce l'errore
function creaSkill($titolo, $immagine, $slug, $percentuale, $colore){
	global $options;

	$errori = [];
	if (empty($titolo))
		$errori["titolo"] = 'Inserisci il titolo della skill';
	else if (strlen($titolo)>255)
		$errori["titolo"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($slug))
		$errori["slug"] = 'Inserisci lo slug';
	else if (strlen($slug)>255)
		$errori["slug"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($percentuale))
		$errori["percentuale"] = 'Inserisci la percentuale';
	else if (!is_numeric($percentuale))
		$errori["percentuale"] = 'Il valore inserito non è un numero';
	else if ($percentuale<1)
		$errori["percentuale"] = 'Il valore inserito deve essere maggiore di 1';
	else if ($percentuale>100)
		$errori["percentuale"] = 'Il valore inserito deve essere inferiore di 100';
	if (empty($colore))
		$errori["colore"] = 'Inserisci il colore';
	else if (strlen($colore)>255)
		$errori["colore"] = 'Il valore inserito supera i 255 caratteri';
	if (!$errori){
		if (empty($immagine))
			$errori["immagine"] = 'Inserisci l\'immagine';
		else {
			$ext = strtolower(pathinfo($immagine["name"],PATHINFO_EXTENSION));
			$file = "img/skills/icona-".$slug.".".$ext;
			$check = getimagesize($immagine["tmp_name"]);
			$formati_ammessi_img = explode(", ",$options["formati_ammessi_img"]);
			if($check === false)
				$errori["immagine"] = 'Il file caricato non è un\'immagine';
			else if (strlen($file)>255)
				$errori["immagine"] = 'Il nome del file supera i 255 caratteri';
			else if (!in_array($ext, $formati_ammessi_img))
				$errori["immagine"] = 'E\' possibile caricare solo jpg, png, jpeg o gif.';
			else if (move_uploaded_file($immagine["tmp_name"], $file)){
				global $mysqli;
				$skill_sql = "INSERT INTO skills (titolo, url_icona, slug, percentuale, colore) VALUES ('$titolo', '$file', '$slug', '$percentuale', '$colore')";
				$query = $mysqli->query($skill_sql);
			}
			else {
				$errori["immagine"] = 'Errore durante il caricamento del file.';
			}
		}
	}
	return $errori;
}

//Tenta di modificare un skill: restituisce null se riesce, altrimenti restituisce l'errore
function modificaSkill($id, $titolo, $immagine, $slug, $percentuale, $colore){
	global $options;
	$skill = SelectFirstSql("SELECT * FROM skills WHERE id = $id");
	
	$errori = [];
	if (empty($titolo))
		$errori["titolo"] = 'Inserisci il titolo della skill';
	else if (strlen($titolo)>255)
		$errori["titolo"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($slug))
		$errori["slug"] = 'Inserisci lo slug';
	else if (strlen($slug)>255)
		$errori["slug"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($percentuale))
		$errori["percentuale"] = 'Inserisci la percentuale';
	else if (!is_numeric($percentuale))
		$errori["percentuale"] = 'Il valore inserito non è un numero';
	else if ($percentuale<1)
		$errori["percentuale"] = 'Il valore inserito deve essere maggiore di 1';
	else if ($percentuale>100)
		$errori["percentuale"] = 'Il valore inserito deve essere inferiore di 100';
	if (empty($colore))
		$errori["colore"] = 'Inserisci il colore';
	else if (strlen($colore)>255)
		$errori["colore"] = 'Il valore inserito supera i 255 caratteri';
	if (!$errori){
		if ($immagine){
			if (empty($immagine))
				$errori["immagine"] = 'Inserisci l\'immagine';
			else {
				$ext = strtolower(pathinfo($immagine["name"],PATHINFO_EXTENSION));
				$file = "img/skills/icona-".$slug.".".$ext;
				$check = getimagesize($immagine["tmp_name"]);
				$formati_ammessi_img = explode(", ",$options["formati_ammessi_img"]);
				if($check === false)
					$errori["immagine"] = 'Il file caricato non è un\'immagine';
				else if (strlen($file)>255)
					$errori["immagine"] = 'Il nome del file supera i 255 caratteri';
				else if (!in_array($ext, $formati_ammessi_img))
					$errori["immagine"] = 'E\' possibile caricare solo jpg, png, jpeg o gif.';
				else if (move_uploaded_file($immagine["tmp_name"], $file)){
					global $mysqli;
					$editskill_sql = "UPDATE skills SET titolo = '$titolo', url_icona = '$file', slug = '$slug', percentuale = '$percentuale', colore = '$colore' WHERE id = ".$skill['id'];
					$query = $mysqli->query($editskill_sql);
				}
				else {
					$errori["immagine"] = 'Errore durante il caricamento del file.';
				}
			}
		}
		else {
			$file = $skill["url_icona"];
			global $mysqli;
			$editaskill_sql = "UPDATE skills SET titolo = '$titolo', url_icona = '$file', slug = '$slug', percentuale = '$percentuale', colore = '$colore' WHERE id = ".$skill['id'];
			$query = $mysqli->query($editaskill_sql);
		}
	}
	return $errori;	
}

//Tenta di creare un conoscenza: restituisce null se riesce, altrimenti restituisce l'errore
function creaConoscenza($titolo){

	$errori = [];
	if (empty($titolo))
		$errori["titolo"] = 'Inserisci il titolo';
	else if (strlen($titolo)>255)
		$errori["titolo"] = 'Il valore inserito supera i 255 caratteri';
	if (!$errori){
		global $mysqli;
		$conoscenza_sql = "INSERT INTO conoscenze (titolo) VALUES ('$titolo')";
		$query = $mysqli->query($conoscenza_sql);
	}
	return $errori;
}

//Tenta di modificare un conoscenza: restituisce null se riesce, altrimenti restituisce l'errore
function modificaConoscenza($id, $titolo){
	$conoscenza = SelectFirstSql("SELECT * FROM conoscenze WHERE id = $id");
	
	$errori = [];
	if (empty($titolo))
		$errori["titolo"] = 'Inserisci il titolo';
	else if (strlen($titolo)>255)
		$errori["titolo"] = 'Il valore inserito supera i 255 caratteri';
	if (!$errori){
		global $mysqli;
		$editconoscenza_sql = "UPDATE conoscenze SET titolo = '$titolo' WHERE id = ".$conoscenza['id'];
		$query = $mysqli->query($editconoscenza_sql);
	}
	return $errori;	
}

//Tenta di salvare il messaggio: restituisce array vuoto o con errori
function salvaMessaggio($nome, $cognome, $telefono, $email, $oggetto, $messaggio){
	global $messaggi_json;
	
	$errori = [];
	if (empty($nome))
		$errori["nome"] = 'Inserisci il nome';
	else if (strlen($nome)>255)
		$errori["nome"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($cognome))
		$errori["cognome"] = 'Inserisci il cognome';
	else if (strlen($cognome)>255)
		$errori["cognome"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($telefono))
		$errori["telefono"] = 'Inserisci il telefono';
	else if (strlen($telefono)>255)
		$errori["telefono"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($email))
		$errori["email"] = 'Inserisci la mail';
	else if (strlen($email)>255)
		$errori["email"] = 'Il valore inserito supera i 255 caratteri';
	else if (!verificaEmail($email))
		$errori["email"] = 'La mail inserita non è valida';
	if (empty($oggetto))
		$errori["oggetto"] = "Inserisci l'oggetto";
	else if (strlen($oggetto)>255)
		$errori["oggetto"] = 'Il valore inserito supera i 255 caratteri';
	if (empty($messaggio))
		$errori["messaggio"] = 'Inserisci il messaggio';
	else if (strlen($messaggio)>1000)
		$errori["messaggio"] = "Il messaggio inserito supera i 1000 caratteri";

	if (count($errori) == 0){
		global $mysqli;
		$messaggio_sql = "INSERT INTO messaggi (nome, cognome, telefono, email, oggetto, messaggio) VALUES ('$nome', '$cognome', '$telefono', '$email', '$oggetto', '$messaggio')";
		$query = $mysqli->query($messaggio_sql);
	}
	return $errori;
}
?>