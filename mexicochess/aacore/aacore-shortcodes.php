<?php
	
// [aa_torneos_destacados]
function shortcode_aa_torneos_destacados($atts, $content = null){
	global $post;
	ob_start();
	
	$aacurrentpressid = ($post) ? $post -> ID : "";
	
	$aatoday = date("Y-m-d", current_time('timestamp'));
	
	$aaargs = array(
	 	'posts_per_page' => 3,
		'post_type' => 'aawp_torneos',
		'post_status' => 'publish',
		'meta_key'	  => 'aawp_torneo_destacado',
		'meta_key'	=> 'aawp_torneo_fecha',
		'orderby'	=> 'meta_value',
		'order'		=> 'ASC',
		'post__not_in' => array($aacurrentpressid),
		'meta_query' => array(
			array(
				'key' => 'aawp_torneo_destacado',
				'compare' => '==',
				'value' => '1',
			),
			array(
				'key' => 'aawp_torneo_fecha',
				'compare' => '>=',
				'value' => $aatoday,
				'type' => 'DATE'
			)
		),
	);

	$aawptorneos = new WP_Query($aaargs);
	
	$aatorneoshtml = "";
	
	if(is_array($aawptorneos -> posts)){
		foreach($aawptorneos -> posts as $aatorneo){
			$aatorneoid = $aatorneo -> ID;
			$aatorneotitle = $aatorneo -> post_title;
			$aatorneopermalink = get_the_permalink($aatorneoid);
			$aatorneothumbnail = get_the_post_thumbnail_url($aatorneoid, "torneo-featured-thumb");
			
			$aatorneodate = get_field("aawp_torneo_fecha", $aatorneoid);
			$aatorneotype = get_field("aawp_torneo_type", $aatorneoid);
			$aatorneoddate = aawp_get_format_date($aatorneodate);
			
			$aatorneoestado = get_field("aawp_torneo_estado", $aatorneoid);
			$aatorneociudad = get_field("aawp_torneo_ciudad", $aatorneoid);

			$aatorneolocationhtml = ($aatorneotype != "Online") ? "{$aatorneolugarlinkstart}<i class='fa fa-map-marker'></i> $aatorneociudad, $aatorneoestado, México{$aatorneolugarlinkend}" : "<i class='fa fa-laptop'></i> Online";
			
			$aatorneothumbnail = ($aatorneothumbnail) ? $aatorneothumbnail : "/wp-content/uploads/2019/11/me.jpg";
			
			$aatorneoshtml .= "<div><a href='$aatorneopermalink'><div class='aa-featuredtor-item'><div class='imagebg' style='background-image: url($aatorneothumbnail);'></div><div class='info'><div class='ddate'><i class='fa fa-calendar-o'></i> $aatorneoddate</div><h3><span>$aatorneotitle</span></h3><div class='loaction'>$aatorneolocationhtml</div></div></div></a></div>";
		}
	}
?>

<div class="aa-featured-tor aa-clearfix">
	<?php echo $aatorneoshtml; ?>
</div>

<?php
	$content = ob_get_contents();
  	ob_end_clean();

	return $content;
}
add_shortcode("aa_torneos_destacados", "shortcode_aa_torneos_destacados");


// [aa_recent_articles]
function shortcode_aa_recent_articles($atts, $content = null){
	global $post;
 	ob_start();
 	
 	$aacurrentpressid = ($post) ? $post -> ID : "";
 	
 	$aaargs = array(
	 	'posts_per_page' => 3,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_type' => 'post',
		'post_status' => 'publish',
		'post__not_in' => array($aacurrentpressid)
	);

	$aapress = new WP_Query($aaargs);
	$aapresshtml = "";
	
	if(is_array($aapress -> posts)){
		foreach($aapress -> posts as $aapress){
			$aapressid = $aapress -> ID;
			$aapressname = $aapress -> post_title;
			$aapressurl = get_permalink($aapressid);
			$aapressddate = get_the_time("F j, Y", $aapressid);
			
			$aapresshtml .= "<li><a href='$aapressurl'>$aapressname<span>$aapressddate</span></a></li>";
		}
	}
?>

<div class="aa-recentnewscont">
	<div class="aa-recentnews-title">Noticias Recientes</div>
	
	<?php if($aapresshtml){ ?>
		<ul>
			<?php echo $aapresshtml; ?>
		</ul>
	<?php } ?>
</div>

<?php
	$content = ob_get_contents();
  	ob_end_clean();

	return $content;
}
add_shortcode("aa_recent_articles", "shortcode_aa_recent_articles");


