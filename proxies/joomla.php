<?php
/**
* @blogchat proxy for joomla 
* @copyright (c) 2011- Robert Beach (fastcatsoftware.com)
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*
* Use this file to establish a proxy between blogchat and joomla's default user authentification protocol.
*
*/

// Set flag that this is a parent file
define( '_JEXEC', 1 );
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
define('SECRET_KEY', 'OqO,X<rU_&=F;V}f39< bh,+&Qlr>:20=V6a^FkQ9N!<Uwp|y}]}<!5(|W|N4E>8');
define('USERNAMES_ENCODED', true);
define('RETURN_AVATAR', true);
define( 'DS', DIRECTORY_SEPARATOR );
define('JPATH_BASE', dirname(__FILE__) .DS. '..' .DS. '..' .DS. '..' .DS. '..');
require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
JDEBUG ? $_PROFILER->mark( 'afterLoad' ) : null;

/**
 * CREATE THE APPLICATION
 *
 * NOTE :
 */
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();

$user_id='';
$password='';

$request = ( isset($_POST['f']) ) ? (int) $_POST['f'] : 0;

function str_decode_utf8($string) {
  if (mb_detect_encoding($string.'a', 'UTF-8', true) === 'UTF-8') {
    $string = utf8_decode($string);
  }
return $string;
}


//Pull the kunena avatar
function fc_get_avatar(){

	/*
	* Test for Kunena avatar.
	*/

	$version=1.6;
	// Detects Kunena 2.0 or later version
	if (class_exists('KunenaForum') && KunenaForum::isCompatible('2.0') && KunenaForum::installed()) {
		KunenaForum::setup();
		$version=2;
	}else if (class_exists('KunenaForum') || !class_exists('Kunena')) { // Detects Kunena 1.6 and 1.7
		return null;
	}

	// Initialize variables
	$sizex = $sizey = 90;
	$class = 'avatar';
	$user = KunenaFactory::getUser();
 
	// Get avatar URL "/media/kunena/avatars/path/file.jpg"
	$avatar=$user->getAvatarURL($sizex, $sizey);

	if(!empty($avatar)){
		if($version==2){
			$url = preg_split('/modules\/mod_blogchat\/blogchat\/proxies/i',$avatar);
			$avatar = $url[count($url)-1];
			if(substr($avatar, 0, 1)=="/"){
				$url = preg_split('/modules\/mod_blogchat\/blogchat\/proxies\//i',JURI::base());
				return $url[0] . substr($avatar, 1);
			}else{
				return $avatar;
			}
		}else{
			$url = preg_split('/modules\/mod_blogchat\/blogchat\/proxies\//i',JURI::base());
			$url = $url[0];
			$url2 = preg_split('/modules\/mod_blogchat\/blogchat\/proxies\//i',$avatar);
			return $url . $url2[count($url2)-1];
		}
	}else{
		return null;
	}
}


if($request==0){
	$current_user =& JFactory::getUser();
	if ($current_user->guest) {
    		// Not logged in.
	 	echo "<fcchatresponse><fcchatresponse>";
	} else {
    		// Logged in.
		$t1 = time();
		if(USERNAMES_ENCODED){
			$username = htmlspecialchars_decode($current_user->username);
		}else{
			$username = $current_user->username;
		}
		$name_length = strlen(str_decode_utf8($username));
		if($name_length<10){
			$name_length = '00' . $name_length;
		}else if($name_length<100){
			$name_length = '0' . $name_length;
		}
		$password = md5('jm1' . $current_user->id . SECRET_KEY);
		$signature = md5($t1 . $password . SECRET_KEY);
		echo "<fcchatresponse>" . 'jm1' . $current_user->id . '&' . $password . '&' . $name_length . $username . $signature . $t1 .  "<fcchatresponse>";

//Grab the avatar
		if(RETURN_AVATAR){
			$avatar=fc_get_avatar();
			if (!empty($avatar)){
				echo "<fcchatresponse2>/" . $avatar . "<fcchatresponse2>";
			}else{
				echo "<fcchatresponse2><fcchatresponse2>";
			}
		}
	}
}else{
	$avatar=fc_get_avatar();
	if (!empty($avatar)){
		echo "<fcchatresponse>/" . $avatar . "<fcchatresponse>";		
	}else{
		echo "<fcchatresponse>0<fcchatresponse>";
	}		
}
