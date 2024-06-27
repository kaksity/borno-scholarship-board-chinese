<?php

namespace App\Actions;

use App\Models\Admin;

class AdminActions
{
    public function __construct(
        private Admin $admin
    )
    {}

    public function createAdminRecord($data)
    {
        return $this->admin->create($data);
    }

    public function updateAdminRecord($data, $id)
    {
        $this->admin->where([
            'id' => $id
        ])->update($data);
    }
    public function getAdminByEmailAddress($emailAddress, $relationships = [])
    {
        return $this->admin->with($relationships)->where([
            'email' => $emailAddress
        ])->first();
    }
}
