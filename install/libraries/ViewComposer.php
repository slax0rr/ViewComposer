<?php
if (!defined("BASEPATH")) exit("No direct script access allowed");

class ViewComposer
{
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

    public function __construct()
    {
        // load the config
        $this->config->load("viewcomposer", true);
        $this->_config = $this->config->item("viewcomposer");

        $this->_composers = $this->_config["composers"];
    }

    public function loadComposer($view, $data)
    {
        if (isset($this->_composers[$view]) === true) {
            
        } else {
            return false;
        }
    }
}
