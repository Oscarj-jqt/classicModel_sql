<?php

namespace Ferdydurke\ClassicModels\Entity;

class Customer
{

    /*
     * La requête SQL sous forme de constante PHP.
     * Les requêtes peuvent être ainsi extraites du code lui-même.
     * On obtient ainsiu un meilleur découplage du code et des données.
     */    
    const CUSTOMER_ORDERS = "
                SELECT C.customerNumber, C.customerName, C.contactFirstName, C.contactLastName, C.country, O.orderNumber, TRUNCATE(SUM(OD.quantityOrdered * OD.priceEach),2) AS amount
                FROM customers AS C
                NATURAL JOIN orders AS O
                NATURAL JOIN orderdetails AS OD
                WHERE C.customerNumber = :customer
                GROUP BY O.orderNumber
            ";

    /*
     * @var PDO $connector Le connecteur à la base de données MySQL
     */
    private \PDO $connector;

    /*
     * @var string $productLine Une propriété absolument inutile :o)
     */
    public string $productLine = "Hello";

    /**
     * Le cosntructeur de la classe Customer.
     * On lui passe en paramètre l'objet qui permet la connextion à MySQL.
     *
     * @param PDO $connector Le connecteur
     */
    public function __construct(\PDO $connector)
    {
        $this->connector = $connector;
    }

    /**
     * Requête sur la base de données pour récupérer
     * la liste des commandes d'un client particulier
     * Première version de la requête (naïve)
     *
     * @param string|int $customer Le numéro de client à consulter
     *
     * @return array La liste des commandes
     */
    public function getCustomerOrders(string|int $customer): array
    {
        $sql = "
                SELECT C.customerNumber, C.customerName, C.contactFirstName, C.contactLastName, C.country, O.orderNumber, TRUNCATE(SUM(OD.quantityOrdered * OD.priceEach),2) AS amount
                FROM customers AS C
                NATURAL JOIN orders AS O
                NATURAL JOIN orderdetails AS OD
                WHERE C.customerNumber = :customer
                GROUP BY O.orderNumber
            ";

        $statement = $this->connector->prepare($sql);
        $result = $statement->execute(['customer' => $customer]);

        return $statement->fetchAll();
    }

    /**
     * Requête sur la base de données pour récupérer
     * la liste des commandes d'un client particulier
     * Seconde version (optimisée)
     * On dispose maintenant d'une méthode générique,
     * capable d'exdécuter n'importe quelle requête PDO.
     * La variable $request fait référence aux constantes définies dans la classe
     * La méthode nécessite aussi les paramètres injectés dans la requête préparée PDO, le cas échéant.
     *
     * @param string $request Le texte de la requête SQL au format PDO
     * @param array $parameters La liste des paramètres attendus par la requête PDO 
     *
     * @return array
     *
     * @see /public/customerOrder.php:20
     */
    public function query(string $request, array $parameters): array
    {
        /*
         * Préparation de la requête
         * Construction d'un modèle incluant des variables PDO
         * destinées à empêcher les injections SQL
         */
        $statement = $this->connector->prepare($request);

        /*
         * Exécution de la requête
         * On passe les valeurs associées aux variables PDO
         * Pour un exemple cf. le script customerOrders.php
         */
        $result = $statement->execute($parameters);

        /*
         * fetchAll renvoie les résultats de la requête
         * au programme appelant.
         */
        return $statement->fetchAll();

    }
}



