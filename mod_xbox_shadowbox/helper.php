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

defined('_JEXEC') or die('Restricted access');

class modXBoxShadowboxHelper {
	private $_imgPlayer;
	private $_swfPlayer;
	private $_flvPlayer;
	private $_qtPlayer;
	private $_wmpPlayer;
	private $_iframePlayer;
	private $_htmlPlayer;
	private $_jsCompress;
	private $_adapter;
	private $_animate;
	private $_animateFade;
	private $_animSequence;
	private $_autoDimensions;
	private $_autoplayMovies;
	private $_continuous;
	private $_counterLimit;
	private $_counterType;
	private $_displayCounter;
	private $_displayNav;
	private $_enableKeys;
	private $_fadeDuration;
	private $_handleOversize;
	private $_handleUnsupported;
	private $_initialHeight;
	private $_initialWidth;
	private $_language;
	private $_modal;
	private $_overlayColor;
	private $_overlayOpacity;
	private $_resizeDuration;
	private $_showMovieControls;
	private $_showOverlay;
	private $_slideshowDelay;
	private $_viewportPadding;
	private $_skipSetup;
	private $_useSizzle;
	private $_players;
	private $_javascript;
	private $_load_adapter;
			
	public function __construct(&$params) {		
		
		// get parameters
		$this->_imgPlayer = $params->get('imgPlayer', '1');
		$this->_swfPlayer = $params->get('swfPlayer', '0');
		$this->_flvPlayer = $params->get('flvPlayer', '0');
		$this->_qtPlayer = $params->get('qtPlayer', '0');
		$this->_wmpPlayer = $params->get('wmpPlayer', '0');
		$this->_iframePlayer = $params->get('iframePlayer', '0');
		$this->_htmlPlayer = $params->get('htmlPlayer', '0');
		$this->_jsCompress = $params->get('jsCompress', '1');
		$this->_adapter = $params->get('adapter', 'base');
		$this->_animate = $params->get('animate', '1');
		$this->_animateFade = $params->get('animateFade', '1');
		$this->_animSequence = $params->get('animSequence', 'sync');
		$this->_autoDimensions = $params->get('autoDimensions', '0');
		$this->_autoplayMovies = $params->get('autoplayMovies', '1');
		$this->_continuous = $params->get('continuous', '0');
		$this->_counterLimit = $params->get('counterLimit', '10');
		$this->_counterType = $params->get('counterType', 'default');
		$this->_displayCounter = $params->get('displayCounter', '1');
		$this->_displayNav = $params->get('displayNav', '1');
		$this->_enableKeys = $params->get('enableKeys', '1');
		$this->_fadeDuration = $params->get('fadeDuration', '0.35');
		$this->_handleOversize = $params->get('handleOversize', 'resize');
		$this->_handleUnsupported = $params->get('handleUnsupported', 'link');
		$this->_initialHeight = $params->get('initialHeight', '160');
		$this->_initialWidth = $params->get('initialWidth', '320');
		$this->_language = $params->get('language', 'en');
		$this->_modal = $params->get('modal', '1');
		$this->_overlayColor = $params->get('overlayColor', '#000');
		$this->_overlayOpacity = $params->get('overlayOpacity', '0.8');
		$this->_resizeDuration = $params->get('resizeDuration', '0.35');
		$this->_showMovieControls = $params->get('showMovieControls', '1');
		$this->_showOverlay = $params->get('showOverlay', '1');
		$this->_slideshowDelay = $params->get('slideshowDelay', '0');
		$this->_viewportPadding = $params->get('viewportPadding', '20');
		$this->_skipSetup = $params->get('skipSetup', '1');
		$this->_useSizzle = $params->get('useSizzle', '1');
		$this->_adapter = $params->get('adapter', 'base');
		$this->_load_adapter = $params->get('load_adapter', '0');
		
	}
	
	/*
	public function fixIE() {
		// This is the IE8 fix
		switch ($this->_param['emulate']) {
	        case 'meta':
	            $document =& JFactory::getDocument();
	            $document->setMetaData('X-UA-Compatible', 'IE=EmulateIE7', true);
	            break;	                
	        case 'header':
	            header('X-UA-Compatible: IE=EmulateIE7');
	            break;	            
	        case 'no':
	            break;
    	}
	}*/
	
