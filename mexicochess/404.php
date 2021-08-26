<?php

add_filter('body_class', 'ig_body_classes');
function ig_body_classes($classes){
    $classes[] = 'ig-fluidpage';
     
    return $classes;
}

?>


<?php get_header(); ?>
	
<div class="aa-main-content-inner aa-404-page">
	<h1>Ups!</h1>
	<h2>Nos has dejado en Zugzwang!</h2>
	<h3 class="h4">No encontramos la página que buscas.</h3>
	<a href="/" class="aa-btn aa-btn-p">Inicio</a>
</div>

<?php get_footer();?>