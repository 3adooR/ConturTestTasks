<?php

namespace Task2\Dto;

class CounterListDto
{
    /**
     * @param array<CounterDto> $list
     */
    public function __construct(public array $list = [])
    {
    }

    public static function createFromArray(array $data): CounterListDto
    {
        $list = [];
        foreach ($data as $item) {
            $dto = CounterDto::createFromArray($item);
            $list[$dto->id] = $dto;
        }

        return new self($list);
    }

    public function indexes(): array
    {
        return array_keys($this->list);
    }
}