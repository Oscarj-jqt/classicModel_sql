<?php

namespace Ferdydurke\ClassicModels\Entity;

class ProductLine
{

    private \PDO $connector;

    public string $productLine = "Hello";

    public function __construct(\PDO $connector)
    {
        $this->connector = $connector;
    }
    public function f(int $y): int
    {
         return $x;
    }

    public function getProductLines(): array
    {
        $sql = "SELECT * FROM productlines";
        $statement = $this->connector->prepare($sql);
        $result = $statement->execute([]);

        return $statement->fetchAll();
    }
}
