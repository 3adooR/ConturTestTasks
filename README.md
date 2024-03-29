## Задание 1
**Необходимо реализовать функцию, которая проверяет, существует ли путь от одной точки к другой:**

```
$map = [
    ['_', '_', '_', '_', '_'],
    ['X', 'X', 'X', 'X', '_'],
    ['_', '_', 'X', '_', '_'],
    ['X', 'X', 'X', '_', 'X'],
    ['_', '_', '_', '_', '_'],
];
```
где:
"X" - стена, нет прохода
"_" - дорожка, можно пройти

Ходить можно только вертикально и горизонтально

Результат выполнения функции:
```
var_dump(pathExists($map, [0, 0], [4, 4])); // True
var_dump(pathExists($map, [0, 0], [2, 1])); // False
```

### Запуск
В директории проекта в консоли запустите скрипт
```
./task1.sh
```
Скрипт автоматически запустит контейнер с PHP 8.1 и выполнит в нём задание 1.
Результат выполнения отобразится в консоли. 

## Задание 2
**Дано 2 массива:** 

**1.json и 2.json, элементы массивов в обоих файлах имеют одинаковую структуру:**

```
[   
    ...,
    [
        "id": 1,
        "status": "need_to_update",
        "counter": 8
    ],
    [
        "id": 2,
        "status": "created",
        "counter": 21
    ],
    ...
]
```

Внутри каждого файла только уникальные ID. 
Нужно найти элементы первого во втором, при условии: 
если "status" элемента в первом равен "need_to_update", то просуммировать поле "counter" со значением из второго массива, 
если значение "status" в первом элементе другое - ничего делать не нужно, пропускаем этот элемент. 
Если во втором массиве нет id первого, то оставляем значение counter как есть.

Для получившихся элементов (со статусом "need_to_update"), нужно эмулировать работу с базой в виде чистого SQL, 
т.е. просто строкой без выполнения. 
Если id элемента есть в базе - то суммируем поле "counter" с тем, что в базе, если нет - вставляем новую запись.

Таблица называется bd.tbl_test, имеет 3 поля: "id", "status", "counter".

Основная оценка задания - скорость выполнения.

### Запуск
В директории проекта в консоли запустите скрипт
```
./task2.sh
```
Скрипт автоматически запустит контейнер с PHP 8.1 и выполнит в нём задание 2.
Результат выполнения отобразится в консоли. 