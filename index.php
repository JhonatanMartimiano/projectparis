<?php
ob_start();

require __DIR__ . "/vendor/autoload.php";

/**
 * BOOTSTRAP
 */

use CoffeeCode\Router\Router;
use Source\Core\Session;

$session = new Session();
$route = new Router(url(), ":");
$route->namespace("Source\App");

/**
 * WEB ROUTES
 */
$route->group(null);
$route->get("/", "Web:home");


/**
 * ADMIN ROUTES
 */
$route->namespace("Source\App\Admin");
$route->group("/admin");

//login
$route->get("/", "Login:root");
$route->get("/login", "Login:login");
$route->post("/login", "Login:login");
$route->get("/register", "Login:register");
$route->post("/register", "Login:register");
$route->get("/forget", "Web:forget");
$route->post("/forget", "Web:forget");
$route->get("/forget/{code}", "Web:reset");
$route->post("/forget/reset", "Web:reset");

//dash
$route->get("/dash", "Dash:dash");
$route->get("/dash/home", "Dash:home");
$route->post("/dash/home", "Dash:home");
$route->get("/logoff", "Dash:logoff");

//users
$route->get("/users/home", "Users:home");
$route->post("/users/home", "Users:home");
$route->get("/users/home/{search}/{page}", "Users:home");
$route->get("/users/user", "Users:user");
$route->post("/users/user", "Users:user");
$route->get("/users/user/{user_id}", "Users:user");
$route->post("/users/user/{user_id}", "Users:user");

//sellers
$route->get("/sellers/home", "Sellers:home");
$route->post("/sellers/home", "Sellers:home");
$route->get("/sellers/home/{search}/{page}", "Sellers:home");
$route->get("/sellers/seller", "Sellers:seller");
$route->post("/sellers/seller", "Sellers:seller");
$route->get("/sellers/seller/{seller_id}", "Sellers:seller");
$route->post("/sellers/seller/{seller_id}", "Sellers:seller");

//clients
$route->get("/clients/home", "Clients:home");
$route->post("/clients/home", "Clients:home");
$route->get("/clients/home/{search}/{page}", "Clients:home");
$route->get("/clients/client", "Clients:client");
$route->post("/clients/client", "Clients:client");
$route->get("/clients/client/{client_id}", "Clients:client");
$route->post("/clients/client/{client_id}", "Clients:client");

//general premises
$route->get("/funnels/home", "Funnels:home");
$route->post("/funnels/home", "Funnels:home");
$route->get("/funnels/home/{search}/{page}", "Funnels:home");
$route->get("/funnels/funnel", "Funnels:funnel");
$route->post("/funnels/funnel", "Funnels:funnel");
$route->get("/funnels/funnel/{funnel_id}", "Funnels:funnel");
$route->post("/funnels/funnel/{funnel_id}", "Funnels:funnel");
$route->get("/negotiations/home", "Negotiations:home");
$route->get("/negotiations/negotiation/{client_id}", "Negotiations:negotiation");
$route->post("/negotiations/negotiation/{client_id}", "Negotiations:negotiation");

//notification center
$route->post("/notifications/count", "Notifications:count");
$route->post("/notifications/list", "Notifications:list");

/**
 * ERROR ROUTES
 */
$route->group("/ops");
$route->get("/{errcode}", "Web:error");

/**
 * ROUTE
 */
$route->dispatch();

/**
 * ERROR REDIRECT
 */
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();