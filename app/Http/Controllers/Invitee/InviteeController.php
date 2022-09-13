<?php

namespace App\Http\Controllers\Invitee;

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
use App\Models\PixPayment;
use App\Models\StarkBank\StarkBankPixPayment;

use OpenGraph;


class InviteeController extends Controller
{
   

    public function convite(Request $request, $token_event)
    {
        $event = Campaign::where('token', "convite/".$token_event)->first();

        if(!isset($event)){
            return view('404/guest-journey');
        }

        $data = explode(" ", $event->starts_at);
        $date_event = explode("-", $data[0]);
        $event->date_event = $date_event[2]."/".$date_event[1]."/".$date_event[0];

        $hour = explode(":", $data[1]);
        $event->hour_event = $hour[0].":".$hour[1];

        $image = CampaignMedia::where('campaign_id', $event->id)->whereNull('deleted_at')->first();
        if($image->type == 'image'){
            $imagem = \Storage::disk('public')->url($image->uri);
        }else{
            $imagem = $image->uri;
        }

        $host = User::where('id', $event->user_id)->first();

        $payments = PixPayment::where('campaign_id', $event->id)->where('status', 'credited')->sum('amount');
        $event_pt = ($event->goal > 0) ? intval(number_format($payments / $event->goal, 2, '.', '') * 100) : 0;

        $url = config('services.urls.APP_URL') . "/" . $event['token'];
        
        return view('guest-journey/index')
            ->with('event', $event)
            ->with('event_pt', $event_pt > 100 ? 100 : $event_pt)
            ->with('host', $host->name)
            ->with('token', $token_event)
            ->with("image", $imagem)
            ->with("url", $url)
            ->with("type_template", $image->type);
    }

    public function conviteConfirm(Request $request, $token_event)
    {
        $event = Campaign::where('token', "convite/".$token_event)->first();

        if(!isset($event)){
            return view('404/guest-journey');
        }

        $data = explode(" ", $event->starts_at);
        $date_event = explode("-", $data[0]);
        $event->date_event = $date_event[2]."/".$date_event[1]."/".$date_event[0];

        $hour = explode(":", $data[1]);
        $event->hour_event = $hour[0].":".$hour[1];

        $image = CampaignMedia::where('campaign_id', $event->id)->whereNull('deleted_at')->first();
        $host = User::where('id', $event->user_id)->first();

        $payments = PixPayment::where('campaign_id', $event->id)->where('status', 'credited')->sum('amount');
        $event_pt = ($event->goal > 0) ? intval(number_format($payments / $event->goal, 2, '.', '') * 100) : 0;

        if($image->type == 'image'){
            $imagem = \Storage::disk('public')->url($image->uri);
        }else{
            $imagem = $image->uri;
        }

        return view('guest-journey/confirm')
            ->with('event', $event)
            ->with('host', $host->name)
            ->with('token', $token_event)
            ->with('event_pt', $event_pt > 100 ? 100 : $event_pt)
            ->with("image", $imagem)
            ->with("type_template", $image->type);
    }

