<?php

namespace Source\App\Admin;

use Source\Models\Client;
use Source\Models\Funnel;
use Source\Models\Negotiation;

/**
 * Class Admin
 * @package Source\App\Admin
 */
class Negotiations extends Admin
{
    /**
     * Negotiations Constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array|null $data
     */
    public function home(?array $data): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Negociações",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/negotiations/home", [
            "app" => "negotiations/home",
            "head" => $head,
            "funnels" => (new Funnel())->find()->fetch(true)
        ]);
    }

    /**
     * @param array|null $data
     */
    public function negotiation(?array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        $client = (new Client())->findById($data["client_id"]);

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Nova Negociação",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/negotiations/negotiation", [
            "app" => "clients/home",
            "head" => $head,
            "client" => $client,
            "funnels" => (new Funnel())->find()->fetch(true),
            "funnelSelected" => $client->funnel_id

        ]);
    }
}