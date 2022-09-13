<input type="text"
       class="form-control rounded-form"
       name="{{ $row->field }}"
       data-name="{{ $row->display_name }}"
       id="cnpj2"
       maxlength="18"
       onkeypress="digitar(event)"
       @if($row->required == 1) required @endif
             step="any"
       placeholder="{{ isset($options->placeholder)? old($row->field, $options->placeholder): $row->display_name }}"
       value="@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@else{{old($row->field)}}@endif">

<script>
      document.getElementById('cnpj2').addEventListener('input', function (e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,3})(\d{0,4})(\d{0,2})/);
            e.target.value = !x[2] ? x[1] : x[1] + '.' + x[2] + '.' + x[3] + '/' + x[4] + (x[5] ? '-' + x[5] : '');
      });

      function digitar(event){
            var x = event.keyCode;        
            var y = String.fromCharCode(x);   
      }
      
</script>