// [aa_ultimas_noticias]
function shortcode_aa_ultimas_noticias($atts, $content = null){
	global $post;
 	ob_start();
 	
 	$aacurrentpressid = ($post) ? $post -> ID : "";
 	
 	$aaargs = array(
	 	'posts_per_page' => 3,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_type' => 'post',
		'post_status' => 'publish',
		'post__not_in' => array($aacurrentpressid)
	);

	$aapress = new WP_Query($aaargs);
	$aapresshtml = "";
	
	if(is_array($aapress -> posts)){
		foreach($aapress -> posts as $aapress){
			$aapressid = $aapress -> ID;
			$aapressname = $aapress -> post_title;
			$aapressurl = get_permalink($aapressid);
			$aapressddate = get_the_time("F j, Y", $aapressid);
			$aapressthumbnail = get_the_post_thumbnail_url($aapressid, "thumbnail");
			
			$aapresshtml .= "<div><a href='$aapressurl'><div class='aa-latestnewsitem'><div class='imagebg aalazybg' data-src='$aapressthumbnail'></div><div class='info'><div class='title'>$aapressname</div><div class='ddate'>$aapressddate</div></div></div></a></div>";
		}
	}
?>

<div class="aa-latestnews aa-clearfix">
	<?php if($aapresshtml){
		echo $aapresshtml;
	} ?>
</div>

<?php
	$content = ob_get_contents();
  	ob_end_clean();

	return $content;
}
add_shortcode("aa_ultimas_noticias", "shortcode_aa_ultimas_noticias");


// [aa_rating_actualizacion]
function shortcode_aa_rating_actualizacion($atts, $content = null){
	global $aawp_monthsnames;
	ob_start();

	aa_check_ratings_cache();
	 
	$aaratingsupdate = get_option("ratings-updated");
	$aaratingsupdatehtml = ($aaratingsupdate) ? "<div class='aa-ratings-updatetag'>Acutalizado: " . $aawp_monthsnames[date("n", $aaratingsupdate)/1 - 1] . " " . date("Y", $aaratingsupdate) . "</div>" : "";

	echo($aaratingsupdatehtml);

	$content = ob_get_contents();
  	ob_end_clean();

	return $content;
}
add_shortcode("aa_rating_actualizacion", "shortcode_aa_rating_actualizacion");


