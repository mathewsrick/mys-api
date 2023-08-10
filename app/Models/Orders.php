<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orders extends Model
{
    protected $guarded = ['id'];

    public function address(): BelongsTo {
        return $this->belongsTo(Address::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id');
    }
}
