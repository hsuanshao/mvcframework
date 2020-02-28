<?php
    namespace core;

    class slack {
        private $channels;
        public function __construct(){
            $this->channels = slackCHANNELS;
        }
        
        // Send to Slack message to #kh_new_requirement
        public function Send($message, ?string $channel=null) {
            global $logger;
            if (ENV !== "prod"){
                // todo: I think here has better way to process
                // error not at production env
                var_dump($message);
                return true;
            }

            $data = array('text' => $message,'mrkdwn'=>true);
            $data_string = json_encode($data);
            $url = $this->channels[$channel];
    
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
            );
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }
    }