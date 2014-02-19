<?php
namespace Tracker\Utilities;

/**
 * post operations
 */
class Post
{
    public $post = null;

    /**
     * @return null
     */
    public function __construct()
    {
        $this->post = $_POST;
    }
}