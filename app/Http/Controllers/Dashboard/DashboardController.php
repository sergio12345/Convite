<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ListCampaignResource;
use Carbon\Carbon;
use App\Models\Campaign;
use Illuminate\Support\Collection;
use App\Models\CampaignMedia;
use App\Models\Invitee;
use App\Models\Institution;
use App\Models\PixPayment;

class DashboardController extends Controller
{
    public function index(){
        preg_match_all('/\b\w/u', Auth::user()->name, $initials);
        $initials = implode('',$initials[0]);

        $campaign = Campaign::where('user_id', Auth::user()->id)
                ->with('pixpayments')
                ->whereNull('deleted_at')
                ->orderBy('created_at', 'desc')
                ->get();
                
        $events = collect(ListCampaignResource::collection($campaign));
        $events = $events->toArray();

        return view('/dashboard')
                    ->with("events", $events)
                    ->with("initials", $initials);
    }

    public function settings(Request $request)
    {
        preg_match_all('/\b\w/u', Auth::user()->name, $initials);
        $initials = implode('',$initials[0]);

        return view('settings/details')
            ->with("email", Auth::user()->email)
            ->with("name", Auth::user()->name)
            ->with("phone", Auth::user()->phone)
            ->with("image", \Storage::disk('public')->url(Auth::user()->avatar))
            ->with("initials", $initials);
    }

