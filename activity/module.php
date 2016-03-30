<?php
/**
 * @package     LOGman
 * @copyright   Copyright (C) 2011 - 2016 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.joomlatools.com
 */

/**
 * Module activity.
 *
 * @author  Arunas Mazeika <https://github.com/amazeika>
 * @package Joomlatools\Plugin\LOGman
 */
class PlgLogmanAdvancedmodulesActivityModule extends ComLogmanModelEntityActivity
{
    protected function _initialize(KObjectConfig $config)
    {
        $config->append(array('object_table' => 'modules'));
        parent::_initialize($config);
    }

    protected function _objectConfig(KObjectConfig $config)
    {
        $component = JComponentHelper::getComponent('com_advancedmodules', true);

        if (!$component->enabled) {
            $config->append(array('url' => 'option=com_modules&task=module.edit&id=' . $this->row));
        }

        parent::_objectConfig($config);
    }
}