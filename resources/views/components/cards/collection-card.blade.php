@props([
'name',
'amount',
'date',
])
<div class="border border-primary-300 rounded-lg flex p-4">
<i class="bi bi-flower2 text-sm"></i>
  <div class="text-xs text-dark-500 pl-3">
    <h5 class="text-dark-700 font-bold text-xs lg:text-sm mb-1">Pix recebido de R$ <span class="text-primary-500 real">{{ $amount }}</span></h5>
    <h5 class="mb-0.5">{{ $name }}</h5>
    <h5>{{ $date }}</h5>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script type="text/javascript">
  $(".real").mask('#.##0,00', {reverse: true});
</script>