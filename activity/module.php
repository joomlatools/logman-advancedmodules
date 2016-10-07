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
        $adapter = $this->getObject('lib:database.adapter.mysqli');

        $query = $this->getObject('lib:database.query.select')
                      ->table('extensions')
                      ->columns('COUNT(*)')
                      ->where('element = :element')
                      ->bind(array('element' => 'com_advancedmodules'));

        if (!$adapter->select($query, KDatabase::FETCH_FIELD)) {
            $config->append(array('url' => array('admin' => 'option=com_modules&task=module.edit&id=' . $this->row)));
        }

        parent::_objectConfig($config);
    }
}