// [aa_rating_mexicano]
function shortcode_aa_rating_mexicano($atts, $content = null){
	global $aa_ratingsjsonpath_absoluto, $aa_players_cutominfo;
	ob_start();
 	
 	aa_check_ratings_cache();
 	$aaratings = @file_get_contents($aa_ratingsjsonpath_absoluto);
 	if($aaratings)
		$aaratings = json_decode($aaratings, true);
 	
 	$aaratingshtml = "<div class='aa-ratingslist-tops aa-clearfix'>";	
 	$aaratingcounter = 1;
	$aaratingsaddtolist = "";
 	
 	if(is_array($aaratings)){
	 	foreach($aaratings as $aaplayer){
		 	$aaplayercode = $aaplayer["player-code"];
		 	$aaplayerposition = $aaplayer["player-position"];
		 	$aaplayername = $aaplayer["player-name"];
		 	$aaplayerrating = $aaplayer["player-rating"];
		 	$aaplayerbirthdate = $aaplayer["player-birthdate"];
		 	
		 	$aaplayerimage = (isset($aa_players_cutominfo[$aaplayercode]) and isset($aa_players_cutominfo[$aaplayercode]["player-picture"])) ? $aa_players_cutominfo[$aaplayercode]["player-picture"] : "";
		 	$aaprofilepicextraclass = $aaplayerimage ? "aahaspic" : "";
		 	
		 	if($aaratingcounter < 11)
			 	$aaratingshtml .= "<div><div class='aa-playerprofile-full aa-playerprofilen-$aaplayerposition' data-playercode='$aaplayercode'><div class='imagebg aalazybg $aaprofilepicextraclass' data-src='$aaplayerimage'></div><div class='info'><div class='name'>$aaplayername</div><div class='numbersinfo'><div class='position'>#$aaplayerposition</div><div class='rating'>$aaplayerrating</div></div><div class='birthdate'><span>Año de Nacimiento:</span><strong>$aaplayerbirthdate</strong></div></div></div></div>";
			else
				$aaratingshtml .= "<div><div class='aa-playerprofile-small aa-playerprofilen-$aaplayerposition' data-playercode='$aaplayercode'><div class='position'><span>$aaplayerposition</span></div><div class='name'>$aaplayername</div><div class='rating'>$aaplayerrating</div><div class='birthyear'>$aaplayerbirthdate</div></div></div>";
				
			if($aaratingcounter == 10)
				$aaratingsaddtolist = "<div><div class='aa-playerprofile-small aa-playerprofilen-$aaplayerposition' data-playercode='$aaplayercode'><div class='position'><span>$aaplayerposition</span></div><div class='name'>$aaplayername</div><div class='rating'>$aaplayerrating</div><div class='birthyear'>$aaplayerbirthdate</div></div></div>";
			
		 	$aaratingcounter++;
		 	
		 	if($aaratingcounter == 11){
		 		$aaratingshtml .= "<div class='aa-text-center'><a class='aa-btn aajs-addclasstotarget' href='javascript:;' data-target='.aa-ratingslist-absoluto' data-theclass='aa-ratingsshowfull'>Ver Top <span>100</span></a></div></div><div class='aa-ratingslist-full aa-clearfix'><div><div class='aa-playerprofile-small aa-playerprofile-titles'><div class='position'>#</div><div class='name'>Nombre</div><div class='rating'>Rating</div><div class='birthyear'>Nac<span>imiento</span></div></div></div>$aaratingsaddtolist";
		 		
		 		$aaratingsaddtolist = "";
		 	}
	 	}
 	}
 	
 	$aaratingshtml .= "<div class='aa-text-center'><a class='aa-btn aajs-removeclasstotarget' href='javascript:;' data-target='.aa-ratingslist-absoluto' data-theclass='aa-ratingsshowfull'>Ocultar Lista</a></div></div>";
?>

<div class="aa-ratingslist aa-ratingslist-absoluto">
	<?php echo $aaratingshtml; ?>
</div>

<?php
	$content = ob_get_contents();
  	ob_end_clean();

	return $content;
}
add_shortcode("aa_rating_mexicano", "shortcode_aa_rating_mexicano");


