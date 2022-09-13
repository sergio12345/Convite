<?php

namespace App\Http\Controllers;

use App\Models\CampaignMedia;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Resources\MediaResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($campaign_id)
    {
        if(!$this->campaignVerify($campaign_id)){
            return response(['error' => 'campaign_id invalid'], 404);
        }

        $media = CampaignMedia::whereNull('deleted_at')
                ->where('campaign_id', $campaign_id)
                ->get();

        return response(['data' => new MediaResource($media)], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make( $data, [
            'uri' => ['required'],
            'user_id' => ['required'],
            'campaign_id' => ['required']
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        if(!$this->campaignVerify($data['campaign_id'])){
            return response(['error' => 'campaign_id invalid'], 404);
        }     

        try {
            $media = CampaignMedia::create($data);
        } catch (QueryException $e) {
            return response(['error' => $e], 500);
        }

        return response(['data' => new MediaResource($media)], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show($campaign_id, $media_id)
    {
        if(!$this->campaignVerify($campaign_id)){
            return response(['error' => 'campaign_id invalid'], 404);
        }

        $media = CampaignMedia::whereNull('deleted_at')
                ->where('campaign_id',$campaign_id)
                ->where('id',$media_id)
                ->first();

        if(!is_null($media)){
            return response(['data' => new MediaResource($media)], 200);
        }

        return response(['message' => 'media id not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $campaign_id, $media_id)
    {
        $data = $request->all();
        $validator = Validator::make( $data, [
            'type' => ['string'],
            'uri' => ['required', 'url']
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        if(!$this->campaignVerify($campaign_id)){
            return response(['error' => 'campaign_id invalid'], 404);
        }

        $media = CampaignMedia::where('id',$media_id)
                ->where('campaign_id', $campaign_id)
                ->whereNull('deleted_at')
                ->first();

        if(!is_null($media)){
            try {
                $media->update($request->all());
            } catch (QueryException $e) {
                return response(['error' => $e], 500);
            }

            return response(['data' => new MediaResource($media)], 200);
        }

        return response(['message' => 'media id not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy($campaign_id, $media_id)
    {
        if(!$this->campaignVerify($campaign_id)){
            return response(['error' => 'campaign_id invalid'], 404);
        }

        try {
            $media = CampaignMedia::whereNull('deleted_at')
                    ->where('campaign_id', $campaign_id)
                    ->where('id', $media_id)
                    ->first();
        } catch (QueryException $e) {
            return response(['error' => $e], 500);
        }

        if(!is_null($media)){
            $media = CampaignMedia::where('id',$media_id)->delete();
            return response(['message' => 'deleted'], 200);
        }

        return response(['message' => 'media id not found'], 404);
    } 

    public function campaignVerify($campaign_id)
    {
        $campaign = Campaign::where('id',$campaign_id)->whereNull('deleted_at')->first();
        return isset($campaign) ? true : false;
    }
}
