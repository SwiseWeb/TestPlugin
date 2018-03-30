<?php
/**
 * TestPlugin plugin for Craft CMS
 *
 * TestPlugin Controller
 *
 * @author    Owen Jones
 * @copyright Copyright (c) 2018 Owen Jones
 * @link      whoisowenjones.com
 * @package   TestPlugin
 * @since     1.0.0
 */

namespace Craft;

class TestPluginController extends BaseController
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     * @access protected
     */
    protected $allowAnonymous = true;
    private $_currLog = 'test.log';

    /**
     */
    public function actionProcessFeeds()
    {
        TestPluginPlugin::log('Creating task to process feeds......', LogLevel::Info, true);
        craft()->tasks->createTask('TestPlugin', "Processing Feeds");
    }

    public function actionLogs()
    {
        craft()->config->maxPowerCaptain();

        if (IOHelper::folderExists(craft()->path->getLogPath())) {
            $dateTimePattern = '/^[0-9]{4}\/[0-9]{2}\/[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}/';

            $logEntries = array();

            $currentFullPath = craft()->path->getLogPath().$this->_currLog;

            if (IOHelper::fileExists($currentFullPath)) {
                // Split the log file's contents up into arrays of individual logs, where each item is an array of
                // the lines of that log.
                $contents = IOHelper::getFileContents(craft()->path->getLogPath().$this->_currLog);

                $requests = explode('******************************************************************************************************', $contents);

                foreach ($requests as $request) {
                    $logChunks = preg_split('/^(\d{4}\/\d{2}\/\d{2} \d{2}:\d{2}:\d{2}) \[(.*?)\] \[(.*?)\] /m', $request, null, PREG_SPLIT_DELIM_CAPTURE);

                    // Ignore the first chunk
                    array_shift($logChunks);

                    // Loop through them
                    $totalChunks = count($logChunks);

                    for ($i = 0; $i < $totalChunks; $i += 4) {
                        $logEntryModel = new LogEntryModel();

                        $logEntryModel->dateTime = DateTime::createFromFormat('Y/m/d H:i:s', $logChunks[$i]);
                        $logEntryModel->level = $logChunks[$i+1];
                        $logEntryModel->category = $logChunks[$i+2];

                        $message = $logChunks[$i+3];
                        $rowContents = explode("\n", $message);

                        // This is a non-devMode log entry.
                        $logEntryModel->message = str_replace('[Forced]', '', $rowContents[0]);

                        // And save the log entry.
                        $logEntries[] = $logEntryModel;
                    }
                }
            }

            // Put these logs at the top
            $logEntries = array_reverse($logEntries);

            $this->renderTemplate('testplugin/logs/index', array(
                'logEntries' => $logEntries,
            ));
        }
    }

    public function actionClear()
    {
        $currentFullPath = craft()->path->getLogPath() . $this->_currLog;
        IOHelper::deleteFile($currentFullPath, true);

        $this->redirect('testplugin/logs');
    }
}