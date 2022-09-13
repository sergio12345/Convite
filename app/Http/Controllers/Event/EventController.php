<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailNewEvent;
use App\Models\Campaign;
use App\Http\Resources\InstitutionResource;
use App\Models\Institution;
use App\Models\CampaignMedia;
use App\Models\User;
use App\Models\Invitee;

class EventController extends Controller
{
    public function createEvent(Request $request)
    {
        $event = new \stdclass();
        if(\Session::has('event')){
            $event = \Session::get('event');
        }

        return view('create-event/step-1')->with('event', $event);
    }

    public function postEventStep(Request $request)
    {
        $event = new \stdclass();
        $event->name = $request->name;
        //$event->short_description = $request->short_description;
        $event->event_format = $request->event_format;
        $event->address = $request->address;
        $event->date = $request->date;
        $event->hour = $request->hour;
        $event->step = "2";
        \Session::put('event', $event);

        return redirect()->route('step2');
    }

    public function createEvent2(Request $request)
    {
        if(\Session::has('event')){
            $event = \Session::get('event');
        }else{
            return view('create-event/step-1');
        }
        $institutions = Institution::whereNull('deleted_at')->get();

        $institutions = collect(InstitutionResource::collection($institutions));
        $institutions = $institutions->toArray();

        return view('create-event/step-2')
                ->with('event', $event)
                ->with('institutions', $institutions);
    }

    public function postEventStep2(Request $request)
    {
        if(\Session::has('event')){
            $event = \Session::get('event');
        }else{
            return view('create-event/step-1');
        }
        
        $event->gift_details = $request->gift_details == "yes" ? 1 : 0;
        $event->description = $request->has('description') ? $request->description : null;
        $event->goal = $request->has('goal') ? $request->goal : null;
        $event->donationInstitution = $request->donationInstitution == "yes" ? 1 : 0;
        $event->institutionId = $request->has('institutionId') ? $request->institutionId : null;
        $event->taxCharity = $request->has('taxCharity') ? $request->taxCharity : null;
        $event->step = "3";
        \Session::put('event', $event);

        return redirect()->route('step3');
    }

    public function createEvent3(Request $request)
    {
        if(\Session::has('event')){
            $event = \Session::get('event');
        }else{
            return view('create-event/step-1');
        }

        return view('create-event/step-3')->with('event', $event);
    }

    public function postEventStep3(Request $request)
    {
        if(\Session::has('event')){
            $event = \Session::get('event');
        }else{
            return view('create-event/step-1');
        }
        //dd($request->all());
        $event->custom_template = $request->has('custom_template') ? $request->custom_template : null;
        $event->image = $request->has('image') ? $request->image : null;
        $event->file_name_image = $request->has('file_name_image') ? $request->file_name_image : null;
        \Session::put('event', $event);

        return redirect()->route('step3.template');
    }

    public function createEvent3Template(Request $request)
    {
        if(\Session::has('event')){
            $event = \Session::get('event');
        }else{
            return view('create-event/step-1');
        }

        return view('create-event/step-3-template')->with('event', $event);
    }

    public function postEventStepTemplate(Request $request)
    {
        if(\Session::has('event')){
            $event = \Session::get('event');
        }else{
            return view('create-event/step-1');
        }
        
        $event->date_rsvp = $request->has('date_rsvp') ? $request->date_rsvp : null;
        $event->hour_rsvp = $request->has('hour_rsvp') ? $request->hour_rsvp : null;

        \Session::put('event', $event);
        
        return redirect()->route('step3.summery');
    }

    public function createEvent3Summery(Request $request)
    {
        if(\Session::has('event')){
            $event = \Session::get('event');
        }else{
            return view('create-event/step-1');
        }

        $format = ($event->event_format == 'presential') ? 'presencial' : 'virtual';
        $event->short_description = "Olá! Estou muito feliz em te convidar para este evento, no formato ". $format .
            ", no endereço: " . $event->address .
            ", dia " . $event->date . ", às " . $event->hour . ".\n\n" .
            "Aguardamos a confirmação da sua presença até o dia " . $event->date_rsvp . " ás " . $event->hour_rsvp . " horas.\n\n" .
            "Estamos ansiosos para comemorarmos juntos esse dia especial!";

        return view('create-event/step-3-summery')->with("event", $event);
    }

