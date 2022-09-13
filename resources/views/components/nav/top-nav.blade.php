@props([
'title',
'name',
'email',
'initials',
])
<div class="w-full text-en py-5 hidden lg:flex items-center justify-between mb-5 lg:mb-0">

  <div>
    @if(Route::getCurrentRoute()->getName() != 'dashboard')
      <a href="{{ route('dashboard') }}" class="text-sm text-primary-500 font-bold hover:underline"><i class="bi bi-arrow-left mr-2"></i>Voltar</a>
    @endif
  </div>

  <div>
    <a href="/create-event" data-tooltip-target="tooltip-event" class="inline-flex items-center justify-center bg-danger-500 h-11 w-11 rounded-full hover:bg-opacity-80 duration-200">
      <i class="bi bi-plus-lg text-white"></i>
    </a>
    <div id="tooltip-event" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
        Criar Evento
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <button data-tooltip-target="tooltip-notification" class="bg-white text-danger-500 h-11 w-11 mx-4 rounded-full hover:text-white hover:bg-danger-500 duration-200" data-dropdown-toggle="notifications">
      <i class="bi bi-bell"></i>
    </button>
    <div id="tooltip-notification" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
        Notificações
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <div data-tooltip-target="tooltip-name" class="inline-flex overflow-hidden relative justify-center hover:text-white hover:bg-indigo-500 duration-200 items-center w-11 h-11 bg-primary-500 rounded-full">
      <span class="text-white font-bold text-sm uppercase tracking-widest">{{ $initials }}</span>
    </div>
    <div id="tooltip-name" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
        {{ Auth::user()->name }}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
  </div>
</div>

<!-- Notifications -->
<div id="notifications" class="hidden z-10 bg-white rounded-lg shadow-md shadow-primary-300 w-3/4 md:w-2/5 xl:w-3/12 2xl:w-1/5 px-8 pt-8 pb-4">
  <h3 class="text-lg font-bold text-primary-500 mb-5">Notificações</h3>
  <ul>
    <li class="mb-5">
      <h5 class="text-xs font-bold mb-1">Lucas Carvalho aceitou seu convite</h5>
      <span class="text-xs text-dark-500 block scale-90 -ml-4">5 min</span>
      <a href="" class="inline-block font-bold text-xs text-danger-500 hover:opacity-60">+ ver detalhes</a>
    </li>
    <li class="mb-5">
      <h5 class="text-xs font-bold mb-1">Evento “O Mundo de Amanda” foi criado</h5>
      <span class="text-xs text-dark-500 block scale-90 -ml-4">25 min</span>
      <a href="" class="inline-block font-bold text-xs text-danger-500 hover:opacity-60">+ ver detalhes</a>
    </li>
    <li class="mb-5">
      <h5 class="text-xs font-bold mb-1">Rafaela Calixto aceitou seu convite</h5>
      <span class="text-xs text-dark-500 block scale-90 -ml-4">12 de Junho, 2022 | às 18h45.</span>
      <a href="" class="inline-block font-bold text-xs text-danger-500 hover:opacity-60">+ ver detalhes</a>
    </li>
    <li class="mb-5">
      <h5 class="text-xs font-bold mb-1">Evento “O circo da Ana Luisa” foi criado</h5>
      <span class="text-xs text-dark-500 block scale-90 -ml-4">10 de Junho, 2022 | às 12h23.</span>
      <a href="" class="inline-block font-bold text-xs text-danger-500 hover:opacity-60">+ ver detalhes</a>
    </li>
  </ul>
</div>