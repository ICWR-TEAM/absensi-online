<?php

namespace App\Imports;

use App\CreateUser;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CreateUser([
            "name"=>$row[0],
            "email"=>$row[1],
            "role"=>$row[2],
            "password"=>Hash::make($row[3]),
            "accept"=>$row[4]
        ]);
    }
}
