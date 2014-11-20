<?php
if (!defined("BASEPATH")) exit("No direct script access allowed");

class Viewcomposer
{
    /**
     * View data
     *
     * @var array
     */
    public $viewData = array();
    /**
     * Config
     *
     * @var array
     */
    protected $_config = array();
    /**
     * View composers
     *
     * @var array
     */
    protected $_composers = array();
    /**
     * Loaded composer classes
     *
     * @var array
     */
    protected $_loaded = array();

    public function __construct()
    {
        // load the config
        $this->config->load("viewcomposer", true);
        $this->_config = $this->config->item("viewcomposer");

        $this->_composers = $this->_config["composers"];

        log_message("debug", "ViewComposer library loaded");
    }

    public function __get($param)
    {
        return get_instance()->$param;
    }

    public function load($view, &$data)
    {
        $regex = "~\\{(.*?)\\}~"; 
        foreach ($this->_composers as $key => $composer) {
            preg_match_all($regex, $key, $matches);
            foreach ($matches[1] as $match) {
                $key = str_replace("{{$match}}", get_instance()->{$match}, $key);
            }
            if ($key === $view) {
                require_once(APPPATH . "composer/{$composer}_composer.php");
                if (isset($this->_loaded[$composer]) === true) {
                    $obj = $this->_loaded[$composer];
                } else {
                    $composer .= "_composer";
                    $obj = new $composer;
                    $this->_loaded[$composer] = $obj;
                }
                $obj->viewData = $data;
                $obj->compose();
                $data = $obj->viewData;
                return true;
            }
        }
        return false;
    }
}
