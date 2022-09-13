<x-dashboard-layout.minimal title="Create Event - Step 3" route="edit" event_id="{{$event_id}}">
  <div class="lg:px-12 xl:px-28 lg:pt-12 lg:grid grid-cols-2 text-center lg:text-left relative overflow-x-clip">

    <div class="pr-16 text-center z-10 absolute top-56 left-8 w-full lg:static hidden lg:block show-on-template-select">
      <div id="templateSelected" class="@if(isset($image) && $image != null) hidden @endif md:shadow-lg shadow-primary-300 relative rounded-md py-28 sm:py-40 md:py-56 lg:py-60 xl:py-64 overflow-hidden -mx-5 md:mx-0 preview-placeholder">
        <img id="templateHead" class="absolute -top-14 sm:-top-20 md:top-0 left-0 z-10 w-full" src="{{ asset('/templates/feminine/header.png') }}" alt="">
        <span class="relative z-20">
          <h2 class="text-lg xl:text-2xl font-bold mb-4">{{ $event->name }}</h2>
          <h3 class="text-md xl:text-xl  mb-2 lg:mb-3">{{ $date_event }} às {{ $hour_event }}h</h3>
          <h3 class="text-md xl:text-xl px-14 lg:px-10 xl:px-14">{{ $event->address }}</h3>
        </span>
        <img id="templateFooter" class="absolute -bottom-14 sm:-bottom-20 md:bottom-0 left-0 z-10 w-full" src="{{ asset('/templates/feminine/footer.png') }}" alt="">
      </div>
      
      <!-- <img src="{-{ $-event->image }}" class="w-full h-auto rounded-sm shadow-lg shadow-primary-200"> -->
      <img src="@if(isset($image) && $image != null) {{$image}} @endif" id="imageSelected" class="@if($custom_template == 'custom_template') hidden @endif w-full h-auto rounded-sm preview-img shadow-lg shadow-primary-200">

    </div>

    <form action="/edit-event-step3/{{$event_id}}" method="POST" enctype="multipart/form-data" class="lg:pt-10">
      @csrf
      <ul class="flex gap-6 font-bold text-sm mb-8 lg:mb-12 justify-center lg:justify-start">
        <li class="text-dark-200 border-b-2 border-dark-200 pb-0.5">1 etapa</li>
        <li class="text-dark-200 border-b-2 border-dark-200 pb-0.5">2 etapa</li>
        <li class="text-primary-500 border-b-2 border-primary-500 pb-0.5">3 etapa</li>
      </ul>

      <h1 class="text-lg lg:text-2xl font-bold text-primary-500 mb-5 lg:mb-8">Customize seu convite!</h1>
      <label class="text-xs text-dark-500 font-bold mb-4 lg:mb-2 block">Escolha algum template pronto</label>

      <!-- Select template -->
      <div class="relative">
        <button id="selectTemplate" data-dropdown-toggle="dropdown" class="w-full text-dark-500 border border-dark-100 hover:bg-primary-100 focus:ring-0 focus:outline-none inline-flex gap-3 p-1.5 items-center rounded-md" type="button">
          <img src="{{ asset('/templates/feminine/thumbnail.png') }}" class="w-12 rounded" alt="feminine">
          <span class="text-xs font-medium capitalize">feminine</span>
          <i class="bi bi-chevron-down ml-auto mr-3 pointer-events-none text-sm"></i></button>
        <!-- Dropdown menu -->
        <div id="dropdown" class="hidden z-10 w-full bg-white rounded shadow-lg shadow-primary-200">
          <ul class="text-xs text-dark-500 -mt-2.5" aria-labelledby="selectTemplate">
            <li onclick="ChangeTemplate('feminine','#FFFFFF')" value="templateFeminine" class="flex items-center gap-3 p-1.5 border border-transparent bg-white cursor-pointer hover:bg-primary-100 hover:text-primary-500 hover:border-primary-500">
              <img src="{{ asset('/templates/feminine/thumbnail.png') }}" class="w-12 rounded" alt="feminine">
              <span class="text-xs font-medium">Feminine</span>
            </li>
            <li onclick="ChangeTemplate('masculine','#FBFBFB')" value="templateMasculine" class="flex items-center gap-3 p-1.5 border border-transparent bg-white cursor-pointer hover:bg-primary-100 hover:text-primary-500 hover:border-primary-500">
              <img src="{{ asset('/templates/masculine/thumbnail.png') }}" class="w-12 rounded" alt="Masculine">
              <span class="text-xs font-medium">Masculine</span>
            </li>
            <li onclick="ChangeTemplate('unisex','#F6F6F6')" value="templateUnisex" class="flex items-center gap-3 p-1.5 border border-transparent bg-white cursor-pointer hover:bg-primary-100 hover:text-primary-500 hover:border-primary-500">
              <img src="{{ asset('/templates/unisex/thumbnail.png') }}" class="w-12 rounded" alt="feminine">
              <span class="text-xs font-medium">Unisex</span>
            </li>
          </ul>
        </div>
      </div>

      <span class="font-bold text-dark-500 text-xs block py-7">Ou</span>

      <div class="block text-xs font-bold items-start border-dashed rounded-lg border border-primary-500 bg-primary-500 bg-opacity-10 col-span-2 relative mb-10">
        <div id="show" class="h-10 min-w-10 w-10 px-5 rounded-full flex justify-center items-center absolute left-8 top-8 lg:pointer-events-none">
          <i style="margin-left: 50px;" class="@if(isset($event->image)) hidden @endif bi bi-card-image text-primary-500 text-5xl preview-placeholder pointer-events-none"></i>  
          <?php $imageThumb = isset($event->image) ? $event->image : ""; ?>
          <img src="" id="iconImageSelected" name="image" class="ml-2 h-14 object-cover preview-img" style="min-width: 70px;min-height:70px" data-modal-toggle="mobileTemplatePreview">
          
        </div>

        <div class="dropzone text-left text-primary-500 w-full pl-28 pr-10 pt-8 pb-14" id="Dropzone"></div>
        <div class="pointer-events-none w-full pl-28 pr-11 absolute top-14 scale-95 text-left text-dark-500">
          <span id="file-name-placeholder" class="font-medium -ml-1 lg:-ml-2">@if(isset($event->file_name_image)) {{$event->file_name_image}} @else PNG, JPEG (Max 2mb) @endif</span>
          <span id="file-name" class="font-medium -ml-1 lg:-ml-2"></span>
        </div>
        <input type="hidden" name="custom_template" id="custom_template" value="">
        <input type="hidden" name="image" id="image-banner" value="@if(isset($event->image)) {{$event->image}} @endif">
        <input type="hidden" name="file_name_image" id="file_name_image" value="@if(isset($event->file_name_image)) {{$event->file_name_image}} @endif">
      </div>
      

      <a href="{{route('edit.event.step2', [$event_id])}}" class="inline-flex items-center justify-center bg-white border border-danger-500 rounded-lg mr-4 w-auto px-6 h-10 text-sm font-bold text-danger-500 hover:bg-opacity-90">Voltar etapa</a>
      
      <button type="submit" id="nextStep" class="bg-danger-500 rounded-lg w-auto px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90">Salvar e Continuar</button>

    </form>
  </div>
  <script>
    window.onload = function(){
      const imgName = document.getElementById('file_name_image').value;
      
      var type_template = "<?php if(isset($custom_template) && $custom_template != null) echo $image; else null; ?>";
      console.log("custom", type_template);
      if(type_template == 'masculine'){ ChangeTemplate('masculine','#FBFBFB'); }
      if(type_template == 'feminine'){ ChangeTemplate('feminine','#FFFFFF'); }
      if(type_template == 'unisex'){ ChangeTemplate('unisex','#F6F6F6'); }
    }
  </script>

  <x-modal.mobile-template-preview></x-modal.mobile-template-preview>
  <script>
    var selectButton = document.getElementById('selectTemplate');
    var templateContainer = document.querySelector('.preview-placeholder');
    var templateHead = document.getElementById('templateHead');
    var templateFooter = document.getElementById('templateFooter');

    // Only effective in mobile/tablet devices 
    var showOnTemplateSelect = document.querySelectorAll('.show-on-template-select');
    var hideOnTemplateSelect = document.querySelector('.hide-on-template-select');

    function ChangeTemplate(template, color) {

      console.log("template: ", template);
      document.getElementById('custom_template').value = template;
      document.getElementById('image-banner').value = "";
      
      document.getElementById('imageSelected').src = "";
      document.getElementById('templateSelected').classList.remove('hidden');
      document.getElementById('file-name-placeholder').innerHTML = "PNG, JPEG (Max 2mb)";
      document.getElementById('iconImageSelected').classList.add('hidden');
      


      color = color || '#ffffff';
      var buttonText = selectButton.children[1].innerHTML;
      var thumbImg = selectButton.children[0].src.split(buttonText);

      // Change button text and thumbnail
      thumbImg = `${thumbImg[0]}${template}${thumbImg[1]}`;
      selectButton.children[1].innerHTML = template;
      selectButton.children[0].src = thumbImg;

      // Change template header
      var newTempHead = templateHead.src.split(buttonText);
      templateHead.src = `${newTempHead[0]}${template}${newTempHead[1]}`;

      // Change template Footer
      var newTempFooter = templateFooter.src.split(buttonText);
      templateFooter.src = `${newTempFooter[0]}${template}${newTempFooter[1]}`;

      // change background color
      templateContainer.style.backgroundColor = color;

      // Only effective in mobile/tablet devices 
      if (document.querySelector('body').offsetWidth < 992) {
        showOnTemplateSelect[0].classList.remove('hidden');
        showOnTemplateSelect[1].classList.remove('hidden');
        hideOnTemplateSelect.classList.add('hidden');
      }
    }
  </script>
</x-dashboard-layout.minimal>