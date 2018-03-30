<?php
/**
 * TestPlugin plugin for Craft CMS
 *
 * TestPlugin Service
 *
 * @author    Owen Jones
 * @copyright Copyright (c) 2018 Owen Jones
 * @link      whoisowenjones.com
 * @package   TestPlugin
 * @since     1.0.0
 */

namespace Craft;

class TestPluginService extends BaseApplicationComponent
{
    /**
     */
    public function getFeedData()
    {
        TestPluginPlugin::log('Hit the getFeedData function...', LogLevel::Info, true);
        $curl = curl_init();

        $options = array(
            CURLOPT_URL => 'http://api.newscred.com/articles?access_key=e4aca60ab53db82bf21dcaf5adc75574&format=json',
            CURLOPT_RETURNTRANSFER => 1,
        );

        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        TestPluginPlugin::log('Got the data with status code ' . $httpCode . '!', LogLevel::Info, true);

        curl_close($curl);
    }

}