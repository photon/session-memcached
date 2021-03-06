session-memcached
=================

[![Build Status](https://travis-ci.org/photon/session-memcached.svg?branch=master)](https://travis-ci.org/photon/session-memcached)

Memcached backend for session storage


Quick start
-----------

1) Add the module in your project

    composer require "photon/session-memcached:dev-master"

or for a specific version

    composer require "photon/session-memcached:1.0.0"

2) Define a MongoDB connection in your project configuration

    'databases' => array(
        'session-db' => array(
            'engine' => '\photon\db\Memcached',
            'host' => array('localhost:11211'),
            'id' => 'myapp',
        ),
    ),

3) Define the session storage backend in your project configuration, and some others session parameters

    'session_storage' => '\photon\session\storage\Memcached',
    'session_cookie_domain' => 'www.example.com',
    'session_cookie_path' => '/',
    'session_timeout' => 4 * 3600,

4) Define the configuration of the MongoDB Session module in your project configuration

    'session_memcached' => array(
        'database' => 'session-db',
    ),

5) Enjoy !

