<!DOCTYPE html>
<html lang="it">
	<head>
		<title><?php echo $pagina["titolo"];?> | LB</title>
        <?php if($template=="light") { ?>
        <link href="css/light.min.css" type="text/css" rel="stylesheet">
        <?php } else { ?>
        <link href="css/dark.min.css" type="text/css" rel="stylesheet">
        <?php } ?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
		<link rel="stylesheet" href="css/fontawesome-iconpicker.min.css">
		<link rel="shortcut icon" href="<?php echo $options["logo_img"];?>">
		<meta name="theme-color" content="<?php if($template=="light") { echo "#006fdd";} else { echo "#003c77";} ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
	</head>
	<body>
	<div class="body"></div>
		<header>
        <div class="header">
            <div class="logo">
                <a href="index.php" title="Vai alla pagina Home"><img src="<?php echo $options["logo_img"]; ?>" alt="Logo <?php echo $options["titolo"]; ?>"></a>
            </div>
            <div class="menu">
                <ul>
                    <li>
                        <form action="" method="POST">
                            <button class="button-i circle <?php if($template=="dark") echo "bg-light"; else if($template=="light") echo "bg-dark"; ?>"><i class="icon circle fas fa-<?php if($template=="dark") echo "sun"; else if($template=="light") echo "moon"; ?>"></i></button>
                            <input type="hidden" name="cambia-template" value="<?php if($template=="dark") echo "light"; else if($template=="light") echo "dark"; ?>"></input>
                        </form>
                    </li>
                </ul>
                <nav class="nav">
                    <input id="menu-toggle" type="checkbox">
                    <label class="menu-button-container" for="menu-toggle">
                        <span class="menu-button"></span>
                    </label>
                    <ul>
                        <?php
                        foreach($pages as &$page){ 
                            if (isset($_SESSION['session_id']) && $page["ordine"]!=null && $page["riservata"]!=null){ ?>
                                <li><a class="button <?php if($pagina["template"]==$page["template"]) echo "bg-dark"; else echo "bg-default";?>" href="<?php echo $page["link"]; ?>" title="Vai alla pagina <?php echo $page["titolo"]; ?>" ><i class="icon <?php echo $page["icona"]; ?>"></i> <span><?php echo $page["titolo"]; ?></span></a></li>
                            <?php
                            }
                            else if(!isset($_SESSION["session_id"]) && $page["ordine"]!=null && $page["riservata"]!=1){ ?>
                                <li><a class="button <?php if($pagina["template"]==$page["template"]) echo "bg-dark"; else echo "bg-default";?>" href="<?php echo $page["link"]; ?>" title="Vai alla pagina <?php echo $page["titolo"]; ?>" ><i class="icon <?php echo $page["icona"]; ?>"></i> <span><?php echo $page["titolo"]; ?></span></a></li>
                            <?php 
                            }
                        } ?>
                    </ul>
                </nav>
            </div>
        </div>
        </header>