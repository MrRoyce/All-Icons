<?php
/*------------------------------------------------------------------------
# mod_allicons - All Icons Module
# ------------------------------------------------------------------------
# author Royce Harding - Total Design and Technology
# copyright Copyright (C) 2012 tdandt.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.tdandt.com
# Technical Support: - https://github.com/MrRoyce/All-Icons
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

// Jloader::register is faster than require/require_once as per Joomla! programming, Mark Dexter, Louis Landry
Jloader::register('modAllIconsHelper', dirname(__FILE__).'/helper.php');

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''));

$buttons = modAllIconsHelper::getButtons($params);

// Note, test for buttons retrieved  is in template, could be done here instead
require JModuleHelper::getLayoutPath('mod_allicons', $params->get('layout', 'default'));
