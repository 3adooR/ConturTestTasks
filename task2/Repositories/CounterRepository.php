<?php

namespace Task2\Repositories;

use Task2\Dto\CounterListDto;
use Task2\Enum\StatusEnum;
use Task2\Services\Db\DbConnectorInterface;

class CounterRepository
{
    public function __construct(
        private readonly DbConnectorInterface $db,
        private readonly string $tableName
    ) {
    }

    public function getAllWithStatus(StatusEnum $status): CounterListDto
    {
        $items = $this->db
            ->table($this->tableName)
            ->select([
                'id',
                'status',
                'counter',
            ])
            ->where('status', $status->value)
            ->get();

        return CounterListDto::createFromArray($items);
    }

    public function findAllWithIndexes(array $indexes): CounterListDto
    {
        $items = $this->db
            ->table($this->tableName)
            ->select([
                'id',
                'counter',
            ])
            ->whereIn('id', $indexes)
            ->get();

        return CounterListDto::createFromArray($items);
    }
}