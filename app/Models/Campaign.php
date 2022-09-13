<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PixPayment;

class Campaign extends Model
{
    use HasFactory;
    use SoftDeletes;

    //public $slug = 'campaigns';
    //protected $table = 'campaigns';

    protected $fillable = [
        'user_id',
        'name',
        'short_description',
        'description',
        'goal',
        'address',
        'starts_at',
        'fundraising',
        'status',
        'receive_gifts',
        'donate_to_charity',
        'fundraising_after_date',
        'status_after_date',
        'ends_at',
        'date_rsvp',
        'type',
        'institution_id',
        'tax_charity',
        'fundraising_after_goal',
        'token',
        'updated_at',
        'deleted_at'
    ];

    public function pixpayments(){
        return $this->hasMany(PixPayment::class, 'campaign_id', 'id')->where('status', 'credited');
    }
}
