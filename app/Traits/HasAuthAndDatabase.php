<?php

namespace App\Traits;

use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;

trait HasAuthAndDatabase
{
    public function __construct(
        private AuthManager $auth,
        private DatabaseManager $database,
    ){}
}
