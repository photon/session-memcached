<?php

use \photon\config\Container as Conf;
use \photon\tests\sessionTest\SessionHighLevelTestCase;

class SessionMemcachedTest extends SessionHighLevelTestCase
{
    public function setup()
    {
        parent::setup();
        Conf::set('session_storage', '\photon\session\storage\Memcached');
    }
}
