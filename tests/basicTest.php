<?php

use \photon\config\Container as Conf;
use \photon\tests\session\sessionTestCase\SessionHighLevelTestCase;

class SessionMemcachedTest extends SessionHighLevelTestCase
{
    public function setup()
    {
        parent::setup();
        Conf::set('session_storage', '\photon\session\storage\Memcached');
    }
}
