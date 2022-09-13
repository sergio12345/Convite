<x-dashboard-layout.minimal title="Create Event - Step 1" route="dashboard">

  <link href="{{ URL::asset('dist/css/datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('dist/css/datepicker-bs4.min.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('dist/css/datepicker-bulma.min.css') }}" rel="stylesheet" />
  <script src="{{ URL::asset('dist/js/datepicker.min.js') }}"></script>
  <script src="{{ URL::asset('dist/js/locales/pt-BR.js') }}"></script>
  <!-- datepicker -->

<link href="dist/css/datepicker-foundation.min.css" rel="stylesheet" />
  <div class="w-full lg:w-3/5 mx-auto xl:px-12">
    <ul class="flex gap-6 font-bold text-sm mb-8 lg:mb-12">
      <li class="text-primary-500 border-b-2 border-primary-500 pb-0.5">1 etapa</li>
      <li class="text-dark-200 border-b-2 border-dark-200 pb-0.5">2 etapa</li>
      <li class="text-dark-200 border-b-2 border-dark-200 pb-0.5">3 etapa</li>
    </ul>
    <h1 class="text-lg lg:text-2xl font-bold text-primary-500 mb-5 lg:mb-8">{{ Auth::user()->name }}, cadastre seu evento!</h1>
    <form action="{{route('post.event.step')}}" method="POST" autocomplete="off">
      @csrf
      <div class="mb-6">
        <label for="" class="text-xs font-bold block mb-1.5 text-dark-500">Título do evento</label>
        <input type="text" name="name" value="@if(isset($event->name)) {{ $event->name }} @endif" placeholder="Ex: festa do pijama da Amanda..." required class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
      </div>

      <div class="mb-6">
        <label for="" class="text-xs font-bold block mb-2.5 text-dark-500">Formato do evento</label>
        <div class="flex">
          <div class="flex items-center mr-4">
            <input checked id="presencial-checkbox" type="radio" @if(isset($event->event_format) && $event->event_format == 'presential') checked @endif name="event_format" value="presential" class="w-4 h-4  text-purple-600 rounded-full border-gray-300 focus:ring-0  ">
            <label for="presencial-checkbox" class="ml-2 text-xs font-medium text-dark-500">Presencial</label>
          </div>
          <div class="flex items-center mr-4">
            <input id="virtual-checkbox" type="radio" @if(isset($event->event_format) && $event->event_format == 'virtual') checked @endif value="virtual" name="event_format" class="w-4 h-4  text-purple-600 rounded-full border-gray-300 focus:ring-0  ">
            <label for="virtual-checkbox" class="ml-2 text-xs font-medium text-dark-500">Virtual</label>
          </div>
        </div>
      </div>

      <div class="mb-6">
        <label for="" class="text-xs font-bold block mb-2.5 text-dark-500">Endereço do Evento</label>
        <input type="text" name="address" value="@if(isset($event->address)) {{ $event->address }} @endif" placeholder="Endereço do evento" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
      </div>

      <label for="" class="text-xs font-bold block mb-2.5 text-dark-500">Data do Evento</label>
      <div class="mb-6 lg:grid grid-cols-10 gap-4">

        <div class="relative col-span-4 mb-4 lg:mb-0">
          <i class="bi bi-calendar-event text-sm absolute right-4 top-2 text-dark-500 pointer-events-none"></i>
          <input type="text" required placeholder="selecione a data" id="date" name="date" value="" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
        </div>
        
        <!-- <div class="relative col-span-4 mb-4 lg:mb-0">
          <i class="bi bi-calendar-event text-sm absolute right-4 top-2 text-dark-500 pointer-events-none"></i>
          <input datepicker datepicker-autohide="true" name="date" required id="datepicker" value="@if(isset($event->date)) {{ $event->date }} @endif" placeholder="Data escolhida" type="text" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
        </div> -->

        <div class=" col-span-3">
          <input placeholder="18 : 30" id="hour_event" value="@if(isset($event->hour)) {{ $event->hour }} @endif" name="hour" required type="time" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
        </div>
      </div>

      <script>
        window.onload = function(){
          const hour = document.getElementById('hour_event');
          hour.value = "<?php if(isset($event->hour)) echo $event->hour; else '';?>";

          const datepicker = document.getElementById('date');
          datepicker.value = "<?php if(isset($event->date)) echo $event->date; else '';?>";
        }
      </script>

      <button type="submit" class="inline-flex items-center bg-danger-500 rounded-lg w-auto px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90">Continuar</button>

    </form>

    <script>
      const elem = document.querySelector('input[name="date"]');
      const datepicker = new Datepicker(elem, {
            language: 'pt-BR',
            autohide: true,
            orientation: 'top',
      });
    </script>
  </div>
  </x-dashboard-layouts.minimal>