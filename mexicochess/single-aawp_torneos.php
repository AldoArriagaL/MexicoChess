<?php get_header(); ?>
<?php
	global $aawp_pagegtype;
	$aawp_pagegtype = "Torneos";
?>

<div class="aa-main-content-inner">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
		
		$aatorneotype = get_field("aawp_torneo_type");
		$aatorneodate = get_field("aawp_torneo_fecha");
		$aatorneoddate = aawp_get_format_date($aatorneodate);
		
		$aatorneoenddate = get_field("aawp_torneo_fecha_end");
		if($aatorneoenddate)
			$aatorneoddate = $aatorneoddate . " - " . aawp_get_format_date($aatorneoenddate);
		
		$aatorneoestado = get_field("aawp_torneo_estado");
		$aatorneociudad = get_field("aawp_torneo_ciudad");
		
		$aatorneofdias = aawp_get_remainingdays($aatorneodate);
		$aatorneodfald = ($aatorneofdias == 1) ? "Falta" : "Faltan";
		$aatorneoddiad = ($aatorneofdias == 1) ? "día" : "días";
		
		$aatorneoritmo = get_field("aawp_torneo_ritmo");
		$aatorneotiporitmo = get_field("aawp_torneo_ritmocategoria");
		$aatorneogmaplink = get_field("aawp_torneo_googlemapsurl");
		$aatorneositiourl = get_field("aawp_torneo_website");
		$aatorneoinscrurl = get_field("aawp_torneo_inscripciones");
		$aatorneoplataforma = get_field("aawp_torneo_plataforma");
		
		if($aatorneotiporitmo == "Relámpago")
			$aatorneoritmoicono = "fa-flash";
		else if($aatorneotiporitmo == "Rápido")
			$aatorneoritmoicono = "fa-bicycle";
		else
			$aatorneoritmoicono = "fa-clock-o";
			
		$aatorneovalidez = get_field("aawp_torneo_validez");
		$aatorneolugar = get_field("aawp_torneo_lugar");
		$aatorneodireccion = get_field("aawp_torneo_direccion");
		$aatorneocontent = get_field("aawp_torneo_content");
		
		$aatorneoconvocatoria = get_field("aawp_torneo_convocatoria");
		$aatorneotag = get_field("aawp_torneo_addtag");

		$aatorneotaghtml = ($aatorneotag) ? "<div class='ig-torneo-divtag-$aatorneotag'></div>" : "";
		
		$uvconvocatoriaimagenes = "";
		if(is_array($aatorneoconvocatoria["aawp_torneo_convocatoria_imagenes"])){	
			foreach($aatorneoconvocatoria["aawp_torneo_convocatoria_imagenes"] as $aatorneoconvimg){
				$aatorneoconvimgurl = $aatorneoconvimg["sizes"]["torneo-convocatoria"];
				$aatorneoconvimgalt = $aatorneoconvimg["alt"];
				
				$uvconvocatoriaimagenes .= "<img src='$aatorneoconvimgurl' alt='$aatorneoconvimgalt'>";
			}
		}
		if(is_array($aatorneoconvocatoria["aawp_torneo_convocatoria_archivo"]))
			$aaconvocatoriadownloadlink = $aatorneoconvocatoria["aawp_torneo_convocatoria_archivo"]["url"];
		else 
			$aaconvocatoriadownloadlink = "";
		
		$aatorneopermalink = get_the_permalink();

		$aatorneolocationhtml = ($aatorneotype != "Online") ? "$aatorneociudad, $aatorneoestado, México" : "Torneo Online";
	?>
	
	<div class="aa-torneo-page">
		<?php echo $aatorneotaghtml; ?>
		<div class="aa-torneo-title">
			<h1><?php the_title(); ?></h1>
			<h2><?php echo $aatorneoddate; ?></h2>
			<h3><?php echo $aatorneolocationhtml; ?></h3>
		</div>
		
		<?php if(has_post_thumbnail($post->ID )){ ?>
			<div class="aa-torneo-image">
				<?php the_post_thumbnail("torneo-thumbnail"); ?>
			</div>
		<?php } ?>
		
		<div class="aa-torneo-info">
			<div class="aa-shares">
				<div class="aa-shares-label">Compartir:</div>
				<ul>
					<li><a class="aajs-share-fb" href="<?php echo $aatorneopermalink; ?>"><i class="fa fa-facebook"></i> <span>Compartir en Facebook</span></a></li>
					<li><a class="aajs-share-tw" href="<?php echo $aatorneopermalink; ?>"><i class="fa fa-twitter"></i> <span>Compartir en Twitter</span></a></li>
					<li><a class="aajs-share-clip aa-stooltip" href="javascript:;" data-clipboard-text="<?php echo $aatorneopermalink; ?>"><i class="fa fa-link"></i> <span>Copiar Enlace</span></a></li>
				</ul>
			</div>
			
			<?php if($aatorneofdias > 0){ ?>
			<div class="aa-torneo-countdown">
				<?php echo $aatorneodfald; ?> <span><?php echo $aatorneofdias; ?></span> <?php echo $aatorneoddiad; ?>
			</div>
			<?php } ?>
			<div class="aa-clear"></div>
			
			<div class="aa-torneo-infoitemscols aa-clearfix">
				<?php if($aatorneofdias > 0 and $aatorneoinscrurl){ ?>
					<div><a class="aa-infobtn" href="<?php echo $aatorneositiourl; ?>" target="_blank"><i class="fa fa-pencil"></i> Inscripciones</a></div>
				<?php } ?>

				<div><span class="aa-infobtn"><div class="tag">Ritmo <?php echo $aatorneotiporitmo; ?></div> <i class="fa <?php echo $aatorneoritmoicono; ?>"></i> <?php echo $aatorneoritmo; ?></span></div>
				
				<?php if($aatorneovalidez and ($aatorneovalidez != "-")){ ?>
					<div><span class="aa-infobtn"><div class="tag">Valido para</div> <i class="fa fa-list"></i> <?php echo $aatorneovalidez; ?></span></div>
				<?php } ?>
				
				<!--<div><a class="aa-infobtn" href="<?php echo $aatorneogmaplink; ?>" target="_blank"><i class="fa fa-map-marker"></i> Ubicación</a></div>-->
				<?php if($aatorneositiourl){ ?>
					<div><a class="aa-infobtn" href="<?php echo $aatorneositiourl; ?>" target="_blank"><i class="fa fa-globe"></i> Sitio Web</a></div>
				<?php } ?>
				
				<?php if($aaconvocatoriadownloadlink){ ?>
					<div><a class="aa-infobtn" href="<?php echo $aaconvocatoriadownloadlink; ?>" target="_blank"><i class="fa fa-download"></i> Convocatoria</a></div>
				<?php } ?>

				<?php if($aatorneoplataforma and $aatorneoplataforma != "-"){ ?>
					<div><span class="aa-infobtn"><div class="tag">Plataforma</div> <i class="fa  fa-laptop"></i> <?php echo $aatorneoplataforma; ?></span></div>
				<?php } ?>
			</div>
			
			<?php if($aatorneotype != "Online"){ ?>
				<div class="aa-torneo-lugar">
					<div class="aa-torneo-lugar-body">
						<div class="aa-clearfix">
							<div>Lugar:</div>
							<div><?php echo $aatorneolugar; ?></div>
						</div>
						<div class="aa-clearfix">
							<div>Dirección:</div>
							<div><?php echo $aatorneodireccion; ?></div>
						</div>
					</div>
					<div class="aa-torneo-lugar-actions"><a class="aa-btn aa-btn-100" href="<?php echo $aatorneogmaplink; ?>" target="_blank">Cómo Llegar</a></div>
				</div>
			<?php } ?>
			
			<div class="aa-torneo-descripcion">
				<?php echo $aatorneocontent; ?>
			</div>
			
			<div class="aa-torneo-convocatoria">
				<?php echo $uvconvocatoriaimagenes; ?>
			</div>
		</div>
	</div>
	
	<div class="wp-block-lazyblock-aablocksection alignfull uv-section-torneosdestacados">
        <div class="aa-blocksection">
	       	<div class="aa-blocksection-inner aa-clearfix">
				<h2 class="has-text-align-center">Torneos Destacados</h2>
				<?php echo do_shortcode("[aa_torneos_destacados]"); ?>
		    </div>
		    <div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
		    <div class="wp-block-button aligncenter aa-is-btn-p"><a class="wp-block-button__link no-border-radius" href="/torneos/">Todos los Torneos</a></div>
		</div>
	</div>
	
	<?php 
		//Schema Data
		$aatorneoenddate = ($aatorneoenddate) ? $aatorneoenddate : $aatorneodate;
		
		if(has_post_thumbnail($post->ID ))
			$aatorneoimage = get_the_post_thumbnail_url($post->ID, "torneo-thumbnail");
			
		$aatorneocontent = ($aatorneocontent) ? $aatorneocontent : "Torneo de Ajedrez en México: " . get_the_title();
		
		if($aatorneotype != "Online"){
			$aaeventattendance = "https://schema.org/OfflineEventAttendanceMode";
			$aaeventloc = array(
		        "@type" => "Place",
				"name" => $aatorneolugar,
				"address" => $aatorneodireccion,
			);
		}else{
			$aaeventattendance = "https://schema.org/OnlineEventAttendanceMode";
			
			$aaplatformurl = ($aatorneoplataforma == "Lichess") ? "https://lichess.org" : "";
			$aaplatformurl = ($aatorneoplataforma == "Chess.com") ? "https://chess.com" : $aaplatformurl;
			$aaplatformurl = ($aatorneoplataforma == "Chess24") ? "https://chess24.com" : $aaplatformurl;
			
			$aaeventloc = array(
		        "@type" => "VirtualLocation",
		        "name" => $aatorneoplataforma,
				"url" => $aaplatformurl,
			);
		}
		
		$aaeventschema = array(
			"@context" => "https://schema.org",
			"@type" => "Event",
			"name" => get_the_title(),
			"startDate" => $aatorneodate,
			"endDate" => $aatorneoenddate,
			"eventStatus" => "https://schema.org/EventScheduled",
			"eventAttendanceMode" => $aaeventattendance,
			"location" => $aaeventloc,
			"image" => array($aatorneoimage),
			"description" => $aatorneocontent,
		);
		
		$aaeventschemajson = json_encode($aaeventschema);
	?>
	
	<script type="application/ld+json">
		<?php echo $aaeventschemajson; ?>
	</script>
	
	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>





