<?php

namespace Source\Models;

use Source\Core\Model;

class Negotiation extends Model
{
    public function __construct()
    {
        parent::__construct("negotiations", ["id"], []);
    }
}