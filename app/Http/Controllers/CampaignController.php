<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Campaign;
use App\Http\Resources\CampaignResource;
use App\Http\Resources\ListCampaignResource;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use App\Models\CampaignPayout;
use Intervention\Image\ImageManagerStatic as Image;

class CampaignController extends Controller
{
    public function download(Request $request, $path){
        $extension = explode(".",$path)[1];
        $path = str_replace(")", "/", $path);
        $headers = array("Content-Type: " . $extension);
        return \Storage::disk(config('services.urls.FILESYSTEM_DRIVER'))->download($path, "download" . strtotime("now") . "." . $extension, $headers);
    }
    
    public function addCampaignPayouts(Request $request){

        $data = $request->all();

        $validator = Validator::make( $data, [
            'amount' => ['required'],
            'attachment' => ['required']
        ]);

        if($validator->fails()){
            toastr()->error('Verifique os campos preenchidos!', 'Algo está errado!');
            return redirect()->back();
        }
        
        if($request->hasFile('attachment') && $request->file('attachment')){
            $requestFile = $request->attachment;
            $extension = $requestFile->extension();
            
            $fileName = md5($requestFile->getClientOriginalName() . "." . strtotime("now") . "." . $extension);
            $filePath = "campaign-payouts-admin/" . $fileName . "." . $extension;

            $path = \Storage::disk(config('services.urls.FILESYSTEM_DRIVER'))->put($filePath, file_get_contents($request->file('attachment')));
            $data['attachment'] = $filePath;
        }

        if($request->type == 'charity_payout'){
            $institutionId = Campaign::where('id', $request->campaign_id)->first();
            if(isset($institutionId)){
                $data['institution_id'] = $institutionId->institution_id;
            }
        }

        try {
            $data['amount'] = preg_replace(['/[.]/', '/[,]/'], ['', '.'], $data['amount']);
            $comprovante = CampaignPayout::create($data);
        } catch (QueryException $e) {
            return response(['error' => $e], 500);
        }

        toastr()->success('Campaign payment successfully added!');
        
        return redirect()->back();
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $campaign = Campaign::where('user_id', $request->user_id)->whereNull('deleted_at')->orderBy('created_at', 'desc')->get();

        return response(['data' => ListCampaignResource::collection($campaign)], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make( $data, [
            'name' => ['required', 'string', 'max:191'],
            'short_description' => ['required', 'string'],
            //'description' => ['required', 'string'],
            //'goal' => ['required', 'numeric'],
            'starts_at' => ['required'],
            'ends_at' => ['required']
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error'], 501);
        }

        $data['token'] = uniqid("convite/", true);
        $data['tax_charity'] = str_replace('%', '', $data['tax_charity']);

        try {
            $campaign = Campaign::create($data);
        } catch (QueryException $e) {
            return response(['error' => $e], 500);
        }
        
        return response(['data' => new CampaignResource($campaign)], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $campaign = Campaign::where('user_id', $request->user_id)->where('id', $id)->whereNull('deleted_at')->first();

        if(!is_null($campaign) && isset($campaign)){
            return response(['data' => new CampaignResource($campaign)], 200);
        }

        return response(['message' => 'id not found'], 404);
    }

    public function details($user_id, $id)
    {
        $campaign = Campaign::where('user_id', $user_id)->where('id', $id)->whereNull('deleted_at')->first();

        if(!is_null($campaign) && isset($campaign)){
            return response(['data' => new CampaignResource($campaign)], 200);
        }

        return response(['message' => 'id not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make( $data, [
            'name' => ['string', 'max:191'],
            'short_description' => ['string'],
            'description' => ['string'],
            'goal' => ['numeric']
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $campaign = Campaign::whereNull('deleted_at')->where('id',$id)->first();

        if(!is_null($campaign)){
            try {
                $campaign->update($request->all());
            } catch (QueryException $e) {
                return response(['error' => $e], 500);
            }

            return response(['data' => new CampaignResource($campaign)], 200);
        }

        return response([ 'message' => 'id not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $campaign = Campaign::whereNull('deleted_at')->where('id', $id)->first();
        } catch (QueryException $e) {
            return response(['error' => $e], 500);
        }

        if(!is_null($campaign)){
            $campaign = Campaign::where('id',$id)->delete();
            return response(['message' => 'deleted'], 200);
        }
 
        return response(['message' => 'campaign not found'], 404);
    }
}
