<?php
/**
*
* @FCChat proxy for wordpress 
* @copyright (c) 2009- Robert Beach (fastcatsoftware.com)
*
* Use this file to establish a proxy between fcchat and wordpress' default user authentification protocol.
*
*/


/** Make sure that the WordPress bootstrap has run before continuing. */
require( dirname(__FILE__) . '/../../wp-load.php' );

$fcchat_plugin_url = trailingslashit( get_bloginfo('wpurl') ).PLUGINDIR.'/'. dirname( plugin_basename(__FILE__) ).'/../';
$fcchat_options = get_blogchat_widget_options();
	echo 'if(!window["FCChatConfig"]){window["FCChatConfig"] = {}}(function(){var a = window["FCChatConfig"];';
	foreach($fcchat_options as $key => $value){
		if($key=='custom_buttons'||$key=='templates'||$key=='quickstyling'||$key=='chatbox'){
			echo 'a.' . $key . '=' . '{' . $fcchat_options[$key]['value'] . '};';
		}else if($fcchat_options[$key]['type']!='hidden'&&$fcchat_options[$key]['type']!='comment'&&$key!='template_overrides'){
			if($fcchat_options[$key]['quote']=='1'||($fcchat_options[$key]['quote']=='2'&&$fcchat_options[$key]['value']!='true'&&$fcchat_options[$key]['value']!='false')){
					echo 'a.' . $key . '=' . '"' . $fcchat_options[$key]['value'] . '";';
				}else{
					if($fcchat_options[$key]['value']==''){
						$fcchat_options[$key]['value']='""';
					}
					echo 'a.' . $key . '=' . str_replace("window['fc_chat_path']",'"' . $fcchat_plugin_url . '"',$fcchat_options[$key]['value']) . ';';
				}
			}
		}
	echo '})();';

?>