    public function bank(Request $request)
    {
        $bancos = array(
            array('code' => '001', 'name' => 'Banco do Brasil'),
            array('code' => '003', 'name' => 'Banco da Amazônia'),
            array('code' => '004', 'name' => 'Banco do Nordeste'),
            array('code' => '021', 'name' => 'Banestes'),
            array('code' => '025', 'name' => 'Banco Alfa'),
            array('code' => '027', 'name' => 'Besc'),
            array('code' => '029', 'name' => 'Banerj'),
            array('code' => '031', 'name' => 'Banco Beg'),
            array('code' => '033', 'name' => 'Banco Santander'),
            array('code' => '036', 'name' => 'Banco Bem'),
            array('code' => '037', 'name' => 'Banpará'),
            array('code' => '038', 'name' => 'Banestado'),
            array('code' => '039', 'name' => 'BEP'),
            array('code' => '040', 'name' => 'Banco Cargill'),
            array('code' => '041', 'name' => 'Banrisul'),
            array('code' => '044', 'name' => 'BVA'),
            array('code' => '045', 'name' => 'Banco Opportunity'),
            array('code' => '047', 'name' => 'Banese'),
            array('code' => '062', 'name' => 'Hipercard'),
            array('code' => '063', 'name' => 'Ibibank'),
            array('code' => '065', 'name' => 'Lemon Bank'),
            array('code' => '066', 'name' => 'Banco Morgan Stanley Dean Witter'),
            array('code' => '069', 'name' => 'BPN Brasil'),
            array('code' => '070', 'name' => 'Banco de Brasília – BRB'),
            array('code' => '072', 'name' => 'Banco Rural'),
            array('code' => '073', 'name' => 'Banco Popular'),
            array('code' => '074', 'name' => 'Banco J. Safra'),
            array('code' => '075', 'name' => 'Banco CR2'),
            array('code' => '076', 'name' => 'Banco KDB'),
            array('code' => '077', 'name' => 'Banco Inter S.A.'),
            array('code' => '096', 'name' => 'Banco BMF'),
            array('code' => '104', 'name' => 'Caixa Econômica Federal'),
            array('code' => '107', 'name' => 'Banco BBM'),
            array('code' => '116', 'name' => 'Banco Único'),
            array('code' => '121', 'name' => 'Banco Agibank S.A.'),
            array('code' => '151', 'name' => 'Nossa Caixa'),
            array('code' => '175', 'name' => 'Banco Finasa'),
            array('code' => '184', 'name' => 'Banco Itaú BBA'),
            array('code' => '204', 'name' => 'American Express Bank'),
            array('code' => '208', 'name' => 'Banco Pactual'),
            array('code' => '212', 'name' => 'Banco Original'),
            array('code' => '213', 'name' => 'Banco Arbi'),
            array('code' => '214', 'name' => 'Banco Dibens'),
            array('code' => '217', 'name' => 'Banco Joh Deere'),
            array('code' => '218', 'name' => 'Banco Bonsucesso'),
            array('code' => '222', 'name' => 'Banco Calyon Brasil'),
            array('code' => '224', 'name' => 'Banco Fibra'),
            array('code' => '225', 'name' => 'Banco Brascan'),
            array('code' => '229', 'name' => 'Banco Cruzeiro'),
            array('code' => '230', 'name' => 'Unicard'),
            array('code' => '233', 'name' => 'Banco GE Capital'),
            array('code' => '237', 'name' => 'Bradesco'),
            array('code' => '241', 'name' => 'Banco Clássico'),
            array('code' => '243', 'name' => 'Banco Stock Máxima'),
            array('code' => '246', 'name' => 'Banco ABC Brasil'),
            array('code' => '248', 'name' => 'Banco Boavista Interatlântico'),
            array('code' => '249', 'name' => 'Investcred Unibanco'),
            array('code' => '250', 'name' => 'Banco Schahin'),
            array('code' => '252', 'name' => 'Fininvest'),
            array('code' => '254', 'name' => 'Paraná Banco'),
            array('code' => '260', 'name' => 'Nubank'),
            array('code' => '263', 'name' => 'Banco Cacique'),
            array('code' => '265', 'name' => 'Banco Fator'),
            array('code' => '266', 'name' => 'Banco Cédula'),
            array('code' => '280', 'name' => 'Banco Willbank'),
            array('code' => '290', 'name' => 'Pagseguro Internet S.A (PagBank)'),
            array('code' => '300', 'name' => 'Banco de la Nación Argentina'),
            array('code' => '318', 'name' => 'Banco BMG'),
            array('code' => '320', 'name' => 'Banco Industrial e Comercial'),
            array('code' => '323', 'name' => 'Mercado Pago'),
            array('code' => '335', 'name' => 'Banco Digio S.A.'),
            array('code' => '336', 'name' => 'Banco C6 S.A – C6 Bank'),
            array('code' => '356', 'name' => 'ABN Amro Real'),
            array('code' => '341', 'name' => 'Itau'),
            array('code' => '347', 'name' => 'Sudameris'),
            array('code' => '351', 'name' => 'Banco Santander'),
            array('code' => '353', 'name' => 'Banco Santander Brasil'),
            array('code' => '366', 'name' => 'Banco Societe Generale Brasil'),
            array('code' => '370', 'name' => 'Banco WestLB'),
            array('code' => '376', 'name' => 'JP Morgan'),
            array('code' => '380', 'name' => 'PicPay Servicos S.A.'),
            array('code' => '389', 'name' => 'Banco Mercantil do Brasil'),
            array('code' => '394', 'name' => 'Banco Mercantil de Crédito'),
            array('code' => '399', 'name' => 'HSBC'),
            array('code' => '409', 'name' => 'Unibanco'),
            array('code' => '412', 'name' => 'Banco Capital'),
            array('code' => '422', 'name' => 'Banco Safra'),
            array('code' => '453', 'name' => 'Banco Rural'),
            array('code' => '456', 'name' => 'Banco Tokyo Mitsubishi UFJ'),
            array('code' => '464', 'name' => 'Banco Sumitomo Mitsui Brasileiro'),
            array('code' => '477', 'name' => 'Citibank'),
            array('code' => '479', 'name' => 'Itaubank (antigo Bank Boston)'),
            array('code' => '487', 'name' => 'Deutsche Bank'),
            array('code' => '488', 'name' => 'Banco Morgan Guaranty'),
            array('code' => '492', 'name' => 'Banco NMB Postbank'),
            array('code' => '494', 'name' => 'Banco la República Oriental del Uruguay'),
            array('code' => '495', 'name' => 'Banco La Provincia de Buenos Aires'),
            array('code' => '505', 'name' => 'Banco Credit Suisse'),
            array('code' => '600', 'name' => 'Banco Luso Brasileiro'),
            array('code' => '604', 'name' => 'Banco Industrial'),
            array('code' => '610', 'name' => 'Banco VR'),
            array('code' => '611', 'name' => 'Banco Paulista'),
            array('code' => '612', 'name' => 'Banco Guanabara'),
            array('code' => '613', 'name' => 'Banco Pecunia'),
            array('code' => '623', 'name' => 'Banco Panamericano'),
            array('code' => '626', 'name' => 'Banco Ficsa'),
            array('code' => '630', 'name' => 'Banco Intercap'),
            array('code' => '633', 'name' => 'Banco Rendimento'),
            array('code' => '634', 'name' => 'Banco Triângulo'),
            array('code' => '637', 'name' => 'Banco Sofisa'),
            array('code' => '638', 'name' => 'Banco Prosper'),
            array('code' => '643', 'name' => 'Banco Pine'),
            array('code' => '652', 'name' => 'Itaú Holding Financeira'),
            array('code' => '653', 'name' => 'Banco Indusval'),
            array('code' => '654', 'name' => 'Banco A.J. Renner'),
            array('code' => '655', 'name' => 'Banco Votorantim'),
            array('code' => '707', 'name' => 'Banco Daycoval'),
            array('code' => '719', 'name' => 'Banif'),
            array('code' => '721', 'name' => 'Banco Credibel'),
            array('code' => '734', 'name' => 'Banco Gerdau'),
            array('code' => '735', 'name' => 'Banco Pottencial'),
            array('code' => '738', 'name' => 'Banco Morada'),
            array('code' => '739', 'name' => 'Banco Galvão de Negócios'),
            array('code' => '740', 'name' => 'Banco Barclays'),
            array('code' => '741', 'name' => 'BRP'),
            array('code' => '743', 'name' => 'Banco Semear'),
            array('code' => '745', 'name' => 'Banco Citibank'),
            array('code' => '746', 'name' => 'Banco Modal'),
            array('code' => '747', 'name' => 'Banco Rabobank International'),
            array('code' => '748', 'name' => 'Banco Cooperativo Sicredi'),
            array('code' => '749', 'name' => 'Banco Simples'),
            array('code' => '751', 'name' => 'Dresdner Bank'),
            array('code' => '752', 'name' => 'BNP Paribas'),
            array('code' => '753', 'name' => 'Banco Comercial Uruguai'),
            array('code' => '755', 'name' => 'Banco Merrill Lynch'),
            array('code' => '756', 'name' => 'Banco Cooperativo do Brasil'),
            array('code' => '757', 'name' => 'KEB'),
        );

        preg_match_all('/\b\w/u', Auth::user()->name, $initials);
        $initials = implode('',$initials[0]);

        return view('settings/bank')
            ->with("user", Auth::user())
            ->with("banks", $bancos)
            ->with("phone", Auth::user()->phone)
            ->with("initials", $initials);
    }

