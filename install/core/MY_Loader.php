<?php

class MY_Loader extends CI_Loader
{
    public function __construct()
    {
        parent::__construct();
        $this->library("viewcomposer");
    }

    public function view($view, $data = array(), $return = false)
    {
        get_instance()->viewcomposer->load($view, $data);
        return parent::view($view, $data, $return);
    }
}
