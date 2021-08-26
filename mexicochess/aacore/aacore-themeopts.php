<?php
$aawp_mobilefooterstyles = "";
$aawp_pagegtype = "";

function aa_include_scripts(){
	wp_register_script('global', get_template_directory_uri() . '/js/global.js', array('jquery'), 21, true);
	
	wp_enqueue_script('global');
}
add_action("wp_enqueue_scripts", "aa_include_scripts");


function aa_include_styles(){
	wp_register_style('groboto', "https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700", false);
	wp_register_style('gcormorant', 'https://fonts.googleapis.com/css?family=Cormorant+Garamond:300,700&display=swap', false);
	wp_register_style('global', get_template_directory_uri(). '/css/global.css', false, 45);	
	wp_register_style('fontawesome', get_template_directory_uri(). '/css/fontawesome.css', false, 1);
	
	wp_enqueue_style('groboto');
	wp_enqueue_style('gcormorant');
	wp_enqueue_style('global');
	wp_enqueue_style('fontawesome');
}
add_action('wp_enqueue_scripts', 'aa_include_styles');


function aa_register_menus() {
	register_nav_menu('main-menu', __( 'Menú Principal' ));
	register_nav_menu('copyright-menu', __( 'Menú de Derechos Reservados' ));
}
add_action( 'init', 'aa_register_menus' );

function aa_add_body_class($classes) {
    $classes[] = 'aa-pageloading';
    $classes[] = 'aa-holdanimations';
    return $classes;
}
add_filter('body_class', 'aa_add_body_class');

//Add Options Page
// Theme Options
if(function_exists('acf_add_options_page')){
	
	acf_add_options_page(array(
		'page_title' 	=> 'MexicoChess',
		'menu_title'	=> 'MexicoChess',
		'menu_slug' 	=> 'aawp-mexicochess-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> true,
		'update_button'	=> __('Save', 'acf'),
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Opciones de Tema',
		'menu_title'	=> 'Opciones de Tema',
		'parent_slug'	=> 'aawp-mexicochess-options',
		'update_button'	=> __('Guardar', 'acf'),
	));
}

