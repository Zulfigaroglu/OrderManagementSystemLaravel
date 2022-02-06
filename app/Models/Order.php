<?php

namespace App\Models;

use App\Dtos\ItemDto;
use App\Dtos\OrderDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'customer_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot(['quantity', 'total']);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function toDto(): OrderDto
    {
        $orderDto = new OrderDto();
        $orderDto->id = $this->id;
        $orderDto->customer_id = $this->customer_id;
        $orderDto->total = $this->total;
        $orderDto->created_at = $this->created_at;
        $orderDto->updated_at = $this->updated_at;

        foreach ($this->items as $item) {
            $itemDto  = new ItemDto();
            $itemDto->product_id = $item->id;
            $itemDto->unit_price = $item->price;
            $itemDto->quantity = $item->pivot->quantity;
            $itemDto->total = $item->pivot->total;
            $orderDto->items[] = $itemDto;
        }

        return $orderDto;
    }
}
