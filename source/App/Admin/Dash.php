<?php

namespace Source\App\Admin;

use Source\Core\Connect;
use Source\Models\Auth;
use Source\Models\Client;
use Source\Models\Customers;
use Source\Models\Negotiation;
use Source\Models\Seller;
use Source\Models\User;

/**
 * Class Dash
 * @package Source\App\Admin
 */
class Dash extends Admin
{
    /**
     * Dash constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    public function dash(): void
    {
        redirect("/admin/dash/home");
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function home(?array $data): void
    {
        $clients = (new Client())->find()->fetch(true);

        if ($clients) {
            foreach ($clients as $client) {
                if ((new Negotiation())->find("client_id = :cid", "cid={$client->id}")->count()) {
                    $count = (new Negotiation())->find("client_id = :cid", "cid={$client->id}")->count() - 1;
                    $lastNegotiations[] = (new Negotiation())->find("client_id = :cid",
                        "cid={$client->id}")->fetch(true)[$count];
                }
            }

            for ($i = 0; $i < count($lastNegotiations); $i++) {
                if (date_diff_panel($lastNegotiations[$i]->next_contact) < -1) {
                    $post24hour[] = $lastNegotiations[$i];
                }
            }

            for ($i = 0; $i < count($lastNegotiations); $i++) {
                if (date_diff_panel($lastNegotiations[$i]->next_contact) >= 0) {
                    if ($lastNegotiations[$i]->infoClient()->status != "Concluído" && $lastNegotiations[$i]->infoClient()->reason_loss == "") {
                        $inNegotiations[] = $lastNegotiations[$i];
                    }
                }
            }
        }

        $firstStep = 1;
        $secondStep = 2;
        $thirdStep = 3;

        $seller_id = (\user()->level >= 5) ? "" : \user()->seller_id;

        $test = Connect::getInstance()->query("SELECT C.name as cliente, V.first_name as vendedor,

(SELECT N2.id FROM negotiations as N2 WHERE N2.client_id = N.client_id ORDER BY N2.id DESC LIMIT 1) as id_neg,

(SELECT N2.contact_type FROM negotiations as N2 WHERE N2.funnel_id = 1 AND N2.client_id = N.client_id) as etapa1,
(SELECT N2.updated_at FROM negotiations as N2 WHERE N2.funnel_id = 1 AND N2.client_id = N.client_id) as data1,
(SELECT N2.description FROM negotiations as N2 WHERE N2.funnel_id = 1 AND N2.client_id = N.client_id) as obs1,

(SELECT N2.contact_type FROM negotiations as N2 WHERE N2.funnel_id = 2 AND N2.client_id = N.client_id) as etapa2,
(SELECT N2.updated_at FROM negotiations as N2 WHERE N2.funnel_id = 2 AND N2.client_id = N.client_id) as data2,
(SELECT N2.description FROM negotiations as N2 WHERE N2.funnel_id = 2 AND N2.client_id = N.client_id) as obs2,

(SELECT N2.contact_type FROM negotiations as N2 WHERE N2.funnel_id = 3 AND N2.client_id = N.client_id) as etapa3,
(SELECT N2.updated_at FROM negotiations as N2 WHERE N2.funnel_id = 3 AND N2.client_id = N.client_id) as data3,
(SELECT N2.description FROM negotiations as N2 WHERE N2.funnel_id = 3 AND N2.client_id = N.client_id) as obs3


FROM negotiations as N INNER JOIN clients as C 
ON N.client_id = C.id INNER JOIN sellers as V
ON N.seller_id = V.id
WHERE 1=1
GROUP BY N.client_id")->fetchAll();

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Dashboard",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/dash/home", [
            "app" => "dash",
            "head" => $head,
            "post24hour" => ($post24hour) ? count($post24hour) : "0",
            "completedOrders" => (new Client())->find("status = 'Concluído'")->count(),
            "waiting" => (new Negotiation())->find("contact_type = 'APagamento' OR contact_type = 'NRespondeu'")->count(),
            "inNegotiations" => ($inNegotiations) ? count($inNegotiations) : "0",
            "allNegotiations" => $test,
            "negotiation" => (new Negotiation())
        ]);
    }

    /**
     *
     */
    public function logoff(): void
    {
        $this->message->success("Você saiu com sucesso {$this->user->first_name}.")->flash();

        Auth::logout();
        redirect("/admin/login");
    }
}