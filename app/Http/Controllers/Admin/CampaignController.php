<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use Exception;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataRestored;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Institution;
use App\Models\Campaign;
use App\Models\CampaignPayout;
use App\Models\PixPayment;
use App\Models\Invitee;

class CampaignController extends VoyagerBaseController
{
        //***************************************
    //                _____
    //               |  __ \
    //               | |__) |
    //               |  _  /
    //               | | \ \
    //               |_|  \_\
    //
    //  Read an item of our Data Type B(R)EAD
    //
    //****************************************

    public function show(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $isSoftDeleted = false;

        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $query = $model->query();

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $query = $query->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $query = $query->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$query, 'findOrFail'], $id);
            if ($dataTypeContent->deleted_at) {
                $isSoftDeleted = true;
            }
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        // Replace relationships' keys for labels and create READ links if a slug is provided.
        $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'read');

        // Check permission
        $this->authorize('read', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'read', $isModelTranslatable);

        $view = 'voyager::bread.read';

        if (view()->exists("voyager::$slug.read")) {
            $view = "voyager::$slug.read";
        }

        $institutionName = "";
        $institutionId = "";
        $campaign = Campaign::where('id', $id)->where('deleted_at', null)->first();
        if(isset($campaign) && ($campaign->institution_id != null)){
            $institution = Institution::where('id', $campaign->institution_id)->where('deleted_at', null)->first();
            if(isset($institution)){
                $institutionName = $institution->name;
                $institutionId = $institution->id;
            }
        }

        $totalCredited = 0;
        $totalCredited = PixPayment::where('status', 'credited')->where('campaign_id', $id)->sum('amount');

        $totalPaymentCampaign = 0;
        $totalPaymentCampaign = CampaignPayout::where('type', 'host_payout')->where('campaign_id', $id)->sum('amount');

        $charityPayout = CampaignPayout::where('type', 'charity_payout')->where('campaign_id', $id)->count();
        $campaignPayout = CampaignPayout::where('type', 'host_payout')->where('campaign_id', $id)->count();

        $totalPaymentCharity = 0;
        $totalPaymentCharity = CampaignPayout::where('type', 'charity_payout')->where('campaign_id', $id)->sum('amount');

        $campaignGoal = isset($campaign->goal) ? $campaign->goal : 0;

        $totalRsvp = 0;
        $totalRsvpConfirmed = 0;
        $totalRsvpConfirmed = Invitee::where('rsvp', '1')->where('campaign_id', $id)->count();
        $totalRsvp = Invitee::where('campaign_id', $id)->count();

        $taxCharity = number_format( floatval($campaign->tax_charity *  $campaignGoal) / 100, 2, ',', '.');

        if (Session::has('tabOption')){
            $pathCurrent = Session::get('tabOption');
        }else{
            $pathCurrent = "general";
        }
        
        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'isSoftDeleted'))
        ->with('institutionName', $institutionName)
        ->with('institutionId', $institutionId)
        ->with('totalCredited', $totalCredited)
        ->with('totalRsvp', $totalRsvp)
        ->with('totalRsvpConfirmed', $totalRsvpConfirmed)
        ->with('totalPaymentCampaign', $totalPaymentCampaign)
        ->with('totalPaymentCharity', $totalPaymentCharity)
        ->with('campaignGoal', $campaignGoal)
        ->with('pathCurrent', $pathCurrent)
        ->with('taxCharity', $taxCharity)
        ->with('charityPayout', $charityPayout)
        ->with('campaignPayout', $campaignPayout);
    }

    public function changeTab(Request $request){
        $tabOption = $request->get("tabOption");
        Session::put('tabOption', $tabOption);
    }

        //***************************************
    //                ______
    //               |  ____|
    //               | |__
    //               |  __|
    //               | |____
    //               |______|
    //
    //  Edit an item of our Data Type BR(E)AD
    //
    //****************************************

    public function edit(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $query = $model->query();

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $query = $query->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $query = $query->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$query, 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        foreach ($dataType->editRows as $key => $row) {
            $dataType->editRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'edit');

        // Check permission
        $this->authorize('edit', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'edit', $isModelTranslatable);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

        // POST BR(E)AD
        public function update(Request $request, $id)
        {
            $goal = str_replace(",", "", $request->goal);

            $request->merge(['goal' => $goal]);

            //dd($request->all());

            $slug = $this->getSlug($request);
    
            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
    
            // Compatibility with Model binding.
            $id = $id instanceof \Illuminate\Database\Eloquent\Model ? $id->{$id->getKeyName()} : $id;
    
            $model = app($dataType->model_name);
            $query = $model->query();
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $query = $query->{$dataType->scope}();
            }
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $query = $query->withTrashed();
            }
    
            $data = $query->findOrFail($id);
    
            // Check permission
            $this->authorize('edit', $data);
    
            // Validate fields with ajax
            $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();
    
            // Get fields with images to remove before updating and make a copy of $data
            $to_remove = $dataType->editRows->where('type', 'image')
                ->filter(function ($item, $key) use ($request) {
                    return $request->hasFile($item->field);
                });
            $original_data = clone($data);
    
            $this->insertUpdateData($request, $slug, $dataType->editRows, $data);
    
            // Delete Images
            $this->deleteBreadImages($original_data, $to_remove);
    
            event(new BreadDataUpdated($dataType, $data));
    
            if (auth()->user()->can('browse', app($dataType->model_name))) {
                $redirect = redirect()->route("voyager.{$dataType->slug}.index");
            } else {
                $redirect = redirect()->back();
            }
    
            return $redirect->with([
                'message'    => __('voyager::generic.successfully_updated')." {$dataType->getTranslatedAttribute('display_name_singular')}",
                'alert-type' => 'success',
            ]);
        }
}