	public function buildParams() {
		// build other parameters
		$parameters = '';
		if ($this->_players) $parameters .= 'players: ["' .$this->_players.'"], ';
		if (!$this->_animate) $parameters .= 'animate: false, ';
		if (!$this->_animateFade) $parameters .= 'animateFade: false, ';
		if ($this->_animSequence != "sync") $parameters .= 'animSequence: "'.$this->_animSequence.'", ';
		if (!$this->_autoplayMovies) $parameters .= 'autoplayMovies: false, ';
		if ($this->_autoDimensions) $parameters .= 'autoDimensions: true, ';
		if ($this->_continuous) $parameters .= 'continuous: true, ';
		if ($this->_counterLimit != 10) $parameters .= 'counterLimit: '.$this->_counterLimit.', ';
		if ($this->_counterType != "default") $parameters .= 'counterType: "'.$this->_counterType.'", ';
		if (!$this->_displayCounter) $parameters .= 'displayCounter: false, ';
		if (!$this->_displayNav) $parameters .= 'displayNav: false, ';
		if (!$this->_enableKeys) $parameters .= 'enableKeys: false, ';
		if ($this->_fadeDuration != 0.35) $parameters .= 'fadeDuration: '.$this->_fadeDuration.', ';
		if ($this->_handleOversize != "resize") $parameters .= 'handleOversize: "'.$this->_handleOversize.'", ';
		if ($this->_handleUnsupported != "link") $parameters .= 'handleUnsupported: "'.$this->_handleUnsupported.'", ';
		if ($this->_initialHeight != 160) $parameters .= 'initialHeight: '.$this->_initialHeight.', ';
		if ($this->_initialWidth != 320) $parameters .= 'initialWidth: '.$this->_initialWidth.', ';
		if (!$this->_modal) $parameters .= 'modal: false, ';
		if ($this->_overlayColor != "#000") $parameters .= 'overlayColor: "'.$this->_overlayColor.'", ';
		if ($this->_overlayOpacity != 0.8) $parameters .= 'overlayOpacity: '.$this->_overlayOpacity.', ';
		if ($this->_resizeDuration != 0.35) $parameters .= 'resizeDuration: '.$this->_resizeDuration.', ';
		if (!$this->_showMovieControls) $parameters .= 'showMovieControls: false, ';
		if (!$this->_showOverlay) $parameters .= 'showOverlay: false, ';
		if ($this->_slideshowDelay != 0) $parameters .= 'slideshowDelay: '.$this->_slideshowDelay.', ';
		if ($this->_viewportPadding != 20) $parameters .= 'viewportPadding: '.$this->_viewportPadding.', ';
		if (!$this->_skipSetup) $parameters .= 'skipSetup: false, ';
		
		// add parameters if necessary
		$javascript = '';
		if ($parameters != '') {
			$javascript .= 'Shadowbox.init({ '.substr($parameters, 0, -2).' });';
		} else {
			$javascript .= 'Shadowbox.init();';
		}
		
		$this->_javascript = $javascript;
	}

	public function loadJs() {		 
    	$document =& JFactory::getDocument();
    	
    	if($this->_load_adapter) {
    		$this->loadLibrary();
    	}
		
    	// inject javascript and css into <head>
		$document->addStyleSheet(XBOX_SHADOWBOX_BASE . $this->_adapter . '/shadowbox.css');
		$document->addScript(XBOX_SHADOWBOX_BASE . $this->_adapter . '/shadowbox.js');
		$document->addScriptDeclaration($this->_javascript);
	}
	
	public function loadLibrary() {
		$document =& JFactory::getDocument();
		$tempScript = $document->_scripts;
		unset($document->_scripts);
		
		switch($this->_adapter) {
			case 'dojo':
				$document->addScript(XBOX_SHADOWBOX_BASE_JS . 'dojo.js');
				break;
			case 'ext':
				$document->addScript(XBOX_SHADOWBOX_BASE_JS . 'ext-4.js');
				break;
			case 'jquery':
				$document->addScript(XBOX_SHADOWBOX_BASE_JS . 'jquery-1.6.4.min.js');
				break;
			case 'mootools':
				$document->addScript(XBOX_SHADOWBOX_BASE_JS . 'mootools-core-1.4.0-full-compat-yc.js');
				break;
			case 'prototype':
				$document->addScript(XBOX_SHADOWBOX_BASE_JS . 'prototype-1.7.js');
				break;
			case 'yui':
				$document->addScript(XBOX_SHADOWBOX_BASE_JS . 'yui-min-3.4.0.js');
				break;
		}
		
		foreach($tempScript as $key => $value) {
			$document->addScript($key);
		}
	}

	public function buildPlayers() {
    	// build javascript for <head>
    	$playerList = array();

		if ($this->_imgPlayer) $playerList[] = 'img';
		if ($this->_swfPlayer) $playerList[] = 'swf';
		if ($this->_flvPlayer) $playerList[] = 'flv';
		if ($this->_qtPlayer) $playerList[] = 'qt';
		if ($this->_wmpPlayer) $playerList[] = 'wmp';
		if ($this->_iframePlayer) $playerList[] = 'iframe';
		if ($this->_htmlPlayer) $playerList[] = 'html';
		
		$players = implode('" ,"', $playerList);
		$this->_players = $players;
 	}
}	
?>