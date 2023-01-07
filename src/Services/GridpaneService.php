<?php

namespace KyleAtDND\Gridpane\Services;

use BadMethodCallException;
use Config;
use Gridpane\Api\HttpClient;
use InvalidArgumentException;

class GridpaneService
{
    /**
     * Get auth parameters from config, fail if any are missing.
     * Instantiate API client and set auth bearer token.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->bearer = config('gridpane-laravel.bearer');
        if (! $this->bearer) {
            throw new InvalidArgumentException('Please set GP_BEARER environment variables.');
        }
        $this->client = new HttpClient();
        $this->client->setAuth('bearer', ['bearer' => $this->bearer]);
    }

    /**
     * Pass any method calls onto $this->client
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        if (is_callable([$this->client, $method])) {
            return call_user_func_array([$this->client, $method], $args);
        } else {
            throw new BadMethodCallException("Method $method does not exist");
        }
    }

    /**
     * Pass any property calls onto $this->client
     *
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this->client, $property)) {
            return $this->client->{$property};
        } else {
            throw new BadMethodCallException("Property $property does not exist");
        }
    }
}
