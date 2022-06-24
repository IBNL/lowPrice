<?php
declare(strict_types = 1);

namespace App\Repositories\Eloquent;

use App\Models\User;

class UserRepository extends AbstractRepository{

    protected $model = User::class;
    
}