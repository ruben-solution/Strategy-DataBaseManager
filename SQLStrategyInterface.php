<?php

interface SQLStrategy
{
    function all($query, $params): array;

    function one($query, $params): array;

    function change($query, $params): bool;
}
