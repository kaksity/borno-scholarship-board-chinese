<?php

namespace App\Actions;

use App\Models\Lga;
use App\Repositories\Interfaces\LgaRepositoryInterface;

class LgaActions
{
    public function __construct(
        private Lga $lga
    )
    {}

    public function getLgas()
    {
        return $this->lga->orderBy('name', 'ASC')->get();
    }
}
