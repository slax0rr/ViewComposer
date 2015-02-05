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
        get_instance()->viewcomposer->load($view, $data, $this->_ci_cached_vars);
        return parent::view($view, $data, $return);
    }
}
