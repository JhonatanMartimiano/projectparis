<?php

namespace Source\Models;

use Source\Core\Model;

class Funnel extends Model
{
    public function __construct()
    {
        parent::__construct("funnels", ["id"], ["title", "sequence"]);
    }

    public function funnelClients()
    {
        $find = (new Client())->find("funnel_id = :fid", "fid={$this->id}");
        return $find->fetch(true);
    }
}