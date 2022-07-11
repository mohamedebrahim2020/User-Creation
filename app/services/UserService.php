<?php

namespace App\services;

use App\Events\UserCreated;
use App\repositories\UserRepository;
use Illuminate\Support\Str;


class UserService extends BaseService
{

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(array $data)
    {
        $roles = $data['roles'];
        $data['password'] = $this->generateRandomPassword();
        unset($data['roles']);
        $user = $this->repository->store($data);
        $this->addUserRoles($user, $roles);
        UserCreated::dispatch($user, $data['password']); 
    }

    private function addUserRoles($user, array $roles) 
    {
        $user->assignRole($roles);
    }

    private function generateRandomPassword()
    {
        return Str::random(10);
    }
}