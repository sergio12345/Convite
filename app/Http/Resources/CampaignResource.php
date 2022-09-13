<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\CampaignMedia;
use App\Models\Invitee;

class CampaignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $banner = CampaignMedia::where('campaign_id', $this->id)->first();
        $invitees = Invitee::where('campaign_id', $this->id)->count();
        $inviteesConfirmed = Invitee::where('campaign_id', $this->id)->where('rsvp', '0')->count();
        
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'short_description' => $this->short_description,
            'description' => isset($this->description) ? $this->description : "",
            'banner' => isset($banner) ? $banner->uri : "",
            'address' => $this->address,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'date_rsvp' => $this->date_rsvp,
            'type' => $this->type,
            'goal' => isset($this->goal) ? $this->goal : 0,
            'campaign_status' => $this->status,
            'campaign_status_after_date' => $this->status_after_date,
            'fundraising_state' => $this->fundraising,
            'fundraising_state_after_date' => $this->fundraising_after_date,
            'fundraising_progress' => "",
            'fundraising_goal'=> $this->goal,
            'number_of_invitees' => $invitees,
            'number_of_invitees_confirmed' => $inviteesConfirmed,
            'shareable_link' => $this->token
        ];
    }
}
