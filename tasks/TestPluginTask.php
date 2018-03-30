<?php
/**
 * TestPlugin plugin for Craft CMS
 *
 * TestPlugin Task
 *
 * @author    Owen Jones
 * @copyright Copyright (c) 2018 Owen Jones
 * @link      whoisowenjones.com
 * @package   TestPlugin
 * @since     1.0.0
 */

namespace Craft;

class TestPluginTask extends BaseTask
{
    /**
     * @access protected
     * @return array
     */

    protected function defineSettings()
    {
        return array(
            'someSetting' => AttributeType::String,
        );
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return 'TestPlugin Tasks';
    }

    /**
     * @return int
     */
    public function getTotalSteps()
    {
        TestPluginPlugin::log('Task was created, running 10 steps...', LogLevel::Info, true);
        craft()->testPlugin->getFeedData();
        return 10;
    }

    /**
     * @param int $step
     * @return bool
     */
    public function runStep($step)
    {
        TestPluginPlugin::log('Running step ' . $step . '...', LogLevel::Info, true);
        return true;
    }
}
