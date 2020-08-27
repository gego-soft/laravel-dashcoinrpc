<?php

namespace Gegosoft\Dashcoin\Exceptions;

use RuntimeException;

class DashcoindException extends RuntimeException
{
    /**
     * Construct new dashcoin exception.
     *
     * @param object $error
     *
     * @return void
     */
    public function __construct($error)
    {
        parent::__construct($error['message'], $error['code']);
    }
}
