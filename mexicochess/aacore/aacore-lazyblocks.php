<?php
	
/*if ( function_exists( 'lazyblocks' ) ) :

    lazyblocks()->add_block( array(
        'id' => 28,
        'title' => 'Sección',
        'icon' => 'dashicons dashicons-feedback',
        'keywords' => array(
            0 => 'Sección',
            1 => 'Background',
        ),
        'slug' => 'lazyblock/aablocksection',
        'description' => '',
        'category' => 'layout',
        'category_label' => 'layout',
        'supports' => array(
            'customClassName' => true,
            'anchor' => false,
            'align' => array(
                0 => 'wide',
                1 => 'full',
            ),
            'html' => false,
            'multiple' => true,
            'inserter' => true,
        ),
        'controls' => array(
            'control_c38b30412f' => array(
                'sort' => '',
                'child_of' => '',
                'label' => 'Background',
                'name' => 'background',
                'type' => 'image',
                'allow_null' => 'false',
                'min' => '',
                'max' => '',
                'step' => '',
                'date_time_picker' => 'date_time',
                'multiline' => 'false',
                'default' => '',
                'checked' => 'false',
                'placeholder' => '',
                'help' => '',
                'placement' => 'inspector',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
            ),
            'control_d7e8ca47e6' => array(
                'sort' => '',
                'child_of' => '',
                'label' => 'Content',
                'name' => 'content',
                'type' => 'inner_blocks',
                'allow_null' => 'false',
                'min' => '',
                'max' => '',
                'step' => '',
                'date_time_picker' => 'date_time',
                'multiline' => 'false',
                'default' => '',
                'checked' => 'false',
                'placeholder' => '',
                'help' => '',
                'placement' => 'content',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
            ),
            'control_b5e9db4456' => array(
                'sort' => '',
                'child_of' => '',
                'label' => 'Mobile Background',
                'name' => 'mobile_background',
                'type' => 'image',
                'allow_null' => 'false',
                'min' => '',
                'max' => '',
                'step' => '',
                'date_time_picker' => 'date_time',
                'multiline' => 'false',
                'default' => '',
                'checked' => 'false',
                'placeholder' => '',
                'help' => '',
                'placement' => 'inspector',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
            ),
        ),
        'code' => array(
            'editor_html' => '<div class="aa-blocksection"></div>',
            'editor_callback' => '',
            'editor_css' => '',
            'frontend_html' => '<div class="aa-blocksection" {{#if background.url}}style="background-image: url({{{background.url}}});"{{/if}}><div class="aa-blocksection-inner">{{{content}}}</div></div>',
            'frontend_callback' => '',
            'frontend_css' => '',
        ),
        'condition' => array(
        ),
    ) );
    
endif;*/



if ( ! function_exists( 'my_block_output' ) ) :
    
    function aawp_lazyblock_section( $output, $attributes ){
	    global $aawp_mobilefooterstyles;
        ob_start();
        
        $aawplbcontent = $attributes["content"];
        $aawplbbackground = (isset($attributes["background"]) and isset($attributes["background"]["url"])) ? $attributes["background"]["url"] : "";
        $aawplbmobbackground = (isset($attributes["mobile_background"]) and isset($attributes["mobile_background"]["url"])) ? $attributes["mobile_background"]["url"] : "";
        
        $aawpsectionbg = (wp_is_mobile() and $aawplbmobbackground) ? $aawplbmobbackground : $aawplbbackground;
        $aawpsectionclass = (wp_is_mobile() and $aawplbmobbackground) ? "aa-ismobbg" : "";
        
        $aaaddpaddstyles = ($attributes["padding_top"]) ? "padding-top: " . $attributes["padding_top"] . "px;" : "";
        $aaaddpaddstyles = ($attributes["padding_bottom"]) ? $aaaddpaddstyles . "padding-bottom: " . $attributes["padding_bottom"] . "px;" : $aaaddpaddstyles;
        
        $aaaddpaddstyles = ($attributes["background_color"]) ? $aaaddpaddstyles . "background-color: " . $attributes["background_color"] : $aaaddpaddstyles;
        
        $aaaddanchorid = ($attributes["anchor_id"]) ? "id='" . $attributes["anchor_id"] . "'" : "";
        
        
        /*Mobile paddings*/
        $aainlinestyles = "";
        
        if($attributes["mobile_padding_top"] or $attributes["mobile_padding_bottom"]){
	        $aainlinestyles .= ".lazyblock-aablocksection-" . $attributes["blockId"] . " .aa-blocksection {";
			
			if($attributes["mobile_padding_top"])
				$aainlinestyles .= "padding-top: " . $attributes["mobile_padding_top"] . "px!important;";
			
			if($attributes["mobile_padding_bottom"])
				$aainlinestyles .= "padding-bottom: " . $attributes["mobile_padding_bottom"] . "px!important;";
			
			$aainlinestyles .= "}";
	        
	        $aawp_mobilefooterstyles .= $aainlinestyles;
        }
        
        ?>

        <div <?php echo $aaaddanchorid; ?> class="aa-blocksection <?php echo $aawpsectionclass; ?>" style="<?php echo $aaaddpaddstyles; ?>">
	        <?php if($aawpsectionbg){ ?>
		        <div class="aa-blocksection-bg aalazybg" data-src="<?php echo $aawpsectionbg; ?>"></div>
		    <?php } ?>
	        <div class="aa-blocksection-inner aa-clearfix">
		        <?php echo $aawplbcontent; ?>
		    </div>
		</div>

        <?php
        return ob_get_clean();
    }
    add_filter( 'lazyblock/aablocksection/frontend_callback', 'aawp_lazyblock_section', 10, 2 );
    
    
    function aawp_lazyblock_posiciones( $output, $attributes ){
        ob_start();
        
        if(is_array($attributes["posicion"])){
	     	$aaposicioncounter = 1;
	     	$aaposicioneshtml = "";
	     	foreach($attributes["posicion"] as $aaposicionplayer){
		     	$aaplayernombre = $aaposicionplayer["posicion_nombre"];
		     	$aaplayerrating = $aaposicionplayer["posicion_rating"];
		     	$aaplayerpais = (isset($aaposicionplayer["posicion_pais"])) ? $aaposicionplayer["posicion_pais"] : "mexico";
		     	$aaplayerimageurl = $aaposicionplayer["posicion_image"]["url"];
		     	$aaplayerpuntos = $aaposicionplayer["posicion_puntos"];
		     	
		     	$aaposicioneshtml .= "<div><div class='aa-playertoptag'>#$aaposicioncounter</div><div class='aa-playerprofile-full aa-playerprofilen-$aaposicioncounter'><div class='imagebg aalazybg aahaspic' data-src='$aaplayerimageurl'></div><div class='info'><div class='name'>$aaplayernombre</div><div class='numbersinfo'><div class='position'><i class='aa-icountry-$aaplayerpais'></i></div><div class='rating'>$aaplayerrating</div></div><div class='birthdate'><span>Puntos:</span><strong>$aaplayerpuntos</strong></div></div></div></div>";
		     	
		     	$aaposicioncounter++;
	     	}   
        }
    ?>
    
    <div class="aa-posicionescont aa-clearfix">
	    <?php echo $aaposicioneshtml; ?>
    </div>
    
    <?php
        return ob_get_clean();
    }
    add_filter( 'lazyblock/posiciones/frontend_callback', 'aawp_lazyblock_posiciones', 10, 2 );
    
endif;