    public function postEventStepSuccess(Request $request){
        if(\Session::has('event')){
            $event = \Session::get('event');
        }else{
            return redirect()->route('dashboard');
        }
        $event->short_description = $request->short_description;
        \Session::put('event', $event);
        
        return redirect()->route('event.success');
    }

    public function eventStepSuccess(Request $request)
    {
        if(\Session::has('event')){
            $event = \Session::get('event');
        }else{
            return redirect()->route('dashboard');
        }
        
        $event->user_id = Auth::user()->id;

        $data = explode("/", $event->date);
        $new_date = $data[2]."-".$data[1]."-".$data[0]." ".$event->hour.":00";
        $event->date_full = $new_date;

        $data_rsvp = explode("/", $event->date_rsvp);
        $new_date_rsvp = $data_rsvp[2]."-".$data_rsvp[1]."-".$data_rsvp[0]." ".$event->hour_rsvp.":00";
        $event->date_rsvp_full = $new_date_rsvp;   
        
        // default
        $event->fundraising = 'active';                             
        $event->status = 'published';                                
        $event->fundraising_after_goal = 'active';                    
        $event->fundraising_after_date = 'active';                   
        $event->status_after_date = 'published';
        
        $event->goal = str_replace('.', '', $event->goal);
        $event->goal = str_replace(',', '.', $event->goal);

        $event->token = uniqid("convite/", true);
        $event->taxCharity = str_replace('%', '', $event->taxCharity);

        \Session::put('event', $event);

        // criar a campanha - evento
        try {
            $campaign = Campaign::create([
                'user_id' => $event->user_id,
                'name' => $event->name,
                'short_description' => $event->short_description,
                'description' => $event->description ,
                'address' => $event->address ,
                'starts_at' => $event->date_full ,                   
                'ends_at' => $event->date_full ,
                'date_rsvp' => $event->date_rsvp_full ,
                'type' => $event->event_format ,          
                'goal' => $event->goal ,
                'institution_id' => $event->institutionId ,                         
                'tax_charity' => $event->taxCharity ,
                'receive_gifts' => $event->gift_details,
                'donate_to_charity' => $event->donationInstitution,
                'fundraising' => 'active',                              
                'status' => 'published',                                
                'fundraising_after_goal' => 'active',                   
                'fundraising_after_date' => 'active',         
                'status_after_date' => 'published',
                'token' => $event->token
            ]);
        } catch (QueryException $e) {
            dd("erro ao criar evento", $e);
            return view('create-event/success')->with('errorCreateEvent', 'Erro ao criar o evento. Tente novamente')->with('url','')->with('event','');
        }

        // http://localhost:8080/ + convite/54354354353.5434234
        $url_shareable = config('services.urls.APP_URL') . "/" .$campaign->token;

        $url = $event->image == null ? $event->custom_template : $this->saveImageCampaign($event->image);
        $type = $event->image == null ? 'custom_template' : 'image';

        // add image campanha - evento
        try {
            $media = CampaignMedia::create([
                'uri' => $url,
                'type' => $type,
                'user_id' => Auth::user()->id,
                'campaign_id' => $campaign->id,
            ]);
        } catch (QueryException $e) {
            dd("erro ao add imagem", $e);
            return view('create-event/success')->with('errorCreateEvent', 'Erro ao adicionar imagem!')->with('url','')->with('event','');
        }
        
        \Session::forget('event');

        return view('create-event/success')
            ->with('user', Auth::user())
            ->with('url', $url_shareable)
            ->with('event', $campaign->id);
    }

    public function eventEditStepSuccess(Request $request, $event_id){
        
        $campaign = Campaign::where('id', $event_id)->whereNull('deleted_at')->first();
        $events = collect($campaign);
        $events = $events->toArray();

        $url_shareable = config('services.urls.APP_URL') . "/" .$events['token'];
        return view('edit-event/success')
            ->with('user', Auth::user())
            ->with('url', $url_shareable)
            ->with('event', $events['id']);
    }

