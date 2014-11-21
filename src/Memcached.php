<?php

namespace photon\session\storage;
use \photon\db\Connection as DB;
use \photon\config\Container as Conf;

class Exception extends \Exception {}

class Memcached extends \photon\session\storage\Base
{
    public  $key = null;
    private $db = null;
    private $expire = null;    
    private $database = null;

    public function __construct()
    {
        $backendConfiguration = Conf::f('session_memcached', array());
        foreach ($backendConfiguration as $key => $value) {
            $this->$key = $value;
        }
        $this->expire = Conf::f('session_cookie_expire', null);

        if ($this->database === null) {
            throw new Exception('Configuration missing or invalid for Memcached Session Backend');
        }

        $this->db = DB::get($this->database);

    } 

    /**
     * Given a the request object, init itself.
     *
     * @required public function init($key, $request=null) 
     *
     * @param $key Session key
     * @param $request Request object (null)
     * @return Session key
     */
    public function init($key, $request=null) 
    {
        $this->key = $key;
    }

    public function load()
    {
        if (null === $this->key) {
            $this->data = array();
            return false;
        }

        $rc = $this->db->get($this->key);
        if ($rc === false) {
            $this->data = array();
            return false;
        }

        $this->data = $rc;
        return true;
    }

    /**
     * Check if a session key already exists in the storage.
     *
     * @param $key string
     * @return bool
     */
    public function keyExists($key)
    {
        $rc = $this->db->get($this->key);
        return ($rc !== false);
    }


    /**
     * Given the response object, save the data.
     *
     * The commit call must ensure that $this->key is set afterwards.
     *
     * @required public function commit($response=null) 
     */
    public function commit($response)
    {
        // Create the object to store
        if (null === $this->key) {
            $this->key = $this->getNewKey(json_encode($response->headers));
        }

        if ($this->expire !== null) {
            $this->db->set($this->key, $this->data, time() + $this->expire);
        } else {
            $this->db->set($this->key, $this->data);
        }

        return $this->key;
    }
}

