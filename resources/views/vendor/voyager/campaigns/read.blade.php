@extends('voyager::master')

@section('page_title', __('voyager::generic.view').' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ __('voyager::generic.viewing') }} {{ ucfirst($dataType->getTranslatedAttribute('display_name_singular')) }} &nbsp;

        @can('edit', $dataTypeContent)
            <a href="{{ route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
                <i class="glyphicon glyphicon-pencil"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.edit') }}</span>
            </a>
        @endcan
        @can('delete', $dataTypeContent)
            @if($isSoftDeleted)
                <a href="{{ route('voyager.'.$dataType->slug.'.restore', $dataTypeContent->getKey()) }}" title="{{ __('voyager::generic.restore') }}" class="btn btn-default restore" data-id="{{ $dataTypeContent->getKey() }}" id="restore-{{ $dataTypeContent->getKey() }}">
                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.restore') }}</span>
                </a>
            @else
                <a href="javascript:;" title="{{ __('voyager::generic.delete') }}" class="btn btn-danger delete" data-id="{{ $dataTypeContent->getKey() }}" id="delete-{{ $dataTypeContent->getKey() }}">
                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.delete') }}</span>
                </a>
            @endif
        @endcan
        @can('browse', $dataTypeContent)
        <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
            <i class="glyphicon glyphicon-list"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.return_to_list') }}</span>
        </a>
        @endcan
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')

<script type="text/javascript">
    function updateTabCurrent(tabOption) {
        document.getElementById(tabOption).className = "tab-pane show active"; 
        if(tabOption != "general") document.getElementById("general").className = "tab-pane"; 
        if(tabOption != "invitees") document.getElementById("invitees").className = "tab-pane";
        if(tabOption != "pix-payments") document.getElementById("pix-payments").className = "tab-pane";
        if(tabOption != "campaign-payouts") document.getElementById("campaign-payouts").className = "tab-pane";
        if(tabOption != "institutions") document.getElementById("institutions").className = "tab-pane";
    }
    function updatePathCurrent(tabOption) {
        this.updateTabCurrent(tabOption);
        $.ajax({
            url: "/admin/changeTabCampaign",
            type: 'POST',
            data: {
            'tabOption': tabOption,
            },
            error : function(err) {
                console.log('Error!', err)
            },
            success: function(data) {
                console.log("success");
            }
        });
    }
</script>

<style>
    /* Style the buttons */
    .btnTabs {
        border: none;
        outline: none;
        padding: 10px 16px;
        background-color: #f1f1f1;
        cursor: pointer;
        font-size: 18px;
    }

    /* Style the active class, and buttons on mouse-over */
    .activeTabs, .btnTabs:hover {
        background-color: #678;
        color: white;
    }
</style>

<div id="TabsCampaign" style="margin-left: 35px">
    <button class="btnTabs @if($pathCurrent == 'general') activeTabs @endif" onclick="updatePathCurrent('general')">General</button>
    <button class="btnTabs @if($pathCurrent == 'invitees') activeTabs @endif" onclick="updatePathCurrent('invitees')">Invitees</button>
    <button class="btnTabs @if($pathCurrent == 'pix-payments') activeTabs @endif" onclick="updatePathCurrent('pix-payments')">Pix Payments</button>
    <button class="btnTabs @if($pathCurrent == 'campaign-payouts') activeTabs @endif" onclick="updatePathCurrent('campaign-payouts')">Payouts</button>
    <button class="btnTabs @if($pathCurrent == 'institutions') activeTabs @endif" onclick="updatePathCurrent('institutions')">Charity payouts</button>
</div>

<script>
    // Add active class to the current button (highlight it)
    var header = document.getElementById("TabsCampaign");
    var btns = header.getElementsByClassName("btnTabs");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("activeTabs");
            current[0].className = current[0].className.replace(" activeTabs", "");
            this.className += " activeTabs";
        });
    }
</script>

