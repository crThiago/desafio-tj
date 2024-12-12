<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    /**
     * @var Model
     */
    protected Model $model;
    /**
     * @var string[]
     */
    protected array $columns = ['*'];

    protected Builder $builder;

    /**
     * @return mixed
     */
    public function query(): mixed
    {
        return $this->model::query();
    }

    /**
     * @param string[] $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->model::all($this->getColumns($columns));
    }

    /**
     * @param int $perPage
     * @param string[] $columns
     * @param string $pageName
     * @param int $page
     * @return mixed
     */
    public function paginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'page', int $page = 1)
    {
        if ($perPage === -1) return $this->getBuilder()->get($this->getColumns($columns));

        return $this->getBuilder()->paginate($perPage, $this->getColumns($columns), $pageName, $page);
    }

    /**
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return $this->query()->create($data);
    }

    /**
     * @param array<string, mixed> $search
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function updateOrCreate(array $search, array $data): mixed
    {
        return $this->query()->updateOrCreate($search, $data);
    }

    /**
     * @param int $id
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function update(int $id, array $data): mixed
    {
        return ($this->find($id))->update($data);
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function updateByAttribute(string $attribute, mixed $value, array $data): mixed
    {
        return $this->query()->where($attribute, $value)->update($data);
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool
    {
        return ($this->find($id))->delete();
    }

    /**
     * @param int $id
     * @param string[] $columns
     * @return mixed
     */
    public function find(int $id, array $columns = ['*']): mixed
    {
        return $this->query()->findOrFail($id, $this->getColumns($columns));
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @param string[] $columns
     * @return mixed
     */
    public function findByAttribute(string $attribute, mixed $value, array $columns = ['*']): mixed
    {
        return $this->query()->where($attribute, $value)->first($this->getColumns($columns));
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @param string[] $columns
     * @return mixed
     */
    public function findOrFailByAttribute(string $attribute, mixed $value, array $columns = ['*']): mixed
    {
        return $this->query()->where($attribute, $value)->firstOrFail($this->getColumns($columns));
    }

    /**
     * @param string[] $columns
     * @return array|string[]
     */
    private function getColumns(array $columns): array
    {
        return $columns === ['*'] ? $this->columns : $columns;
    }

    private function getBuilder(): Builder
    {
        if ($this->builder instanceof Builder) {
            return $this->builder;
        }

        return $this->query();
    }
}
