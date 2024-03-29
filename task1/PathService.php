<?php

namespace Task1;

class PathService
{
    // значение ячейки, которая доступна для перемещения
    private const TRUE_VALUE = '_';

    // максимальное количество узлов в пути (если больше, то путь не существует)
    private const MAX_COUNT_NODES = 10000;

    public function pathExists(array $map, array $cellFrom, array $cellTo): bool
    {
        if (!$this->isValidData($map, $cellFrom, $cellTo)) {
            return false;
        }

        $path = $this->getPath($map, $cellFrom, $cellTo);
        //$this->printPath($path);

        return !empty($path);
    }

    public function getPath(array $map, array $cellFrom, array $cellTo): ?array
    {
        $startNode = new PathNode(
            $this->getRowFromArray($cellFrom),
            $this->getColFromArray($cellFrom)
        );
        $endNode = new PathNode(
            $this->getRowFromArray($cellTo),
            $this->getColFromArray($cellTo)
        );

        $nodes = [$startNode];
        $checkedNodes = [];
        while (!empty($nodes)) {
            $currentNode = null;
            $currentRouteCost = PHP_INT_MAX;
            foreach ($nodes as $node) {
                if ($node->getCost() < $currentRouteCost) {
                    $currentNode = $node;
                    $currentRouteCost = $node->getCost();
                }
            }

            if ($this->isEndNode($currentNode, $endNode)) {
                $path = [];
                while ($currentNode->getParent()) {
                    array_unshift($path, [$currentNode->getRow(), $currentNode->getCol()]);
                    $currentNode = $currentNode->getParent();
                }
                return $path;
            }

            unset($nodes[array_search($currentNode, $nodes)]);

            $checkedNodes[] = $currentNode;
            if (count($checkedNodes) >= self::MAX_COUNT_NODES) {
                return [];
            }

            $neighborsNodes = $this->getNeighborsNodes($map, $currentNode);
            if (empty($neighborsNodes)) {
                continue;
            }
            foreach ($neighborsNodes as $neighborNode) {
                if (in_array($neighborNode, $checkedNodes)) {
                    continue;
                }

                if (
                    !in_array($neighborNode, $nodes)
                    || $neighborNode->getCost() < $currentNode->getCost()
                ) {
                    $nodes[] = $neighborNode;
                }
            }
        }

        return null;
    }

    public function printPath(array $route): void
    {
        foreach ($route as $step => $cell) {
            $step = $step + 1;
            print(sprintf('%d => %s', $step, implode(',', $cell).PHP_EOL));
        }
    }

    private function isValidData(array $map, array $cellFrom, array $cellTo): bool
    {
        // check that we have data
        if (empty($map) || empty($cellFrom) || empty($cellTo)) {
            return false;
        }

        // check that we have our cells in map
        $cellFromRow = $this->getRowFromArray($cellFrom);
        $cellFromCol = $this->getColFromArray($cellFrom);
        $cellToRow = $this->getRowFromArray($cellTo);
        $cellToCol = $this->getColFromArray($cellTo);
        if (empty($map[$cellFromRow][$cellFromCol]) || empty($map[$cellToRow][$cellToCol])) {
            return false;
        }

        // check true value in cells
        if ($map[$cellFromRow][$cellFromCol] !== self::TRUE_VALUE || $map[$cellToRow][$cellToCol] !== self::TRUE_VALUE) {
            return false;
        }

        return true;
    }

    private function getRowFromArray(array $cell): int
    {
        return (int) $cell[0] ?? 0;
    }

    private function getColFromArray(array $cell): int
    {
        return (int) $cell[1] ?? 0;
    }

    private function isEndNode(PathNode $currentNode, PathNode $endNode): bool
    {
        return (
            $currentNode->getRow() === $endNode->getRow()
            && $currentNode->getCol() === $endNode->getCol()
        );
    }

    private function getNeighborsNodes(array $map, PathNode $currentNode): array
    {
        $neighborsNodes = [];
        $row = $currentNode->getRow();
        $col = $currentNode->getCol();
        $neighbors = [
            [$row - 1, $col],
            [$row + 1, $col],
            [$row, $col - 1],
            [$row, $col + 1]
        ];
        foreach ($neighbors as $neighbor) {
            $row = $this->getRowFromArray($neighbor);
            $col = $this->getColFromArray($neighbor);
            if (!isset($map[$row][$col]) || $map[$row][$col] !== self::TRUE_VALUE) {
                continue;
            }

            $neighborNode = new PathNode($row, $col, $currentNode);
            $neighborNode->setCost($currentNode->getCost() + 1);
            $neighborsNodes[] = $neighborNode;
        }

        return $neighborsNodes;
    }
}