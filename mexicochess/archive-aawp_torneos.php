<?php get_header(); ?>
<?php
	global $aawp_pagegtype;
	$aawp_pagegtype = "Torneos";
	
	$aatitlebg = get_field("aawp_titles_bg", "option");
?>

<div class="aa-main-content-inner aa-archive-torneos">
	
	<div class="aa-pagetitle alignfull">
        
        <div class="aa-pagetitle-bg aalazybg" data-src="<?php echo $aatitlebg; ?>"></div>
        <div class="aa-pagetitle-inner">
	        <h1 class="aaan-slideup">Torneos</h1>
        </div>

    </div>
	
	<div class="aa-torneos-list aa-clearfix">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
			
			$aatorneotype = get_field("aawp_torneo_type");
			$aatorneoestado = get_field("aawp_torneo_estado");
			$aatorneociudad = get_field("aawp_torneo_ciudad");
			$aatorneopermalink = get_the_permalink();
			$aatorneoritmo = get_field("aawp_torneo_ritmo");
			$aatorneotiporitmo = get_field("aawp_torneo_ritmocategoria");
			$aatorneotime = get_field("aawp_torneo_fecha");
			$aatorneogmaplink = get_field("aawp_torneo_googlemapsurl");
			$aatorneotag = get_field("aawp_torneo_addtag");
			$aastrtime = strtotime($aatorneotime);
			
			$aadday = date("j", $aastrtime);
			$aamonthname = $aawp_monthsshortnames[date("n", $aastrtime)/1 - 1];

			$aatorneoitemclass = ($aatorneotag) ? "aa-torneo-tag-" . $aatorneotag : "";
			
			if($aatorneotiporitmo == "Relámpago")
				$aatorneoritmoicono = "fa-flash";
			else if($aatorneotiporitmo == "Rápido")
				$aatorneoritmoicono = "fa-bicycle";
			else
				$aatorneoritmoicono = "fa-clock-o";
				
			$aatorneolugarlinkstart = ($aatorneogmaplink) ? "<a href='$aatorneogmaplink' target='_blank'>" : "";
			$aatorneolugarlinkend = ($aatorneogmaplink) ? "</a>" : "";

			$aatorneolocationhtml = ($aatorneotype != "Online") ? "{$aatorneolugarlinkstart}<i class='fa fa-map-marker'></i> $aatorneociudad, $aatorneoestado{$aatorneolugarlinkend}" : "<i class='fa fa-laptop'></i> Online";
		?>
			
			<div class="aa-torneo-listitem <?php echo $aatorneoitemclass; ?>">
				<div class="ddate">
					<div class="dday"><?php echo $aadday; ?></div>
					<div class="dmonth"><?php echo $aamonthname; ?></div>
				</div>
				<div class="name">
					<a href="<?php echo $aatorneopermalink; ?>"><div class="title"><?php the_title(); ?></div></a>
					<div class="locationmob"><?php echo $aatorneolocationhtml; ?></div>
					<div class="ritmo"><span>Ritmo <?php echo $aatorneotiporitmo; ?>:</span> <i class="fa <?php echo $aatorneoritmoicono; ?>"></i> <?php echo $aatorneoritmo; ?></div>
				</div>
				<div class="location"><?php echo $aatorneolocationhtml; ?></div>
				<div class="actions">
					<div class="actionbtn">
						<a class="aa-btn" href="<?php echo $aatorneopermalink; ?>">Detalles</a>
					</div>
					<div class="share">
						<a class="aajs-sharedrop" href="<?php echo $aatorneopermalink; ?>"><i class="fa fa-share-alt"></i><span>Compartir</span></a>
					</div>
				</div>
			</div>
			
		<?php endwhile; endif; ?>
	</div>
</div>

<?php get_footer(); ?>
