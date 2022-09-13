<x-dashboard-layout.minimal title="Create Event - Step 3" route="dashboard">
  <link href="{{ URL::asset('dist/css/datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('dist/css/datepicker-bs4.min.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('dist/css/datepicker-bulma.min.css') }}" rel="stylesheet" />
  <script src="{{ URL::asset('dist/js/datepicker.min.js') }}"></script>
  <script src="{{ URL::asset('dist/js/locales/pt-BR.js') }}"></script>
  <!-- datepicker -->
  <div class="lg:px-12 xl:px-28 lg:pt-12 lg:grid grid-cols-2">
    <div class="hidden lg:block lg:pr-16 text-center mb-10 lg:mb-0 -mt-10 lg:mt-0">

      @if($event->custom_template != null && $event->image == null)
        <div class="md:shadow-lg shadow-primary-300 relative rounded-md py-28 sm:py-40 md:py-56 lg:py-60 xl:py-64 overflow-hidden -mx-5 md:mx-0 preview-placeholder">
          <img id="templateHead" class="absolute -top-14 sm:-top-20 md:top-0 left-0 z-10 w-full" src="{{ asset('/templates/'.$event->custom_template.'/header.png') }}" alt="">
          <span class="relative z-20">
            <h2 class="text-lg xl:text-2xl font-bold mb-4">{{ $event->name }}</h2>
            <h3 class="text-md xl:text-xl  mb-2 lg:mb-3">{{ $event->date }} às {{ $event->hour }}h</h3>
            <h3 class="text-md xl:text-xl px-14 lg:px-10 xl:px-14">{{ $event->address }}</h3>
          </span>
          <img id="templateFooter" class="absolute -bottom-14 sm:-bottom-20 md:bottom-0 left-0 z-10 w-full" src="{{ asset('/templates/'.$event->custom_template.'/footer.png') }}" alt="">
        </div>
      @else
        <!-- if its a custom image show this 👇  -->
        <img src="@if(isset($event->image)) {{ $event->image }} @endif" class="w-full h-auto lg:shadow-md shadow-primary-200">
      @endif
    </div>

    <form action="{{route('post.event.stepTemplate')}}" method="POST" class="lg:pt-10 text-center lg:text-left" autocomplete="off">
      @csrf
      <ul class="hidden lg:flex gap-6 font-bold text-sm mb-8 lg:mb-12">
        <li class="text-dark-200 border-b-2 border-dark-200 pb-0.5">2 etapa</li>
        <li class="text-dark-200 border-b-2 border-dark-200 pb-0.5">3 etapa</li>
        <li class="text-primary-500 border-b-2 border-primary-500 pb-0.5">Presença</li>
      </ul>

      <h1 class="text-lg lg:text-2xl font-bold text-primary-500 mb-5 lg:mb-8">Que legal o seu evento! Estamos quase terminando</h1>

      <label class="text-xs text-dark-500 font-bold mb-5 lg:mb-2.5 block px-10 lg:px-0">Até quando os seus convidados devem confirmar presença?</label>
      <div class="grid grid-cols-10 gap-4 mb-8">
        
        <div class="relative col-span-4 mb-4 lg:mb-0">
          <i class="bi bi-calendar-event text-sm absolute right-4 top-2 text-dark-500 pointer-events-none"></i>
          <input type="text" required placeholder="selecione a data" id="date_rsvp" name="date_rsvp" value="" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
        </div>

        <div class="relative col-span-5 lg:col-span-3">
          <!-- <i class="bi bi-clock text-sm absolute right-4 top-2 text-dark-500 pointer-events-none"></i> -->
          <input placeholder="18 : 30" id="hour_rsvp" value="@if(isset($event->hour_rsvp)) {{ $event->hour_rsvp }} @endif" name="hour_rsvp" required type="time" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
        </div>

        <script>
          window.onload = function(){
            const datepicker2 = document.getElementById('date_rsvp');
            datepicker2.value = "<?php if(isset($event->date_rsvp)) echo $event->date_rsvp; else '';?>";

            const hour_rsvp = document.getElementById('hour_rsvp');
            hour_rsvp.value = "<?php if(isset($event->hour_rsvp)) echo $event->hour_rsvp; else '';?>";
          }
        </script>
      </div>

      <!-- <label class="text-xs text-dark-500 font-bold mb-5 lg:mb-2.5 block px-10 lg:px-0">Até quando os seus convidados devem confirmar presença?</label>
      <div class="border border-primary-500 rounded-lg shadow-primary-300 px-4 lg:px-6 py-3 lg:py-5 lg:mr-12 mb-10 lg:mb-10 bg-white">
        <div class="flex items-center gap-5">
          <img src="{{ asset('/templates/feminine/thumbnail.png') }}" class="w-16 h-16 object-cover">
          <div class="w-full text-left">
            <h6 class="text-xs font-bold -mb-0.5">O mundo de Amanda</h6>
            <div class="flex items-center mb-0.5">
              <div class="w-full bg-primary-300 rounded-full h-1.5">
                <div class="bg-primary-500 h-1.5 rounded-full" style="width: 45%"></div>
              </div>
              <span class="w-12 text-sm font-medium pl-2 scale-90 text-right mb-1">10%</span>
            </div>
          </div>
        </div>
      </div> -->

      <a href="/create-event/3" class="inline-flex items-center justify-center bg-white border border-danger-500 rounded-lg mr-4 w-auto px-6 h-10 text-sm font-bold text-danger-500 hover:bg-opacity-90">Voltar etapa</a>
      <button type="submit" class="bg-danger-500 rounded-lg w-auto px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90">Ver convite</button>

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