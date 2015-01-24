<?php

	class qa_search_setting_widget {	

		function allow_template($template)
		{
			return ($template=='admin');
		}

		function allow_region($region)
		{
			if($region=='main')//only allow at main region
				return true;
			else	
				return false;
		}
		
		function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
		{
			//only show search box when data is available
			if((bool)qa_opt('plugin_ss_data_inserted')){
				$themeobject->output('
				<form action="'.qa_opt('site_url').'/index.php/search-result" METHOD="GET"> 
				<input type="text" required name="search_value" class="search-setting" placeholder="'.qa_lang_html('plugin_s_setting/placeholder_text').'"> 
				<input type="submit" name="submit" value="'.qa_lang_html('plugin_s_setting/search_button').'"> 
				</form>
				');
			}
		}
		
		function option_default($option)
		{
			if ($option=='plugin_ss_is_enable')//to check if plug-in is enable
				return false;
			if ($option=='plugin_ss_data_inserted')// to check if database is inserted or not
				return false;
			if ($option=='plugin_ss_table_lengh')//number of results in result table
				return 15;
			if ($option=='plugin_ss_old_language')// to see what language that plug-in had in database
				return '';

			return null;
		}

		function admin_form(&$qa_content)
		{
			require_once QA_INCLUDE_DIR.'qa-app-admin.php';
			require_once QA_INCLUDE_DIR.'qa-app-options.php';
			require_once QA_INCLUDE_DIR.'qa-db.php';

			$saved=false;
			
			if (qa_clicked('plugin_ss_save_button')) {
				qa_opt('plugin_ss_is_enable', ((bool)qa_post_text('plugin_ss_is_enable_field'))? true:false);
				//plugin_ss_table_lengh_field
				qa_opt('plugin_ss_table_lengh', (int)qa_post_text('plugin_ss_table_lengh_field'));
				
				//if enable plugin
				if((bool)qa_opt('plugin_ss_is_enable'))
				{
					//create table to save data
					$result=qa_db_query_sub('CREATE TABLE IF NOT EXISTS `qa_plugin_setting` (
										`id` int NOT NULL AUTO_INCREMENT,
										`site` varchar(100) NOT NULL,
										`key_word` varchar(100) NOT NULL,
										`value` varchar(500) character set utf8,
										PRIMARY KEY (`id`))');
										
					//if not insert data yet
					if(!(bool)qa_opt('plugin_ss_data_inserted')) {
						qa_opt('plugin_ss_data_inserted',true);
						//insert value
						
						//general
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("general", "site_language")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("general", "site_maintenance")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("general", "site_theme_mobile")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("general", "site_theme")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("general", "site_title")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("general", "site_url")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("general", "tags_or_categories")');
						//emails
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("emails", "from_email")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("emails", "feedback_email")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("emails", "notify_admin_q_post")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("emails", "feedback_enabled")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("emails", "email_privacy")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("emails", "smtp_active")');
						//users
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "show_notice_visitor")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "show_custom_register")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "show_notice_welcome")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "show_custom_welcome")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "allow_login_email_only")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "allow_change_usernames")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "allow_private_messages")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "show_message_history")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "allow_user_walls")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "page_size_wall")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "avatar_allow_gravatar")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "avatar_allow_upload")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "avatar_store_size")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "avatar_default_show")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "avatar_profile_size")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "avatar_users_size")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "avatar_q_page_q_size")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "avatar_q_page_a_size")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "avatar_q_page_c_size")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "avatar_q_list_size")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("users", "avatar_message_list_size")');
						//layout
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("layout", "logo_show")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("layout", "show_custom_sidebar")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("layout", "show_custom_sidepanel")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("layout", "show_custom_header")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("layout", "show_custom_footer")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("layout", "show_custom_in_head")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("layout", "show_custom_home")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("layout", "show_home_description")');
						//posting
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "do_close_on_select")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "allow_close_questions")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "allow_self_answer")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "allow_multi_answers")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "follow_on_as")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "comment_on_qs")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "comment_on_as")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "editor_for_qs")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "editor_for_as")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "editor_for_cs")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "show_custom_ask")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "extra_field_active")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "show_custom_answer")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "show_custom_comment")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "min_len_q_title")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "max_len_q_title")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "min_len_q_content")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "min_num_q_tags")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "max_num_q_tags")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "tag_separator_comma")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "min_len_a_content")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "min_len_c_content")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "notify_users_default")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "block_bad_words")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "do_ask_check_qs")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "do_example_tags")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "match_example_tags")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "do_complete_tags")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("posting", "page_size_ask_tags")');
						//viewing
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "q_urls_title_length")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "q_urls_remove_accents")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "do_count_q_views")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "show_view_counts")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "show_view_count_q_page")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "voting_on_qs")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "voting_on_q_page_only")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "voting_on_as")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "votes_separated")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "show_url_links")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "links_in_new_window")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "show_when_created")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "show_full_date_days")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "show_user_points")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "sort_answers_by")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "show_selected_first")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "page_size_q_as")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "show_a_form_immediate")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "show_fewer_cs_from")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "show_fewer_cs_count")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "show_c_reply_buttons")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("viewing", "pages_prev_next")');
						//lists
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "page_size_home")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "page_size_activity")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "page_size_qs")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "page_size_hot_qs")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "page_size_una_qs")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "page_size_tag_qs")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "page_size_tags")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "columns_tags")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "page_size_users")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "columns_users")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "search_module")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "page_size_search")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "hot_weight_q_age")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "hot_weight_a_age")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "hot_weight_answers")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "hot_weight_votes")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("lists", "hot_weight_views")');
						//categories
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("categories", "allow_no_category")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("categories", "allow_no_sub_category")');
						//permissions, - in qa-lang-profile.php
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_view_q_page")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_post_q")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_post_a")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_post_c")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_vote_q")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_vote_a")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_vote_down")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_recat")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_edit_q")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_edit_a")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_edit_c")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_edit_silent")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_close_q")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_select_a")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_anon_view_ips")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_view_voters_flaggers")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_flag")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_moderate")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_hide_show")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_delete_hidden")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_post_wall")');
						//permissions, - in qa-lang-options.php
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_block")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_approve_users")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_create_experts")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_see_emails")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_delete_users")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_create_eds_mods")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("permissions", "permit_create_admins")');
						//pages
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("pages", "nav_links_explanation")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("pages", "plugin_pages_explanation")');
						//feeds
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("feeds", "feed_for_questions")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("feeds", "feed_for_qa")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("feeds", "feed_for_activity")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("feeds", "feed_for_hot")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("feeds", "feed_for_unanswered")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("feeds", "feed_for_tag_qs")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("feeds", "feed_per_category")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("feeds", "feed_for_search")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("feeds", "feed_number_items")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("feeds", "feed_full_text")');
						//points
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_post_q")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_select_a")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_per_q_voted_up")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_per_q_voted_down")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_q_voted_max_gain")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_q_voted_max_loss")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_post_a")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_a_selected")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_per_a_voted_up")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_per_a_voted_down")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_a_voted_max_gain")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_a_voted_max_loss")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_vote_up_q")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_vote_down_q")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_vote_up_a")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_vote_down_a")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_multiple")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("points", "points_base")');
						//spam
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "confirm_user_emails")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "confirm_user_required")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "moderate_users")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "register_notify_admin")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "suspend_register_users")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "captcha_on_register")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "captcha_on_reset_password")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "captcha_on_anon_post")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "captcha_on_unconfirmed")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "captcha_on_feedback")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "captcha_module")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "moderate_anon_post")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "moderate_unconfirmed")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "moderate_by_points")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "flagging_of_posts")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "flagging_notify_first")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "flagging_notify_every")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "flagging_hide_after")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "block_ips_write")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "max_rate_ip_registers")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "max_rate_ip_logins")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "max_rate_ip_qs")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "max_rate_ip_as")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "max_rate_ip_cs")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "max_rate_ip_votes")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "max_rate_ip_flags")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "max_rate_ip_uploads")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("spam", "max_rate_ip_messages")');
						//mailing
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("mailing", "mailing_enabled")');
						//stats - in qa-lang-admin.php
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("stats", "q2a_version")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("stats", "q2a_build_date")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("stats", "q2a_latest_version")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("stats", "q2a_db_version")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("stats", "q2a_db_size")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("stats", "php_version")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("stats", "mysql_version")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("stats", "total_qs")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("stats", "from_users")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("stats", "from_anon")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("stats", "total_as")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("stats", "total_cs")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("stats", "users_registered")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("stats", "users_posted")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("stats", "users_voted")');
						qa_db_query_sub('INSERT INTO `qa_plugin_setting` (`site`,`key_word`) VALUES ("stats", "database_cleanup")');
						
						//set old language that we had
						qa_opt('plugin_ss_old_language', qa_opt('site_language'));
						
						//update database to find new value, base on site_language
						update_database_value(qa_opt('site_language'));						
					}
				}
				else //disable plugin
				{
					//set it not insert data yet
					qa_opt('plugin_ss_data_inserted',false);
					
					//delete table
					$result=qa_db_query_sub('DROP TABLE IF EXISTS `qa_plugin_setting`');
				}
			
				$saved=true;
			}
			
			return array(
				'ok' => $saved ? qa_lang_html('plugin_s_setting/saved_setting') : null,
				
				'fields' => array(
					array(
						'label' => qa_lang_html('plugin_s_setting/enable_option'),
						'type' => 'checkbox',
						'value' => ((bool)qa_opt('plugin_ss_is_enable'))? true:false,
						'suffix' => '',
						'tags' => 'NAME="plugin_ss_is_enable_field"',
					),
					
					array(
						'label' => qa_lang_html('plugin_s_setting/table_lengh'),
						'type' => 'number',
						'value' => ((int)qa_opt('plugin_ss_table_lengh')),
						'suffix' => '',
						'tags' => 'NAME="plugin_ss_table_lengh_field"',
					),
				),
				
				'buttons' => array(
					array(
						'label' => qa_lang_html('plugin_s_setting/save_settings'),
						'tags' => 'NAME="plugin_ss_save_button"',
					),
				),
			);
		}
			
		}

/*
	Omit PHP closing tag to help avoid accidental output
*/
