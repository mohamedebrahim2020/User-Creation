<?php

namespace App\services;

use App\repositories\BaseRepository;

class BaseService
{
    protected $repository;
    public $relations;
    public $pagination;
    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->all();
    }
    public function show($id)
    {
        return $this->repository->find($id);
    }
    public function store(array $data)
    {
        return $this->repository->store($data, false);
    }
    public function update(array $data, $id)
    {
        return $this->repository->update($data, $id);
    }
    public function delete($model)
    {
        $this->repository->delete($model);
    }
}