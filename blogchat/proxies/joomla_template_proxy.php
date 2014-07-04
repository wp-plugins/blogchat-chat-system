<?php
/**
*
* @blogchat template overrides proxy for joomla 
* @copyright (c) 2009- Robert Beach (fastcatsoftware.com)
*
* Use this file to establish a proxy between blogchat and joomla.
*
*/


// Set flag that this is a parent file
define( '_JEXEC', 1 );
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
define( 'DS', DIRECTORY_SEPARATOR );
define('JPATH_BASE', dirname(__FILE__) .DS. '..' .DS. '..' .DS. '..' .DS. '..');
require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
require_once( dirname(__FILE__).DS. '..'.DS.'..'.DS.'fcchat-config.php' );
JDEBUG ? $_PROFILER->mark( 'afterLoad' ) : null;

/**
 * CREATE THE APPLICATION
 *
 * NOTE :
 */
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();
jimport( 'joomla.application.module.helper' );
jimport( 'joomla.html.parameter' );

    function get_blogchat_widget_options($params) {
  	return blogchat_array_merge(fcchat_widget_options(),$params);
    }

    function blogchat_array_merge($Arr1, $params)
    {
  	foreach($Arr1 as $key => $Value)
  	{
      		//Compatible with previous versions
      		if($key=='chat_id'){
			if($params->get('chatid')&&$Arr1['chat_id']['value']==''){
      				$Arr1['chat_id']['value'] = $params->get('chatid');
			}
      		}
      		if($params->get($key))
      		$Arr1[$key]['value'] = $params->get($key);
  	}
  	return $Arr1;
    }

	
	//$module = &JModuleHelper::getModule('blogchat');
	$db = JFactory::getDBO();
	$query = "
  	SELECT params
    	FROM ".$db->nameQuote('#__modules')."
    	WHERE ".$db->nameQuote('module')." = ".$db->quote('mod_blogchat').";
  	";
	$db->setQuery($query);
	$result = $db->loadResult();
	$params = new JRegistry();
	$params->loadString($result); 
	$options = get_blogchat_widget_options($params);
	$plugin_url = JURI::base() . '../';
	$javascript='';
	if ($options['template_overrides']['value']!=""){
		$javascript .= '(function(){function getObj(a,b,d){var c=window;for(var i=0;i<b.length-d;i++){c=c[b[i]]}return c};function setOption(a,d){try{var b=a.split(".");var c= getObj(a,b,1);c[b[b.length-1]]=d}catch(e){}};function mergeOption(a,d){try{var b=a.split(".");var c = getObj(a,b,1);c[b[b.length-1]]+=d}catch(e){}};function mergeBlock(a,d){try{var b=a.split(".");var c=getObj(a,b,0);jGo.$.extend(true,c,d)}catch(e){}};';
		$javascript .= 'function getCSSProp(a,d,g){try{var b=a.split(".");var c;c=getObj(a,b,1);var f=((c[b[b.length-1]].split(d+":"))[1].split(";"))[0];return (g?jGo.util.eN(f):f)}catch(e){}};';
		$javascript .= $options['template_overrides']['value'];
		$javascript .= '})();';
        }
	echo $javascript;


?>