<x-dashboard-layout.minimal title="Create Event - Step 3" route="edit" event_id="{{$event_id}}">
  <link href="{{ URL::asset('dist/css/datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('dist/css/datepicker-bs4.min.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('dist/css/datepicker-bulma.min.css') }}" rel="stylesheet" />
  <script src="{{ URL::asset('dist/js/datepicker.min.js') }}"></script>
  <script src="{{ URL::asset('dist/js/locales/pt-BR.js') }}"></script>
  <!-- datepicker --> 
  <div class="lg:px-12 xl:px-28 lg:pt-12 lg:grid grid-cols-2">

    <div class="pr-16 text-center z-10 absolute top-56 left-8 w-full lg:static hidden lg:block show-on-template-select">
      <div id="templateSelected" class="@if($custom_template != 'custom_template') hidden @endif md:shadow-lg shadow-primary-300 relative rounded-md py-28 sm:py-40 md:py-56 lg:py-60 xl:py-64 overflow-hidden -mx-5 md:mx-0 preview-placeholder">
        <img id="templateHead" class="absolute -top-14 sm:-top-20 md:top-0 left-0 z-10 w-full" src="{{ asset('/templates/'.$image.'/header.png') }}" alt="">
        <span class="relative z-20">
          <h2 class="text-lg xl:text-2xl font-bold mb-4">{{ $event->name }}</h2>
          <h3 class="text-md xl:text-xl  mb-2 lg:mb-3">{{ $date_rsvp }} às {{ $hour_rsvp }}h</h3>
          <h3 class="text-md xl:text-xl px-14 lg:px-10 xl:px-14">{{ $event->address }}</h3>
        </span>
        <img id="templateFooter" class="absolute -bottom-14 sm:-bottom-20 md:bottom-0 left-0 z-10 w-full" src="{{ asset('/templates/'.$image.'/footer.png') }}" alt="">
      </div>
      
      <!-- <img src="{-{ $-event->image }}" class="w-full h-auto rounded-sm shadow-lg shadow-primary-200"> -->
      <img src="@if(isset($image) && $image != null) {{$image}} @endif" id="imageSelected" class="@if($custom_template == 'custom_template') hidden @endif w-full h-auto rounded-sm preview-img shadow-lg shadow-primary-200">

    </div>

    <form action="/edit-event-step3-template/{{$event_id}}" method="POST" class="lg:pt-10 text-center lg:text-left" autocomplete="off">
      @csrf
      <ul class="hidden lg:flex gap-6 font-bold text-sm mb-8 lg:mb-12">
        <li class="text-dark-200 border-b-2 border-dark-200 pb-0.5">2 etapa</li>
        <li class="text-dark-200 border-b-2 border-dark-200 pb-0.5">3 etapa</li>
        <li class="text-primary-500 border-b-2 border-primary-500 pb-0.5">Presença</li>
      </ul>

      <h1 class="text-lg lg:text-2xl font-bold text-primary-500 mb-5 lg:mb-8">Editar a confirmação de presença</h1>

      <label class="text-xs text-dark-500 font-bold mb-5 lg:mb-2.5 block px-10 lg:px-0">Até quando os seus convidados devem confirmar presença?</label>
      <div class="grid grid-cols-10 gap-4 mb-8">
        
        <div class="relative col-span-4 mb-4 lg:mb-0">
          <i class="bi bi-calendar-event text-sm absolute right-4 top-2 text-dark-500 pointer-events-none"></i>
          <input type="text" required placeholder="selecione a data" id="date_rsvp" name="date_rsvp" value="{{ $date_rsvp }}" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
        </div>

        <div class="relative col-span-5 lg:col-span-3">
          <input placeholder="18 : 30" id="hour_rsvp" value="{{ $hour_rsvp }}" name="hour_rsvp" required type="time" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
        </div>

      </div>

      <a href="{{route('edit.event.step3', [$event_id])}}" class="inline-flex items-center justify-center bg-white border border-danger-500 rounded-lg mr-4 w-auto px-6 h-10 text-sm font-bold text-danger-500 hover:bg-opacity-90">Voltar etapa</a>
      <button type="submit" class="bg-danger-500 rounded-lg w-auto px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90">Salvar e Continuar</button>

    </form>
    <script>
      const elem = document.querySelector('input[name="date_rsvp"]');
      const datepicker = new Datepicker(elem, {
            language: 'pt-BR',
            autohide: true,
            orientation: 'top',
      });
    </script>
  </div>
</x-dashboard-layout.minimal>