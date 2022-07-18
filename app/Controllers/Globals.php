<?php

namespace App\Controllers;

/**
 * author: https://beamtic.com/avoid-superglobals-oop-php
 */
class Globals extends Controller
{
    private $_SERVER;
    private $_POST;
    private $_GET;
    private $_SESSION;

    public function __construct()
    {
        $this->defineSuperglobals();
    }

    //ajouter suppress warning

    /**
     * Returns a key from the superglobal,
     * as it was at the time of instantiation.
     *
     * @param $key
     * @return mixed
     */
    public function getServerData($key = null)
    {
        if (null !== $key) {
            return (isset($this->_SERVER["$key"])) ? $this->_SERVER["$key"] : null;
        } else {
            return $this->_SERVER;
        }
    }
    /**
     * Returns a key from the superglobal,
     * as it was at the time of instantiation.
     *
     * @param $key
     * @return mixed
     */
    public function getPostData($key = null)
    {
        if (null !== $key) {
            return (isset($this->_POST["$key"])) ? $this->_POST["$key"] : null;
        } else {
            return $this->_POST;
        }
    }

    /**
     * Returns a key from the superglobal,
     * as it was at the time of instantiation.
     *
     * @param $key
     * @return mixed
     */
    public function getGetData($key = null)
    {
        if (null !== $key) {
            return (isset($this->_GET["$key"])) ? $this->_GET["$key"] : null;
        } else {
            return $this->_GET;
        }
    }

    /**
     * Returns a key from the superglobal,
     * as it was at the time of instantiation.
     *
     * @param $key
     * @return mixed
     */
    public function getSessionData($key = null)
    {
        if (null !== $key) {
            return (isset($this->_SESSION["$key"])) ? $this->_SESSION["$key"] : null;
        } else {
            return $this->_SESSION;
        }
    }

    public function putSessionData($key, $value)
    {
        $this->_SESSION[$key][]= $value;
    }

    /**
     * Function to define superglobals for use locally.
     * We do not automatically unset the superglobals after
     * defining them, since they might be used by other code.
     *
     * @return mixed
     */
    private function defineSuperglobals()
    {

        // Store a local copy of the PHP superglobals
        // This should avoid dealing with the global scope directly
        // $this->_SERVER = $_SERVER;
        $this->_SERVER = (isset($_SERVER)) ? $_SERVER : null;
        $this->_POST = (isset($_POST)) ?  $this->sanitize($_POST) : null;
        $this->_GET = (isset($_GET)) ?  $this->sanitize($_GET) : null;
        // ajouter référence
        $this->_SESSION = (isset($_SESSION)) ? $_SESSION : null; 

    }
    /**
     * You may call this function from your compositioning root,
     * if you are sure superglobals will not be needed by
     * dependencies or outside of your own code.
     *
     * @return void
     */
    public function unsetSuperglobals()
    {
        unset($_SERVER);
        unset($_POST);
        unset($_GET);
        unset($_SESSION);
    }

}