<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreateUser extends Model
{
    protected $table = "users";
    protected $fillable = ["name","email", "role", "password", "accept"];
}
