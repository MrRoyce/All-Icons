<?php
/**
 * @package		AllIconsAdministrator
 * @subpackage	mod_allicons
 * @copyright	Copyright (C) 2012 TDAndT, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Jloader::register is faster than require/require_once as per Joomla! programming, Mark Dexter, Louis Landry
Jloader::register('modAllIconsHelper', dirname(__FILE__).'/helper.php');

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''));

$buttons = modAllIconsHelper::getButtons($params);

// Note, test for buttons retrieved  is in template, could be done here instead
require JModuleHelper::getLayoutPath('mod_allicons', $params->get('layout', 'default'));
