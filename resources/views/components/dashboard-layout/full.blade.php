@props([
'title',
'name',
'email',
'initials',
])

<x-layout title="{{ $title }}">

  <main class="2xl:container lg:grid grid-cols-7">

    <x-nav.sidebar></x-nav.sidebar>

    <section class="col-span-5 lg:px-11">

      <!-- Header buttons -->
      <x-nav.top-nav name="{{ $name }}" email="{{ $email }}" initials="{{ $initials }}"></x-nav.top-nav>

      {{ $slot }}

    </section>

  </main>

  <img class="hidden lg:block fixed bottom-0 right-0 -z-10 w-72 xl:w-80" alt="gift box" src="{{ asset('/img/gift-box.png') }}">

  <x-slot:scripts>
    <script>
      var temp = document.querySelector('#show');
      if (temp) {
        Dropzone.options.Dropzone = {
          url: "/fake/location",
          autoProcessQueue: false,
          paramName: "file",
          clickable: true,
          maxFilesize: 1, //in mb
          addRemoveLinks: true,
          acceptedFiles: '.png,.jpg',
          dictDefaultMessage: "Clique aqui para carregar uma imagem de perfil",
          previewTemplate: temp.innerHTML,
          addedfile: function(file) {
            file.previewElement = Dropzone.createElement(this.options.previewTemplate)
          },
          thumbnail: function(file, dataUrl) {
            var preview = document.getElementById("preview-img")
            preview.src = dataUrl;
            preview.classList.remove('hidden')
            document.getElementById("preview-placeholder").classList.add('hidden')
          },
        };
      }
    </script>
  </x-slot:scripts>

</x-layout>