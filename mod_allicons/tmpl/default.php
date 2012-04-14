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
