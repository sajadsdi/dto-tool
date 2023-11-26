<?php

namespace Sajadsdi\DtoTool;

use Sajadsdi\DtoTool\Concerns\DTOArray;
use Sajadsdi\DtoTool\Concerns\GetterSetter;

abstract class DTO
{
    use GetterSetter, DTOArray;
}
