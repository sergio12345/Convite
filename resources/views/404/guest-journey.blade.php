<x-layout title="Guest Journey">

  <x-nav.mobile-nav backLink="/guest-journey/confirm" guest="true"></x-nav.mobile-nav>

  <div class="container pt-10 pb-6 hidden lg:block">
    <img class="h-14 mx-auto mb-10" src="{{ asset('/img/logo-horizontal.png') }}" alt="maisconvite">
  </div>

  <div class="container p-12 lg:py-28 bg-white md:bg-primary-100 lg:bg-white rounded-xl shadow-purple-100 lg:shadow-sm -mt-6 lg:mt-0 lg:mb-10 h-2/2 lg:h-3/4 flex items-center">
    <div class="text-center w-full">
      <i class="bi bi-emoji-frown text-6xl lg:text-8xl text-primary-300"></i>
      <h1 class="text-lg lg:text-2xl mt-4 mb-6 font-bold text-primary-500">Este evento não existe ou não está publicado.</h1>
      <a href="/dashboard" class="inline-flex items-center bg-danger-500 rounded-lg w-auto px-6 h-10 text-xs font-bold text-white hover:bg-opacity-90">Ir para home</a>
    </div>
  </div>

  <img class="fixed bottom-0 -left-0 -z-10 w-40 md:w-72 xl:w-80" alt="gift box" src="{{ asset('/img/decoration-balloon.png') }}">
  <img class="fixed bottom-0 right-0 -z-10 w-40 md:w-72 xl:w-80" alt="gift box" src="{{ asset('/img/gift-box.png') }}">

</x-layout>