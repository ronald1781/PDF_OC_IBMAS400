<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . "/third_party/PHPExcel.php";

class PhpExcel1 extends PHPExcel {

    public function __construct() {
        parent::__construct();
    }

}
