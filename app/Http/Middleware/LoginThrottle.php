<?php


namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ThrottleRequests;

class LoginThrottle extends ThrottleRequests
{
    protected function buildException($key, $maxAttempts)
    {
        $retryAfter = $this->getTimeUntilNextRetry($key);

        dd("Много попыток", gmdate("H:i:s", $retryAfter));
    }
}