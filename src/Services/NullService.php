<?php

namespace KyleWLawrence\GridPane\Services;

use Illuminate\Support\Facades\Log;

class NullService
{
    /**
     * @var bool
     */
    private $logCalls;

    public function __construct(bool $logCalls = false)
    {
        $this->logCalls = $logCalls;
    }

    public function __call($name, $arguments)
    {
        if ($this->logCalls) {
            Log::debug('Called GridPane facade method: '.$name.' with:', $arguments);

            return new self;
        }

        return $this;
    }
}
