<?php
	get_header();
	
	global $aawp_pagegtype;
	$aawp_pagegtype = "Noticias";
?>

<div class="aa-main-content-inner">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
		$aaauthorname = get_the_author_meta('first_name') . " " . get_the_author_meta('last_name');
		$aaavatarinfo = get_wp_user_avatar(get_the_author_meta($post->ID), "thumbnail");
	?>
	
	<div class="aa-single-page">
		<div class="aa-article-conteiner aa-clearfix">
			<div class="aa-article-content">
				<div class="aa-torneo-title">
					<h1><?php the_title(); ?></h1>
					<h3><?php the_time("F j, Y"); ?></h3>
				</div>
				
				<div class="aa-article-thecontent">
					<?php the_content(); ?>
				</div>
				
				<div class="aa-article-author">
					<?php echo $aaavatarinfo; ?>
					<div class="info"><?php echo $aaauthorname; ?> <span>Administrador de MéxicoChess</span></div>
				</div>
			</div>
			<div class="aa-article-sidebar">
				<div class="aa-shares">
					<div class="aa-shares-label">Compartir:</div>
					<ul>
						<li><a class="aajs-share-fb" href="<?php echo get_the_permalink(); ?>"><i class="fa fa-facebook"></i> <span>Compartir en Facebook</span></a></li>
						<li><a class="aajs-share-tw" href="<?php echo get_the_permalink(); ?>"><i class="fa fa-twitter"></i> <span>Compartir en Twitter</span></a></li>
						<li><a class="aajs-share-clip aa-stooltip" href="javascript:;" data-clipboard-text="<?php echo get_the_permalink(); ?>"><i class="fa fa-link"></i> <span>Copiar Enlace</span></a></li>
					</ul>
				</div>
				
				<?php the_post_thumbnail("medium_large"); ?>
				<?php echo do_shortcode("[aa_recent_articles]"); ?>
			</div>
		</div>

		<div class="aa-annbox">
			<div class="tag">¡Muy Pronto!</div>
			<div class="aa-logo small">MéxicoChess</div>
			<h2>Sección de Entrenadores</h2>
			<p>Envíanos tu datos y te añadiremos a nuetras nueva sección de entrenadores, es gratuito.</p>
			<a class="aa-btn aa-btn-p" href="https://api.whatsapp.com/send?phone=+524437339841&text=Quiero+aparecer+en+la+seccion+de+entrenadores" target="_blank">Soy Entrenador</a>
		</div>
		<ul class="aa-annbox-disclaimer">
			<li>Se debe tener título FIDE y/o logros en la formación de ajedrecistas</li>
			<li>Aparecerás en una lista de entrenadores y tendrás tu propia página con datos personales, información y botón de contacto.</li>
		</ul>
	</div>
	
	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>





