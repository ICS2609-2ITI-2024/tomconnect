<?php

declare(strict_types=1);

namespace Tomconnect\Models;

class Model extends Database 
{
    public function model_connect()
    {
        return parent::connect();
    }
}