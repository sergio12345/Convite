<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\CampaignMedia;
use App\Models\PixPayment;
use Carbon\Carbon;

class ListCampaignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $image = CampaignMedia::where('campaign_id', $this->id)->first();
        $imagem = null;
        if(isset($image)){
            if($image->type == 'image'){
                $imagem = \Storage::disk('public')->url($image->uri);
            }else{
                $imagem = $image->uri;
            }
        }

        $length = strlen($this->short_description);

        // verificar se o evento já terminou
        $now = Carbon::today()->toDateString();
        $ends_at = Carbon::parse($this->ends_at)->toDateString();//->format('M d Y');

        $finished_event = 0;
        if($now > $ends_at){
            $finished_event = 1;
        }

        $amount = collect($this->pixpayments)->sum('amount');
        $amount =  number_format( floatval($amount), 2, ',', '.');

        $payments = PixPayment::where('campaign_id', $this->id)->where('status', 'credited')->sum('amount');

        $event_pt = ($this->goal > 0) ? intval(number_format($payments / $this->goal, 2, '.', '') * 100) : 0;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'finished_event' => $finished_event,
            'receive_gifts' => $this->receive_gifts,
            'short_description' => $length > 40 ? substr($this->short_description,0,40) . "..." : $this->short_description,
            'description' => isset($this->description) ? $this->description : "",
            'address' => $this->address,
            'pixpayments' => $amount,
            'event_pt' => $event_pt,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'date_rsvp' => $this->date_rsvp,
            'type' => $this->type,
            'goal' => isset($this->goal) ? $this->goal : 0,
            'banner' => $imagem,
            'type_template' => $image->type,
            'campaign_status' => $this->status,
            'fundraising_state' => $this->fundraising,
            'fundraising_progress' => "",
            'shareable_link' => $this->token
        ];
    }
}
