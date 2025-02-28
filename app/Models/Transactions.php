<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Transactions
 *
 * @property int $id
 * @property string $transaction_id
 * @property string $name
 * @property string $email
 * @property float $amount
 * @property string $currency
 * @property int $created_at
 * @property int $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Transactions extends Model
{
    use HasFactory;
    protected $table    = 'transactions';
    public  $timestamps = false;
    protected $fillable = [
            'id',
            'transaction_id',
            'name',
            'email',
            'amount',
            'currency',
            'created_at',
            'updated_at'
    ];
}