<div class="tab-content">
    <div class="tab-pane @if($pathCurrent == 'invitees') show active @endif" id="invitees" style="margin-left: 15px"> 
        <table class="table">
            <tr>
                <td>RSVP: {{$totalRsvpConfirmed}}/{{$totalRsvp}}</td>
            </tr>
        </table>
        
        @foreach($dataType->readRows as $row)
            @if($row->type == 'relationship' && $row->getTranslatedAttribute('display_name') == "invitees")
                    @include('voyager::formfields.relationship', ['view' => 'read', 'options' => $row->details])
            @endif
        @endforeach
    </div>
    <div class="tab-pane @if($pathCurrent == 'pix-payments') show active @endif" id="pix-payments" style="margin-left: 15px"> 
        <table class="table">
            <tr>
                <td style="width: 135px">Total credited: R$</td>
                <td class="money" style="padding-left:0">{{ $totalCredited }}</td>
                <td style="width: 140px">Goal campaign: R$</td>
                <td class="money" style="padding-left:0">{{ $campaignGoal }}</td>
            </tr>
        </table>
        
        @foreach($dataType->readRows as $row)
            @if($row->type == 'relationship' && $row->getTranslatedAttribute('display_name') == "pix_payments")
                    @include('voyager::formfields.relationship', ['view' => 'read', 'options' => $row->details])
            @endif
        @endforeach
    </div>
    <div class="tab-pane @if($pathCurrent == 'campaign-payouts') show active @endif" id="campaign-payouts" style="margin-left: 15px"> 
        <table class="table">
            <tr> 
                <td style="width: 140px">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_modal_campaign_payout">
                        <i class="voyager-plus"> </i><span class="hidden-xs hidden-sm">Add payment voucher</span>
                    </button>
                </td>
                <td style="width: 195px; padding-top: 20px;">Total payment campaign: R$</td>
                <td class="money" style="padding-left:0; padding-top: 20px;">{{ $totalPaymentCampaign }}</td>
            </tr>
        </table>

        @if($campaignPayout > 0)
            @foreach($dataType->readRows as $row)
                @if($row->type == 'relationship' && $row->getTranslatedAttribute('display_name') == "campaign_payouts")
                    @include('voyager::formfields.relationship', ['view' => 'read', 'options' => $row->details, 'typePayout' => "host_payout"])
                @endif
            @endforeach
        @else 
            <p>No results</p>
        @endif
    </div>
    <!-- institutions - charity payouts -->
    <div class="tab-pane @if($pathCurrent == 'institutions') active show @endif" id="institutions" style="margin-left: 15px"> 
        <table class="table">
            <tr> 
                <td style="width: 140px">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_modal_charity_payout">
                        <i class="voyager-plus"> </i><span class="hidden-xs hidden-sm">Add payment voucher</span>
                    </button>
                </td>
                
                @if($institutionId != "")
                    <td style="width: 180px; padding-top: 20px;">Total payment charity: R$</td>
                    <td class="money" style="padding-top: 20px;">{{ $totalPaymentCharity }}</td>
                    <td style="padding-top: 20px;">Charity Institution: <a href = "/admin/institutions/{{$institutionId}}" style="text-decoration:none" target="_blank">{{$institutionName}}</a></td>
                @else 
                    <td style="padding-left:0; padding-top: 20px;">Charity Institution: unregistered</td>
                @endif
            </tr>
        </table>

        @if($charityPayout > 0)
            @foreach($dataType->readRows as $row)
                @if($row->type == 'relationship' && $row->getTranslatedAttribute('display_name') == "campaign_payouts")
                    @include('voyager::formfields.relationship', ['view' => 'read', 'options' => $row->details, 'typePayout' => "charity_payout"])
                @endif
            @endforeach 
        @else 
            <p>No results</p>
        @endif
        
    </div>

    <!-- general - campaign -->
    <div class="tab-pane @if($pathCurrent == 'general') active show @endif" id="general">

        <div class="page-content read container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-bordered" style="padding-bottom:5px;">
                        <!-- form start -->
                        @foreach($dataType->readRows as $row)
                            @php
                            if ($dataTypeContent->{$row->field.'_read'}) {
                                $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_read'};
                            }
                            @endphp
                            <div class="panel-heading" style="border-bottom:0;">
                                @if ($row->getTranslatedAttribute('display_name') != "invitees" && $row->getTranslatedAttribute('display_name') != "pix_payments" && $row->getTranslatedAttribute('display_name') != "institutions" && $row->getTranslatedAttribute('display_name') != "campaign_payouts")
                                    <h3 class="panel-title">{{ $row->getTranslatedAttribute('display_name') }}</h3>
                                @endif
                            </div>

                            @if ($row->getTranslatedAttribute('display_name') != "invitees" && $row->getTranslatedAttribute('display_name') != "pix_payments" && $row->getTranslatedAttribute('display_name') != "institutions" && $row->getTranslatedAttribute('display_name') != "campaign_payouts")
                            <div class="panel-body" style="padding-top:0;">
                                @if (isset($row->details->view))
                                    @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => 'read', 'view' => 'read', 'options' => $row->details])
                                @elseif($row->type == "image")
                                    <img class="img-responsive"
                                        src="{{ filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field}) }}">
                                @elseif($row->type == 'multiple_images')
                                    @if(json_decode($dataTypeContent->{$row->field}))
                                        @foreach(json_decode($dataTypeContent->{$row->field}) as $file)
                                            <img class="img-responsive"
                                                src="{{ filter_var($file, FILTER_VALIDATE_URL) ? $file : Voyager::image($file) }}">
                                        @endforeach
                                    @else
                                        <img class="img-responsive"
                                            src="{{ filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field}) }}">
                                    @endif
                                @elseif($row->type == 'relationship')
                                    @if ($row->getTranslatedAttribute('display_name') != "invitees" && $row->getTranslatedAttribute('display_name') != "pix_payments" && $row->getTranslatedAttribute('display_name') != "institutions" && $row->getTranslatedAttribute('display_name') != "campaign_payouts")
                                        @include('voyager::formfields.relationship', ['view' => 'read', 'options' => $row->details])
                                    @endif
                                @elseif($row->type == 'select_dropdown' && property_exists($row->details, 'options') &&
                                        !empty($row->details->options->{$dataTypeContent->{$row->field}})
                                )
                                    <?php echo $row->details->options->{$dataTypeContent->{$row->field}};?>
                                @elseif($row->type == 'select_multiple')
                                    @if(property_exists($row->details, 'relationship'))

                                        @foreach(json_decode($dataTypeContent->{$row->field}) as $item)
                                            {{ $item->{$row->field}  }}
                                        @endforeach

                                    @elseif(property_exists($row->details, 'options'))
                                        @if (!empty(json_decode($dataTypeContent->{$row->field})))
                                            @foreach(json_decode($dataTypeContent->{$row->field}) as $item)
                                                @if (@$row->details->options->{$item})
                                                    {{ $row->details->options->{$item} . (!$loop->last ? ', ' : '') }}
                                                @endif
                                            @endforeach
                                        @else
                                            {{ __('voyager::generic.none') }}
                                        @endif
                                    @endif
                                @elseif($row->type == 'date' || $row->type == 'timestamp')
                                    @if ( property_exists($row->details, 'format') && !is_null($dataTypeContent->{$row->field}) )
                                        {{ \Carbon\Carbon::parse($dataTypeContent->{$row->field})->formatLocalized($row->details->format) }}
                                    @else
                                        {{ $dataTypeContent->{$row->field} }}
                                    @endif
                                @elseif($row->type == 'checkbox')
                                    @if(property_exists($row->details, 'on') && property_exists($row->details, 'off'))
                                        @if($dataTypeContent->{$row->field})
                                        <span class="label label-info">{{ $row->details->on }}</span>
                                        @else
                                        <span class="label label-primary">{{ $row->details->off }}</span>
                                        @endif
                                    @else
                                    {{ $dataTypeContent->{$row->field} }}
                                    @endif
                                @elseif($row->type == 'color')
                                    <span class="badge badge-lg" style="background-color: {{ $dataTypeContent->{$row->field} }}">{{ $dataTypeContent->{$row->field} }}</span>
                                @elseif($row->type == 'coordinates')
                                    @include('voyager::partials.coordinates')
                                @elseif($row->type == 'rich_text_box')
                                    @include('voyager::multilingual.input-hidden-bread-read')
                                    {!! $dataTypeContent->{$row->field} !!}
                                @elseif($row->type == 'file')
                                    @if(json_decode($dataTypeContent->{$row->field}))
                                        @foreach(json_decode($dataTypeContent->{$row->field}) as $file)
                                            <a href="{{ Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ?: '' }}">
                                                {{ $file->original_name ?: '' }}
                                            </a>
                                            <br/>
                                        @endforeach
                                    @else
                                        <a href="{{ Storage::disk(config('voyager.storage.disk'))->url($row->field) ?: '' }}">
                                            {{ __('voyager::generic.download') }}
                                        </a>
                                    @endif
                                @else
                                    @include('voyager::multilingual.input-hidden-bread-read')
                                    <p>{{ $dataTypeContent->{$row->field} }}</p>
                                @endif
                            </div><!-- panel-body -->
                            @if(!$loop->last)
                                <hr style="margin:0;">
                            @endif
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="{{ __('voyager::generic.delete_confirm') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <style>
        .center{
            padding: 40px; 
            display: flex; 
            flex-wrap: wrap; 
            justify-content: center; 
            flex-direction: column; 
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>

    <script>
        $('.money').mask("#.##0,00", {reverse: true});
    </script>

    {{-- Single add campaign payouts modal --}}
    <div class="modal modal-success fade" tabindex="-1" id="add_modal_campaign_payout" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-plus"></i> Add Campaign Payout </h4>
                </div>
                <form action="{{ route('add.campaignPayout') }}" id="campaign_payout_form" method="POST" enctype="multipart/form-data">
                
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="center">
                        <input type="hidden" name="campaign_id" value="{{ $dataTypeContent->getKey() }}" class="form-control">
                        <input type="hidden" name="type" value="host_payout" class="form-control">

                        <span class="input-group-text">Amount</span>
                        <div class="input-group mb-3">
                            <input style="margin-top: 5px; margin-bottom: 15px;" name="amount" type="text" class="form-control money" placeholder="R$ 0.00">
                        </div>

                        <span class="input-group-text">Attachment</span>
                        <input style="margin-top: 5px; margin-bottom: 15px;" name="attachment" type="file" accept="image/x-png,image/jpg,image/jpeg,application/pdf">

                    </div>

                    <div class="modal-footer">
                            <!-- <input type="submit" class="btn btn-success pull-right" value="ADD Payout..."> -->
                            <button type="submit" class="btn btn-success pull-right">Submit</button>
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    {{-- Single add charity payouts modal --}}
    <div class="modal modal-success fade" tabindex="-1" id="add_modal_charity_payout" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-plus"></i> Add Charity Payout </h4>
                </div>

                @if($institutionId != "")
                    <form action="{{ route('add.campaignPayout') }}" id="charity_payout_form" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="center">
                            <input type="hidden" name="campaign_id" value="{{ $dataTypeContent->getKey() }}" class="form-control">
                            <input type="hidden" name="type" value="charity_payout" class="form-control">

                            <span class="input-group-text">Amount</span>
                            <div class="input-group mb-3">
                                <input style="margin-top: 5px; margin-bottom: 15px;" name="amount" type="text" class="form-control money" placeholder="R$ 0.00" value="{{$taxCharity}}">
                            </div>

                            <span class="input-group-text">Attachment</span>
                            <input style="margin-top: 5px; margin-bottom: 15px;" name="attachment" type="file" accept="image/x-png,image/jpg,image/jpeg,application/pdf">
                        </div>

                        <div class="modal-footer">
                                <button type="submit" class="btn btn-success pull-right">Submit</button>
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                        </div>
                    </form>
                @else
                    <div class="center">
                        <span class="input-group-text">Unregistered Charity</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('Close') }}</button>
                    </div>
                @endif
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
    @if ($isModelTranslatable)
        <script>
            $(document).ready(function () {
                $('.side-body').multilingual();
            });
        </script>
    @endif
    <script>
        var deleteFormAction;
        $('.delete').on('click', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) {
                // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id');

            $('#delete_modal').modal('show');
        });

    </script>
@stop
