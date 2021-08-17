<?php

namespace Source\App\Admin;

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

        if (\user()->level >= 5) {
            for ($x = 0; $x < count($lastNegotiations); $x++) {
                if ($lastNegotiations[$x]->status == "Negociação") {
                    $totalNegotiation[] = $lastNegotiations[$x];
                }
            }
        } else {
            for ($x = 0; $x < count($lastNegotiations); $x++) {
                if ($lastNegotiations[$x]->status == "Negociação" && $lastNegotiations[$x]->seller_id == \user()->seller_id) {
                    $totalNegotiation[] = $lastNegotiations[$x];
                }
            }
        }

        if (\user()->level >= 5) {
            for ($i = 0; $i < count($lastNegotiations); $i++) {
                if (date_diff_panel($lastNegotiations[$i]->next_contact) <= -3) {
                    $totalInDelay[] = $lastNegotiations[$i];
                }
            }
        } else {
            for ($i = 0; $i < count($lastNegotiations); $i++) {
                if (date_diff_panel($lastNegotiations[$i]->next_contact) <= -3 && $lastNegotiations[$x]->seller_id == \user()->seller_id) {
                    $totalInDelay[] = $lastNegotiations[$i];
                }
            }
        }

        $firstStep = 1;
        $secondStep = 2;
        $thirdStep = 3;

        $seller_id = (\user()->level >= 5) ? "" : \user()->seller_id;

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
            "clientFirstStep" => (\user()->level >= 5) ? (new Client())->find("funnel_id = :fid","fid={$firstStep}")->count() : (new Client())->find("seller_id = :sid AND funnel_id = :fid", "sid={$seller_id}&fid={$firstStep}")->count(),
            "clientSecondStep" => (\user()->level >= 5) ? (new Client())->find("funnel_id = :fid","fid={$secondStep}")->count() : (new Client())->find("seller_id = :sid AND funnel_id = :fid", "sid={$seller_id}&fid={$secondStep}")->count(),
            "clientThirdStep" => (\user()->level >= 5) ? (new Client())->find("funnel_id = :fid","fid={$thirdStep}")->count() : (new Client())->find("seller_id = :sid AND funnel_id = :fid", "sid={$seller_id}&fid={$thirdStep}")->count(),
            "totalClients" => (\user()->level >= 5) ? (new Client())->find()->count() : (new Client())->find("seller_id = :sid", "sid={$seller_id}")->count(),
            "totalSellers" => (new Seller())->find()->count(),
            "totalInNegotiations" => count($totalNegotiation),
            "totalInDelay" => ($totalInDelay) ? count($totalInDelay) : "0"
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