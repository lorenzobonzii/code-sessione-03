		<footer>
		<div class="footer">
			<div class="widgets">
				<div class="contenitore">
					<section class="social">
						<h2>Social</h2>
						<ul>
							<?php 
							if ($options["instagram"]) {?>
								<li><a href="https://www.instagram.com/<?php echo $options["instagram"];?>" title="Vai al profilo Instagram">
									<div>
										<h6><?php echo $options["instagram"];?></h6>
										Instagram
									</div>
									<i class="icon button-i bg-default fa-brands fa-instagram"></i>
								</a></li>
							<?php 
							}
							if ($options["facebook"]) {?>
								<li><a href="https://www.facebook.com/<?php echo $options["facebook"];?>" title="Vai al profilo Facebook">
									<div>
										<h6><?php echo $options["facebook"];?></h6>
										Facebook										</div>
									<i class="icon button-i bg-default fa-brands fa-facebook"></i>
								</a></li>
							<?php 
							}
							if ($options["twitter_x"]) {?>
								<li><a href="https://www.twitter.com/<?php echo $options["twitter_x"];?>" title="Vai al profilo Twitter">
									<div>
										<h6><?php echo $options["twitter_x"];?></h6>
										Twitter										</div>
									<i class="icon button-i bg-default fa-brands fa-x-twitter"></i>
								</a></li>
							<?php 
							}
							if ($options["linkedin"]) {?>
								<li><a href="https://www.linkedin.com/in/<?php echo $options["linkedin"];?>" title="Vai al profilo LinkedIN">
									<div>
										<h6><?php echo $options["linkedin"];?></h6>
										LinkedIN										</div>
									<i class="icon button-i bg-default fa-brands fa-linkedin"></i>
								</a></li>
							<?php 
							} ?>
						</ul>
					</section>
					<div class="logo">
						<a href="index.php" title="Vai alla pagina Home"><img src="<?php echo $options["logo_img"];?>" alt="Logo <?php echo $options["titolo"];?>"></a>
						<a href="privacy.php" title="Vai alla pagina Privacy Policy">Privacy Policy</a>
						<a href="cookie.php" title="Vai alla pagina Cookie Policy">Cookie Policy</a>
					</div>
					<section class="contatti">
						<h2>Contatti</h2>
						<ul>
							<?php 
							if ($options["telefono"]) {?>
								<li><a href="tel:<?php echo $options["telefono"];?>" title="Chiama il numero <?php echo $options["telefono"];?>">
									<div>
										<h6>Telefono</h6>
										<?php echo $options["telefono"];?>										</div>
									<i class="icon button-i bg-default fas fa-phone"></i>
								</a></li>
							<?php 
							}
							if ($options["email"]) {?>
								<li><a href="mailto:<?php echo $options["email"];?>" title="Scrivi all'email <?php echo $options["email"];?>">
									<div>
										<h6>Email</h6>
										<?php echo $options["email"];?>										</div>
									<i class="icon button-i bg-default fas fa-envelope"></i>
								</a></li>
							<?php 
							}
							if ($options["sito_web"]) {?>
								<li><a href="https://<?php echo $options["sito_web"];?>" title="Vai al sito <?php echo $options["sito_web"];?>">
									<div>
										<h6>Sito Web</h6>
										<?php echo $options["sito_web"];?>										</div>
									<i class="icon button-i bg-default fas fa-globe"></i>
								</a></li>
							<?php 
							}
							if ($options["indirizzo"]) {?>
								<li><a href="https://www.google.com/maps/place/<?php echo $options["indirizzo"];?>" title="Vai all'indirizzo <?php echo $options["indirizzo"];?>">
									<div>
										<h6>Indirizzo</h6>
										<?php echo $options["indirizzo"];?>										</div>
									<i class="icon button-i bg-default fas fa-map-marker"></i>
								</a></li>
							<?php 
							} ?>
						</ul>
					</section>
				</div>	
			</div>
			<div class="copyright">
				<p>© <?php echo date("Y");?> <a href="index.php" title="Vai alla pagina Home"><?php echo $options["titolo"];?></a> | All Rights Reserved</p>
			</div>
		</div>
		</footer>
		<script src="//code.jquery.com/jquery-2.2.1.min.js"></script>
		<script src="js/accordion.js"></script>
		<script src="js/fontawesome-iconpicker.min.js"></script>
		<script src="js/iconpicker.js"></script>
		<script src="https://cdn.tiny.cloud/1/u5bplik7rcd68mxgegzp2th1w7cmmbivhdhbfbbkymxwq1xg/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
		<script>tinymce.init({selector:'textarea.tiny'});</script>
	</body>
</html>