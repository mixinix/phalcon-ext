<?php

namespace Sb\Phalcon\Service;

use \Phalcon\DiInterface as Di;
use Sb\Phalcon\Service\Assets\Assets;

class AssetsService
{
    const SERVICE_NAME = 'assets';

    public static function init(Di $di)
    {
        $di->setShared(self::SERVICE_NAME, function() {
            return new Assets;
        });
    }
}
