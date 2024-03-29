<?php

namespace Task1;

class PathNode
{
    /**
     * @param int $row - Строка
     * @param int $col - Колонка
     * @param PathNode|null $parent - Родитель
     * @param int|null $cost - Стоимость пути. Увеличивается на стоимость перехода к соседней точке
     */
    function __construct(
        private int $row,
        private int $col,
        private ?PathNode $parent = null,
        private ?int $cost = 0
    ) {
    }

    public function getRow(): int
    {
        return $this->row;
    }

    public function getCol(): int
    {
        return $this->col;
    }

    public function getParent(): ?PathNode
    {
        return $this->parent;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }
}