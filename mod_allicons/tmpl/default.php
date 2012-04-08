<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	mod_allicons
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;
$html = JHtml::_('icons.buttons', $buttons);
?>
<?php if (!empty($html)): ?>
	<!-- 
	* Must use an id for cpanel, not a class! The Bluestork template defines the icon css for both a class and div.  
	* the core Quick Icons module uses the class definition.  This causes a conflict with Akeeba admin tools
	* becuse it tries to put its icons in the cpanel icons class.  The KC QUcik Icons also uses the id of cpanel
	* so this module should not be shown on the same page as that module because there will be two 
	* divs with the same id.
	-->
	<div id="cpanel<?php echo $moduleclass_sfx; ?>"><?php echo $html;?></div>
<?php endif;?>
