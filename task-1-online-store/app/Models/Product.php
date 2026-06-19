<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Guarded(['id'])]
class Product extends BaseModel
{
    /**
     * Get the inventory associated with the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inventory(): HasOne
    {
        return $this->hasOne(Inventory::class);
    }
}