    public function balance(Request $request)
    {
        preg_match_all('/\b\w/u', Auth::user()->name, $initials);
        $initials = implode('',$initials[0]);

        return view('settings/balance')
            ->with("email", Auth::user()->email)
            ->with("name", Auth::user()->name)
            ->with("initials", $initials);
    }

    public function password(Request $request)
    {
        preg_match_all('/\b\w/u', Auth::user()->name, $initials);
        $initials = implode('',$initials[0]);

        return view('settings/password')
            ->with("user", Auth::user())
            ->with("initials", $initials);
    }

    public function policy(Request $request)
    {
        preg_match_all('/\b\w/u', Auth::user()->name, $initials);
        $initials = implode('',$initials[0]);

        return view('settings/policy')
            ->with("email", Auth::user()->email)
            ->with("name", Auth::user()->name)
            ->with("initials", $initials);
    }

    public function termsOfUse(Request $request)
    {
        preg_match_all('/\b\w/u', Auth::user()->name, $initials);
        $initials = implode('',$initials[0]);

        return view('settings/termsOfUse')
            ->with("email", Auth::user()->email)
            ->with("name", Auth::user()->name)
            ->with("initials", $initials);
    }

    public function events(Request $request, $event_id)
    {
        $campaign = Campaign::where('user_id', Auth::user()->id)->where('id', $event_id)->whereNull('deleted_at')->first();
        
        if(!isset($campaign)){
            preg_match_all('/\b\w/u', Auth::user()->name, $initials);
            $initials = implode('',$initials[0]);
            return view('404/dashboard')
                ->with("email", Auth::user()->email)
                ->with("name", Auth::user()->name)
                ->with("initials", $initials);
        }

        $events = collect($campaign);
        $events = $events->toArray();

        $image = CampaignMedia::where('campaign_id', $event_id)->first();
        
        if($image->type == 'image'){
            $imagem = \Storage::disk('public')->url($image->uri);
        }else{
            $imagem = $image->uri;
        }
        $events['type_template'] = $image->type;
        $events['banner'] = $imagem;

        $invitees = Invitee::where('campaign_id', $event_id)->count();
        $inviteesConfirmed = Invitee::where('campaign_id', $event_id)->where('rsvp', 'yes')->count();
        $events['number_of_invitees'] = $invitees;
        $events['number_of_invitees_confirmed'] = $inviteesConfirmed;
        $events['shareable_link'] = $events['token'];

        // date starts_at
        $data = explode(" ", $events['starts_at']);
        $date_event = explode("-", $data[0]);
        $events['date_event'] = $date_event[2]."/".$date_event[1]."/".$date_event[0];
        $hour = explode(":", $data[1]);
        $events['hour_event'] = $hour[0].":".$hour[1];

        // date rsvp
        $date2 = explode(" ", $events['date_rsvp']);
        $date_event_rsvp = explode("-", $date2[0]);
        $events['date_rsvp'] = $date_event_rsvp[2]."/".$date_event_rsvp[1]."/".$date_event_rsvp[0];
        $hour = explode(":", $date2[1]);
        $events['hour_rsvp'] = $hour[0].":".$hour[1];

        $events['shareable_link'] = config('services.urls.APP_URL') . "/" . $events['shareable_link'];

        $length = strlen($events['short_description']);
        $events['short_description2'] = $length > 60 ? substr($events['short_description'],0,60) . "..." : $events['short_description'];

        // verificar se o evento já terminou
        $now = Carbon::today()->toDateString();
        $ends_at = Carbon::parse($events['ends_at'])->toDateString();//->format('M d Y');

        $events['finished_event'] = 0;
        if($now > $ends_at){
            $events['finished_event'] = 1;
        }

        if($events['donate_to_charity'] == 1){
            $institution = Institution::where('id', $events['institution_id'])->first();
            $events['institution_name'] = $institution->name;
        }

        // convidados
        $invitees = Invitee::where('campaign_id', $event_id)
            ->with('pixpayments')
            ->get();
        $invitees = collect($invitees);
        $invitees = $invitees->toArray();

        // arrecadação
        $payments = PixPayment::where('campaign_id', $event_id)
            ->with('invitees')
            ->where('status', 'credited')->get();
        $events['total_amount'] = number_format($payments->sum('amount'), 2, '.', '');
        $events['event_pt'] = ($events['goal'] > 0) ? floatval(number_format($events['total_amount'] / $events['goal'], 2, '.', '') * 100) : 0;

        $payments = collect($payments)->toArray();

        foreach ($invitees as $key => $invitee) {
            preg_match_all('/\b\w/u', $invitee['name'], $initials);
            $invitees[$key]['initials'] = implode('',$initials[0]);
        }

        preg_match_all('/\b\w/u', Auth::user()->name, $initials);
        $initials = implode('',$initials[0]);

        return view('events')
            ->with("email", Auth::user()->email)
            ->with("name", Auth::user()->name)
            ->with("initials", $initials)
            ->with("invitees", $invitees)
            ->with("payments", $payments)
            ->with("event", $events);
    }
}
