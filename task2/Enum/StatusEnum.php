<?php

namespace Task2\Enum;

enum StatusEnum: string
{
    case CREATED = 'created';
    case DELETED = 'deleted';
    case UPDATED = 'updated';
    case NEED_TO_UPDATE = 'need_to_update';
}
