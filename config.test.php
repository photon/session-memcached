<?php

return array(
    // Create a list of DB available
    'databases' => array(
        'session-db' => array(
            'engine' => '\photon\db\Memcached',
            'host' => array('localhost:11211'),
            'id' => 'myapp',
        ),
    ),

    // Configure the session backend
    'session_memcached' => array(
        'database' => 'session-db',
    ),
);
