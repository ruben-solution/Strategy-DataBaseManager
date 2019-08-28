<?php

class DatabaseManager
{
    private $strategy;

    function __construct(SQLStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function all($query, $params): array
    {
        return $this->strategy->all($query, $params);
    }

    public function one($query, $params): array
    {
        return $this->strategy->one($query, $params);
    }

    public function change($query, $params): bool
    {
        return $this->strategy->change($query, $params);
    }
}
