<?php

/*
	Plugin Name: Search In Setting
	Plugin URI: https://github.com/heartsmile/search-in-setting-plugin
	Plugin Description: Search a setting in administrator panel quickly
	Plugin Version: 1.2
	Plugin Date: 2014-11-10
	Plugin Author: NTHQ group
	Plugin Author URI: https://namgivu.wordpress.com/2015/01/25/nthq-a-new-question2answer-team-to-bring-rich-features-to-vietnamese-community/
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.5
	Plugin Update Check URI: https://raw.githubusercontent.com/heartsmile/search-in-setting-plugin/master/qa-plugin.php
*/

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

define('SS_PLUGIN_DIR', dirname(__FILE__));
define('SS_PLUGIN_DIR_NAME', basename(dirname(__FILE__)));

require_once SS_PLUGIN_DIR.'/qa-search-setting-function.php' ;

qa_register_plugin_module(
			'widget', 
			'qa-search-setting-widget.php', 
			'qa_search_setting_widget', 
			'Search In Setting');
qa_register_plugin_module(
			'page', // type of module
			'qa-search-setting-result.php', // PHP file containing module class
			'qa_search_setting_result', // name of module class
			'Search Setting Result' // human-readable name of module
);
qa_register_plugin_phrases(
	'qa-search-setting-lang-*.php', // pattern for language files
	'plugin_s_setting' // prefix to retrieve phrases
);
