<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'code',
        'type',
        'value',
        'percent_off'
    ];

    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }

    public function discount($total)
    {
        switch ($this->type) {
            case 'fixed':
                return $this->value;
            case 'percent':
                return ($this->percent_off / 100) * $total;
            default:
                return 0;
        }
    }
}
