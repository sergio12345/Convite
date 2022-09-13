@props([
'status',
'name',
'initials',
'pix',
'pix_status',
])
<div class="grid grid-cols-3 lg:grid-cols-5 text-xs lg:text-sm font-bold px-3 items-center py-2 lg:py-2.5">

  <div class="col-span-2 flex items-center gap-2 lg:gap-3">
    <div class="inline-flex overflow-hidden relative justify-center items-center w-8 lg:w-10 h-8 lg:h-10 rounded-full bg-primary-500">
      <span class="font-bold text-xs lg:text-sm text-white">{{ $initials }}</span>
    </div>
    {{ $name }}
  </div>

  
  @if($pix_status != 'credited')
    <span class="hidden lg:block text-red-600">R$ <span class="real">{{ $pix }}</span></span>
  @else
    <span class="hidden lg:block">R$ <span class="real">{{ $pix }}</span></span>
  @endif

  <div class="lg:text-center">
    @if($isTouch = isset($status) && $status === 'no')
    <span class="flex w-8 lg:w-10 h-8 lg:h-10 rounded-full bg-danger-500 text-white justify-center items-center ml-auto lg:mx-auto">
      <i class="bi bi-x-lg"></i>
    </span>
    @elseif($isTouch = isset($status) && $status === 'yes')
    <span class="flex w-8 lg:w-10 h-8 lg:h-10 rounded-full bg-emerald-400 text-white justify-center items-center ml-auto lg:mx-auto">
      <i class="bi bi-check-lg"></i>
    </span>
    @else
    <span class="flex w-8 lg:w-10 h-8 lg:h-10 rounded-full bg-amber-400 text-white justify-center items-center ml-auto lg:mx-auto">
      <i class="bi bi-question-lg"></i>
    </span>
    @endif
  </div>

  <div class="text-right hidden lg:block">
    <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="text-primary-500 text-sm" type="button">
      <i class="bi bi-three-dots"></i>
    </button>
    <!-- Dropdown menu -->
    <div id="dropdown" class="hidden z-10 w-40 bg-white rounded shadow-lg shadow-primary-200 text-left">
      <ul class="py-1 text-xs font-medium text-gray-700" aria-labelledby="dropdownDefault">
        <li>
          <a href="#" class="block py-2.5 px-4 hover:bg-primary-100 hover:bg-opacity-50"><i class="bi bi-send mr-2"></i>Send Card</a>
        </li>
        <li>
          <a href="#" class="block py-2.5 px-4 hover:bg-primary-100 hover:bg-opacity-50"><i class="bi bi-pencil mr-2"></i>Edit Card</a>
        </li>
        <li>
          <a href="#" class="block py-2.5 px-4 text-danger-500 hover:bg-primary-100 hover:bg-opacity-50"><i class="bi bi-trash mr-2"></i>Delete Card</a>
        </li>
      </ul>
    </div>
  </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script type="text/javascript">
  $(".real").mask('#.##0,00', {reverse: true});
</script>