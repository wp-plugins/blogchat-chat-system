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
require( dirname(__FILE__) . '/../../../../wp-load.php' );

$fcchat_plugin_url = trailingslashit( get_bloginfo('wpurl') ).PLUGINDIR.'/'. dirname( plugin_basename(__FILE__) ).'/../';

$fcchat_options=get_blogchat_widget_options();
if ($fcchat_options['template_overrides']['value']!=""){
	echo '(function(){function getObj(a,b,d){var c=window;for(var i=0;i<b.length-d;i++){c=c[b[i]]}return c};function setOption(a,d){try{var b=a.split(".");var c= getObj(a,b,1);c[b[b.length-1]]=d}catch(e){}};function mergeOption(a,d){try{var b=a.split(".");var c = getObj(a,b,1);c[b[b.length-1]]+=d}catch(e){}};function mergeBlock(a,d){try{var b=a.split(".");var c=getObj(a,b,0);jGo.$.extend(true,c,d)}catch(e){}};';
	echo 'function getCSSProp(a,d,g){try{var b=a.split(".");var c;c=getObj(a,b,1);var f=((c[b[b.length-1]].split(d+":"))[1].split(";"))[0];return (g?jGo.util.eN(f):f)}catch(e){}};';
	echo $fcchat_options['template_overrides']['value'];
	echo '})();';
}


?>