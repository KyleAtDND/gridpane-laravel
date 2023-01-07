<?php

namespace KyleAtDND\GridPane\Services;

use Config, InvalidArgumentException, BadMethodCallException;
use GridPane\API\HttpClient;

class GridPaneService {

    /**
     * Get auth parameters from config, fail if any are missing.
     * Instantiate API client and set auth token.
     *
     * @throws Exception
     */
    public function __construct() {
        $this->token = config('gridpane-laravel.token');
        if(!$this->token) {
            throw new InvalidArgumentException('Please set GP_TOKEN environment variables.');
        }
        $this->client = new HttpClient();
        $this->client->withToken($this->token);
    }

    /**
     * Pass any method calls onto $this->client
     *
     * @return mixed
     */
    public function __call($method, $args) {
        if(is_callable([$this->client,$method])) {
            return call_user_func_array([$this->client,$method],$args);
        } else {
            throw new BadMethodCallException("Method $method does not exist");
        }
    }

    /**
     * Pass any property calls onto $this->client
     *
     * @return mixed
     */
    public function __get($property) {
        if(property_exists($this->client,$property)) {
            return $this->client->{$property};
        } else {
            throw new BadMethodCallException("Property $property does not exist");
        }
    }

}
