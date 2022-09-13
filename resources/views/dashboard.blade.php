<x-dashboard-layout.full title="Home" name="{{ Auth::user()->name }}" email="{{ Auth::user()->email }}" initials="{{ $initials }}">

  <div class="bg-primary-100 px-5 lg:px-0 pb-10 lg:pb-0 lg:mb-8">
    <div class="-mx-5">
      <x-nav.mobile-nav backLink="/"></x-nav.mobile-nav>
    </div>
    <div class="flex justify-between items-center mb-4 lg:mb-8">
      <h1 class="text-lg lg:text-2xl font-bold text-primary-500">Bem-vindo, {{ Auth::user()->name }} 😀</h1>
      <a href="/create-event" class="inline-flex lg:hidden justify-center items-center bg-danger-500 h-11 w-11 rounded-full hover:opacity-90">
        <i class="bi bi-plus-lg text-white"></i>
      </a>
    </div>
    <!-- Show hide this accordingly  -->
    @if(count($events) == 0)
      <a href="/create-event" class="block w-full py-12 lg:py-28 px-10 mb-6 lg:mb-0 bg-primary-500 rounded-xl text-white bg-new-event bg-center bg-cover bg-no-repeat shadow-xl lg:shadow-none">
        <h2 class="text-lg lg:text-3xl font-bold"><i class="bi bi-plus-circle mr-4 text-2xl lg:text-4xl"></i>Crie um evento</h2>
      </a>
    @endif
  </div>

  <div class="p-5 lg:p-10 bg-white rounded-xl shadow-purple-100 lg:shadow-sm -mt-5 lg:mt-0 mb-5 lg:mb-10">
    <h2 class="text-lg lg:text-2xl font-bold text-primary-500  mb-3 lg:mb-5">Eventos</h2>
    <!-- <p class="text-dark-200 text-center py-10 text-xs lg:text-base">Você não tem nehum evento criado</p> -->
    
    <div class="md:grid grid-cols-2 gap-6">
      @foreach($events as $key => $event)
        <div id="{{ $event['id'] }}">
          <x-cards.event-card title="{{ $event['name'] }}" event_pt="{{$event['event_pt']}}" amount="{{$event['pixpayments']}}" pending="{{ $event['finished_event'] }}" id="{{ $event['id'] }}" receive_gifts="{{ $event['receive_gifts'] }}" short_description="{{ $event['short_description'] }}" goal="{{ $event['goal'] }}" image="{{ $event['banner'] }}" type_template="{{ $event['type_template'] }}">
          </x-cards.event-card>
        </div>
      @endforeach
      
    </div>
  </div>

</x-dashboard-layout.full>