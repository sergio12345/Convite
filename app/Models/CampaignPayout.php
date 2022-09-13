<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Institution;

class CampaignPayout extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'campaign_id',
        'institution_id',
        'type',
        'amount',
        'attachment'
    ];

    public $slug = 'campaign_payouts';
    public $additional_attributes = ['campaignpayouts'];

    public function getCampaignpayoutsAttribute(){

        $institution = Institution::where('id', $this->institution_id)->first();
        $charityInstitution = isset($institution) ? $institution->name : "";

        $info = array(
            'id' => $this->id,
            'campaign_id' => $this->campaign_id,
            'institution_id' => $this->institution_id,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'charity_institution' => $charityInstitution,
            'amount' => $this->amount,
            'attachment' => $this->attachment
        );
        return $info;
    }
}
