<?php
/*
Plugin Name: BLOGCHAT Chat System
Plugin URI: http://www.fastcatsoftware.com
Description: Live Comments and Chat System.
Version: 1.0.0
Author: Fastcat Software
Author URI: http://www.fastcatsoftware.com
License: GPL2
*/

/*  Copyright 2013 Fastcat Software (www.fastcatsoftware.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

include('fcchat-config.php');

$blogchat_options;
$blogchat_plugin_url = trailingslashit( get_bloginfo('wpurl') ).'blogchat/';


function get_blogchat_widget_options() {
	if(($blogchat_options = get_option('blogchat_widget')) === FALSE) $blogchat_options = array();
  	return blogchat_array_merge(fcchat_widget_options(), $blogchat_options);
}

function blogchat_array_merge($Arr1, $Arr2)
{
  foreach($Arr2 as $key => $Value)
  {
      //Compatible with previous versions
      if($key=='chatid'){
		if($Arr1['chat_id']['value']==''){
      			$Arr1['chat_id']['value'] = $Value;
		}
      }
      if(array_key_exists($key, $Arr1))
      $Arr1[$key]['value'] = $Value;
  }

  return $Arr1;

}

//widget header js
function blogchat_add_header_js(){
	global $blogchat_options,$blogchat_plugin_url;
        if (!is_admin()){
		$blogchat_options = get_blogchat_widget_options();
		echo '<script type="text/javascript">if(!window["FCChatConfig"]){window["FCChatConfig"] = {}}(function(){var a = window["FCChatConfig"];';
		foreach($blogchat_options as $key => $value){
			if($key=='custom_buttons'||$key=='templates'||$key=='quickstyling'||$key=='chatbox'){
				echo 'a.' . $key . '=' . '{' . $blogchat_options[$key]['value'] . '};';
			}else if($blogchat_options[$key]['type']!='hidden'&&$blogchat_options[$key]['type']!='comment'&&$key!='template_overrides'){
				if($blogchat_options[$key]['quote']=='1'||($blogchat_options[$key]['quote']=='2'&&$blogchat_options[$key]['value']!='true'&&$blogchat_options[$key]['value']!='false')){
					echo 'a.' . $key . '=' . '"' . $blogchat_options[$key]['value'] . '";';
				}else{
					if($blogchat_options[$key]['value']==''){
						$blogchat_options[$key]['value']='""';
					}
					echo 'a.' . $key . '=' . str_replace("window['fc_chat_path']",'"' . $blogchat_plugin_url . '"',$blogchat_options[$key]['value']) . ';';
				}
			}
		}
		echo '})();</script>';

        }
}


// Run code later in case this loads prior to any required plugins.
// add_action('plugins_loaded', 'blogchat_widget_init');


//widget scripts
function blogchat_add_header_scripts(){
        $blogchat_plugin_url = trailingslashit( get_bloginfo('wpurl') ).'blogchat';
        if (!is_admin()){
		    wp_register_script('fc-chat-import-google.loader', $blogchat_plugin_url.'/js/import.google.loader.js');
                wp_enqueue_script('fc-chat-import-google.loader');
		    wp_register_script('fc-chat-import-config', $blogchat_plugin_url.'/js/import.config.alt.php?path='.str_ireplace(array(".","http"), array("||period||","||protocol||"), $blogchat_plugin_url).'&t=1');
               wp_enqueue_script('fc-chat-import-config');
		    wp_register_script('fc-chat-import-libs', $blogchat_plugin_url.'/js/import.libs.js');
                wp_enqueue_script('fc-chat-import-libs');
		    wp_register_script('fc-chat-import-includes', $blogchat_plugin_url.'/js/import.includes.js');
                wp_enqueue_script('fc-chat-import-includes');
		     
        }
}

//widget header js
function blogchat_add_header_js_after(){
	global $blogchat_options,$blogchat_plugin_url;
        if (!is_admin()&&$blogchat_options['template_overrides']['value']!=""){
		echo '<script type="text/javascript">(function(){function getObj(a,b,d){var c=window;for(var i=0;i<b.length-d;i++){c=c[b[i]]}return c};function setOption(a,d){try{var b=a.split(".");var c= getObj(a,b,1);c[b[b.length-1]]=d}catch(e){}};function mergeOption(a,d){try{var b=a.split(".");var c = getObj(a,b,1);c[b[b.length-1]]+=d}catch(e){}};function mergeBlock(a,d){try{var b=a.split(".");var c=getObj(a,b,0);jGo.$.extend(true,c,d)}catch(e){}};';
		echo 'function getCSSProp(a,d,g){try{var b=a.split(".");var c;c=getObj(a,b,1);var f=((c[b[b.length-1]].split(d+":"))[1].split(";"))[0];return (g?jGo.util.eN(f):f)}catch(e){}};';
		echo $blogchat_options['template_overrides']['value'];
		echo '})();</script>';

        }
}
function blogchat_add_footer_script(){
        $blogchat_plugin_url = trailingslashit( get_bloginfo('wpurl') ).'blogchat';
	$filename = '/path/to/foo.txt';
	if (!is_admin()){
		if (!file_exists(ABSPATH.'blogchat')) {
    			echo "<script type='text/javascript' >alert('To use the blogchat widget, download the blogchat package from www.fastcatsoftware.com/FCChat/download/blogchat.zip. Next, upload the blogchat folder to the root directory of your wordpress installation.');</script>";
		} else {
        	
                	echo '<div id="fc_package"><script type="text/javascript" src="'.$blogchat_plugin_url.'/js/install.prep.js"></script><script type="text/javascript" >FCChatConfig.noshow=true;</script></div><script type="text/javascript">document.write("</div>" + (true?FCChatConfig.load_standalone:FCChatConfig.load_integrated));</script>';    
        	}
	}
}

// Inserts scripts into page
add_action( 'wp_print_scripts', 'blogchat_add_header_js' );
add_action('wp_enqueue_scripts', 'blogchat_add_header_scripts');
add_action('wp_head','blogchat_add_header_js_after');
add_action('wp_footer','blogchat_add_footer_script');

//the widget
function blogchat_widget_init() {
        if ( !function_exists('register_sidebar_widget') )
                return;      

	//Echo widget to sidebar
        function blogchat_widget($args) {
		global $blogchat_options;
  		extract($args);
		//$blogchat_options = get_blogchat_widget_options();
		//$blogchat_plugin_url = trailingslashit( get_bloginfo('wpurl') ).PLUGINDIR.'/'. dirname( plugin_basename(__FILE__) );
  		echo $before_widget;
  		//echo $before_title . $blogchat_options['title']['value'] . $after_title;
  		echo '';
  		echo $after_widget;
	}
                
        //widget control form
        function blogchat_widget_control() {
                $blogchat_options = get_blogchat_widget_options();
		$blogchat_options2 = array();
		//unset($blogchat_options[0]); //returned by get_option(), but we don't need it

		// If user is submitting custom option values for this widget
		if ( $_POST['blogchat-submit'] ) {
                        // Remember to sanitize and format use input appropriately.
                        foreach($blogchat_options as $key => $value){
				if(isset($_POST['blogchat-'.$key])){
					$blogchat_options[$key]['value'] = str_replace('"', '&quot;', stripslashes($_POST['blogchat-'.$key]));
				}
				$blogchat_options2[$key] = $blogchat_options[$key]['value'];
			}
                        
                        // Save changes
			update_option('blogchat_widget', $blogchat_options2);
		}
        
                //Go to activation page
		echo '<p style="text-align:left"><b>Step 1:</b> <a href="http://www.fastcatsoftware.com/chat/wp-activation.aspx" TARGET="_blank" >Click here to activate your chat</a></p>';
		   
		//Upgrade notice 
		echo '<p style="text-align:left"><b>Upgrade notice:</b> If you are upgrading from a previous version, please read the <a target=_blank href="http://www.fastcatsoftware.com/chat/userguide/upgrading2.2.12.asp">Upgrade Notice</a>.<br>Upgrading from a version prior to 2.1.8 requires that you obtain a new chat ID from the link above.</p>';
		    echo '<p style="text-align:left"><b>Step 2:</b> Enter your activation info below, and press save.</p>';
		
		//Title                
		echo '<p style="text-align:left"><label for="blogchat-title">Title: <input style="width: 200px;" id="blogchat-title" name="blogchat-title" type="text" value="'.$blogchat_options['title']['value'].'" /></label></p>';
                                        
                //Host
                 echo '<p style="text-align:left"><label for="blogchat-host">Host: <br/><input id="blogchat-host" name="blogchat-host" type="text" value="'.$blogchat_options['host']['value'].'" /></label></p>';
                
                //Chat ID
                echo '<p style="text-align:left"><label for="blogchat-chat_id">Chat ID: <br/><input id="blogchat-chat_id" name="blogchat-chat_id" type="text" value="'.$blogchat_options['chat_id']['value'].'" /></label></p>';
                
		//Links
		echo '<p style="text-align:left">Here are some other helpful links:</p>';
		echo '<p style="text-align:left"><a href="http://www.fastcatsoftware.com/chat/userguide/Blogchat.asp" TARGET="_blank" >Getting Started with BLOGCHAT</a></p>';
		echo '<p style="text-align:left">If you need assistance, or have any ideas on making this product better, please contact us at <a href="mailto:support@fastcatsoftware.com">support@fastcatsoftware.com</a></p>';

                // Submit
                echo '<input type="hidden" id="blogchat-submit" name="blogchat-submit" value="1" />';
        }
        // This registers our widget so it appears with the other available
        // widgets and can be dragged and dropped into any active sidebars.
        //register_sidebar_widget('blogchat Widget', 'blogchat_widget');
        wp_register_sidebar_widget( 'blogchat-widget', 'BLOGCHAT Widget', 'blogchat_widget');

        // This registers our optional widget control form.
        wp_register_widget_control('blogchat-widget', 'BLOGCHAT Widget', 'blogchat_widget_control');
}


//Administration page

// blogchat_settings_page() displays the page content for the blogchat settings submenu
function blogchat_settings_page() {

    //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    $blogchat_options = get_blogchat_widget_options();
    $blogchat_options2 = array();
    //unset($blogchat_options[0]); //returned by get_option(), but we don't need it

	// If user is submitting custom option values for this widget
	if ( $_POST['blogchat-settings-submit'] && $_POST['blogchat-settings-submit']=='1') {
                  // Remember to sanitize and format use input appropriately.
                 foreach($blogchat_options as $key => $value){
			if(isset($_POST['blogchat-'.$key])){
				if($key!='custom_buttons'&&$key!='templates'&&$key!='quickstyling'&&$key!='chatbox'&&$key!='template_overrides'){
    					$blogchat_options[$key]['value'] = str_replace('"', '&quot;', stripslashes($_POST['blogchat-'.$key]));	
				}else{
					$blogchat_options[$key]['value'] = stripslashes($_POST['blogchat-'.$key]);	
				}
			}
			$blogchat_options2[$key] = $blogchat_options[$key]['value'];
		}
                        
                // Save changes
		update_option('blogchat_widget', $blogchat_options2)


        // Put an settings updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Settings Saved.', 'menu-test' ); ?></strong></p></div>
<?php

    	}
	if ( $_POST['blogchat-settings-submit'] && $_POST['blogchat-settings-submit']=='2') {
                // Remember to sanitize and format use input appropriately.
		$blogchat_options=fcchat_widget_options();
		if(($blogchat_options3 = get_option('blogchat_widget')) === FALSE) $blogchat_options3 = array();
		if(isset($blogchat_options3['chatid'])){
			$blogchat_options2['chat_id'] = $blogchat_options3['chatid'];
		}
		if(isset($blogchat_options3['chat_id'])){
			$blogchat_options2['chat_id'] = $blogchat_options3['chat_id'];
		}
		if(isset($blogchat_options3['host'])){
			$blogchat_options2['host'] = $blogchat_options3['host'];
		}
		if(isset($blogchat_options3['updates'])){
			$blogchat_options2['updates'] = $blogchat_options3['updates'];
		}
                        
                // Save changes
		update_option('blogchat_widget', $blogchat_options2);
		$blogchat_options = get_blogchat_widget_options();

        // Put an settings updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Settings Reset.', 'menu-test' ); ?></strong></p></div>
<?php

    	}
    // Now display the settings editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'BLOGCHAT Plugin Settings', 'menu-test' ) . "</h2>";

    // settings form
    
    ?>

<form name="form1" method="post" action="">
<input type="hidden" id="blogchat-settings-submit" name="blogchat-settings-submit" value="1" />

<?php
_e('This page is an HTML implemention of the BLOGCHAT configuration file (blogchat/config/config.js). For a complete description of the functions and usage of the variables below, refer to the <a href="http://www.fastcatsoftware.com/chat/Manual3.html" TARGET="_blank" >FCChat Manual</a>. Some additional tutorials are found in the <a href="http://www.fastcatsoftware.com/chat/userguide/index.html" TARGET="_blank" >User Guide</a>. You can restore all the settings to their default values by pressing the reset button below.', 'menu-test' );
echo '<br /><br />';
foreach($blogchat_options as $key => $value){
	if($blogchat_options[$key]['type']=='comment'){
		echo '<br /><br /><div style="color:blue;font-weight:bold"><big>';
		_e($blogchat_options[$key]['desc'], 'menu-test' ); 
		echo '</big></div><br>';
	}else if($blogchat_options[$key]['type']=='text'){
		echo '<p>' . _e($blogchat_options[$key]['desc'], 'menu-test' ); 
		echo '<b>' . $key . '</b>&nbsp; <input type="text" name="blogchat-' . $key . '" value="' . $blogchat_options[$key]['value'] . '" size="' . $blogchat_options[$key]['sz'] . '">';
		echo '</p><hr />';
	}else if($blogchat_options[$key]['type']=='radio'){
		echo '<p><b>' . $key . '</b>&nbsp; ' . _e($blogchat_options[$key]['desc'], 'menu-test' ); 
		echo '<input type="radio"  name="blogchat-' . $key . '" value="true" ' . ($blogchat_options[$key]['value'] == "true"? 'checked="checked"':'') . ' /> Yes&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="blogchat-' . $key . '" value="false" ' . ($blogchat_options[$key]['value'] == "false"? 'checked="checked"':'') . ' /> no ';
		echo '</p><hr />';
	}else if($blogchat_options[$key]['type']=='textarea'){
		echo '<p>' . _e($blogchat_options[$key]['desc'], 'menu-test' ); 
		echo '&nbsp;&nbsp;<b>' . $key . '</b><br>&nbsp; <textarea style="font-size:16px;font-family:arial;width:100%;height:300px" name="blogchat-' . $key . '">' . $blogchat_options[$key]['value'] . '</textarea>';
		echo '</p><hr />';
	}else if($blogchat_options[$key]['type']=='hidden'){
		
	}else{
		echo '<p><b>' . $key . '</b>&nbsp; ' . _e($blogchat_options[$key]['desc'], 'menu-test' ); 
		foreach($blogchat_options[$key]['ops'] as $op => $val){
			echo '<input type="radio"  name="blogchat-' . $key . '" value="' . $blogchat_options[$key]['ops'][$op]['value'] . '" ' . ($blogchat_options[$key]['value'] == $blogchat_options[$key]['ops'][$op]['value']? 'checked="checked"':'') . ' /> ' . $blogchat_options[$key]['ops'][$op]['desc'] . '&nbsp;&nbsp;&nbsp;';
		}
		echo '</p><hr />';
	}
}

?>

<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
<input type="submit" name="Reset" class="button-primary" onclick="if(confirm('<?php esc_attr_e('Are you sure you want to restore the settings to their default values?') ?>')){document.getElementById('blogchat-settings-submit').value='2'}else{return false};" value="<?php esc_attr_e('Reset Settings') ?>" />
</p>

</form>
</div>

<?php
 
}

add_action('admin_menu', 'blogchat_add_pages');

// action function for above hook
function blogchat_add_pages() {
    // Add a new submenu under Settings:
    add_options_page(__('BLOGCHAT Settings','menu-test'), __('BLOGCHAT Settings','menu-test'), 'manage_options', 'testsettings', 'blogchat_settings_page');
}

function blogchat_activate() {
    if(($blogchat_options = get_option('blogchat_widget')) !== FALSE){
	$updates_found=false;
	$updated=false;


	// look for 3.0 updates
    	foreach($blogchat_options as $key => $value){
	 	if($key=='updates'){
			if(strpos($value , "update 3.0;") !== false){
				$updated=true;
			}
			$updates_found=true;
         	}
    	}
	if(!$updates_found){
		$blogchat_options['updates']='update 3.0;';
	}else{
		if(!$updated){
			$blogchat_options['updates']+='update 3.0;';
		}
	}

	// apply 3.0 updates
	if(!$updated){
		foreach($blogchat_options as $key => $value){
	 		if($key=='forum_proxy'){
				$proxy="";
				if(strpos($value , "wordpress_proxy")){
					$proxy="wordpress";
				}
				if(strpos($value , "wordpress_proxy2")){
					$proxy="wordpress2";
				}
				if(strpos($value , "joomla")){
					$proxy="joomla";
				}
				if(strpos($value , "phpbb3")){
					$proxy="phpbb";
				}
				if(strpos($value , "smf")){
					$proxy="smf";
				}
				if(strpos($value , "mybb")){
					$proxy="mybb";
				}
				$blogchat_options['user_integration_bridge']=$proxy;
			}
         	}
		$blogchat_options['startText']="Click here to join our chat.";
		$blogchat_options['loginText']="Please sign in to join our chat.";
		$blogchat_options['autoGreet']="Wellcome!! ";
		$blogchat_options['max_video_streams']="100";
		$blogchat_options['avatars_dir']="";
		$blogchat_options['images_dir']="";
		$blogchat_options['smileys_dir']="";
		$blogchat_options['avatar_sz']="18";
		$blogchat_options['window_height_offset']="-160";
		$blogchat_options['chat_room_height_offset']="105";
	}
    }else{
	$blogchat_options = array();
	$blogchat_options['updates']='update 3.0;';
	
    }
    // Save changes
    update_option('blogchat_widget', $blogchat_options);
}

register_activation_hook( __FILE__, 'blogchat_activate' );

?>