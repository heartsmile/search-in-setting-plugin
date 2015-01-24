<?php

function update_database_value($lang){
	$qa_lang_ss = QA_LANG_DIR.'/'.$lang.'/';
	//check if language file is available or not
	if(file_exists($qa_lang_ss.'qa-lang-options.php') ) {
		$array_options = include ($qa_lang_ss.'qa-lang-options.php');
	} else {//if not exist, use the default file
		$array_options = include (QA_INCLUDE_DIR.'qa-lang-options.php');
	}
	if(file_exists($qa_lang_ss.'qa-lang-admin.php') ) {
		$array_admin = include ($qa_lang_ss.'qa-lang-admin.php');
	} else {
		$array_admin = include (QA_INCLUDE_DIR.'qa-lang-admin.php');
	}
	if(file_exists($qa_lang_ss.'qa-lang-profile.php') ) {
		$array_profile = include ($qa_lang_ss.'qa-lang-profile.php');
	} else {
		$array_profile = include (QA_INCLUDE_DIR.'qa-lang-profile.php');
	}

	//update database with correspond language string
	foreach($array_options as $key_word => $value){
		qa_db_query_sub('UPDATE `qa_plugin_setting` SET `value` = $ WHERE `key_word` = $ ',$value, $key_word);
	}
	foreach($array_admin as $key_word => $value){
		qa_db_query_sub('UPDATE `qa_plugin_setting` SET `value` = $ WHERE `key_word` = $ ',$value, $key_word);
	}
	foreach($array_profile as $key_word => $value){
		qa_db_query_sub('UPDATE `qa_plugin_setting` SET `value` = $ WHERE `key_word` = $ ',$value, $key_word);
	}
}

