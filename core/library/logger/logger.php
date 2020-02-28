<?php 
    namespace Psr\Log;
    use file\File as cloud;
    use slack\slack as slack;
    use Google\Cloud\Storage\StorageClient;

    class Logger implements LoggerInterface {
        /**
         * System is unusable.
         *
         * @param string $message
         * @param array  $context
         *
         * @return void
         */
        public function emergency($message, array $context = array())
        {
            $this->log(LogLevel::EMERGENCY, $message, $context);
        }
        /**
         * Action must be taken immediately.
         *
         * Example: Entire website down, database unavailable, etc. This should
         * trigger the SMS alerts and wake you up.
         *
         * @param string $message
         * @param array  $context
         *
         * @return void
         */
        public function alert($message, array $context = array())
        {
            $this->log(LogLevel::ALERT, $message, $context);
        }
        /**
         * Critical conditions.
         *
         * Example: Application component unavailable, unexpected exception.
         *
         * @param string $message
         * @param array  $context
         *
         * @return void
         */
        public function critical($message, array $context = array())
        {
            $this->log(LogLevel::CRITICAL, $message, $context);
        }
        /**
         * Runtime errors that do not require immediate action but should typically
         * be logged and monitored.
         *
         * @param string $message
         * @param array  $context
         *
         * @return void
         */
        public function error($message, array $context = array())
        {
            $this->log(LogLevel::ERROR, $message, $context);
        }
        /**
         * Exceptional occurrences that are not errors.
         *
         * Example: Use of deprecated APIs, poor use of an API, undesirable things
         * that are not necessarily wrong.
         *
         * @param string $message
         * @param array  $context
         *
         * @return void
         */
        public function warning($message, array $context = array())
        {
            $this->log(LogLevel::WARNING, $message, $context);
        }
        /**
         * Normal but significant events.
         *
         * @param string $message
         * @param array  $context
         *
         * @return void
         */
        public function notice($message, array $context = array())
        {
            $this->log(LogLevel::NOTICE, $message, $context);
        }
        /**
         * Interesting events.
         *
         * Example: User logs in, SQL logs.
         *
         * @param string $message
         * @param array  $context
         *
         * @return void
         */
        public function info($message, array $context = array())
        {
            $this->log(LogLevel::INFO, $message, $context);
        }
        /**
         * Detailed debug information.
         *
         * @param string $message
         * @param array  $context
         *
         * @return void
         */
        public function debug($message, array $context = array())
        {
            $this->log(LogLevel::DEBUG, $message, $context);
        }

        /**
         * log every log into file and send msg while it is emergency or alert 
         * 
         * log text format
         * [date time] [time millionsecond] [level] [message] context array
         */
        public function log($level, $message, array $context = array()){
            $currentDate = date("Y-m-d H:i:s");
            $currentMs   = TimeToMs();
            $jsonContext = json_encode($context);

            $logText = " *$level* from: ".HOST."\n`[ $currentDate -ms:$currentMs ] $message` \n```".$jsonContext."```\n\n";

            if ($level !== "info"){
                throw new \Exception("log level:".$level.", message:".$logText);
            }
            
            $result = $this->logToFile($level, $logText);
            if ($level ==LogLevel::EMERGENCY || $level == LogLevel::ERROR || $level == LogLevel::WARNING || $level == LogLevel::ALERT){
                $this->sendMsg($logText);
            }
        }
        
        private function logToFile($level, $message){
            $path = $_SERVER['DOCUMENT_ROOT']."/../../systemlogs";
            $fullpath = $path."/".date("Y")."/".date("m")."/".date("d")."/";
            if (!is_dir($fullpath)){
                @mkdir($fullpath, 0777, true);
            }
            
            $myfile = fopen($fullpath."/".$level.".log", "a") or die("Unable to open file!");
            fwrite($myfile, $message);
            fclose($myfile);
        }

        private function uploadLogToGCP(){
            $storage = new StorageClient(["projectId"=>GPROJECTID, "keyFilePath"=>GKEY]);
            $bucket = $storage->bucket(GCPBUCKETNAME);
            try {
                $object = $bucket->upload(fopen($this->source, 'r'), ['name'=>$this->prefix]);
                $this->removeLocalFile();
            } catch (\GuzzleHttp\Exception\GuzzleException $e){
                var_dump($e);
                return false;
            }
        }

        private function sendMsg($msg){
            $slack = new slack;
            $slack->Send($msg, "systemlogger");
        }
    }
    