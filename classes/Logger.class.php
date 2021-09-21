<?php

class Logger
{
    /**
     * KLogger options
     *  Anything options not considered 'core' to the logging library should be
     *  settable view the third parameter in the constructor
     *
     *  Core options include the log file path and the log threshold
     *
     * @var array
     */
    protected $options = array (
        'extension'      => 'txt',
        'dateFormat'     => 'Y-m-d G:i:s.u',
        'filename'       => false,
        'flushFrequency' => false,
        'prefix'         => 'log_',
        'logFormat'      => false,
        'appendContext'  => true,
    );

    /**
     * Path to the log file
     * @var string
     */
    private $logFilePath;

    /**
     * Path to the log file
     * @var string
     */
    private $logPath;

    /**
     * Current minimum logging threshold
     * @var integer
     */
    protected $logLevelThreshold = 7;

    /**
     * The number of lines logged in this instance's lifetime
     * @var int
     */
    private $logLineCount = 0;

    /**
     * Log Levels
     * @var array
     */
    protected $logLevels = array(
        0 => 'EMERGENCY',// EMERGENCY
        1 => 'ALERT',//ALERT
        2 => 'CRITICAL',//CRITICAL
        3 => 'ERROR',//ERROR
        4 => "WARNING",//WARNING
        5 => 'NOTICE',//NOTICE
        6 => 'INFO',//INFO
        7 => 'DEBUG'//DEBUG
    );

    /**
     * This holds the file handle for this instance's log file
     * @var resource
     */
    private $fileHandle;

    /**
     * This holds the last line logged to the logger
     *  Used for unit tests
     * @var string
     */
    private $lastLine = '';

    /**
     * Octal notation for default permissions of the log file
     * @var integer
     */
    private $defaultPermissions = 0777;

    public function __construct($logDirectory, $logLevelThreshold = 7, array $options = array())
    {
        $this->logLevelThreshold = $logLevelThreshold;
        $this->options = array_merge($this->options, $options);
        $logDirectory = rtrim($logDirectory, DIRECTORY_SEPARATOR);
        $this->logPath = $logDirectory;
    }

    /**
     * @param string $stdOutPath
     */
    public function setLogToStdOut(string $stdOutPath) {
        $this->logFilePath = $stdOutPath;
    }

    /**
     * @param string $logDirectory
     */
    public function setLogFilePath(string $logDirectory) {
        if ($this->options['filename']) {
            if (strpos($this->options['filename'], '.log') !== false || strpos($this->options['filename'], '.txt') !== false) {
                $this->logFilePath = $logDirectory.DIRECTORY_SEPARATOR.$this->options['filename'];
            }
            else {
                $this->logFilePath = $logDirectory.DIRECTORY_SEPARATOR.$this->options['filename'].'.'.$this->options['extension'];
            }
        } else {
            $this->logFilePath = $logDirectory.DIRECTORY_SEPARATOR.$this->options['prefix'].date('Y-m-d').'.'.$this->options['extension'];
        }
    }

    /**
     * @param $writeMode
     *
     * @internal param resource $fileHandle
     */
    public function setFileHandle($writeMode) {
        $this->fileHandle = fopen($this->logFilePath, $writeMode);
    }

    /**
     * Class destructor
     */
    public function __destruct()
    {
        if ($this->fileHandle) {
            fclose($this->fileHandle);
        }
    }

    /**
     * Sets the date format used by all instances of KLogger
     *
     * @param string $dateFormat Valid format string for date()
     */
    public function setDateFormat(string $dateFormat)
    {
        $this->options['dateFormat'] = $dateFormat;
    }

    /**
     * Sets the Log Level Threshold
     *
     * @param string $logLevelThreshold The log level threshold
     */
    public function setLogLevel(string $logLevelThreshold)
    {
        $this->logLevelThreshold = $logLevelThreshold;
    }