    public function saveImageCampaign($imageBase64){
        $requestFile = $imageBase64;
        $extension = ".jpeg";
        $fileName = md5(strtotime("now") . "." . $extension);
        $filePath = "campaign-images/" . $fileName . $extension;
        
        $path = \Storage::disk('public')->put($filePath, file_get_contents($requestFile));
        return $filePath;
    }

    public function sendEmailEvent(Request $request){
        $user = Auth::user();
        $event = Campaign::where('id', $request->event_id)->first();

        $data = explode(" ", $event->starts_at);
        $date_event = explode("-", $data[0]);
        $event->date_event = $date_event[2]."/".$date_event[1]."/".$date_event[0];

        $hour = explode(":", $data[1]);
        $event->hour_event = $hour[0].":".$hour[1];

        $emails = explode(",", $request->email);

        foreach ($emails as $key => $email) {
            Mail::to($email)->send(new SendMailNewEvent($user, $event));
            /* if (Mail::failures()) {
                return new Error(Mail::failures()); 
            } */
        }
        
        return response()->json(
            [
                'message' => 'Enviado!',
                'event' => $event
            ]
        );
    }

    public function editEvent(Request $request, $event_id)
    {
        $campaign = Campaign::where('id', $event_id)->whereNull('deleted_at')->first();
        $event = collect($campaign);
        $event = $event->toArray();
        if(!isset($event)){
            return dd("tratar caso");
        }
        
        $data = explode(" ", $event['starts_at']);
        $date_event = explode("-", $data[0]);
        $event['date'] = $date_event[2]."/".$date_event[1]."/".$date_event[0];

        $hour = explode(":", $data[1]);
        $event['hour'] = $hour[0].":".$hour[1];

        return view('edit-event/step-1')
                ->with('event', $event);
    }

    public function saveEditEvent(Request $request, $event_id)
    {
        $date = explode("/", $request->date);
        $new_date = $date[2]."-".$date[1]."-".$date[0]." ".$request->hour.":00";

        $campaign = Campaign::where('id', $event_id)->update([ 
            "name" => $request->name,
            "type" => $request->event_format,
            "address" => $request->address,
            "starts_at" => $new_date,
            //"short_description" => $request->short_description,
         ]);
         // verificar quando houver error....

        return redirect()->route('edit.event.step2', ['id'=> $event_id]);
    }
    
    public function saveEditEventStep2(Request $request, $event_id)
    {
        $goal = str_replace('.', '', $request->goal);
        $goal = str_replace(',', '.', $goal);
        $taxCharity = str_replace('%', '', $request->taxCharity);

        $campaign = Campaign::where('id', $event_id)->update([ 
            "receive_gifts" => $request->gift_details == "yes" ? 1 : 0,
            "donate_to_charity" => $request->donationInstitution == "yes" ? 1 : 0,
            "description" => $request->description,
            "goal" => $goal,
            "institution_id" => $request->institutionId,
            "tax_charity" => $taxCharity,
         ]);
         // verificar quando houver error....

        return redirect()->route('edit.event.step3', ['id'=> $event_id]);
    }

    public function saveEditEventStep3(Request $request, $event_id)
    {
        $url = $request->image == null ? $request->custom_template : $this->saveImageCampaign($request->image);
        $type = $request->image == null ? 'custom_template' : 'image';

        $campaign = CampaignMedia::where('campaign_id', $event_id)->update([ 
            "uri" => $url,
            'type' => $type,
            ]);
       
        return redirect()->route('edit.event.step3Template', ['id'=> $event_id]);
    }

    public function saveEditEventStep3Template(Request $request, $event_id)
    {
        $date = explode("/", $request->date_rsvp);
        $date_full_rsvp = $date[2]."-".$date[1]."-".$date[0]." ".$request->hour_rsvp.":00";

        $campaign = Campaign::where('id', $event_id)->update([ 
            "date_rsvp" => $date_full_rsvp,
         ]);
       
        return redirect()->route('edit.event.step3Summery', ['id'=> $event_id]);
    }

