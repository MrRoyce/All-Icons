<?php
/*------------------------------------------------------------------------
# com_allicons - All Icons Component
# ------------------------------------------------------------------------
# author Royce Harding - Total Design and Technology
# copyright Copyright (C) 2012 tdandt.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.tdandt.com
# Technical Support: - https://github.com/MrRoyce/All-Icons
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

class com_AllIconsInstallerScript
{
	/*
         * The mimimum required joomla version for this extension. It will be read from the version attribute (install tag) in the manifest file
         */
	private $minimum_joomla_release = '2.5.0';
	private $release;
	
	/*
	 * $parent is the class calling this method.
	 * $type is the type of change (install, update or discover_install, not uninstall).
	 * preflight runs before anything else and while the extracted files are in the uploaded temp folder.
	 * If preflight returns false, Joomla will abort the update and undo everything already done.
	 */
    function preflight($type, $parent)  
    {
		// this component does not work with Joomla releases prior to 1.6
		// abort if the current Joomla release is older
		$jversion = new JVersion();
 
		// Extract the version number from the manifest. This will overwrite the 1.0 value set above 
		$this->release = $parent->get("manifest")->version; 
 
		if( version_compare( $jversion->getShortVersion(), $this->minimum_joomla_release, 'lt' ) ) {
			Jerror::raiseWarning(null, JText::_('COM_ALLICONS_CANNOT_INSTALL') . $this->minimum_joomla_release);
			return false;
		}  

		// abort if the component being installed is not newer than the currently installed version
		if ($type == 'update') {
			$oldRelease = $this->getParam('version');
			$rel = $oldRelease . ' -> ' . $this->release;
			if ( version_compare( $this->release, $oldRelease, 'le' ) ) {
				Jerror::raiseWarning(null, JText::_('COM_ALLICONS_CANNOT_INSTALL_SEQUENCE') . $rel);
				return false;
			}
		} else { 
			$rel = $this->release; 
		}
		
		$parent->set('message', JText::_('COM_ALLICONS_PREFLIGHT_' . strtoupper($type)) . ' ' . $rel);		
        
    }
	
    /*
	 * $parent is the class calling this method.
	 * install runs after the database scripts are executed.
	 * If the extension is new, the install method is run.
	 * If install returns false, Joomla will abort the install and undo everything already done.
	 */
    function install($parent)
    {
        $this->release = $parent->get("manifest")->version;
		$parent->set('message', JText::_('COM_ALLICONS_INSTALL') . $this->release);
    }
    
    function uninstall($parent)
    {
        $this->release = $parent->get("manifest")->version;
		$parent->set('message', JText::_('COM_ALLICONS_UNINSTALL') . ' ' . $this->release);
        
    }
	
	/*
	 * get a variable from the manifest file (actually, from the manifest cache).
	 */
	function getParam($name) {
		$db = JFactory::getDbo();
		$db->setQuery('SELECT `manifest_cache` FROM `#__extensions` WHERE `name` = ' . $db->quote('com_allicons'));
		$manifest = json_decode($db->loadResult(), true);
		return $manifest[$name];
	}
    
	/*
	 * $parent is the class calling this method.
	 * update runs after the database scripts are executed.
	 * If the extension exists, then the update method is run.
	 * If this returns false, Joomla will abort the update and undo everything already done.
	 */
    function update($parent)
    {
        $this->release = $parent->get("manifest")->version;
		$parent->set('message', JText::_('COM_ALLICONS_UPDATE') . $this->release);
    }
    
	/*
	 * $parent is the class calling this method.
	 * $type is the type of change (install, update or discover_install, not uninstall).
	 * postflight is run after the extension is registered in the database.\
	 * set the module to enabled and the position to icons
	 */
    
    function postflight($type, $parent)
    {
		$this->release = $parent->get("manifest")->version;
        $parent->set('message', JText::_('COM_ALLICONS_POSTFLIGHT') . $this->release);
    }
}