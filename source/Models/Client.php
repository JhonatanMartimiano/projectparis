<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * FSPHP | Class User Active Record Pattern
 *
 * @author Robson V. Leite <cursos@upinside.com.br>
 * @package Source\Models
 */
class Client extends Model
{
    /**
     * Client constructor.
     */
    public function __construct()
    {
        parent::__construct("clients", ["id"],
            ["name","city", "state", "phone", "seller_id", "funnel_id", "registration_date"]);
    }

    /**
     * @return array|mixed|Model|null
     */
    public function sellerName(): string
    {
        $find = (new Seller())->findById($this->seller_id);
        return "{$find->first_name} {$find->last_name}";
    }

    public function stepTitle()
    {
        return (new Funnel())->findById($this->funnel_id);
    }

    public function lastNegotiationInfo()
    {
        $find = (new Negotiation())->find("client_id = :cid", "cid={$this->id}");
        $count = $find->count() - 1;
        return $find->fetch(true)[$count];
    }
}