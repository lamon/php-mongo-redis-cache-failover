<?php

namespace AppBundle\Service;

use Predis;

/**
 * Here you have to implement a CacheService with the operations below.
 * It should contain a failover, which means that if you cannot retrieve
 * data you have to hit the Database.
 **/
class CacheService
{
    protected $client;

    public function __construct($host, $port, $prefix)
    {
        $client = new Predis\Client([
            'host'   => $host,
            'port'   => $port,
            'prefix' => $prefix
        ]);

        $this->setClient($client);
    }

    protected function setClient(Predis\Client $client)
    {
        $this->client = $client;
    }

    protected function getClient()
    {
        return $this->client;
    }

    public function get($key)
    {
        if (!$key) {
            return null;
        }

        return $this->getClient()->get($key);
    }

    public function set($key, $value)
    {

        if (!$key || !$value) {
            return null;
        }

        return $this->getClient()->set($key, $value);
    }

    public function del($key)
    {
        if (!$key) {
            return null;
        }

        return $this->getClient()->del($key);
    }

    public function isOnline()
    {
        try {
            $this->getClient()->ping();
        } catch (Predis\Connection\ConnectionException $e) {
            return false;
        }

        return true;
    }

}
