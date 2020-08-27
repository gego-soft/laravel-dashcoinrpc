<?php

if (! function_exists('dashcoind')) {
    /**
     * Get dashcoind client instance.
     *
     * @return \Gegosoft\Dashcoin\Client
     */
    function dashcoind()
    {
        return app('dashcoind');
    }
}
