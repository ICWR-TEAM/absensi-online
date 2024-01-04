<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
class ViewUser extends Model
{
    // use HasFactory;/
    protected $table = "users";
    protected $hidden = ["email_verified_at", "nisn", "password", "remember_token", "created_at", "updated_at"];
    // protected $fillable = [
    //     "name",
    //     "email"
    // ];
}
