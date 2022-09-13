<x-dashboard-layout.minimal title="Create Event - Step 3" route="edit" event_id="{{$event['id']}}">
  <div class="lg:px-12 xl:px-28 lg:pt-12 lg:grid grid-cols-2">
      <div class="pr-16 text-center z-10 absolute top-56 left-8 w-full lg:static hidden lg:block show-on-template-select">
        <div id="templateSelected" class="@if($custom_template != 'custom_template') hidden @endif md:shadow-lg shadow-primary-300 relative rounded-md py-28 sm:py-40 md:py-56 lg:py-60 xl:py-64 overflow-hidden -mx-5 md:mx-0 preview-placeholder">
          <img id="templateHead" class="absolute -top-14 sm:-top-20 md:top-0 left-0 z-10 w-full" src="{{ asset('/templates/'.$image.'/header.png') }}" alt="">
          <span class="relative z-20">
            <h2 class="text-lg xl:text-2xl font-bold mb-4">{{ $event['name'] }}</h2>
            <h3 class="text-md xl:text-xl  mb-2 lg:mb-3">{{ $date_rsvp }} às {{ $hour_rsvp }}h</h3>
            <h3 class="text-md xl:text-xl px-14 lg:px-10 xl:px-14">{{ $event['address'] }}</h3>
          </span>
          <img id="templateFooter" class="absolute -bottom-14 sm:-bottom-20 md:bottom-0 left-0 z-10 w-full" src="{{ asset('/templates/'.$image.'/footer.png') }}" alt="">
        </div>
        
        <!-- <img src="{-{ $-event->image }}" class="w-full h-auto rounded-sm shadow-lg shadow-primary-200"> -->
        <img src="@if(isset($image) && $image != null) {{$image}} @endif" id="imageSelected" class="@if($custom_template == 'custom_template') hidden @endif w-full h-auto rounded-sm preview-img shadow-lg shadow-primary-200">

    </div>

    <div class="lg:pt-10 text-center lg:text-left">
      <ul class="hidden lg:flex gap-6 font-bold text-sm mb-8 lg:mb-12">
        <li class="text-dark-200 border-b-2 border-dark-200 pb-0.5">2 etapa</li>
        <li class="text-dark-200 border-b-2 border-dark-200 pb-0.5">Presença</li>
        <li class="text-primary-500 border-b-2 border-primary-500 pb-0.5">Editar Descrição!</li>
      </ul>

      <h1 class="hidden lg:block text-lg lg:text-2xl font-bold text-primary-500 mb-5 lg:mb-5">{{ $event['name'] }}</h1>

      <form action="/edit-event-step3-summery/{{$event_id}}" method="POST" class="lg:pt-10 text-center lg:text-left" autocomplete="off">
        @csrf
        <div class="mb-6">
          <textarea name="short_description" required placeholder="Ex: festa de 8 anos da Amanda, tema o Munda da Amanda... " class="border border-dark-100 p-6 pb-2 resize-none text-xs rounded-md mb-6 text-dark-500 text-left w-full focus:border-primary-500" style="height: 190px; margin-bottom: 0px;">{{$event['short_description']}}</textarea>
          <span class="italic text-dark-200" style="text-align:left; font-size: 12px;">Verifique a descrição. Você pode alterar quando quiser.</span>
        </div>

        <a href="{{ route('edit.event.step3Template', [$event_id]) }}" class="bg-white inline-flex items-center border border-danger-500 rounded-lg mr-4 w-auto px-8 h-10 text-sm font-bold text-danger-500 hover:bg-opacity-90">Voltar</a>
        <button type="submit" class="bg-danger-500  inline-flex items-center rounded-lg w-auto px-8 h-10 text-sm font-bold text-white hover:bg-opacity-90">Pronto</button>
      </form>

    </div>
  </div>
</x-dashboard-layout.minimal>