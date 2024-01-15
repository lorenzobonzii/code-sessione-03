<?php
	include "controller.php";
	include "header.php";
?>
<main>
	<div class="main">
		<div class="title">
			<h1><?php echo $pagina["titolo"]; ?></h1><hr>
		</div>
		<div class="content">
			<aside class="left">
				<div class="article">
					<img class="circle" src="<?php echo $options["img_principale"] ?>" alt="Immagine <?php echo $options["titolo"] ?>">
				</div>
				<div class="article social">
					<?php 
					if ($options["instagram"]) {?>
						<a href="https://www.instagram.com/<?php echo $options["instagram"];?>" title="Vai al profilo Instagram">
							<i class="icon button-i circle bg-light fa-brands fa-instagram"></i>
						</a>
					<?php 
					}
					if ($options["facebook"]) {?>
						<a href="https://www.facebook.com/<?php echo $options["facebook"];?>" title="Vai al profilo Facebook">
							<i class="icon button-i circle bg-light fa-brands fa-facebook"></i>
						</a>
					<?php 
					}
					if ($options["twitter_x"]) {?>
						<a href="https://www.twitter.com/<?php echo $options["twitter_x"];?>" title="Vai al profilo Twitter">
							<i class="icon button-i circle bg-light fa-brands fa-x-twitter"></i>
						</a>
					<?php 
					}
					if ($options["linkedin"]) {?>
						<a href="https://www.linkedin.com/in/<?php echo $options["linkedin"];?>" title="Vai al profilo LinkedIN">	
							<i class="icon button-i circle bg-light fa-brands fa-linkedin"></i>
						</a>
					<?php 
					} ?>
				</div>
			</aside>
			<section class="principale article bio">
				<h2>Descrizione</h2>
				<p><?php echo $options["descrizione"];?></p>
				<a class="button bg-light" href="portfolio.php" title="Vai alla pagina Portfolio">Scopri di più</a>
			</section>
		</div>
		<div class="content chi-sono">
			<aside class="left">
				<div class="article conoscenze">
					<h2>Conoscenze</h2>
					<ul>
						<?php foreach ($conoscenze as $conoscenza){ ?>
							<li><?php echo $conoscenza["titolo"]; ?></li>
						<?php } ?>
					</ul>
				</div>
			</aside>
			<section class="principale article">
				<h2>Skills</h2>	
				<?php foreach($skills as $skill){ ?>
				<div class="skill-<?php echo $skill["slug"]; ?> skill-container">
					<div class="skill-icon" style="background-image:url(<?php echo $skill["url_icona"]; ?>)"></div>
					<div class="skill-content">
						<div class="skill-header">
							<div class="skill-titolo">
							<?php echo $skill["titolo"]; ?>
							</div>
							<div class="skill-percentuale">
							<?php echo $skill["percentuale"]; ?>%
							</div>
						</div>
						<div class="skill">
							<hr class="skill-left" style="background-color:<?php echo $skill["colore"]; ?>; width:<?php echo $skill["percentuale"];?>%; <?php if($skill["percentuale"]==100){echo "border-radius:20px";} ?>">
							<hr class="skill-right" style="width:<?php echo 100-$skill["percentuale"]; ?>%;">
						</div>
					</div>
				</div>
				<?php } ?>
			</section>
		</div>
	</div>
</main>
<?php
	include "footer.php";
?>