@props([
'title',
'pending',
'short_description',
'goal',
'image',
'id',
'receive_gifts',
'amount',
'event_pt',
'type_template'
])
<div class="border border-dark-100 rounded-lg p-3.5 grid grid-cols-3 mb-4 lg:mb-0 relative items-center">
  <div class="bg-primary-500 aspect-square rounded-md overflow-hidden flex items-center">

    @if($type_template == 'custom_template')
      <img src="{{ asset('/templates/'.$image.'/thumbnail.png') }}" class="object-cover aspect-square" onclick="redirectEvent({{$id}})" alt="feminine">
    @else
      <img src="@if(isset($image) && $image != null) {{asset( $image )}} @else {{asset('/img/banner.png')}} @endif" onclick="redirectEvent({{$id}})" class="object-cover aspect-square">
    @endif
    
  </div>
  <div class="col-span-2 pl-3 py-1">
    <h4 class="text-sm font-bold mb-1" onclick="redirectEvent({{$id}})">{{ $title }}</h4>
    
    @if($isTouch = isset($pending) && $pending == 1)
      <a href="#" class="bg-danger-500 text-xs text-white  rounded-md font-bold h-8 inline-flex items-center px-4 hover:opacity-80">Finalizado</a>
    @else
      <span class="text-xs block leading-4 text-dark-500 mb-2 scale-90 -mx-3" onclick="redirectEvent({{$id}})">{{ $short_description }}</span>

      @if($receive_gifts == 1)
        <h5 class="text-xs font-bold" onclick="redirectEvent({{$id}})">R$ <span class="inline-block scale-100 real">{{ $amount }}</span> / R$<span class="inline-block scale-100 real">{{ $goal }}</span></h5>
        <div class="flex items-center mb-1">
          <div class="w-full bg-primary-300 rounded-full h-1">
            <?php $escale = $event_pt > 100 ? $escale = 100 : $escale = $event_pt; ?>
            <div class="bg-primary-500 h-1 rounded-full" style="width: {{$escale}}%"></div>
          </div>
          
          <span class="w-12 text-xs pl-2 scale-90">{{ $event_pt }}%</span>
        </div>
      @else
        <p class="italic leading-normal" style="font-size: 10px;">O recebimento de presentes está desativado. Você pode habilitar a qualquer momento, <a href="/edit-event-step2/{{$id}}">clicando aqui.</a></p>
      @endif

      <div class="flex -space-x-1.5">
        <!-- <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://randomuser.me/api/portraits/men/35.jpg">
        <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://randomuser.me/api/portraits/women/79.jpg">
        <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://api.uifaces.co/our-content/donated/AVQ0V28X.jpg">
        <a class="flex justify-center items-center bg-white w-6 h-6 text-xs font-bold border border-primary-500 text-primary-500 rounded-full border-1 hover:bg-primary-500 hover:text-white" href="#">
          <span class="block scale-75">+19</span>
        </a> -->
      </div>
    @endif
  </div>

  <!-- Dropdown actions -->
  <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="text-primary-500 absolute right-2 top-3.5 text-sm" type="button">
    <i class="bi bi-three-dots-vertical"></i>
  </button>
  <!-- Dropdown menu -->
  <div id="dropdown" class="hidden z-10 w-40 bg-white rounded shadow-lg shadow-primary-200">
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
  <script type="text/javascript">
    $(".real").mask('#.##0,00', {reverse: true});
  </script>

  <script>
    function redirectEvent(id) {
      console.log("id", id);
      window.location.href = 'events/' + id;
    }
  </script>

</div>