//Add Torneos post types
function aa_torneos_post_type(){

    $labels = array(
        'name'                  => _x( 'Torneos', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Torneos', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Torneos', 'text_domain' ),
        'name_admin_bar'        => __( 'Torneos', 'text_domain' ),
        'archives'              => __( 'Torneos Archives', 'text_domain' ),
        'attributes'            => __( 'Torneos Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Torneo:', 'text_domain' ),
        'all_items'             => __( 'Todos Los Torneos', 'text_domain' ),
        'add_new_item'          => __( 'Añadir Torneo', 'text_domain' ),
        'add_new'               => __( 'Añadir Torneo', 'text_domain' ),
        'new_item'              => __( 'Torneo Nuevo', 'text_domain' ),
        'edit_item'             => __( 'Editar Torneo', 'text_domain' ),
        'update_item'           => __( 'Actualizar Torneo', 'text_domain' ),
        'view_item'             => __( 'Ver Torneo', 'text_domain' ),
        'view_items'            => __( 'Ver Torneos', 'text_domain' ),
        'search_items'          => __( 'Buscar Torneo', 'text_domain' ),
        'not_found'             => __( 'Torneo no Encontrado', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Imagen del Torneo', 'text_domain' ),
        'set_featured_image'    => __( 'Elegir Imagen del Torneo', 'text_domain' ),
        'remove_featured_image' => __( 'Remover Imagen del Torneo', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
        'items_list'            => __( 'Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    
    $rewrite = array(
        'slug'                  => 'torneos',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    
    $args = array(
        'label'                 => __( 'Torneos', 'text_domain' ),
        'description'           => __( 'Torneos', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'thumbnail', 'custom-fields' ),
        'taxonomies'            => array('asset-type'), //array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 2,
        'menu_icon'             => 'dashicons-calendar-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
    );
    
    register_post_type( 'aawp_torneos', $args );
}
add_action( 'init', 'aa_torneos_post_type', 0 );

//Adding Featured Image Support
function aawp_post_thumbs(){
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'aawp_post_thumbs' );

//Add Image Sizes
add_image_size( 'torneo-featured-thumb', 10000, 200 );
add_image_size( 'noticia-thumbnail', 10000, 300 );
add_image_size( 'torneo-thumbnail', 900, 2000 );
add_image_size( 'torneo-convocatoria', 1100, 1000000 );
add_image_size( 'jugador-avatar', 400, 10000 );

//Adding column to Shows list
function aawp_torneos_columns($columns){
	unset($columns['date']);
	
	$columns["aawp_torneo_fecha"] = "Fecha";
	$columns["date"] = "Date";
	
	return $columns;
}
add_filter( 'manage_aawp_torneos_posts_columns', 'aawp_torneos_columns' );

//Add info to Show date column
function aawp_torneos_column( $column, $post_id ){
	global $post;

	switch( $column ) {

		case 'aawp_torneo_fecha' :
			$aatorneodate = get_field("aawp_torneo_fecha", $post_id);
			$aatorneoddate = date("d/m/Y", strtotime($aatorneodate));
            echo "<abbr title='$aatorneodate'>$aatorneoddate</abbr>"; 
            break;

    }
}
add_action( 'manage_posts_custom_column', 'aawp_torneos_column', 10, 2 );

//Add Sortable column
add_filter( 'manage_edit-aawp_torneos_sortable_columns', 'aawp_torneos_sort_columns' );
function aawp_torneos_sort_columns($columns){
	$columns["aawp_torneo_fecha"] = "torneo_fecha";
	
	return $columns;
}
//Add columns extra sort
add_action( 'pre_get_posts', 'aawp_custom_orderby' );
function aawp_custom_orderby($query){
	if(!is_admin() || !$query->is_main_query()){
		return;
	}

	if(('aawp_torneos' === $query->get( 'post_type' )) and ('' === $query->get('orderby'))){
		$query->set( 'orderby', 'torneo_fecha');
		$query->set( 'order', 'asc');
	}
	if('torneo_fecha' === $query->get( 'orderby')){
    	$query->set( 'orderby', 'meta_value');
		$query->set( 'meta_key', 'aawp_torneo_fecha');
	}
}

//Torneos sort by date
function aawp_pre_get_posts( $query ){
	if(is_admin()){
		return $query;
	}

	// only modify queries for 'event' post type
	if(isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'aawp_torneos' && !is_singular()){
		$aatoday = date("Y-m-d", current_time('timestamp'));
		
		$aaaddmetaquery = array(
			'key' => 'aawp_torneo_fecha',
			'compare' => '>=',
			'value' => $aatoday,
			'type' => 'DATE'
		);
		
		$aametaquery = $query->get('meta_query');
		if(is_array($aametaquery))
			$aametaquery[] = $aaaddmetaquery;
		else
			$aametaquery = array($aaaddmetaquery);
		
		$query->set('orderby', 'meta_value');	
		$query->set('meta_key', 'aawp_torneo_fecha');	 
		$query->set('order', 'ASC');
		$query->set('meta_query', $aametaquery);
	}
	
	// return
	return $query;
}

add_action('pre_get_posts', 'aawp_pre_get_posts');

//Allow SVGs
function aa_mime_types($mimes) {
  	$mimes['svg'] = 'image/svg+xml';
  	
  	return $mimes;
}
add_filter('upload_mimes', 'aa_mime_types');


//Gutemberg Full Width
function uvwp_gutemberg_full(){
	add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'uvwp_gutemberg_full' );

//Add Whats App
function awpa_add_footercode(){
	global $aawp_pagegtype, $aawp_whatappmsgs;
	
	if(!$aawp_pagegtype)
		$aawp_pagegtype = get_the_title();
	
	if(is_array($aawp_whatappmsgs[$aawp_pagegtype])){
		$aawptorneowhatlabel = "<div>" . $aawp_whatappmsgs[$aawp_pagegtype]["label"] . "</div>";
		$aawptorneowhatmsg = $aawp_whatappmsgs[$aawp_pagegtype]["message"];
		
		$aawptorneowhatmsgurl = "&text=" . urlencode($aawptorneowhatmsg);
	}
	else{
		$aawptorneowhatlabel = "";
		$aawptorneowhatmsgurl = "";
	}
	
	echo("<a class='aa-whatsapp-link' href='https://api.whatsapp.com/send?phone=+524437339841$aawptorneowhatmsgurl'  target='_blank'>$aawptorneowhatlabel<i class='fa fa-whatsapp'></i> <span>WhatsApp</span></a>");
}
add_action( 'wp_footer', 'awpa_add_footercode', 100 );

//Include admin styles
add_action( 'admin_enqueue_scripts', 'aawp_include_admin_styles' );
	function aawp_include_admin_styles() {
    wp_register_style('admin', get_template_directory_uri(). '/css/admin.css', false, 1);
    
	wp_enqueue_style('admin');
}

//Add mobile footer styles
function aawp_footer_styles(){
	global $aawp_mobilefooterstyles;
	
	$aawp_mobilefooterstyles = "@media(max-width:600px){" . $aawp_mobilefooterstyles . "}";
	
    wp_register_style( 'aablockmobstyles', false );
	wp_enqueue_style( 'aablockmobstyles' );
	wp_add_inline_style( 'aablockmobstyles', $aawp_mobilefooterstyles );
	
	if(is_page('contacto') and isset($_REQUEST["asunto"]) and $_REQUEST["asunto"]){
		$aacontactsubject = $_REQUEST["asunto"];
		
		$aacontactsubject = ($aacontactsubject == "convocatoria") ? "Quiero registrar mi torneo" : $aacontactsubject;
		$aacontactsubject = ($aacontactsubject == "colabora") ? "Quiero publicar mis propios artículos" : $aacontactsubject;
		
		wp_register_script('aafooterscript', false);
		wp_enqueue_script('aafooterscript');
		wp_add_inline_script('aafooterscript', "<script>jQuery(\"select[name='asunto']\").val('$aacontactsubject');</script>");
	}
}
add_action( 'get_footer', 'aawp_footer_styles', 100 );

//Edit Excerpt
function aawp_custom_excerpt_length( $length ) {
	return 18;
}
add_filter( 'excerpt_length', 'aawp_custom_excerpt_length', 999 );
function aawp_new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'aawp_new_excerpt_more');
