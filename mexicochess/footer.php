<?php
	$aa_curyear = date("Y");
?>

	</div>
	<!-- Main Content -->
	
	<div class="aa-footer">
		<div class="aa-section-inner">
			<ul class="aa-footer-social">
				<li><a href="https://www.facebook.com/pg/MexicoChessSocial" target="_blank"><i class="fa fa-facebook"></i><span>Facebook</span></a></li>
				<li><a href="https://twitter.com/mexicochesscom" target="_blank"><i class="fa fa-twitter"></i><span>Twitter</span></a></li>
			</ul>
			
			<div class="aa-footer-sections aa-clearfix">
				<div>
					<a href="/"><div class="aa-logo small">MéxicoChess</div></a>
					<p>Ajedrez en México, promoción y difusión, encuentra torneos con nuestro calendario, conoce las últimas noticias del Ajedrez en nuestro país, descubre a nuestros talentos mexicanos...</p>
				</div>
				<div>
					<div class="h5">Enlaces de Interés</div>
					<div class="aa-footer-imgslinks">
						<a href="https://lichess.org/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-lichess.jpg" alt="Lichess"></a>
						<a href="https://chess.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-chesscom.jpg" alt="Chess.com"></a>
						<a href="https://chess24.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-chess24.jpg" alt="Chess24"></a>
						<a href="https://www.chessbomb.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-chessbomb.png" alt="Chess Bomb" style="height: 33px;"></a>
						<a href="https://2700chess.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-chess2700.jpg" alt="2700 Chess"></a>
						<a href="https://chessbase.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-chessbase.png" alt="ChessBase"></a>
						<a href="https://fide.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-fide.jpg" alt="FIDE"></a>
						<a href="https://fenamacajedrez.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-fenamac.jpg" alt="FENAMAC"></a>
					</div>
				</div>
				<div>
					<div class="h5">Páginas</div>
					<?php wp_nav_menu(array('menu' => 'Menú Principal', 'menu_class' => 'aa-footer-menupages')); ?>
				</div>
			</div>
			
			<div class="aa-footer-copy aa-clearfix">
				<div class="aa-footer-copymenu">
					<?php wp_nav_menu(array('menu' => 'Menú de Derechos Reservados', 'menu_class' => 'aa-copyright-menu')); ?>
				</div>
				<div class="aa-footer-copytext">
					&copy; <?php echo $aa_curyear; ?> MéxicoChess. Derechos Reservados. Desarrollado por <a href="mailto:contacto@mexicochess.com">AldoArriaga</a>.
				</div>
			</div>
		</div>
	</div>
	
	<a class="aajs-scrollto aa-pagegototop" href="#pagetop" title="Ir Arriba"><i class="fa fa-angle-up"></i><span>Ir Arriba</span></a>
	
	<script>
		jQuery("body").removeClass("aa-pageloading");
		setTimeout(function(){
			jQuery("body").removeClass("aa-holdanimations");
		}, 700);
	</script>
	<?php wp_footer(); ?>
</body>
</html>
