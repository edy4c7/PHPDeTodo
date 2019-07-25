<?php
class PostParser
{
   private $request;

   function __construct()
   {
        $content_type = explode(';', trim(strtolower($_SERVER['CONTENT_TYPE'])))[0];
        if (strpos($content_type, 'json')) {
            $this->request = json_decode(file_get_contents('php://input'), true);
        }
        else {
            $this->request = $_REQUEST;
        }
   }

   public function getValue(string $key) {
       return $this->request[$key];
   }
}
