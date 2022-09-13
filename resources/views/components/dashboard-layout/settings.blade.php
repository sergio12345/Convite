@props([
'title',
'name',
'email',
'initials',
'phone',
])
<x-dashboard-layout.full title="{{ $title }}" name="{{ $name }}" email="{{ $email }}" phone="{{ $phone }}" initials="{{ $initials }}">
  <x-nav.mobile-nav backLink="/"></x-nav.mobile-nav>

  <div class="bg-white rounded-xl shadow-purple-100 lg:shadow-sm -mt-6 lg:mt-0 lg:mb-10 lg:grid grid-cols-8">
    <div class="col-span-3 border-r border-primary-100 p-7 hidden lg:block">
      <h2 class="text-lg lg:text-xl font-bold text-primary-500 mb-6">Configurações</h2>
      <div class="flex items-center">
        <div class="inline-flex overflow-hidden relative justify-center items-center w-16 h-16 bg-primary-500 rounded-full">
          <span class="font-bold text-white">{{ $initials }}</span>
        </div>
        <div class="pl-3">
          <h5 class="font-bold text-sm">{{ $name }}</h5>
          <span class="text-xs block text-dark-500">{{ $email }}</span>
        </div>
      </div>

      <ul class="text-left text-xs font-bold pt-8 text-dark-500 pb-10">
        <!-- add .text-white .bg-primary-500 class to active item -->
        <li class="mb-1">
          <a href="{{ route('settings.details') }}" class="block relative rounded-lg px-5 py-3 hover:bg-primary-500 hover:text-white @if(Route::getCurrentRoute()->getName() == 'settings.details') text-white bg-primary-500 @endif">Meus Dados
            <i class="bi bi-chevron-right ml-auto inline-block float-right"></i>
          </a>
        </li>
        <li class="mb-1">
          <a href="{{ route('settings.bank') }}" class="block relative rounded-lg px-5 py-3 hover:bg-primary-500 hover:text-white @if(Route::getCurrentRoute()->getName() == 'settings.bank') text-white bg-primary-500 @endif">Minha Chave Pix
            <i class="bi bi-chevron-right ml-auto inline-block float-right"></i>
          </a>
        </li>
        <!-- <li class="mb-1">
          <a href="{{ route('settings.balance') }}" class="block relative rounded-lg px-5 py-3 hover:bg-primary-500 hover:text-white @if(Route::getCurrentRoute()->getName() == 'settings.balance') text-white bg-primary-500 @endif">Meu saldo
            <i class="bi bi-chevron-right ml-auto inline-block float-right"></i>
          </a>
        </li> -->
        <li class="mb-1">
          <a href="{{ route('settings.password') }}" class="block relative rounded-lg px-5 py-3 hover:bg-primary-500 hover:text-white @if(Route::getCurrentRoute()->getName() == 'settings.password') text-white bg-primary-500 @endif">Trocar Senha
            <i class="bi bi-chevron-right ml-auto inline-block float-right"></i>
          </a>
        </li>
        <li class="mb-1">
          <a href="{{ route('settings.policy') }}" class="block relative rounded-lg px-5 py-3 hover:bg-primary-500 hover:text-white @if(Route::getCurrentRoute()->getName() == 'settings.policy') text-white bg-primary-500 @endif">Política de Privacidade
            <i class="bi bi-chevron-right ml-auto inline-block float-right"></i>
          </a>
        </li>
        <li class="mb-1">
          <a href="{{ route('settings.termsOfUse') }}" class="block relative rounded-lg px-5 py-3 hover:bg-primary-500 hover:text-white @if(Route::getCurrentRoute()->getName() == 'settings.termsOfUse') text-white bg-primary-500 @endif">Condições e Termos de Uso
            <i class="bi bi-chevron-right ml-auto inline-block float-right"></i>
          </a>
        </li>
        <li class="mb-1">
          <form method="POST" action="{{ route('logout') }}" id="form_logout">
            @csrf
            <a href="#" onclick="document.getElementById('form_logout').submit()" class="block relative rounded-lg px-5 py-3 hover:bg-primary-500 hover:text-white">Sair da Conta
              <i class="bi bi-chevron-right ml-auto inline-block float-right"></i>
            </a>
          </form>
        </li>
        

      </ul>
    </div>
    <div class="col-span-5 px-4 py-8 lg:p-7">
      <h4 class="text-sm font-bold mb-6">{{ $title }}</h4>
      {{ $slot }}
    </div>
  </div>

</x-dashboard-layout.full>