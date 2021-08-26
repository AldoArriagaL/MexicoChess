<?php
	
$aa_cache_path = realpath(dirname(__FILE__)) . "/aacache";
$aa_cache_duration = 2592000;
$aa_players_cutominfo = array();

$aa_ratingshtmlurl_absoluto = "https://ratings.fide.com/a_top.php?list_type=open&rating_type=standard&country_type=MEX";
$aa_ratingshtmlurl_juvenil = "https://ratings.fide.com/a_top.php?list_type=u_j_18&rating_type=standard&country_type=MEX";
$aa_ratingshtmlurl_femenino = "https://ratings.fide.com/a_top.php?list_type=women&rating_type=standard&country_type=MEX";

$aa_ratingshtmlpath_absoluto = $aa_cache_path . "/rating-absoluto.html";
$aa_ratingshtmlpath_juvenil = $aa_cache_path . "/rating-juvenil.html";
$aa_ratingshtmlpath_femenino = $aa_cache_path . "/rating-femenino.html";

$aa_ratingsjsonpath_absoluto = $aa_cache_path . "/rating-absoluto.json";
$aa_ratingsjsonpath_juvenil = $aa_cache_path . "/rating-juvenil.json";
$aa_ratingsjsonpath_femenino = $aa_cache_path . "/rating-femenino.json";
	
function aawp_get_format_date($aawpdate){
	global $aawp_weekdays, $aawp_monthsnames;
	
	$aastrtime = strtotime($aawpdate);
	$aadayname = $aawp_weekdays[date("N", $aastrtime)/1 - 1];
	$aamonthname = $aawp_monthsnames[date("n", $aastrtime)/1 - 1];
	$aanday = date("j", $aastrtime);
	$aanyear = date("Y", $aastrtime);
	
	$aatorneoddate = "{$aadayname} $aanday de $aamonthname de $aanyear";
	
	return $aatorneoddate; 
}
function aawp_get_remainingdays($aawpdate){
	$aatimenow = date("Y-m-d", current_time("timestamp"));
	$aatimenow = strtotime($aatimenow);
	$aatorneotime = strtotime($aawpdate);
	
	$aatimediff = $aatorneotime - $aatimenow;
	$aadaysdiff = round($aatimediff / (60 * 60 * 24));
	
	return $aadaysdiff;
}
function aawp_pull_ratings(){
	global $aa_cache_path, $aa_ratingshtmlurl_absoluto, $aa_ratingshtmlurl_juvenil, $aa_ratingshtmlurl_femenino, $aa_ratingshtmlpath_absoluto, $aa_ratingshtmlpath_juvenil, $aa_ratingshtmlpath_femenino;
	
	$aaratinghtmlabsoluto = @aa_file_get_contents($aa_ratingshtmlurl_absoluto);
	$aaratinghtmljuvenil = @aa_file_get_contents($aa_ratingshtmlurl_juvenil);
	$aaratinghtmlfemenino = @aa_file_get_contents($aa_ratingshtmlurl_femenino);
	
	if($aaratinghtmlabsoluto){
		if(file_exists("$aa_ratingshtmlpath_absoluto"))
			unlink("$aa_ratingshtmlpath_absoluto");
		
		$fp = fopen("$aa_ratingshtmlpath_absoluto", "w+");
		fwrite($fp, $aaratinghtmlabsoluto);
		fclose($fp);
	}
	
	if($aaratinghtmljuvenil){
		if(file_exists("$aa_ratingshtmlpath_juvenil"))
			unlink("$aa_ratingshtmlpath_juvenil");
		
		$fp = fopen("$aa_ratingshtmlpath_juvenil", "w+");
		fwrite($fp, $aaratinghtmljuvenil);
		fclose($fp);
	}
	
	if($aaratinghtmlfemenino){
		if(file_exists("$aa_ratingshtmlpath_femenino"))
			unlink("$aa_ratingshtmlpath_femenino");
		
		$fp = fopen("$aa_ratingshtmlpath_femenino", "w+");
		fwrite($fp, $aaratinghtmlfemenino);
		fclose($fp);
	}
	
	if($aaratinghtmlabsoluto and $aaratinghtmljuvenil and $aaratinghtmlfemenino)
		return true;
	else
		return false;
}
function aa_generate_ratings_files(){
	global $aa_ratingshtmlpath_absoluto, $aa_ratingshtmlpath_juvenil, $aa_ratingshtmlpath_femenino, $aa_ratingsjsonpath_absoluto, $aa_ratingsjsonpath_juvenil, $aa_ratingsjsonpath_femenino;
	
	$aaratingsabsolutoarray = aa_get_ratings_array($aa_ratingshtmlpath_absoluto);
	$aaratingsabsolutojson = aa_get_ratings_json($aaratingsabsolutoarray);
	
	$aaratingsjuvenilarray = aa_get_ratings_array($aa_ratingshtmlpath_juvenil);
	$aaratingsjuveniljson = aa_get_ratings_json($aaratingsjuvenilarray);
	
	$aaratingsfemeninoarray = aa_get_ratings_array($aa_ratingshtmlpath_femenino);
	$aaratingsfemeninojson = aa_get_ratings_json($aaratingsfemeninoarray);
	
	if($aaratingsabsolutojson){
		if(file_exists("$aa_ratingsjsonpath_absoluto"))
			unlink("$aa_ratingsjsonpath_absoluto");
		
		$fp = fopen("$aa_ratingsjsonpath_absoluto", "w+");
		fwrite($fp, $aaratingsabsolutojson);
		fclose($fp);
	}
	if($aaratingsjuveniljson){
		if(file_exists("$aa_ratingsjsonpath_juvenil"))
			unlink("$aa_ratingsjsonpath_juvenil");
		
		$fp = fopen("$aa_ratingsjsonpath_juvenil", "w+");
		fwrite($fp, $aaratingsjuveniljson);
		fclose($fp);
	}
	if($aaratingsfemeninojson){
		if(file_exists("$aa_ratingsjsonpath_femenino"))
			unlink("$aa_ratingsjsonpath_femenino");
		
		$fp = fopen("$aa_ratingsjsonpath_femenino", "w+");
		fwrite($fp, $aaratingsfemeninojson);
		fclose($fp);
	}
	
	if($aaratingsabsolutojson and $aaratingsjuveniljson and $aaratingsfemeninojson)
		return true;
	else
		return false;
}
function aa_get_ratings_array($aaratingsfilepath){
	$aaratinsarray = array();
	$aaratingshtml = @file_get_contents($aaratingsfilepath);
	
	$doc = new DOMDocument();
	$doc -> loadHTML($aaratingshtml);
	$xpath = new DOMXPath($doc);
	
	$query = '//table/tr';
	$entries = $xpath->query($query);
	
	foreach($entries as $aarow){
		
		$aacols = $aarow->getElementsByTagName('td');
		$aarowarray = array();
		
		foreach($aacols as $aacol){
			$aarowarray[] = trim($aacol -> nodeValue);
		}
		
		$aaratinsarray[] = $aarowarray;
	}
	
	return $aaratinsarray;
}
function aa_get_ratings_json($aaratingsarray){
	$aaratingnewarray = array();
	if(is_array($aaratingsarray)){
		foreach($aaratingsarray as $aaplayerrating){
			if($aaplayerrating[0] and is_numeric($aaplayerrating[0])){
				$aaplayercode = str_replace(" ", "-", $aaplayerrating[1]);
				$aaplayercode = str_replace(",", "", $aaplayercode);
				$aaplayercode = strtolower($aaplayercode);
				
				$aaratingnewarray[] = array(
					"player-code" => $aaplayercode,
					"player-position" => $aaplayerrating[0],
					"player-name" => $aaplayerrating[1],
					"player-rating" => $aaplayerrating[3],
					"player-birthdate" => $aaplayerrating[5],
				);
			}
		}
	}
	
	$aaratingsjson = json_encode($aaratingnewarray);
	
	return $aaratingsjson;
}
function aa_check_ratings_cache(){
	global $aa_cache_duration, $aa_ratingshtmlpath_absoluto;
	
	$aacurrentexpiration = get_option("aawp_ratingsexpirations");
	if((time() > $aacurrentexpiration) or !file_exists("$aa_ratingshtmlpath_absoluto")){
		$aapullratings = aawp_pull_ratings();
		if($aapullratings){
			$aagenerateratings = aa_generate_ratings_files();
			
			if($aagenerateratings){
				$aanextexpiration = time() + $aa_cache_duration;
				update_option("aawp_ratingsexpirations", $aanextexpiration);
				update_option("ratings-updated", time());
			}
		}
	}
}
function aa_generate_flyerinfo_array(){
	global $aa_players_cutominfo;
	
	$aaplayerscustoms = get_field("aawp_customize_player", "option");
	
	if(is_array($aaplayerscustoms)){
		foreach($aaplayerscustoms as $aaplayercustom){
			$aaplayercustomcode = $aaplayercustom["aawp_cuspl_playercode"];
			$aaplayercustomimage = $aaplayercustom["aawp_cuspl_profilepic"]["sizes"]["jugador-avatar"];
			
			$aanewplayercustom = array(
				"player-picture" => $aaplayercustomimage,
			);
			$aa_players_cutominfo[$aaplayercustomcode] = $aanewplayercustom;
		}
	}
}
aa_generate_flyerinfo_array();

