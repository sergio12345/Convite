<x-layout title="Confirme sua presença">

  <x-nav.mobile-nav backLink="/guest-journey/" guest="true"></x-nav.mobile-nav>

  <style>
    html {
      scroll-behavior: smooth;
    }
  </style>
  <div class="container pt-10 pb-6 hidden lg:block">
    <img class="h-14 mx-auto mb-10" src="{{ asset('/img/logo-horizontal.png') }}" alt="maisconvite">
    <a href="/convite/{{$token}}" class="text-center pt-2 text-primary-500  hover:opacity-90 text-sm font-bold">
      <i class="bi bi-arrow-left mr-3"></i>Voltar
    </a>
  </div>
    <form action="{{route('post.save.confirm', [$token])}}" method="POST" autocomplete="off" id="formInvitee">
      @csrf

      <input name="gift_status" type="hidden" value="yes" id="gift_status">
      <div class="container bg-white rounded-xl lg:shadow-lg shadow-purple-100 relative mb-10 -mt-6 lg:mt-0">
        <div class="lg:grid grid-cols-3 gap-16 p-5 py-12 lg:p-16 border-b  border-gray-200">
          <div class="col-span-1 lg:pr-4 mb-8 lg:mb-0">
            
            <div class="">
              @if($type_template == 'custom_template')
                <div class="pr-17 text-center z-10 absolute top-56 left-8 w-full lg:static hidden lg:block show-on-template-select">
                  <div id="templateSelected" class="md:shadow-lg shadow-primary-300 relative rounded-md py-28 sm:py-35 md:py-35 lg:py-35 xl:py-35 overflow-hidden -mx-5 md:mx-0 preview-placeholder">
                    <img id="templateHead" class="absolute -top-14 sm:-top-20 md:top-0 left-0 z-10 w-full" src="{{ asset('/templates/'.$image.'/header.png') }}" alt="">
                    <span class="relative z-20">
                      <h2 class="text-lg xl:text-2xl font-bold mb-4">{{ $event->name }}</h2>
                      <h3 class="text-md xl:text-xl  mb-2 lg:mb-3">{{ $event->date_event }} às {{ $event->hour_event }}h</h3>
                      <h3 class="text-md xl:text-xl px-14 lg:px-10 xl:px-14">{{ $event->address }}</h3>
                    </span>
                    <img id="templateFooter" class="absolute -bottom-14 sm:-bottom-20 md:bottom-0 left-0 z-10 w-full" src="{{ asset('/templates/'.$image.'/footer.png') }}" alt="">
                  </div>
                </div>
              @else
                <img src="{{ $image }}" class="w-full h-auto">
              @endif
            </div>


            <div class="shadow-lg lg:shadow-md rounded-lg shadow-gray-100 px-5 lg:px-8 py-4 lg:py-6 bg-white">
              <p class="text-center text-sm font-bold mb-2.5">Evento ativo</p>
              @if($event->receive_gifts == 1)
                <h6 class="text-primary-500 text-xs font-medium -mb-0.5">Arrecadados</h6>
                <div class="flex items-center mb-0.5">
                  <div class="w-full bg-primary-300 rounded-full h-1.5">
                    <div class="bg-primary-500 h-1.5 rounded-full" style="width: {{$event_pt}}%"></div>
                  </div>
                  <span class="w-12 text-sm font-medium pl-2 scale-90 text-right mb-1">{{$event_pt}}%</span>
                </div>
              @endif
            </div>
          </div>

          <div class="col-span-2 lg:pr-12">
            <h1 class="lg:text-2xl font-bold text-dark-700 mb-6">Detalhes da confirmação 🎉 </h1>
            <div class="mb-7">
              <label for="" class="text-xs font-bold block mb-3 text-dark-500">Confirmar sua presença?</label>
              <div class="flex">
                <div class="flex items-center mr-4">
                  <input checked id="Sim-checkbox" type="radio" name="rsvp" value="yes" class="w-4 h-4  text-purple-600 rounded-full border-gray-300 focus:ring-0  ">
                  <label for="Sim-checkbox" class="ml-2 text-xs font-medium text-dark-500">Sim</label>
                </div>
                <div class="flex items-center mr-4">
                  <input id="Não-checkbox" type="radio" value="no" name="rsvp" class="w-4 h-4  text-purple-600 rounded-full border-gray-300 focus:ring-0">
                  <label for="Não-checkbox" class="ml-2 text-xs font-medium text-dark-500">Não</label>
                </div>
                <div class="flex items-center mr-4">
                  <input id="Talvez-checkbox" type="radio" value="maybe" name="rsvp" class="w-4 h-4  text-purple-600 rounded-full border-gray-300 focus:ring-0">
                  <label for="Talvez-checkbox" class="ml-2 text-xs font-medium text-dark-500">Talvez</label>
                </div>
              </div>
            </div>

            <div class="mb-4">
              <textarea name="description" placeholder="Ex: Parabéns Amanda... " class="border border-dark-100 rounded-lg h-24 resize-none py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200"></textarea>
            </div>

            <div class="mb-4">
              <input required type="text" id="name" name="name" value="" placeholder="Nome do convidado" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
            </div>

            <div class="mb-4">
              <input required type="email" id="email" name="email" placeholder="Email" value="" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
            </div>

            <div class="mb-8 lg:mb-10">
              <input required type="tel" id="phone" value="" name="phone" placeholder="Telefone" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200 telefone">
            </div>

            <div class="text-center lg:text-left">
              @if($event->receive_gifts == 1)
                <a href="#section2" class="inline-flex items-center bg-danger-500 rounded-lg w-auto px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90">Continuar</a>
                <!-- <button type="submit" class="inline-flex items-center bg-danger-500 rounded-lg w-auto px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90">Continuar</button> -->
              @else
                <a href="#confirm" onclick="prepareForm('no_donation')" class="inline-flex items-center bg-danger-500 rounded-lg w-auto px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90">Continuar</a>
              @endif
            </div>

          </div>
        </div>
        <!-- group 2 -->
        @if($event->receive_gifts == 1)
          <div class="lg:grid grid-cols-3 gap-16 p-5 py-12 lg:p-16 border-b border-gray-200" id="section2">
            <div></div>
            <div class="col-span-2 lg:pr-12">
              <h2 class="font-bold mb-6 text-dark-700 lg:text-2xl">Deseja contribuir com o presente? 💝</h2>
              <div class="mb-8 lg:w-2/3">
                
                <input type="text" name="cpf" id="cpf" required placeholder="Informe o CPF" class="cpf border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
                <span class="italic hidden" id="cpf_invalid" style="font-size: 12px; color: red">CPF inválido</span>
              </div>

              <label class="text-xs font-bold block mb-2.5 text-dark-500">Escolha o valor da contribuição</label>
              <div class="lg:grid grid-cols-2 gap-4 items-center mb-10">
                <ul class="grid grid-cols-4 gap-3 mb-6 lg:mb-0" id="contribution-amount">
                  <li class="relative">
                    <input class="sr-only peer" required="required" checked value="10" type="radio" name="answer" id="option_1">
                    <label class="flex h-10 items-center justify-center font-bold text-xs bg-white border border-gray-300 rounded-md cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:border-primary-500 peer-checked:text-primary-500" for="option_1">R$ 10</label>
                  </li>
                  <li class="relative">
                    <input class="sr-only peer" type="radio" value="20" name="answer" id="option_2">
                    <label class="flex h-10 items-center justify-center font-bold text-xs bg-white border border-gray-300 rounded-md cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:border-primary-500 peer-checked:text-primary-500" for="option_2">R$ 20</label>
                  </li>
                  <li class="relative">
                    <input class="sr-only peer" type="radio" value="50" name="answer" id="option_3">
                    <label class="flex h-10 items-center justify-center font-bold text-xs bg-white border border-gray-300 rounded-md cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:border-primary-500 peer-checked:text-primary-500" for="option_3">R$ 50</label>
                  </li>
                  <li class="relative">
                    <input class="sr-only peer" type="radio" value="100" name="answer" id="option_4">
                    <label class="flex h-10 items-center justify-center font-bold text-xs bg-white border border-gray-300 rounded-md cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:border-primary-500 peer-checked:text-primary-500" for="option_4">R$ 100</label>
                  </li>
                </ul>
                <div class="lg:flex items-center gap-4 pt-3 lg:pt-0">
                  <hr class="lg:hidden -mb-3.5">
                  <div class="text-xs text-dark-500 font-bold block text-center mb-5 lg:mb-0">
                    <span class="inline-block bg-white p-1 px-4 opacity-60">Ou</span>
                  </div>
                  <div class="relative w-2/3 lg:w-full mx-auto">
                    <input id="contribution-amount-value" maxlength="10" name="answer2" onkeydown="resetRadio()" type="text" placeholder="0,00" class="real font-bold border border-dark-100 rounded-lg h-10 py-4 pl-10 pr-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
                    <span class="font-bold text-xs absolute left-4 bottom-3 text-dark-700">R$</span>
                  </div>
                </div>
              </div>


              <!-- <div class="lg:w-2/3 mb-10">
                <label class="text-xs font-bold block mb-5 text-dark-500"><i class="bi bi-flower2 text-primary-500 mr-1"></i>Forma de contribuição atráves do Pix</label>
                <dl class="grid grid-cols-4 text-xs text-dark-500 px-4 font-medium">
                  <dt class="mb-3 col-span-3">Presente</dt>
                  <dd><span class="" id="gift_value">R$ 0,00</span></dd>
                  <dt class="mb-3 col-span-3">Doação ({{ $event->tax_charity }} %)</dt>
                  <dd><p class="" id="donation_value">R$ 0,00</p></dd>
                  <dt class="mb-3 col-span-3">Subtotal</dt>
                  <dd><p class="" id="subtotal_value">R$ 0,00</p></dd>
                </dl>
                <dl class="grid grid-cols-4 text-xs px-4 py-3 rounded-md font-bold text-primary-500 bg-primary-300">
                  <dt class="col-span-3">Total</dt>
                  <dd><p class="" id="total_value">R$ 0,00</p></dd>
                </dl>
              </div> -->

              <div class="text-center lg:text-left">
                <!-- <a href="/guest-journey/pix" class="inline-flex items-center bg-danger-500 rounded-lg w-auto px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90">Contribuir</a> -->
                <!-- <button type="submit" class="inline-flex items-center bg-danger-500 rounded-lg w-auto px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90">Contribuir</button> -->
                <a href="#confirm" onclick="prepareForm('donation')" class="inline-flex items-center bg-danger-500 rounded-lg w-auto px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90">Contribuir</a>
                <a href="#confirm" onclick="prepareForm('continue')" class="inline-flex justify-center items-center bg-white border border-danger-500 rounded-lg mr-3 w-auto px-6 h-10 text-sm font-bold text-danger-500 hover:bg-opacity-90">Finalizar</a>
                
              </div>

            </div>
          </div>
        @endif
      </div>
    </form>

    <script type="text/javascript">
      function prepareForm(status) {

        var error = false;
        var elementPhone = document.getElementById("phone");
        if(elementPhone.value.length == 0) { elementPhone.focus(); error = true; }

        var elementEmail = document.getElementById("email");
        if(elementEmail.value.length == 0) { elementEmail.focus(); error = true; }

        var elementName = document.getElementById("name");
        if(elementName.value.length == 0) { elementName.focus(); error = true; }

        if(status == 'no_donation'){
          document.getElementById("gift_status").value = "no";
          document.getElementById('formInvitee').submit();
        }

        if(error == false && status == 'continue'){
          // criar o convidado e prosseguir
          document.getElementById("gift_status").value = "no";
          document.getElementById('formInvitee').submit();
        }else{
          var elementCpf = document.getElementById("cpf");
          if(elementCpf.value.length == 0) { elementCpf.focus(); error = true; }

          if(validarCPF(elementCpf.value) && error == false){
            document.getElementById("cpf_invalid").classList.add('hidden');
            document.getElementById('formInvitee').submit();
          }else{
            if(elementCpf.value.length > 0){
              document.getElementById("cpf_invalid").classList.remove('hidden');
              elementCpf.focus();
            }else{
              elementCpf.focus();
            }
          }
        }
      }

      function validarCPF(cpf) {	
        cpf = cpf.replace(/[^\d]+/g,'');	
        if(cpf == '') return false;	
        // Elimina CPFs invalidos conhecidos	
        if (cpf.length != 11 || 
          cpf == "00000000000" || 
          cpf == "11111111111" || 
          cpf == "22222222222" || 
          cpf == "33333333333" || 
          cpf == "44444444444" || 
          cpf == "55555555555" || 
          cpf == "66666666666" || 
          cpf == "77777777777" || 
          cpf == "88888888888" || 
          cpf == "99999999999")
            return false;		
        // Valida 1o digito	
        add = 0;	
        for (i=0; i < 9; i ++)		
          add += parseInt(cpf.charAt(i)) * (10 - i);	
          rev = 11 - (add % 11);	
          if (rev == 10 || rev == 11)		
            rev = 0;	
          if (rev != parseInt(cpf.charAt(9)))		
            return false;		
        // Valida 2o digito	
        add = 0;	
        for (i = 0; i < 10; i ++)		
          add += parseInt(cpf.charAt(i)) * (11 - i);	
        rev = 11 - (add % 11);	
        if (rev == 10 || rev == 11)	
          rev = 0;	
        if (rev != parseInt(cpf.charAt(10)))
          return false;		
        return true;   
      }
    </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
  
  <script type="text/javascript">
    $(".real").mask('#.##0,00', {reverse: true});
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $(".telefone")
      .mask("(99) 9999-99999")
      .focusout(function (event) {  
          var target, phone, element;  
          target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
          phone = target.value.replace(/\D/g, '');
          element = $(target);  
          element.unmask();  
          if(phone.length > 10) {  
              element.mask("(99) 99999-999?9");  
          } else {  
              element.mask("(99) 9999-9999?9");  
          }  
      });
  </script>


  <img class="fixed bottom-0 -left-0 -z-10 w-40 md:w-72 xl:w-80" alt="gift box" src="{{ asset('/img/decoration-balloon.png') }}">
  <img class="fixed bottom-0 right-0 -z-10 w-40 md:w-72 xl:w-80" alt="gift box" src="{{ asset('/img/gift-box.png') }}">

  <x-slot:scripts>
    <script>
      function resetRadio() {
        var radio = document.getElementById('contribution-amount').children;
        for (var i = 0; i < radio.length; i++) {
          radio[i].children[0].checked = false;
          radio[i].children[0].required = false;
        }
      }
    </script>
  </x-slot:scripts>



</x-layout>