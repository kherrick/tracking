<?php
namespace Tracker\Utilities;

/**
 * post operations
 */
class Post
{
    private $settings = null;
    private $path     = '/../../../config/settings.ini';

    public $config    = null;
    public $post      = null;

    /**
     * @return null
     */
    public function __construct()
    {
        $this->settings = __DIR__ . $this->path;
        $this->config   = $this->loadConfig();
        $this->post     = $_POST;
    }

    /**
     * load the post configuration file
     *
     * @return array
     */
    private function loadConfig()
    {
        return parse_ini_file($this->settings, true);
    }
}