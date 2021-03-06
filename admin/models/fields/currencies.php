<?php
/**
 * @package      CrowdFunding
 * @subpackage   Components
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * CrowdFunding is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package      CrowdFunding
 * @subpackage   Components
 * @since       1.6
 */
class JFormFieldCurrencies extends JFormFieldList {
    /**
     * The form field type.
     *
     * @var     string
     * @since   1.6
     */
    protected $type = 'currencies';
    
    /**
     * Method to get the field options.
     *
     * @return  array   The field option objects.
     * @since   1.6
     */
    protected function getOptions(){
        
        // Initialize variables.
        $options = array();
        
        $db     = JFactory::getDbo();
        $query  = $db->getQuery(true);
        
        $query
            ->select('a.id AS value, '. $query->concatenate( array("a.abbr", "a.title"), " - " ) . ' AS text')
            ->from('#__crowdf_currencies AS a')
            ->order("a.abbr ASC");
        
        // Get the options.
        $db->setQuery($query);
        $options = $db->loadObjectList();
        
        // Merge any additional options in the XML definition.
        $options = array_merge(parent::getOptions(), $options);
        
        return $options;
    }
}
