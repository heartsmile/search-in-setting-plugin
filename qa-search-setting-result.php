<?php

class qa_search_setting_result {
	
	function match_request($request)
	{
		$parts=explode('/', $request);
		
		return ($parts[0]=='search-result'||$parts[1]=='search-result');
	}
	
	function process_request($request)
	{		
		$qa_content=qa_content_prepare();			
		$qa_content['title']= qa_lang_html('plugin_s_setting/result_title');

		//check to see if current site language is difference from old language that we had
		if(qa_opt('site_language') != qa_opt('plugin_ss_old_language')){
		
			//update new database for new language.
			update_database_value(qa_opt('site_language'));
			
			//set old language that we had
			qa_opt('plugin_ss_old_language', qa_opt('site_language'));
		}
		
		$search_value = '';
		$arr_result = null;
		if(isset($_GET['submit']) && (bool)qa_opt('plugin_ss_data_inserted')) {
			$search_value = $_GET['search_value'];
			if($search_value != ''){
				$result_search = 
				qa_db_query_sub('SELECT `qa_plugin_ss_site`.`site_name`, `qa_plugin_setting`.`site`, `qa_plugin_setting`.`value` FROM `qa_plugin_setting` LEFT JOIN `qa_plugin_ss_site` ON `qa_plugin_setting`.`site` = `qa_plugin_ss_site`.`site` WHERE (SELECT LOCATE($, `qa_plugin_setting`.`value`) > 0) or (SELECT LOCATE($, `qa_plugin_setting`.`value`) > 0)',' '.$search_value, $search_value.' ');
				$arr_result = qa_db_read_all_assoc($result_search);
			}
		}
		
		//generate a search form
		$qa_content['custom'] = '<form action="" METHOD="GET"> 
			<input type="text" required name="search_value" class="search-setting" placeholder="'.qa_lang_html('plugin_s_setting/placeholder_text').'"> 
			<input type="submit" name="submit" value="'.qa_lang_html('plugin_s_setting/search_button').'"> 
			</form> <p> </p>';
			
		//have some results
		if(count($arr_result)>0)
		{
			$count = 0;
			
			//styling the table
			$qa_content['custom'] .= ''
				.'<style>'
				.'table#result_ss {border: 0px;border-color: lightgray;}'
				.'table#result_ss th {border: 0px;font-size: smaller;}'
				.'table#result_ss td {padding: 5px;}'				
				.'</style>'
			;
			
			//printing the table
			$qa_content['custom'] .= 
			'<table border=1 id="result_ss">'
			.' <tr> '
<<<<<<< HEAD
				.'<th width = "150">'.qa_lang_html('plugin_s_setting/site_name_table').'</th>'
				.' <th  width = "550">'.qa_lang_html('plugin_s_setting/option_name_table').'</th>'
=======
				.'<th width = "70">'.qa_lang_html('plugin_s_setting/site_name_table').'</th>'
				.' <th  width = "630">'.qa_lang_html('plugin_s_setting/option_name_table').'</th>'
>>>>>>> cd07be2b973fac8064b53f7d947f9f80cab8d08c
			.' </tr>';
			foreach($arr_result as $arr){
				if($count < (int)qa_opt('plugin_ss_table_lengh')){
					$qa_content['custom'] 
					.= '<tr> <td>'.$arr['site_name'].'</td> <td> <a href="'.qa_opt('site_url')
					.'/index.php/admin/'.$arr['site'].'">'.$arr['value'].'</a> </td> </tr>';
					$count+=1;
				}
			}
			$qa_content['custom'] .= '</table>';
			
		}
		//no setting found
		else
		{
			$qa_content['custom'] .= '<p>'.qa_lang_html('plugin_s_setting/no_seting_found').'</p>';
		}

		return $qa_content;
	}
	
}
