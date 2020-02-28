<?php 
    namespace core;
    use Symfony\Component\Yaml\Yaml;

    class i18n  {
        private string $lang;
        public function __construct(string $lang="zhTW") {
            $this->lang = $lang;
        }

        private function ymals():array {
            global $logger;
            if (!is_dir(ROOT.'/conf/i18n/'.$this->lang)){
                $logger->error(Erri18nNotExists, array("language"=>$this->lang));
                return array(null, Erri18nNotExists); 
            }

            $return = array();
            // get first layer files
            foreach(glob(ROOT.'/conf/i18n/'.$this->lang.'/*.yaml') as $filename){
                $return[] = ROOT.'/conf/i18n/'.$this->lang.'/'.$filename;
            }

            return array($reutrn, null);
        }

        /**
         * todo: here has few way to reduce load too much i18n related yaml file to slow down system
         * current version need to improve
         */
        public function Load():generalReturnStruct{
            global $logger;
            list($yamls, $err) = $this->ymals();
            if ($err != null){
                $logger->error($err, array("lang"=>$this->lang));
                return array(null, $err);
            }
            
            $lang = array();
            foreach($yamls as $yaml){
                $yamlContent = \file_get_contents($yaml);
                $tmp = Yaml::parse($yamlContent);
                $duplicateChk = false;
                foreach($tmp as $key=>$val){
                    if (\key_exists($key, $lang)){
                        $logger->error(ErrLangKeyDuplicate, array("lang"=>$this->lang, "key"=>$key));
                        $duplicateChk = true;
                    }
                }
                if ($duplicateChk===true) {
                    $result  = new generalReturnStruct(array(null, ErrLangKeyDuplicate));
                    return $result;
                }
                $lang = array_merge($lang, $tmp);
            }
            $result  = new generalReturnStruct(array($lang, null));
            return $result;
        }

    }