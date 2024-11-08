<?php

/* Exemple de requête HTTP
 *
 * http://localhost/classicModels/public/customerOrders.php?id=363
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Ferdydurke\ClassicModels\Entity\Customer;
use Ferdydurke\ClassicModels\DBAL\Connector;

/*
 * Création du connecteur MySQL
 */
$connection = new Connector();

/*
 * Création d'un objet Customer,
 * qui sera chargé de communiquer avec la base de données
 * C'est pourquoi on lui indique le connecteur à utiliser.
 */
$customer = new Customer($connection->dbh);

/*
 * Exécution de la requête SQL
 * CUSTOMER_ORDERS est une constante définie dans la classe Customer
 * 'id' est un des paramètres de la chaîne de requête HTTP GET,
 * stockée dans la variable super-globale $_GET
 */
$orders = $customer->query(
        Customer::CUSTOMER_ORDERS, 
        ['customer' => $_GET['id']]
);

/*
 * Affichage des résultats
 */
require_once __DIR__ . '/../templates/orders.html.php';