    public function saveEditEventStep3Summery(Request $request, $event_id)
    {
        $campaign = Campaign::where('id', $event_id)->update([ 
            "short_description" => $request->short_description,
         ]);
       //dd("salvar summery edit",$request->all());
       return redirect()->route('event.edit.success', ['id'=> $event_id]);
    }
    

    public function editEventStep2(Request $request, $event_id)
    {
        $campaign = Campaign::where('id', $event_id)->whereNull('deleted_at')->first();
        $event = collect($campaign);
        $event = $event->toArray();

        $institutions = Institution::whereNull('deleted_at')->get();

        $institutions = collect(InstitutionResource::collection($institutions));
        $institutions = $institutions->toArray();
        
        return view('edit-event/step-2')
            ->with('event', $event)
            ->with('institutions', $institutions);
    }

    public function editEventStep3(Request $request, $event_id)
    {
        $image = CampaignMedia::where('campaign_id', $event_id)->whereNull('deleted_at')->first();
        if($image->type == 'image'){
            $imagem = \Storage::disk('public')->url($image->uri);
        }else{
            $imagem = $image->uri;
        }

        $event = Campaign::where('id', $event_id)->first();

        $date = explode(" ", $event->starts_at);
        $date_event = explode("-", $date[0]);
        $date_event = $date_event[2]."/".$date_event[1]."/".$date_event[0];

        $hour = explode(":", $date[1]);
        $hour_event = $hour[0].":".$hour[1];

        return view('edit-event/step-3')
            ->with('event_id', $event_id)
            ->with('event', $event)
            ->with('date_event', $date_event)
            ->with('hour_event', $hour_event)
            ->with('custom_template', $image->type)
            ->with("image", $imagem);
    }

    public function editEventStep3Template(Request $request, $event_id)
    {
        $image = CampaignMedia::where('campaign_id', $event_id)->whereNull('deleted_at')->first();
        if($image->type == 'image'){
            $imagem = \Storage::disk('public')->url($image->uri);
        }else{
            $imagem = $image->uri;
        }
        $event = Campaign::where('id', $event_id)->whereNull('deleted_at')->first();

        $date = explode(" ", $event->date_rsvp);
        $date_event = explode("-", $date[0]);
        $date_rsvp = $date_event[2]."/".$date_event[1]."/".$date_event[0];

        $hour = explode(":", $date[1]);
        $hour_rsvp = $hour[0].":".$hour[1];
        
        return view('edit-event/step-3-template')
            ->with('event_id', $event_id)
            ->with('event', $event)
            ->with('date_rsvp', $date_rsvp)
            ->with('hour_rsvp', $hour_rsvp)
            ->with('custom_template', $image->type)
            ->with("image", $imagem);
    }

    public function editEventStep3Summery(Request $request, $event_id)
    {
        $campaign = Campaign::where('id', $event_id)->whereNull('deleted_at')->first();
        $image = CampaignMedia::where('campaign_id', $event_id)->whereNull('deleted_at')->first();
        if($image->type == 'image'){
            $imagem = \Storage::disk('public')->url($image->uri);
        }else{
            $imagem = $image->uri;
        }
        $event = collect($campaign);
        $event = $event->toArray();

        $date = explode(" ", $event['date_rsvp']);
        $date_event = explode("-", $date[0]);
        $date_rsvp = $date_event[2]."/".$date_event[1]."/".$date_event[0];

        $hour = explode(":", $date[1]);
        $hour_rsvp = $hour[0].":".$hour[1];

        $date2 = explode(" ", $event['starts_at']);
        $date_event = explode("-", $date2[0]);
        $date_starts_at = $date_event[2]."/".$date_event[1]."/".$date_event[0];

        $hour = explode(":", $date2[1]);
        $hour_starts_at = $hour[0].":".$hour[1];

        return view('edit-event/step-3-summery')
            ->with('event_id', $event_id)
            ->with('event', $event)
            ->with('date_starts_at', $date_starts_at)
            ->with('hour_starts_at', $hour_starts_at)
            ->with('date_rsvp', $date_rsvp)
            ->with('hour_rsvp', $hour_rsvp)
            ->with('custom_template', $image->type)
            ->with("image", $imagem);
    }

}
