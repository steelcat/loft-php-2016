<?php
namespace App;

class Controller
{
    protected static $response;

    public function __construct($response)
    {
        self::$response = $response;
        $this->init();
    }

    public function init()
    {
        $actionName = self::$response['actionName'];
        if (method_exists(get_class($this), 'action' . $actionName)) {
            $this->{'action' . $actionName}();
        } else {
            $this->action404();
        }
    }

    public function action404()
    {
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        View::show('404');
    }
}
