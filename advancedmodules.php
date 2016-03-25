<?php
/**
 * @package     LOGman
 * @copyright   Copyright (C) 2011 - 2015 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.joomlatools.com
 */

/**
 * Advanced Module Manager LOGman plugin.
 *
 * @author  Arunas Mazeika <https://github.com/amazeika>
 * @package Joomlatools\Plugin\LOGman
 */
class PlgLogmanAdvancedmodules extends ComLogmanPluginJoomla
{
    public function onExtensionAfterSave($context, $data, $isNew)
    {
        $dispatcher = AdvancedModulesEventDispatcher::getInstance();

        if ($plugin = $dispatcher->getPlugin('PlgLogmanModules')) {
            $plugin->onExtensionAfterSave('com_modules.module', $data, $isNew); // Forward event
        }
    }

    public function onExtensionAfterDelete($context, $data)
    {
        $dispatcher = AdvancedModulesEventDispatcher::getInstance();

        if ($plugin = $dispatcher->getPlugin('PlgLogmanModules')) {
            $plugin->onExtensionAfterDelete('com_modules.module', $data); // Forward event
        }
    }

    public function onContentChangeState($context, $pks, $state)
    {
        $dispatcher = AdvancedModulesEventDispatcher::getInstance();

        if ($plugin = $dispatcher->getPlugin('PlgLogmanModules')) {
            $plugin->onContentChangeState('com_modules.module', $pks, $state); // Forward event
        }
    }
}

class AdvancedModulesEventDispatcher extends JEventDispatcher
{
    static protected $_instance;

    static public function getInstance()
    {
        if (!self::$_instance instanceof  self) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Plugin getter.
     *
     * @param string $name The name of the plugin.
     * @return JPlugin|null Returns the plugin, null if the plugin is not found.
     */
    public function getPlugin($name)
    {
        $plugin = null;

        $dispatcher = self::$instance;

        foreach ($dispatcher->_observers as $observer)
        {
            if (is_object($observer) && get_class($observer) == $name) {
                $plugin = $observer;
                break;
            }
        }

        return $plugin;
    }
}