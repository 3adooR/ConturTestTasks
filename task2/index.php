<?php

use Task2\Enum\StatusEnum;
use Task2\Repositories\CounterRepository;
use Task2\Services\Db\JsonDb;

$start = microtime( true );
$dbConnector = new JsonDb();
$firstRepository = new CounterRepository($dbConnector, '1');
$secondRepository = new CounterRepository($dbConnector, '2');

$needToUpdate = $firstRepository->getAllWithStatus(StatusEnum::NEED_TO_UPDATE);
if (empty($needToUpdate->list)) {
    exit('Nothing to update'.PHP_EOL);
}

$needToUpdateIndexes = $needToUpdate->indexes();
$founded = $secondRepository->findAllWithIndexes($needToUpdateIndexes);
if (empty($founded->list)) {
    exit('Nothing found'.PHP_EOL);
}

$cases = [];
foreach ($needToUpdate->list as $item) {
    $newCounterValue = $item->counter + $founded->list[$item->id]?->counter;
    $cases[] = sprintf("WHEN id = %d THEN %d", $item->id, $newCounterValue);
}

$query = sprintf(
    "UPDATE bd.tbl_test SET counter = (case %s end) WHERE id IN (%s)",
    implode(' ', $cases),
    implode(',', $needToUpdateIndexes)
);

$diff = sprintf( '%.6f sec.', microtime( true ) - $start );

print 'SQL query: '.$query.PHP_EOL;
print 'Affected rows: '.count($needToUpdateIndexes).PHP_EOL;
print 'Time: '.$diff.PHP_EOL;


