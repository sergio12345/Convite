<x-layout title="Estamos lhe esperando!">

  <x-nav.mobile-nav backLink="/guest-journey/" guest="true"></x-nav.mobile-nav>

  <section class="flex lg:min-h-screen items-center justify-center -mt-6 lg:mt-0">
    <div class="lg:grid grid-cols-2 gap-20 container items-center">
      <div class="mb-12 lg:mb-0">
        <div class="aspect-square overflow-hidden lg:shadow-lg shadow-primary-200 rounded-xl">
          @if($type_template == 'custom_template')
          <div class="pr-17 text-center z-10 absolute top-56 left-8 w-full lg:static hidden lg:block show-on-template-select">
            <div id="templateSelected" class="md:shadow-lg shadow-primary-300 relative rounded-md py-28 sm:py-40 md:py-56 lg:py-60 xl:py-64 overflow-hidden -mx-5 md:mx-0 preview-placeholder">
              <img id="templateHead" class="absolute -top-14 sm:-top-20 md:top-0 left-0 z-10 w-full" src="{{ asset('/templates/'.$image.'/header.png') }}" alt="">
              <span class="relative z-20">
                <h2 class="text-lg xl:text-2xl font-bold mb-4">{{ $event->name }}</h2>
                <h3 class="text-md xl:text-xl  mb-2 lg:mb-3">{{ $event->date_event }} às {{ $event->hour_event }}h</h3>
                <h3 class="text-md xl:text-xl px-14 lg:px-10 xl:px-14">{{ $event->address }}</h3>
              </span>
              <img id="templateFooter" class="absolute -bottom-14 sm:-bottom-20 md:bottom-0 left-0 z-10 w-full" src="{{ asset('/templates/'.$image.'/footer.png') }}" alt="">
            </div>
          </div>
          @else
            <img src="{{ $image }}" class="w-full h-auto">
          @endif
        </div>

        <div class="px-16 -mt-12 z-10 relative">
          <div class="shadow-xl lg:shadow:md rounded-lg shadow-primary-300 px-5 lg:px-8 py-4 lg:py-6 mb-8 bg-white">
            <p class="text-center text-sm font-bold mb-2.5">Evento ativo</p>
            @if($event->receive_gifts == 1)
                <h6 class="text-primary-500 text-xs font-medium -mb-0.5">Arrecadados</h6>
                <div class="flex items-center mb-0.5">
                  <div class="w-full bg-primary-300 rounded-full h-1.5">
                    <div class="bg-primary-500 h-1.5 rounded-full" style="width: {{$event_pt}}%"></div>
                  </div>
                  <span class="w-12 text-sm font-medium pl-2 scale-90 text-right mb-1">{{$event_pt}}%</span>
                </div>
              @endif
          </div>
        </div>
      </div>

      <div>
        <div class="text-center mb-8">
          <img class="h-14 mx-auto mb-5 hidden lg:inline-block" src="{{ asset('/img/logo-horizontal.png') }}" alt="maisconvite">
          <h1 class="font-bold text-xl lg:text-2xl mb-1">Estamos te aguardando {{$name}}🎉</h1>
          <a href="/convite/{{$token}}" style="margin-top: 15px;" class="hidden lg:inline-flex items-center bg-danger-500 rounded-lg w-auto px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90">Confirmar outra presença</a>
        </div>
        <div class="bg-white p-3 rounded-md shadow-md shadow-dark-100 hidden lg:block">
          <div class="border border-dark-100 rounded-md p-5 pb-1 text-xs font-medium text-dark-500">
            <h2 class="text-xl text-primary-500 font-bold mb-3">{{ $event->name }}</h2>
            <p class="mb-4">{{ $event->short_description }}</p>
            <p class="mb-4">Estamos ansiosos para comemorarmos juntos esse dia especial!</p>
          </div>
        </div>
      </div>

    </div>
  </section>


  <img class="fixed bottom-0 -left-0 -z-10 w-40 md:w-72 xl:w-80" alt="gift box" src="{{ asset('/img/decoration-balloon.png') }}">
  <img class="fixed bottom-0 right-0 -z-10 w-40 md:w-72 xl:w-80" alt="gift box" src="{{ asset('/img/gift-box.png') }}">

</x-layout>