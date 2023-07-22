<?php

namespace App\Scopes;

use App\Helpers\Constants\TransactionConstants;
use Illuminate\Database\Eloquent\Builder;

trait TransactionScopes
{
    public function scopeSearch(Builder $query, ?string $args): Builder
    {
        if ($args) {
            return $query->where('reference_no', 'like', "%{$args}%")
                ->orWhere('date', 'like', "%{$args}%")
                ->orWhere('transaction_type', 'like', "%{$args}%")
                ->orWhereHas('category', function($categoryQuery) use($args) {
                    return $categoryQuery->where('name', 'like', "%{$args}%");
                })
                ->orWhere('amt_type', 'like', "%{$args}%")
                ->orWhere('amount', 'like', "%{$args}%")
                ->orWhere('balance', 'like', "%{$args}%");
        }
        return $query;
    }

    public function scopeType(Builder $query, $type){
        return $query->where('type',$type);
    }

    public function scopeCategory(Builder $query, $category){
        return $query->where('category_id',$category);
    }

    public function scopeLimitBy(Builder $query, int $start, int $length): Builder
    {
        if($length != -1)
        {
            return $query->offset($start)->limit($length);
        }
        return $query;
    }

    public function scopeOrder(Builder $query, array $order): Builder
    {
        if ($order) {
            $columns = [
                'actions',
                'id',
                'reference_no',
                'date',
                'description',
                'type',
                'category',
                'amt_type',
                'amount',
                'balance',
            ];
            return $query->orderBy($columns[$order[0]['column']], $order[0]['dir']);
        }
        return $query;
    }
}
