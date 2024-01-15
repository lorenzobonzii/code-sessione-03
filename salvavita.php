<?php

include("db.php");
include("functions.php");

$options = json_decode(file_get_contents("json/options.json"),true);
$progetti = $options["progetti"];
$servizi = $options["servizi"];
$skills = $options["chi-sono"]["skills"]["items"];
$conoscenze = $options["chi-sono"]["conoscenze"]["items"];
/*
foreach($progetti as $progetto){
    $inEvidenza = $progetto["inEvidenza"] ? 1 : 0;urlImg
    $sql = 'INSERT INTO progetti (titolo, urlImg, link, inEvidenza, descrizione) VALUES ("'.$progetto['titolo'].'", "'.$progetto['linkImg'].'", "'.$progetto['sito'].'",'.$inEvidenza.',"'.$progetto['descrizione'].'")';
    echo $sql;
    $mysqli->query($sql);
}

foreach($servizi as $servizio){
    $inEvidenza = $servizio["inEvidenza"] ? 1 : 0;
    $sql = 'INSERT INTO servizi (titolo, icona, descrizione, inEvidenza) VALUES ("'.$servizio['titolo'].'", "'.$servizio['icona'].'", "'.$servizio['descrizione'].'",'.$inEvidenza.')';
    echo $sql;
    $mysqli->query($sql);
}
foreach($skills as $skill){
    $sql = 'INSERT INTO skills (skill, slug, percentuale, url_icona, colore) VALUES ("'.$skill['skill'].'", "'.$skill['slug'].'", "'.$skill['percentuale'].'","'.$skill['url_icona'].'","'.$skill['colore'].'")';
    echo $sql;
    $mysqli->query($sql);
}
*/
foreach($conoscenze as $conoscenza){
    $sql = 'INSERT INTO conoscenze (conoscenza) VALUES ("'.$conoscenza.'")';
    echo $sql;
    $mysqli->query($sql);
}