// [aa_rating_mexicano_juvenil]
function shortcode_aa_rating_mexicano_juvenil($atts, $content = null){
	global $aa_ratingsjsonpath_juvenil, $aa_players_cutominfo;
 	ob_start();
 	
 	aa_check_ratings_cache();
 	$aaratings = @file_get_contents($aa_ratingsjsonpath_juvenil);
 	if($aaratings)
 		$aaratings = json_decode($aaratings, true);
 	
 	$aaratingshtml = "<div class='aa-ratingslist-tops aa-clearfix'>";	
 	$aaratingcounter = 1;
 	$aaratingsaddtolist = "";
 	
 	if(is_array($aaratings)){
	 	foreach($aaratings as $aaplayer){
		 	$aaplayercode = $aaplayer["player-code"];
		 	$aaplayerposition = $aaplayer["player-position"];
		 	$aaplayername = $aaplayer["player-name"];
		 	$aaplayerrating = $aaplayer["player-rating"];
		 	$aaplayerbirthdate = $aaplayer["player-birthdate"];
		 	
		 	$aaplayerimage = (isset($aa_players_cutominfo[$aaplayercode]) and isset($aa_players_cutominfo[$aaplayercode]["player-picture"])) ? $aa_players_cutominfo[$aaplayercode]["player-picture"] : "";
		 	$aaprofilepicextraclass = $aaplayerimage ? "aahaspic" : "";
		 	
		 	if($aaratingcounter < 11)
			 	$aaratingshtml .= "<div><div class='aa-playerprofile-full aa-playerprofilen-$aaplayerposition' data-playercode='$aaplayercode'><div class='imagebg aalazybg $aaprofilepicextraclass' data-src='$aaplayerimage'></div><div class='info'><div class='name'>$aaplayername</div><div class='numbersinfo'><div class='position'>#$aaplayerposition</div><div class='rating'>$aaplayerrating</div></div><div class='birthdate'><span>Año de Nacimiento:</span><strong>$aaplayerbirthdate</strong></div></div></div></div>";
			else
				$aaratingshtml .= "<div><div class='aa-playerprofile-small aa-playerprofilen-$aaplayerposition' data-playercode='$aaplayercode'><div class='position'><span>$aaplayerposition</span></div><div class='name'>$aaplayername</div><div class='rating'>$aaplayerrating</div><div class='birthyear'>$aaplayerbirthdate</div></div></div>";
				
			if($aaratingcounter == 10)
				$aaratingsaddtolist = "<div><div class='aa-playerprofile-small aa-playerprofilen-$aaplayerposition' data-playercode='$aaplayercode'><div class='position'><span>$aaplayerposition</span></div><div class='name'>$aaplayername</div><div class='rating'>$aaplayerrating</div><div class='birthyear'>$aaplayerbirthdate</div></div></div>";
			
		 	$aaratingcounter++;
		 	
		 	if($aaratingcounter == 11){
		 		$aaratingshtml .= "<div class='aa-text-center'><a class='aa-btn aajs-addclasstotarget' href='javascript:;' data-target='.aa-ratingslist-juvenil' data-theclass='aa-ratingsshowfull'>Ver Top <span>50</span></a></div></div><div class='aa-ratingslist-full aa-clearfix'><div><div class='aa-playerprofile-small aa-playerprofile-titles'><div class='position'>#</div><div class='name'>Nombre</div><div class='rating'>Rating</div><div class='birthyear'>Nac<span>imiento</span></div></div></div>$aaratingsaddtolist";
		 		
		 		$aaratingsaddtolist = "";
		 	}
		 	
		 	
		 	if($aaratingcounter >= 51)
		 		break;
	 	}
 	}
 	
 	$aaratingshtml .= "<div class='aa-text-center'><a class='aa-btn aajs-removeclasstotarget' href='javascript:;' data-target='.aa-ratingslist-juvenil' data-theclass='aa-ratingsshowfull'>Ocultar Lista</a></div></div>";
?>

<div class="aa-ratingslist aa-ratingslist-juvenil">
	<?php echo $aaratingshtml; ?>
</div>

<?php
	$content = ob_get_contents();
  	ob_end_clean();

	return $content;
}
add_shortcode("aa_rating_mexicano_juvenil", "shortcode_aa_rating_mexicano_juvenil");


