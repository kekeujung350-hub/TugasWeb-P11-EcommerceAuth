<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    /* ---------- Local Scopes ---------- */

    // Produk aktif & stok tersedia
    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('is_active', true)->where('stock', '>', 0);
    }

    // Pencarian nama produk (abaikan jika kosong)
    public function scopeSearch(Builder $query, ?string $keyword): Builder
    {
        return $query->when($keyword, fn ($q) => $q->where('name', 'like', "%{$keyword}%"));
    }

    // Rentang harga
    public function scopePriceBetween(Builder $query, int $min, int $max): Builder
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    /* ---------- Accessor ---------- */

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp '.number_format($this->price, 0, ',', '.');
    }

    /* ---------- Relationships ---------- */

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
