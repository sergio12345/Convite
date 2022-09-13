@props([
'backLink',
'title',
'name',
'email',
'initials',
'guest'
])
<div class="bg-primary-100 pb-6 lg:pb-0">
  <nav class="border-b border-primary-300 py-2 grid grid-cols-8 justify-between items-center px-3 lg:hidden">

    <div class="col-span-2 flex items-center">
      @if($isTouch = isset($backLink))
     <!--    <a href="{{ route('dashboard') }}" class="text-center pt-2 text-primary-500 inline-block h-10 w-10 rounded-full hover:opacity-90 text-md active:bg-primary-500 active:text-white">
          <i class="bi bi-arrow-left"></i>
        </a> -->
      @else
      <div class="inline-flex overflow-hidden relative justify-center items-center w-10 h-10 bg-primary-500 rounded-full">
        <span class="text-white font-bold text-xs uppercase tracking-widest">pi</span>
      </div>
      @endif
    </div>

    <div class="col-span-4 text-center">
      <a href="/dashboard" class="text-xs font-medium">
        <img class="h-8 mb-1 mx-auto" src="{{ asset('/img/logo-horizontal.png') }}" alt="maisconvite">
      </a>
    </div>
    @if($isTouch = isset($guest))
    <!-- No sidebar menu for guests -->
    @else
    <div class="col-span-2 text-right">
      <button onclick="menuOpen('#mobileMenu')" class="text-primary-500 h-10 w-10 rounded-full hover:opacity-90 text-lg active:bg-primary-500 active:text-white">
        <i class="bi bi-list"></i>
      </button>
    </div>
    @endif

  </nav>
</div>


<!-- NAV MENU -->

<div id="mobileMenu" class="lg:hidden fixed top-0 bg-primary-100 w-screen min-h-screen z-50 -left-full duration-200 lg:-left-full">
  <nav class="border-b border-primary-300 py-2 grid grid-cols-8 justify-between items-center px-3 lg:hidden">
    <div class="col-span-2 flex items-center">
      <button onclick="menuClose('#mobileMenu')" class="text-center text-primary-500 inline-block h-10 w-10 rounded-full hover:opacity-90 text-md active:bg-primary-500 active:text-white">
        <i class="bi bi-arrow-left"></i>
      </button>
    </div>
    <div class="col-span-4 text-center">
      <span class="text-sm font-medium text-dark-700 opacity-80">Menu</span>
    </div>
    <div class="col-span-2 text-right">
      <button onclick="menuClose('#mobileMenu')" class="text-primary-500 h-10 w-10 rounded-full hover:opacity-90 text-lg active:bg-primary-500 active:text-white">
        <i class="bi bi-x-lg"></i>
      </button>
    </div>
  </nav>



  <div class="col-span-3 border-r border-primary-100 px-4 py-8">
    <div class="flex items-center px-3 mb-2">
      <div class="inline-flex overflow-hidden relative justify-center items-center w-14 h-14 bg-primary-500 rounded-full">
        <span class="font-bold text-white">PI</span>
      </div>
      <div class="pl-3">
        <h5 class="font-bold text-sm">Pietra Galvão</h5>
        <span class="text-xs block text-dark-500">pietra@ultrahaus.com</span>
      </div>
    </div>

    <ul class="text-left text-xs font-bold pt-4 text-dark-500">
      <li class="mb-1">
        <a href="/dashboard" class="block relative rounded-lg px-4 py-3 text-white bg-primary-500 hover:opacity-90">Dashboard
          <i class="bi bi-chevron-right ml-auto inline-block float-right"></i>
        </a>
      </li>
      <li class="mb-1">
        <a href="/events" class="block relative rounded-lg px-4 py-3 hover:opacity-90">Eventos
          <i class="bi bi-chevron-right ml-auto inline-block float-right"></i>
        </a>
      </li>
    </ul>

    <hr class="mt-3 mb-6 -mx-4">

    <h2 class="text-base lg:text-xl font-bold text-primary-500 px-4">Configurações</h2>

    <ul class="text-left text-xs font-bold pt-4 text-dark-500 pb-10">
      <li class="mb-1">
        <a href="/settings/details" class="block relative rounded-lg px-4 py-3 hover:opacity-90">Meus Dados
          <i class="bi bi-chevron-right ml-auto inline-block float-right"></i>
        </a>
      </li>
      <li class="mb-1">
        <a href="/settings/details" class="block relative rounded-lg px-4 py-3 hover:opacity-90">Minha Chave Pix
          <i class="bi bi-chevron-right ml-auto inline-block float-right"></i>
        </a>
      </li>
      <!-- <li class="mb-1">
        <a href="/settings/details" class="block relative rounded-lg px-4 py-3  hover:opacity-90">Meu saldo
          <i class="bi bi-chevron-right ml-auto inline-block float-right"></i>
        </a>
      </li> -->
      <li class="mb-1">
        <a href="" class="block relative rounded-lg px-4 py-3  hover:opacity-90">Trocar Senha
          <i class="bi bi-chevron-right ml-auto inline-block float-right"></i>
        </a>
      </li>
      <li class="mb-1">
        <a href="" class="block relative rounded-lg px-4 py-3  hover:opacity-90">Política de Privacidade
          <i class="bi bi-chevron-right ml-auto inline-block float-right"></i>
        </a>
      </li>
      <li class="mb-1">
        <a href="" class="block relative rounded-lg px-4 py-3  hover:opacity-90">Condições e Termos de Uso
          <i class="bi bi-chevron-right ml-auto inline-block float-right"></i>
        </a>
      </li>
      <li class="mb-1">
        <a href="" class="block relative rounded-lg px-4 py-3  hover:opacity-90">Sair da Conta
          <i class="bi bi-chevron-right ml-auto inline-block float-right"></i>
        </a>
      </li>

    </ul>
  </div>

</div>