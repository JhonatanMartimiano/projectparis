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
            ["name","city", "state", "phone", "seller_id", "funnel_id", "contact_date"]);
    }

    /**
     * @return array|mixed|Model|null
     */
    public function sellerName(): string
    {
        $find = (new Seller())->findById($this->seller_id);
        return $find->name;
    }
}