<html>
    <head>
    </head>
    <body>
        <header>
        <h1>Commandes de  :<?= $orders[0]['customerName'] ?></h1>
        <article>
            <p><?= "{$orders[0]['contactFirstName']} {$orders[0]['contactLastName']}" ?></p>
            <p><?= "{$orders[0]['country']}" ?></p>
        </article>        
        <main>
            <h2>Liste des commandes</h2>
            <ul>
                <?php foreach ($orders as $line) : ?>
                <li>
                    <?= "{$line['orderNumber']} : {$line['amount']}"; ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </main>
        </header>
    </body>
</html>
