<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we update votes in the database.
$votes = getVotes($pdo);
