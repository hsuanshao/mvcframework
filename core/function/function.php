<?php 
    function getUserIP()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } else if (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } else if (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } else if (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }
    
        return $ipaddress;
    }

    function substrUTF8($string, $start, $length)
    {
        $chars = $string;
        $i = 0;
        do {
            if (preg_match("/[0-9a-zA-Z]/", $chars[$i])) {
                //纯英文
                ++$m;
            } else {
                //非英文
                ++$n;
            }
            $k = $n / 3 + $m / 2;
            $l = $n / 3 + $m;
            ++$i;
        } while ($k < $length);
        $str1 = mb_substr($string, $start, $l, 'utf-8'); 
        return $str1;
    }

    function TimeToMs($datetime=false){
        if ($datetime == false){
            return round(microtime(true) * 1000);
        } 
    
        return strtotime($datetime)*1000;
    }
    
    
    function MsToTime($ms){
        $seconds = $ms / 1000;
        return date("Y-m-d H:i:s", $seconds);
    }

    function sanitize_output($buffer) {
        $search = array(
            '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
            '/[^\S ]+\</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );
    
        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );
    
        $buffer = preg_replace($search, $replace, $buffer);
    
        return $buffer;
    }