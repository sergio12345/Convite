@props([
'title',
'route',
'event_id'
])

<x-layout title="{{ $title }}">
  <x-nav.mobile-nav backLink="/"></x-nav.mobile-nav>

  <div class="lg:min-h-screen flex items-center">
    <div class="2xl:container container lg:p-10">
      <div class="bg-white rounded-xl lg:shadow-lg shadow-purple-100 py-10 pb-14 relative px-4 lg:px-0 -mt-6">
        <div class="w-full lg:px-10 absolute right-0 top-6 text-right  hidden lg:block">
          @if($route == 'edit')
            <div id="tooltip-event-edit-step" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                Fechar
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <a href="/events/{{$event_id}}" data-tooltip-target="tooltip-event-edit-step" class="text-danger-500 hover:text-white hover:bg-danger-500 inline-flex justify-center items-center h-11 w-11 rounded-full hover:opacity-90">
              <i class="bi bi-x-lg text-xl"></i>
            </a>
          @else
            <a href="/dashboard" class="text-danger-500 hover:text-white hover:bg-danger-500 inline-flex justify-center items-center h-11 w-11 rounded-full hover:opacity-90">
              <i class="bi bi-x-lg text-xl"></i>
            </a>
          @endif
        </div>
        {{ $slot }}
      </div>
    </div>
  </div>

  <img class="hidden lg:block fixed bottom-0 right-0 -z-10 w-72 xl:w-80" alt="gift box" src="{{ asset('/img/gift-box.png') }}">


  <x-slot:scripts>
    <script>
      var temp = document.querySelector('#show');
      console.log(temp)
      if (temp) {
        Dropzone.options.Dropzone = {
          url: "/fake/location",
          autoProcessQueue: false,
          paramName: "file",
          clickable: true,
          addRemoveLinks: true,
          thumbnailWidth: 1060,
          thumbnailHeight: 1416,
          acceptedFiles: '.png,.jpg',
          thumbnailMethod: 'contain',
          dictDefaultMessage: "Selecione uma imagem ",
          previewTemplate: temp.innerHTML,
          addedfile: function(file) {
            file.previewElement = Dropzone.createElement(this.options.previewTemplate)
          },
          thumbnail: function(file, dataUrl) {
            var preview = document.getElementsByClassName('preview-img');

            document.getElementById('image-banner').value = file.dataURL;
            document.getElementById('file_name_image').value = file.name;
            document.getElementById("custom_template").value = null;

            document.getElementById('file-name-placeholder').classList.add('hidden');
            document.getElementById('file-name').innerHTML = file.name;

            for (var i = 0; i < preview.length; i++) {
              preview[i].src = dataUrl;
              preview[i].classList.remove('hidden');
              document.getElementsByClassName("preview-placeholder")[i].classList.add('hidden')
            }

          },
        };
      }
    </script>
  </x-slot:scripts>

</x-layout>