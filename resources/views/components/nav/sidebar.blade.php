<aside class="hidden lg:flex h-screen col-span-2 border-r border-dark-100 lg:px-5 flex-col justify-between sticky top-0">

  <!-- Top links with logo -->
  <div class="text-center p-8 w-full">
    <a href=""><img src="{{ asset('/img/logo.png') }}" class="h-28 inline-block"></a>
    <ul class="text-left text-sm font-bold pt-8 text-dark-500">
      <li class="mb-1">
        <a href="/dashboard" class="block relative rounded-lg px-6 py-3.5 hover:bg-primary-500 hover:text-white text-white bg-primary-500">
          <i class="bi bi-house-door mr-6"></i>Eventos
          <i class="bi bi-arrow-right-short text-xl absolute top-3 right-5"></i>
        </a>
      </li>
      <!-- <li class="mb-1">
        <a href="/events" class="block relative rounded-lg px-6 py-3.5 hover:bg-primary-500 hover:text-white">
          <i class="bi bi-calendar-event mr-6"></i>Eventos
        </a>
      </li> -->
    </ul>
  </div>

  <!-- Bottom Links -->
  <div class="text-center p-8 w-full self-end">
    <ul class="text-left text-sm font-bold pt-8 text-dark-500">
      <!-- add .text-white .bg-primary-500 class to active item -->
      <li class="mb-1">
        <a href="" class="block relative rounded-lg px-6 py-3.5 hover:bg-primary-500 hover:text-white">
          <i class="bi bi-question-circle mr-6"></i>Ajuda
        </a>
      </li>
      <li class="mb-1">
        <a href="/settings/details" class="block relative rounded-lg px-6 py-3.5 hover:bg-primary-500 hover:text-white">
          <i class="bi bi-gear mr-6"></i>Configurações
        </a>
      </li>
    </ul>
  </div>

</aside>