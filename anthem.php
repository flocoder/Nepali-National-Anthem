<?php
/**
 * @package Nepali_National_Anthem
 * @version 1.0
 */
/*
Plugin Name: Nepali National Anthem
Plugin URI: https://wordpress.org/plugins/nepali-national-anthem/
Description: This plugin adds Nepali National Anthem lyrics in WordPress dashboard. This plugin is forked from Hello Dolly plugin by Matt Mullenweg. When activated you will randomly see a lyric of Nepali national anthem (<cite>सयौं थुँगा फूलका</cite>) in the upper right of your admin screen on every page.
Author: FloCoder (Ashi Lohorung)
Version: 1.0
Author URI: http://flocoder.com
*/

function nepali_anthem_get_lyric() {
	/** Full lyrics of Nepali national anthem */
	$lyrics = "सयौं थुँगा फूलका हामी, एउटै माला नेपाली
	सार्वभौम भै फैलिएका, मेची-महाकाली
    प्रकृतिका कोटी-कोटी सम्पदाको आंचल
    वीरहरूका रगतले, स्वतन्त्र र अटल
    ज्ञानभूमि, शान्तिभूमि तराई, पहाड, हिमाल
    अखण्ड यो प्यारो हाम्रो मातृभूमि नेपाल
    बहुल जाति, भाषा, धर्म, संस्कृति छन् विशाल
    अग्रगामी राष्ट्र हाम्रो, जय जय नेपाल";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function nepali_anthem() {
	$chosen = nepali_anthem_get_lyric();
	echo "<p id='anthem'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'nepali_anthem' );

// We need some CSS to position the paragraph
function anthem_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#anthem {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'anthem_css' );