    public function conviteSaveConfirm(Request $request, $token_event)
    {
        $event = Campaign::where('token', "convite/".$token_event)->first();

        if(!isset($event)){
            return view('404/guest-journey');
        }

        try {
            $invitee = Invitee::create([
                'campaign_id' => $event->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'cpf' => isset($request->cpf) ? $request->cpf : null,
                'message' => $request->message,
                'rsvp' => $request->rsvp,
            ]);
        } catch (QueryException $e) {

        }

        $convidado = explode(" ",$request->name);
        $convidado = $convidado[0];

        $image = CampaignMedia::where('campaign_id', $event->id)->whereNull('deleted_at')->first();
        $host = User::where('id', $event->user_id)->first();

        // evento configurado para receber && convidado contribuiu
        if($event->receive_gifts == 1 && $request->gift_status == 'yes'){

            $request->answer2 = isset($request->answer2) ? $request->answer2 : 0;
            $amount = isset($request->answer) ? $request->answer : $request->answer2;
            $amount = str_replace(".", "", $amount);
            $amount = str_replace(",", ".", $amount);

            // criar o pagamento
            $starkBank = new StarkBankPixPayment();

            $generatePixPayment = [
                'value' => $amount,
                'cpf' => $request->cpf,
                'name' => $request->name,
                'email' => $request->email
            ];

            // verificar erro de valor e cpf
            $pix = $starkBank->makePayment($generatePixPayment);
            $array = get_object_vars($pix);

            //$qrcode = $starkBank->getQrCode($array['id']);
            //'qrcode' => \Storage::disk('public')->url($qrcode)

            // armazena na tabela pix_payments, simulando uma transação...
            $pixPayment = new PixPayment;
            $pixPayment->campaign_id = $event->id;
            $pixPayment->invitee_id = $invitee->id;    
            $pixPayment->amount = $amount;
            $pixPayment->transaction_id = $array['id'];
            $pixPayment->pdf = $array['pdf'];
            $pixPayment->link = $array['link'];
            $pixPayment->brcode = $array['brcode'];
            $pixPayment->save();
            return redirect()->route('pix.payment', ['id'=> $token_event, 'id_pix'=> $pixPayment->id]);
        }

       /*  $payments = PixPayment::where('campaign_id', $event->id)->where('status', 'credited')->sum('amount');
        $event_pt = ($event->goal > 0) ? intval(number_format($payments / $event->goal, 2, '.', '') * 100) : 0;

        $data = explode(" ", $event->starts_at);
        $date_event = explode("-", $data[0]);
        $event->date_event = $date_event[2]."/".$date_event[1]."/".$date_event[0];

        $hour = explode(":", $data[1]);
        $event->hour_event = $hour[0].":".$hour[1]; */

        /* if($image->type == 'image'){
            $imagem = \Storage::disk('public')->url($image->uri);
        }else{
            $imagem = $image->uri;
        } */

        return redirect()->route('journey.success', ['id'=> $token_event, 'invitee'=> $invitee->name]);
        
      /*   return view('guest-journey/success')
            ->with('event', $event)
            ->with('host', $host->name)
            ->with('token', $token_event)
            ->with('name', $convidado)
            ->with('event_pt', $event_pt > 100 ? 100 : $event_pt)
            ->with("image", $imagem)
            ->with("type_template", $image->type); */
    }

    
    public function pixPayment(Request $request, $token_event, $pix_id)
    {
        $pix = PixPayment::where('id', $pix_id)->first();
        $invitee = Invitee::where('id', $pix->invitee_id)->first();
        // valor do pix
        // qrcode
        // codigo da pagina starkbank
        // id da transação
        
        $starkBank = new StarkBankPixPayment();
        $qrcode = $starkBank->getQrCode($pix->transaction_id);

        $status_payment = $pix->status == 'credited' ? 'true' : 'false';
        
        return view('guest-journey/pix')
            ->with('token_event', $token_event)
            ->with('invitee', $invitee->name)
            ->with('status_payment', $status_payment)
            ->with('qrcode', \Storage::disk('public')->url($qrcode))
            ->with('pix', $pix);
    }


    public function conviteSuccess(Request $request, $token_event, $invitee)
    {
        $event = Campaign::where('token', "convite/".$token_event)->first();

        if(!isset($event)){
            return view('404/guest-journey');
        }

        $data = explode(" ", $event->starts_at);
        $date_event = explode("-", $data[0]);
        $event->date_event = $date_event[2]."/".$date_event[1]."/".$date_event[0];

        $hour = explode(":", $data[1]);
        $event->hour_event = $hour[0].":".$hour[1];

        $image = CampaignMedia::where('campaign_id', $event->id)->whereNull('deleted_at')->first();
        $payments = PixPayment::where('campaign_id', $event->id)->where('status', 'credited')->sum('amount');
        $event_pt = ($event->goal > 0) ? intval(number_format($payments / $event->goal, 2, '.', '') * 100) : 0;

        if($image->type == 'image'){
            $imagem = \Storage::disk('public')->url($image->uri);
        }else{
            $imagem = $image->uri;
        }

        return view('guest-journey/success')
            ->with('event', $event)
            ->with('host', "")
            ->with('token', $token_event)
            ->with('name', $invitee)
            ->with('event_pt', $event_pt > 100 ? 100 : $event_pt)
            ->with("image", $imagem)
            ->with("type_template", $image->type);
    }

    public function verifyPixPayment(Request $request){
        
        $verify = PixPayment::where('id', $request->pix_id)->first();

        if(isset($verify) && ($verify->status == 'credited' || $verify->status == 'paid')){
            return "success";
        }
        
        return "failed";
    }


    public function novoteste(Request $request){
        
        $data = OpenGraph::fetch("https://4719-177-23-190-115.sa.ngrok.io/convite/6317960e3c4937.68915568");
        dd('data', $data);
    }
}
