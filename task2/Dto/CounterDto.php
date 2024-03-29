<?php

namespace Task2\Dto;

class CounterDto
{
    public function __construct(
        public ?int $id,
        public ?string $status,
        public ?string $counter
    ) {
    }

    public static function createFromArray(array $data): CounterDto
    {
        return new self(
            $data['id'] ?? null,
            $data['status'] ?? null,
            $data['counter'] ?? null
        );
    }
}