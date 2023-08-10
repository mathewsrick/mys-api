<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Orders extends Model
{
    protected $guarded = ['id'];

    public function address(): BelongsTo {
        return $this->belongsTo(Address::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function products() {
        $rels = OrderProduct::where('product_id', $this->id)->get();
        return $rels;
    }
}
