<?php   
    namespace core;

    class Layout {
        private $logger;
        public function __construct(){
            global $logger;
            $this->logger = $logger;
        }

        public function View(string $viewFileName, array $inputData):string{
            \ob_start("sanitize_output");
            \extract($inputData);
            include VIEW.$viewFileName;
            $buffer = \ob_get_contents();
            \ob_end_clean();
            return $buffer;
        }
    }