<?php
/**
 * XBox Shadowbox
 * Developer Dana Harris
 * Shadowbox            (C) 2007 Michael J.I. Jackson GNU LGPL
 * Copyright            (C) 2011 Dana Harris http://www.optikool.com
 * Email:               optikool@yahoo.com
 * Date:                September 2011
 * License :            http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
    
defined('_JEXEC') or die ('Restricted access.');

if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

//jimport('joomla.application.component.helper');

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

if(! defined('XBOX_SHADOWBOX_BASE')) {
	define('XBOX_SHADOWBOX_BASE',  JURI::base().'modules/mod_xbox_shadowbox/shadowbox-');
}

if(! defined('XBOX_SHADOWBOX_BASE_JS')) {
	define('XBOX_SHADOWBOX_BASE_JS', JURI::base().'modules/mod_xbox_shadowbox/js/');
}

$xboxsb = new modXBoxShadowboxHelper($params);
$xboxsb->buildPlayers();
$xboxsb->buildParams();
$xboxsb->loadJs();
?>