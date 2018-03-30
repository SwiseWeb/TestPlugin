<?php
/**
 * TestPlugin plugin for Craft CMS
 *
 * Test Plugin
 *
 * @author    Owen Jones
 * @copyright Copyright (c) 2018 Owen Jones
 * @link      whoisowenjones.com
 * @package   TestPlugin
 * @since     1.0.0
 */

namespace Craft;

class TestPluginPlugin extends BasePlugin
{
    /**
     * @return mixed
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
         return Craft::t('TestPlugin');
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return Craft::t('Test Plugin');
    }

    /**
     * @return string
     */
    public function getDocumentationUrl()
    {
        return '???';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl()
    {
        return '???';
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getSchemaVersion()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return 'Owen Jones';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'whoisowenjones.com';
    }

    public function hasCpSection()
    {
        return true;
    }

    public function registerCpRoutes()
    {
        return array (
            'testplugin' => array('action' => 'testPlugin/logs'),
            'testplugin/logs' => array('action' => 'testPlugin/logs')
        );
    }

    /**
     */
    public function onBeforeInstall()
    {
    }

    /**
     */
    public function onAfterInstall()
    {
    }

    /**
     */
    public function onBeforeUninstall()
    {
    }

    /**
     */
    public function onAfterUninstall()
    {
    }
}