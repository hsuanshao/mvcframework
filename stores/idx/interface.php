<?php 
    namespace idx;

    interface IndexInterface{
        public function banners();

        public function addBanner(string $title, string $desc, string $filepath);
    }