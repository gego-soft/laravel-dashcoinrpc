<?php

namespace Gegosoft\Dashcoin\Traits;

trait Dashcoind
{
    public function dashcoind()
    {
        return app('dashcoind');
    }
}
