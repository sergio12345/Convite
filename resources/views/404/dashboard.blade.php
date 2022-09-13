<x-dashboard-layout.full title="Eventos" name="{{ $name }}" email="{{ $email }}" initials="{{ $initials }}">

  <x-nav.mobile-nav backLink="/"></x-nav.mobile-nav>

  <div class="p-12  lg:p-10 bg-white md:bg-primary-100 lg:bg-white rounded-xl shadow-purple-100 lg:shadow-sm -mt-6 lg:mt-0 lg:mb-10 h-2/2 lg:h-3/4 flex items-center">
    <div class="text-center w-full">
      <i class="bi bi-emoji-frown text-6xl lg:text-8xl text-primary-300"></i>
      <h1 class="text-lg lg:text-2xl mt-4 mb-6 font-bold text-primary-500">Este evento não existe.</h1>
      <a href="/home" class="inline-flex items-center bg-danger-500 rounded-lg w-auto px-6 h-10 text-xs font-bold text-white hover:bg-opacity-90">Ir para home</a>
    </div>
  </div>

</x-dashboard-layout.full>