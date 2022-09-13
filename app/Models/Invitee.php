<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PixPayment;

class Invitee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'campaign_id',
        'name',
        'email',
        'phone',
        'rsvp'
    ];

    public $slug = 'invitees';
    public $additional_attributes = ['invitees'];

    public function getInviteesAttribute(){
        $info = array(
            'id' => $this->id,
            'campaign_id' => $this->campaign_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'rsvp' => $this->rsvp
        );
        return $info;
    }

    public function pixpayments(){
        return $this->hasOne(PixPayment::class);
    }

}
