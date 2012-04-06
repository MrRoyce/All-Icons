<?php
/**
 * @package		AllIconsAdministrator
 * @subpackage	mod_allicons
 * @copyright	Copyright (C) 2012 TDAndT, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

require_once dirname(__FILE__).'/helper.php';

$buttons = modAllIconsHelper::getButtons($params);

require JModuleHelper::getLayoutPath('mod_allicons', $params->get('layout', 'default'));
