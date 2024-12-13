<?php

namespace App\Traits;

trait OrderByTrait
{
    private function orderBy(array $sortBy)
    {
        if (!empty($sortBy))  {
            foreach ($sortBy as $sort) {
                $this->builder->orderBy($sort['key'], $sort['order']);
            }
        }
    }
}
