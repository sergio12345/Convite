<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'cnpj',
        'amount',
        'description',
        'transaction_id',
        'bank_name',
        'bank_code',
        'bank_agency',
        'bank_account_number',
        'bank_pix_key',
        'logo'
    ];

    public $slug = 'institution';
    public $additional_attributes = ['institution'];

    public function getInstitutionAttribute(){
        $info = array(
            'id' => $this->id,
            'name' => $this->name,
            'cnpj' => $this->cnpj,
            'amount' => $this->amount,
            'description' => $this->description,
            'campaign_id' => $this->campaign_id,
            'transaction_id' => $this->transaction_id,
            'created_at' => $this->created_at,
            'bank' => $this->bank,
            'agency' => $this->agency
        );
        return $info;
    }
}