    public function emergency($msg,array $context = array()){
        $this->log(0,$msg,$context);
    }
    public function alert($msg,array $context = array()){
        $this->log(1,$msg,$context);
    }
    public function critical($msg,array $context = array()){
        $this->log(2,$msg,$context);
    }
    public function error($msg,array $context = array()){
        $this->log(3,$msg,$context);
    }
    public function warning($msg,array $context = array()){
        $this->log(4,$msg,$context);
    }
    public function notice($msg,array $context = array()){
        $this->log(5,$msg,$context);
    }
    public function info($msg,array $context = array()){
        $this->log(6,$msg,$context);
    }
    public function debug($msg,array $context = array()){
        $this->log(7,$msg,$context);
    }
    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, string $message, array $context = array())
    {
        if ($this->logLevelThreshold < $level) {
            return;
        }
        $message = $this->formatMessage($level, $message, $context);
        $this->write($message);
    }

    /**
     * Writes a line to the log without prepending a status or timestamp
     *
     * @param string $message Line to write to the log
     * @return void
     */
    public function write(string $message)
    {
        if ( ! file_exists($this->logPath)) {
            mkdir($this->logPath, $this->defaultPermissions, true);
        }

        if(strpos($this->logPath, 'php://') === 0) {
            $this->setLogToStdOut($this->logPath);
            $this->setFileHandle('w+');
        } else {
            $this->setLogFilePath($this->logPath);
            if(file_exists($this->logFilePath) && !is_writable($this->logFilePath)) {
                throw new RuntimeException('The file could not be written to. Check that appropriate permissions have been set.');
            }
            $this->setFileHandle('a');
        }

        if (null !== $this->fileHandle) {
            if (fwrite($this->fileHandle, $message) === false) {
                throw new RuntimeException('The file could not be written to. Check that appropriate permissions have been set.');
            } else {
                $this->lastLine = trim($message);
                $this->logLineCount++;

                if ($this->options['flushFrequency'] && $this->logLineCount % $this->options['flushFrequency'] === 0) {
                    fflush($this->fileHandle);
                }
            }
        }
    }

    /**
     * Get the file path that the log is currently writing to
     *
     * @return string
     */
    public function getLogFilePath(): string
    {
        return $this->logFilePath;
    }

    /**
     * Get the last line logged to the log file
     *
     * @return string
     */
    public function getLastLogLine(): string
    {
        return $this->lastLine;
    }

    /**
     * Formats the message for logging.
     *
     * @param string $level   The Log Level of the message
     * @param string $message The message to log
     * @param array $context The context
     * @return string
     */
    protected function formatMessage(string $level, string $message, array $context): string
    {
        if ($this->options['logFormat']) {
            $parts = array(
                'date'          => $this->getTimestamp(),
                'level'         => strtoupper($level),
                'level-padding' => str_repeat(' ', 9 - strlen($level)),
                'priority'      => $this->logLevels[$level],
                'message'       => $message,
                'context'       => json_encode($context),
            );
            $message = $this->options['logFormat'];
            foreach ($parts as $part => $value) {
                $message = str_replace('{'.$part.'}', $value, $message);
            }

        } else {
            $message = "[{$this->getTimestamp()}] [{$this->logLevels[$level]}] {$message}";
        }

        if ($this->options['appendContext'] && ! empty($context)) {
            $message .= PHP_EOL.$this->indent($this->contextToString($context));
        }

        return $message.PHP_EOL;

    }

    private function getTimestamp(): string
    {
        $originalTime = microtime(true);
        $micro = sprintf("%06d", ($originalTime - floor($originalTime)) * 1000000);
        $date = new DateTime(date('Y-m-d H:i:s.'.$micro, $originalTime));

        return $date->format($this->options['dateFormat']);
    }

    /**
     * Takes the given context and coverts it to a string.
     *
     * @param array $context The Context
     * @return string
     */
    protected function contextToString(array $context): string
    {
        $export = '';
        foreach ($context as $key => $value) {
            $export .= "{$key}: ";
            $export .= preg_replace(array(
                '/=>\s+([a-zA-Z])/im',
                '/array\(\s+\)/im',
                '/^  |\G  /m'
            ), array(
                '=> $1',
                'array()',
                '    '
            ), str_replace('array (', 'array(', var_export($value, true)));
            $export .= PHP_EOL;
        }
        return str_replace(array('\\\\', '\\\''), array('\\', '\''), rtrim($export));
    }

    /**
     * Indents the given string with the given indent.
     *
     * @param  string $string The string to indent
     * @param  string $indent What to use as the indent.
     * @return string
     */
    protected function indent($string, $indent = '    ')
    {
        return $indent.str_replace("\n", "\n".$indent, $string);
    }
}