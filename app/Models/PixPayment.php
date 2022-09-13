<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PixPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'invitee_id',
        'amount',
        'transaction_id',
        'status',
        'pdf'
    ];

    public $slug = 'pix_payments';
    public $additional_attributes = ['pixpayments'];

    public function getPixpaymentsAttribute(){
        $info = array(
            'id' => $this->id,
            'campaign_id' => $this->campaign_id,
            'amount' => $this->amount,
            'transaction_id' => $this->transaction_id,
            'status' => $this->status,
            'pdf' => $this->pdf
        );
        return $info;
    }

    public function invitees(){
        return $this->hasOne(Invitee::class,'id', 'invitee_id');
    }
}
