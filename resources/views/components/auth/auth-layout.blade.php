@props([
'title',
'description',
'backButton',
])

<x-layout title="{{ $title }}">
  <div class="lg:container h-screen lg:flex items-center justify-center xl:px-10 xl:py-5">
    <div class="w-full xl:w-3/4 lg:rounded-xl bg-white lg:p-5 lg:shadow-2xl lg:grid grid-cols-2 lg:h-4/5">
      <div class="lg:pr-10 h-full relative text-center overflow-hidden lg:overflow-visible">
        <div class="lg:rounded-xl h-full bg-primary-500 bg-auth bg-cover text-center pb-28 pt-6 lg:pt-10">
          <a href=""><img src="{{ asset('/img/logo-light.png') }}" class="max-h-20 lg:max-h-28 inline-block relative z-20" alt=""></a>
          <img src="{{ asset('/img/auth-img.png') }}" alt="Party" class="absolute top-5 lg:top-auto lg:-bottom-5 md:left-36 lg:-left-5 pointer-events-none z-10 md:w-2/3 mx-auto lg:w-full">
        </div>
        @if($isTouch = isset($backButton))
        <a href="/" class="w-11 h-11 z-50 rounded-full absolute border top-5 -right-8 hidden lg:flex justify-center items-center text-danger-500 hover:border-danger-500 hover:bg-danger-500 hover:text-white">
          <i class="bi bi-arrow-left-short text-2xl pointer-events-none"></i>
        </a>
        @endif
      </div>
      <div class="lg:pl-5 lg:pr-10 h-full flex items-center z-30 relative">
        <div class="w-full text-center bg-white py-12 lg:py-0 px-14 lg:px-0 rounded-xl -mt-5 lg:mt-0">
          <h1 class="text-lg lg:text-2xl font-bold text-primary-500 mb-2">{{ $title }}</h1>
          <p class="text-sm text-dark-500 px-3 lg:px-10">{{ $description }}</p>
          <div class="lg:px-3 pt-7">
            {{ $slot }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-slot:scripts>
    <script>
      // Show hide/password
      function showHidePassword($this) {
        $this.parentElement.children[0].classList.toggle("hidden");
        $this.parentElement.children[1].classList.toggle("hidden");
        // $this.parentElement.children[2].type = 'text';
        if ($this.parentElement.children[2].type == 'text') {
          $this.parentElement.children[2].type = 'password';
        } else {
          $this.parentElement.children[2].type = 'text';
        }
      }
    </script>
  </x-slot:scripts>
</x-layout>