// [aa_rating_mexicano_femenil]
function shortcode_aa_rating_mexicano_femenil($atts, $content = null){
	global $aa_ratingsjsonpath_femenino, $aa_players_cutominfo;
 	ob_start();
 	
 	aa_check_ratings_cache();
 	$aaratings = @file_get_contents($aa_ratingsjsonpath_femenino);
 	if($aaratings)
 		$aaratings = json_decode($aaratings, true);
 	
 	$aaratingshtml = "<div class='aa-ratingslist-tops aa-clearfix'>";	
 	$aaratingcounter = 1;
 	$aaratingsaddtolist = "";
 	
 	if(is_array($aaratings)){
	 	foreach($aaratings as $aaplayer){
		 	$aaplayercode = $aaplayer["player-code"];
		 	$aaplayerposition = $aaplayer["player-position"];
		 	$aaplayername = $aaplayer["player-name"];
		 	$aaplayerrating = $aaplayer["player-rating"];
		 	$aaplayerbirthdate = $aaplayer["player-birthdate"];
		 	
		 	$aaplayerimage = (isset($aa_players_cutominfo[$aaplayercode]) and isset($aa_players_cutominfo[$aaplayercode]["player-picture"])) ? $aa_players_cutominfo[$aaplayercode]["player-picture"] : "";
		 	$aaprofilepicextraclass = $aaplayerimage ? "aahaspic" : "";
		 	
		 	if($aaratingcounter < 11)
			 	$aaratingshtml .= "<div><div class='aa-playerprofile-full aa-playerprofilen-$aaplayerposition' data-playercode='$aaplayercode'><div class='imagebg aalazybg $aaprofilepicextraclass' data-src='$aaplayerimage'></div><div class='info'><div class='name'>$aaplayername</div><div class='numbersinfo'><div class='position'>#$aaplayerposition</div><div class='rating'>$aaplayerrating</div></div><div class='birthdate'><span>Año de Nacimiento:</span><strong>$aaplayerbirthdate</strong></div></div></div></div>";
			else
				$aaratingshtml .= "<div><div class='aa-playerprofile-small aa-playerprofilen-$aaplayerposition' data-playercode='$aaplayercode'><div class='position'><span>$aaplayerposition</span></div><div class='name'>$aaplayername</div><div class='rating'>$aaplayerrating</div><div class='birthyear'>$aaplayerbirthdate</div></div></div>";
				
			if($aaratingcounter == 10)
				$aaratingsaddtolist = "<div><div class='aa-playerprofile-small aa-playerprofilen-$aaplayerposition' data-playercode='$aaplayercode'><div class='position'><span>$aaplayerposition</span></div><div class='name'>$aaplayername</div><div class='rating'>$aaplayerrating</div><div class='birthyear'>$aaplayerbirthdate</div></div></div>";
			
		 	$aaratingcounter++;
		 	
		 	if($aaratingcounter == 11){
		 		$aaratingshtml .= "<div class='aa-text-center'><a class='aa-btn aajs-addclasstotarget' href='javascript:;' data-target='.aa-ratingslist-femenil' data-theclass='aa-ratingsshowfull'>Ver Top <span>50</span></a></div></div><div class='aa-ratingslist-full aa-clearfix'><div><div class='aa-playerprofile-small aa-playerprofile-titles'><div class='position'>#</div><div class='name'>Nombre</div><div class='rating'>Rating</div><div class='birthyear'>Nac<span>imiento</span></div></div></div>$aaratingsaddtolist";
		 		
		 		$aaratingsaddtolist = "";
		 	}
		 	
		 	
		 	if($aaratingcounter >= 51)
		 		break;
	 	}
 	}
 	
 	$aaratingshtml .= "<div class='aa-text-center'><a class='aa-btn aajs-removeclasstotarget' href='javascript:;' data-target='.aa-ratingslist-femenil' data-theclass='aa-ratingsshowfull'>Ocultar Lista</a></div></div>";
?>

<div class="aa-ratingslist aa-ratingslist-femenil">
	<?php echo $aaratingshtml; ?>
</div>

<?php
	$content = ob_get_contents();
  	ob_end_clean();

	return $content;
}
add_shortcode("aa_rating_mexicano_femenil", "shortcode_aa_rating_mexicano_femenil");


// [aa_talentos_mejores]
function shortcode_aa_talentos_mejores($atts, $content = null){
	global $aa_ratingsjsonpath_absoluto, $aa_ratingsjsonpath_juvenil, $aa_ratingsjsonpath_femenino, $aa_players_cutominfo;
 	ob_start();
 	
 	$aaratingshtml = "";
 	
 	$aaratings = @file_get_contents($aa_ratingsjsonpath_absoluto);
 	if($aaratings){
 		$aaratings = json_decode($aaratings, true);
 		
 		if(is_array($aaratings))
 			$aaratingshtml .= aa_get_topplayer($aaratings, "<div class='aa-playertoptag'>#1 Absoluto</div>");
 	}
 		
 	$aaratings = @file_get_contents($aa_ratingsjsonpath_juvenil);
 	if($aaratings){
 		$aaratings = json_decode($aaratings, true);
 		
 		if(is_array($aaratings))
 			$aaratingshtml .= aa_get_topplayer($aaratings, "<div class='aa-playertoptag'>#1 Juvenil</div>");
 	}
 	
 	$aaratings = @file_get_contents($aa_ratingsjsonpath_femenino);
 	if($aaratings){
 		$aaratings = json_decode($aaratings, true);
 		
 		if(is_array($aaratings))
 			$aaratingshtml .= aa_get_topplayer($aaratings, "<div class='aa-playertoptag'>#1 Mujeres</div>");
 	}	
?>

<div class="aa-talentos-mejores aa-ratingslist-tops aa-clearfix">
	<?php echo $aaratingshtml; ?>
</div>

<?php
	$content = ob_get_contents();
  	ob_end_clean();

	return $content;
}
add_shortcode("aa_talentos_mejores", "shortcode_aa_talentos_mejores");