function aa_get_topplayer($aaratingsarray, $aaaddtoptag = ""){
	global $aa_players_cutominfo;
	$aaratingshtml = "";
	
	if(is_array($aaratingsarray)){
	 	$aaplayer = $aaratingsarray[0];
	 	
	 	$aaplayercode = $aaplayer["player-code"];
	 	$aaplayerposition = $aaplayer["player-position"];
	 	$aaplayername = $aaplayer["player-name"];
	 	$aaplayerrating = $aaplayer["player-rating"];
	 	$aaplayerbirthdate = $aaplayer["player-birthdate"];
	 	
	 	$aaplayerimage = (isset($aa_players_cutominfo[$aaplayercode]) and isset($aa_players_cutominfo[$aaplayercode]["player-picture"])) ? $aa_players_cutominfo[$aaplayercode]["player-picture"] : "";
	 	$aaprofilepicextraclass = $aaplayerimage ? "aahaspic" : "";
	 	
	 	$aaratingshtml = "<div>$aaaddtoptag<div class='aa-playerprofile-full aa-playerprofilen-$aaplayerposition' data-playercode='$aaplayercode'><div class='imagebg aalazybg $aaprofilepicextraclass' data-src='$aaplayerimage'></div><div class='info'><div class='name'>$aaplayername</div><div class='numbersinfo'><div class='position'>FIDE:</div><div class='rating'>$aaplayerrating</div></div><div class='birthdate'><span>Año de Nacimiento:</span><strong>$aaplayerbirthdate</strong></div></div></div></div>";
	}
	
	return $aaratingshtml;
}

function aa_file_get_contents($aafileurl, $usefileget = false){
	if($usefileget){
		$output = file_get_contents($aafileurl);
	}
	else{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $aafileurl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 50);
		curl_setopt($ch, CURLOPT_TIMEOUT, 600);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$output = curl_exec($ch);
	}
	
 	return($output);
}




