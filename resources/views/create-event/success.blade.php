<x-dashboard-layout.minimal title="Success" route="dashboard">

  <div class="w-full lg:w-3/5 mx-auto xl:px-12 text-center">
    @if(isset($errorCreateEvent))
      <h1 class="font-bold text-lg lg:text-3xl text-primary-500 lg:mt-4 mb-5 lg:mb-8">Algo deu errado!</h1>
      <img src="{{ asset('/img/auth-img.png') }}" alt="Party" class="w-64 max-w-xs mx-auto mb-3">
      <h2 class="font-bold text-md lg:text-2xl mb-4">{{$errorCreateEvent}}</h2>
      <p class="text-dark-500 font-medium text-xs opacity-70 lg:px-10">.</p>
      <div class="pb-16 pt-6">
        <a href="{{route('dashboard')}}" class="inline-flex items-center justify-center bg-white border border-danger-500 rounded-lg mr-4 w-auto px-6 h-10 lg:h-12 text-sm font-bold text-danger-500 hover:bg-opacity-90">Ir para home</a>
      </div>
    @else
      <h1 class="font-bold text-lg lg:text-3xl text-primary-500 lg:mt-4 mb-5 lg:mb-8">Evento publicado!</h1>
      <img src="{{ asset('/img/auth-img.png') }}" alt="Party" class="w-64 max-w-xs mx-auto mb-3">
      <h2 class="font-bold text-md lg:text-2xl mb-4">Vamos chamar os convidados?</h2>
      <p class="text-dark-500 font-medium text-xs opacity-70 lg:px-10">Você só precisa copiar o link da sua campanha ou enviar por e-mail, e divulgar aos seus amigos e familiares as informações sobre o evento.</p>

      <div class="mr-3 relative my-5 inline-block  w-64">
        <button onclick="copyToClipboard();" class="text-xs absolute w-10 h-10 lg:h-12 text-primary-500"><i class="bi bi-clipboard"></i></button>
        <input id="copyText" class="px-5 pl-10 border-0 bg-primary-100 text-xs font-bold text-primary-500 h-10 lg:h-12 rounded-xl w-full" type="text" value="@if(isset($url)) {{ $url }} @endif">
      </div>

      <div class="pb-16 pt-6">
        <a href="{{route('dashboard')}}" class="inline-flex items-center justify-center bg-white border border-danger-500 rounded-lg mr-4 w-auto px-6 h-10 lg:h-12 text-sm font-bold text-danger-500 hover:bg-opacity-90">Ir para home</a>
        <button type="button" data-modal-toggle="shareEventModal" class="bg-danger-500 rounded-lg w-auto px-6 h-10 lg:h-12 text-sm font-bold text-white hover:bg-opacity-90">Enviar e-mail</button>
      </div>
    @endif
    
  </div>


  <!-- Back button -->
  <!-- <div class="absolute hidden lg:block bottom-10 left-10">
    <a href="/create-event/3/summery" class="text-sm text-primary-500 font-bold hover:underline"><i class="bi bi-arrow-left mr-2"></i>Voltar</a>
  </div> -->

  <x-modal.share-event url="{{ $url }}" event="{{ $event }}"></x-modal.share-event>
</x-dashboard-layout.minimal>