<?php

namespace App\repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(User $model)
   {
       parent::__construct($model);
   }
}