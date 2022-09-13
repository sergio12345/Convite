<input type="text"
       class="form-control rounded-form"
       name="{{ $row->field }}"
       data-name="{{ $row->display_name }}"
       id="cpf2"
       maxlength="11"
       onkeypress="return event.charCode >= 48 && event.charCode <= 57"
       @if($row->required == 1) required @endif
             step="any"
       placeholder="{{ isset($options->placeholder)? old($row->field, $options->placeholder): $row->display_name }}"
       value="@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@else{{old($row->field)}}@endif">
