<?php

//$title = "Ce texte est importé";

require_once __DIR__ . '/../vendor/autoload.php';

use Ferdydurke\ClassicModels\Entity\ProductLine;
use Ferdydurke\ClassicModels\Entity\Product;
use Ferdydurke\ClassicModels\Entity\Customer;
use Ferdydurke\ClassicModels\DBAL\Connector;

$p =  new Product();

$connection = new Connector();
$ppl1 = new ProductLine($connection->dbh);

$c = new Customer($connection->dbh);
$orders = $c->query(Customer::CUSTOMER_ORDERS, ['customer' => 363]);


$title =  $ppl1->productLine;
$lines = $ppl1->getProductLines();
require_once __DIR__ . '/../templates/base.html.php';
