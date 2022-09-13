@if(isset($options->model) && isset($options->type))

    @if(class_exists($options->model))

        @php $relationshipField = $row->field; @endphp

        @if($options->type == 'belongsTo')

            @if(isset($view) && ($view == 'browse' || $view == 'read'))

                @php
                    $relationshipData = (isset($data)) ? $data : $dataTypeContent;
                    $model = app($options->model);
                    $query = $model::where($options->key,$relationshipData->{$options->column})->first();
                @endphp

                @if(isset($query))
                    <p>{{ $query->{$options->label} }}</p>
                @else
                    <p>{{ __('voyager::generic.no_results') }}</p>
                @endif

            @else

                <select
                    class="form-control select2-ajax" name="{{ $options->column }}"
                    data-get-items-route="{{route('voyager.' . $dataType->slug.'.relation')}}"
                    data-get-items-field="{{$row->field}}"
                    @if(!is_null($dataTypeContent->getKey())) data-id="{{$dataTypeContent->getKey()}}" @endif
                    data-method="{{ !is_null($dataTypeContent->getKey()) ? 'edit' : 'add' }}"
                    @if($row->required == 1) required @endif
                >
                    @php
                        $model = app($options->model);
                        $query = $model::where($options->key, old($options->column, $dataTypeContent->{$options->column}))->get();
                    @endphp

                    @if(!$row->required)
                        <option value="">{{__('voyager::generic.none')}}</option>
                    @endif

                    @foreach($query as $relationshipData)
                        <option value="{{ $relationshipData->{$options->key} }}" @if(old($options->column, $dataTypeContent->{$options->column}) == $relationshipData->{$options->key}) selected="selected" @endif>{{ $relationshipData->{$options->label} }}</option>
                    @endforeach
                </select>

            @endif

        @elseif($options->type == 'hasOne')

            @php
                $relationshipData = (isset($data)) ? $data : $dataTypeContent;

                $model = app($options->model);
                $query = $model::where($options->column, '=', $relationshipData->{$options->key})->first();

            @endphp

            @if(isset($query))
                <p>{{ $query->{$options->label} }}</p>
            @else
                <p>{{ __('voyager::generic.no_results') }}</p>
            @endif

        @elseif($options->type == 'hasMany')

            @if(isset($view) && ($view == 'browse' || $view == 'read'))

                @php
                    $relationshipData = (isset($data)) ? $data : $dataTypeContent;
                    $model = app($options->model);

                    $selected_values = $model::where($options->column, '=', $relationshipData->{$options->key})->get()->map(function ($item, $key) use ($options) {
                        return $item->{$options->label};
                    })->all();
                @endphp

                @if($view == 'browse')
                    {{-- @php
                        $string_values = implode(", ", $selected_values);
                        if(mb_strlen($string_values) > 25){ $string_values = mb_substr($string_values, 0, 25) . '...'; }
                    @endphp
                    @if(empty($selected_values))
                        <p>{{ __('voyager::generic.no_results') }}</p>
                    @else
                        <p>{{ $string_values }}</p>
                    @endif --}}
                @else
                    @if(empty($selected_values))
                        <p>{{ __('voyager::generic.no_results') }}</p>
                    @else
                        @if($model->slug == "invitees")
                        <div class="panel panel-bordered" style="margin-top: 10px">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead style="background: #f8fafc; color: #337ab7; font-weight: 500;"><td>ID</td><td>Name</td><td>Email</td><td>RSVP</td><td>Phone</td><td></td></thead>
                                        <tbody>
                                        @foreach($selected_values as $key=> $selected_value)
                                            <tr>
                                                <td>{{ $selected_value['id'] }}</td>
                                                <td>{{ $selected_value['name'] }}</td>
                                                <td>{{ $selected_value['email'] }}</td>
                                                <td>{{ ($selected_value['rsvp'] == "1") ? "Yes" : "No" }}</td>
                                                <td>{{ $selected_value['phone'] }}</td>
                                                <td><a href = "/admin/invitees/{{$selected_value['id']}}" target="_blank" style="text-decoration:none"><i class="glyphicon glyphicon-eye-open"></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @elseif($model->slug == "pix_payments")
                        <div class="panel panel-bordered" style="margin-top: 10px">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped" style="margin-top: 15px">
                                        <thead style="background: #f8fafc; color: #337ab7; font-weight: 500;"><td>ID</td><td>Amount R$</td><td>Transaction ID</td><td>Status</td><td>PDF</td><td></td></thead>
                                        <tbody>
                                        @foreach($selected_values as $key=> $selected_value)
                                            <tr>
                                                <td>{{ $selected_value['id'] }}</td>
                                                <td class="money2">{{ $selected_value['amount'] }}</td>
                                                <td>{{ $selected_value['transaction_id'] }}</td>
                                                <td>{{ $selected_value['status'] }}</td>
                                                <td>{{ $selected_value['pdf'] }}</td>
                                                <td><a href = "/admin/pix-payments/{{$selected_value['id']}}" target="_blank" style="text-decoration:none"><i class="glyphicon glyphicon-eye-open"></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @elseif($model->slug == "institution")
                        <div class="panel panel-bordered" style="margin-top: 10px">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped" style="margin-top: 15px">
                                        <thead style="background: #f8fafc; color: #337ab7; font-weight: 500;"><td>ID</td><td>Name</td><td>CNPJ</td><td>Amount R$</td><td>Description</td><td>Payday</td><td>Bank - agency</td></thead>
                                        <tbody>
                                        @foreach($selected_values as $key=> $selected_value)
                                            <tr>
                                                <td><a href = "/admin/institutions/{{$selected_value['id']}}" style="text-decoration:none">{{ $selected_value['id'] }}</a></td>
                                                <td>{{ $selected_value['name'] }}</td>
                                                <td>{{ $selected_value['cnpj'] }}</td>
                                                <td class="money2">{{ $selected_value['amount'] }}</td>
                                                <td>{{ $selected_value['description'] }}</td>
                                                <td>{{ $selected_value['created_at'] }}</td>
                                                <td>{{ $selected_value['bank'] }} - {{ $selected_value['agency'] }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @elseif($model->slug == "campaign_medias")
                        <div class="panel panel-bordered">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead style="background: #f8fafc; color: #337ab7; font-weight: 500;"><td>ID</td><td>Campaign ID</td><td>Uri</td></thead>
                                        <tbody>
                                        @foreach($selected_values as $key=> $selected_value)
                                            <tr>
                                                <td><a href = "/admin/campaign-medias/{{$selected_value['id']}}" style="text-decoration:none">{{ $selected_value['id'] }}</a></td>
                                                <td>{{ $selected_value['campaign_id'] }}</td>
                                                <td>{{ $selected_value['uri'] }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @elseif($model->slug == "campaign_payouts")
                            @if($typePayout == 'host_payout')
                            
                                <div class="panel panel-bordered" style="margin-top: 10px">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead style="background: #f8fafc; color: #337ab7; font-weight: 500;"><td>ID</td><td>Amount</td><td>Payment Date</td><td style="text-align: center;">Download Receipt</td></thead>
                                                <tbody>
                                                
                                                @foreach($selected_values as $key=> $selected_value)
                                                    @if($selected_value['type'] == $typePayout)
                                                        <tr>
                                                            <td>{{ $selected_value['id'] }}</td>
                                                            <td class="money2">{{ $selected_value['amount'] }}</td>
                                                            <td>{{ $selected_value['created_at'] }}</td>
                                                            @php $pathDownload = str_replace("/", ")", $selected_value['attachment']); @endphp
                                                            <td style="text-align: center;"><a href = "/download/{{$pathDownload}}" style="text-decoration:none" target="_blank"><i class="glyphicon glyphicon-download-alt"></a></td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @elseif($typePayout == 'charity_payout')
                                <div class="panel panel-bordered" style="margin-top: 10px">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead style="background: #f8fafc; color: #337ab7; font-weight: 500;"><td>ID</td><td>Charity Institution</td><td>Amount</td><td>Payment Date</td><td style="text-align: center;">Download Receipt</td></thead>
                                                <tbody>
                                                
                                                @foreach($selected_values as $key=> $selected_value)
                                                    @if($selected_value['type'] == $typePayout)
                                                        <tr>
                                                            <td>{{ $selected_value['id'] }}</td>
                                                            <td><a href = "/admin/institutions/{{$selected_value['institution_id']}}" style="text-decoration:none" target="_blank">{{ $selected_value['charity_institution'] }}</a></td>
                                                            <td class="money2">{{ $selected_value['amount'] }}</td>
                                                            <td>{{ $selected_value['created_at'] }}</td>
                                                            @php $pathDownload = str_replace("/", ")", $selected_value['attachment']); @endphp
                                                            <td style="text-align: center;"><a href = "/download/{{$pathDownload}}" style="text-decoration:none" target="_blank"><i class="glyphicon glyphicon-download-alt"></a></td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <ul>
                                @foreach($selected_values as $selected_value)
                                    <li>{{ $selected_value }}</li>
                                @endforeach
                            </ul>
                        @endif
                    @endif
                @endif

            @else

                @php
                    $model = app($options->model);
                    $query = $model::where($options->column, '=', $dataTypeContent->{$options->key})->get();
                @endphp

                @if(isset($query))
                    <ul>
                        @foreach($query as $query_res)
                            @php
                                $query_res_string = "";
                                if(is_array($query_res->{$options->label})){
                                    $query_res_string = implode(" ", $query_res->{$options->label});
                                }
                            @endphp
                            @if($query_res_string != "")
                                <li>{{ $query_res_string }}</li>
                            @else
                                <li>{{ $query_res->{$options->label} }}</li>
                            @endif
                        @endforeach
                    </ul>

                @else
                    <p>{{ __('voyager::generic.no_results') }}</p>
                @endif

            @endif

        @elseif($options->type == 'belongsToMany')

            @if(isset($view) && ($view == 'browse' || $view == 'read'))

                @php
                    $relationshipData = (isset($data)) ? $data : $dataTypeContent;

                    $selected_values = isset($relationshipData) ? $relationshipData->belongsToMany($options->model, $options->pivot_table, $options->foreign_pivot_key ?? null, $options->related_pivot_key ?? null, $options->parent_key ?? null, $options->key)->get()->map(function ($item, $key) use ($options) {
            			return $item->{$options->label};
            		})->all() : array();
                @endphp

                @if($view == 'browse')
                    @php
                        $string_values = implode(", ", $selected_values);
                        if(mb_strlen($string_values) > 25){ $string_values = mb_substr($string_values, 0, 25) . '...'; }
                    @endphp
                    @if(empty($selected_values))
                        <p>{{ __('voyager::generic.no_results') }}</p>
                    @else
                        <p>{{ $string_values }}</p>
                    @endif
                @else
                    @if(empty($selected_values))
                        <p>{{ __('voyager::generic.no_results') }}</p>
                    @else
                        <ul>
                            @foreach($selected_values as $selected_value)
                                <li>{{ $selected_value }}</li>
                            @endforeach
                        </ul>
                    @endif
                @endif

            @else
                <select
                    class="form-control select2-ajax @if(isset($options->taggable) && $options->taggable === 'on') taggable @endif"
                    name="{{ $relationshipField }}[]" multiple
                    data-get-items-route="{{route('voyager.' . $dataType->slug.'.relation')}}"
                    data-get-items-field="{{$row->field}}"
                    @if(!is_null($dataTypeContent->getKey())) data-id="{{$dataTypeContent->getKey()}}" @endif
                    data-method="{{ !is_null($dataTypeContent->getKey()) ? 'edit' : 'add' }}"
                    @if(isset($options->taggable) && $options->taggable === 'on')
                        data-route="{{ route('voyager.'.\Illuminate\Support\Str::slug($options->table).'.store') }}"
                        data-label="{{$options->label}}"
                        data-error-message="{{__('voyager::bread.error_tagging')}}"
                    @endif
                    @if($row->required == 1) required @endif
                >

                        @php
                            $selected_keys = [];
                            
                            if (!is_null($dataTypeContent->getKey())) {
                                $selected_keys = $dataTypeContent->belongsToMany(
                                    $options->model,
                                    $options->pivot_table,
                                    $options->foreign_pivot_key ?? null,
                                    $options->related_pivot_key ?? null,
                                    $options->parent_key ?? null,
                                    $options->key
                                )->pluck($options->table.'.'.$options->key);
                            }
                            $selected_keys = old($relationshipField, $selected_keys);
                            $selected_values = app($options->model)->whereIn($options->key, $selected_keys)->pluck($options->label, $options->key);
                        @endphp

                        @if(!$row->required)
                            <option value="">{{__('voyager::generic.none')}}</option>
                        @endif

                        @foreach ($selected_values as $key => $value)
                            <option value="{{ $key }}" selected="selected">{{ $value }}</option>
                        @endforeach

                </select>

            @endif

        @endif

    @else

        cannot make relationship because {{ $options->model }} does not exist.

    @endif

@endif

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>

<script>
    $('.money2').mask("#.##0,00", {reverse: true});
</script>