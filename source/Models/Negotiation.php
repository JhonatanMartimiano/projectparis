<?php

namespace Source\Models;

use Source\Core\Model;

class Negotiation extends Model
{
    public function __construct()
    {
        parent::__construct("negotiations", ["id"], [
            "client_id",
            "seller_id",
            "met_us",
            "branch",
            "contact_type",
            "next_contact",
            "funnel_id",
            "description"
        ]);
    }
}