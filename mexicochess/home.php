<?php get_header(); ?>
<?php
	global $aawp_pagegtype;
	$aawp_pagegtype = "Noticias";
	
	$aatitlebg = get_field("aawp_titles_bg", "option");
?>

<div class="aa-main-content-inner aa-archive-blog">
	
	<div class="aa-pagetitle alignfull">
        
        <div class="aa-pagetitle-bg aalazybg" data-src="<?php echo $aatitlebg; ?>"></div>
        <div class="aa-pagetitle-inner">
	        <h1 class="aaan-slideup">Noticias</h1>
        </div>

    </div>
	
	<div class="aa-noticias-list aa-clearfix">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
			$aaauthorname = get_the_author_meta('first_name') . " " . get_the_author_meta('last_name');
			$aaavatarinfo = get_wp_user_avatar(get_the_author_meta($post->ID), "thumbnail");
		?>
			
			<div>
				<a href="<?php the_permalink(); ?>"><div class="aa-noticias-listitem">
					<div class="bgimagecont"><div class="bgimage" style="background-image: url(<?php echo get_the_post_thumbnail_url($post->ID, 'noticia-thumbnail'); ?>);"></div></div>
					<div class="info">
						<div class="title"><?php the_title(); ?></div>
						<div class="excerpt"><?php the_excerpt(); ?></div>
						<div class="author">
							<?php echo $aaavatarinfo; ?>
							<div class="name"><?php echo $aaauthorname; ?></div>
							<div class="ddate"><?php the_time("F j, Y"); ?></div>
						</div>
					</div>
				</div></a>
			</div>
			
		<?php endwhile; endif; ?>
	</div>
</div>

<?php get_footer(); ?>
