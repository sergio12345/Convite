<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignMedia extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $slug = 'campaign_medias';
    protected $table = 'campaign_medias';
    public $additional_attributes = ['campaign_medias'];

    protected $fillable = [
        'user_id',
        'campaign_id',
        'type',
        'uri'
    ];

    public function getCampaignMediasAttribute(){
        
        $info = array(
            'id' => $this->id,
            'campaign_id' => $this->campaign_id,
            'uri' => $this->uri,
            'user_id' => $this->user_id
        );
        return $info;
    }
}
