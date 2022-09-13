<x-dashboard-layout.minimal title="Create Event - Step 2" route="edit" event_id="{{$event['id']}}">
  <div class="w-full lg:w-3/5 mx-auto xl:px-12">
    <ul class="flex gap-6 font-bold text-sm mb-8 lg:mb-12">
      <li class="text-dark-200 border-b-2 border-dark-200 pb-0.5">1 etapa</li>
      <li class="text-primary-500 border-b-2 border-primary-500 pb-0.5">2 etapa</li>
      <li class="text-dark-200 border-b-2 border-dark-200 pb-0.5">3 etapa</li>
    </ul>
    <h1 class="text-lg lg:text-2xl font-bold text-primary-500 mb-5 lg:mb-8">Editar evento!</h1>

    <form action="/edit-event-step2/{{$event['id']}}" method="POST" autocomplete="off">
      @csrf
      <div class="mb-4">
        <label for="" class="text-xs font-bold block mb-1.5 text-dark-500">Você aceitaria receber presentes também pela plataforma?</label>
      </div>

      <div class="mb-6">
        <div class="flex">
          <div class="flex items-center mr-4">
            <input id="gift_details_yes" onclick="openConfig(true)" type="radio" name="gift_details" @if($event['receive_gifts'] == '1') checked @endif value="yes" class="w-4 h-4  text-purple-600 rounded-full border-gray-300 focus:ring-0  ">
            <label for="gift_details_yes" class="ml-2 text-xs font-medium text-dark-500">Sim</label>
          </div>
          <div class="flex items-center mr-4">
            <input id="gift_details_no" onclick="openConfig(false)" type="radio" name="gift_details" @if($event['receive_gifts'] == '0') checked @endif value="no" class="w-4 h-4  text-purple-600 rounded-full border-gray-300 focus:ring-0  ">
            <label for="gift_details_no" class="ml-2 text-xs font-medium text-dark-500">Não</label>
          </div>
        </div>
      </div>

      <!-- Collapsed  -->
      <div data-accordion="collapse" class="mb-8">
        <button id="config" type="button" class="flex bg-opacity-0 text-xs font-medium py-3 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white" data-accordion-target="#accordion-collapse" aria-expanded="false" aria-controls="accordion-collapse">
          <span>Configurar</span>
          <span id="config2" data-accordion-icon class="w-6 shrink-0 ml-2 text-dark-500">
            <i class="bi bi-chevron-down"></i>
          </span>
        </button>
        <div id="accordion-collapse" class="bg-dark-100 px-5 py-6 bg-opacity-20 rounded-lg hidden">
          <div class="mb-5">
            <label for="" class="text-xs font-bold block mb-1.5 text-dark-500">Deseja escrever sobre o presente?</label>
            <textarea name="description" id="description" placeholder="Ex: estamos arrecadando esse valor para que possamos realizar o sonho da Amanda de ter uma guitarra elétrica." class="border border-dark-100 rounded-lg h-24 resize-none py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">{{ $event['description'] }}</textarea>
          </div>

          <div class="mb-6 relative">
            <label for="" class="text-xs font-bold block mb-1.5 text-dark-500">Qual será o valor do presente?</label>
            <input name="goal" id="goal" value="{{ $event['goal'] }}" type="text" placeholder="200,00" class="real border border-dark-100 rounded-lg h-10 py-4 pl-10 pr-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
            <span class="font-medium text-xs absolute left-4 bottom-3 text-dark-500">R$</span>
          </div>

          <script>
            window.onload = function(){
              const gift_details = document.getElementById("gift_details_no").checked;
              if(gift_details){
                document.getElementById("accordion-collapse").classList.add('hidden');
                document.getElementById("config").classList.add('hidden');
              }

              const donation = document.getElementById("charity_yes").checked;
              if(donation){
                document.getElementById("donation").classList.remove('hidden');
              }

              
            }
          </script>

          <div class="mb-5">
            <label for="" class="text-xs font-bold block mb-2.5 text-dark-500">Gostaria de destinar parte do valor para uma instituição beneficente?</label>
            <div class="flex">
              <div class="flex items-center mr-4">
                <input onchange="isDonation(true)" id="charity_yes" type="radio" @if($event['donate_to_charity'] == '1') checked @endif name="donationInstitution" value="yes" class="w-4 h-4  text-purple-600 rounded-full border-gray-300 focus:ring-0  ">
                <label for="charity_yes" class="ml-2 text-xs font-medium text-dark-500">Sim</label>
              </div>
              <div class="flex items-center mr-4">
                <input onchange="isDonation(false)" id="charity_no" type="radio" @if($event['donate_to_charity'] == '0') checked @endif name="donationInstitution" value="no" class="w-4 h-4  text-purple-600 rounded-full border-gray-300 focus:ring-0  ">
                <label for="charity_no" class="ml-2 text-xs font-medium text-dark-500">Não</label>
              </div>
            </div>
          </div>

          <!-- Donations` -->
          <div class="hidden" id="donation">
            @if(count($institutions) > 0)
            <div class="mb-6">
              <select id="countries" name="institutionId" class="border border-dark-100 rounded-lg h-10 py-1 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
                @foreach($institutions as $key => $institution)
                  <option @if($event['institution_id'] == $institution['id']) selected @endif value="{{ $institution['id'] }}">{{ $institution['name'] }}</option>
                @endforeach
              </select>
            </div>

            <div class="flex items-center">
              <label class="text-xs font-bold block mb-1.5 text-dark-500 mr-2">Porcentagem a ser doada:</label>
              <div class="relative">
                <input id="donationPercentage" type="text" readonly name="taxCharity" value="{{ $event['tax_charity'] }}" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full mb-1 focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
                <div class="absolute right-2 top-0">
                  <button onclick="increaseDonation()" type="button" class="h-10 w-8 text-dark-500 active:text-dark-700"><i class="bi bi-plus text-xl"></i></button>
                  <button onclick="decreaseDonation()" type="button" class="h-10 w-8 text-dark-500 active:text-dark-700"><i class="bi bi-dash text-xl"></i></button>
                </div>
              </div>
            </div>
            @else
              <label class="text-xs font-bold mb-1.0 text-dark-200 mr-1">Nenhuma instituição cadastrada até o momento. Aguarde!</label>
            @endif
          </div>

        </div>
      </div>

      <!-- Collapsed end -->

      <a href="{{route('edit.event', [$event['id']])}}" class="inline-flex justify-center items-center bg-white border border-danger-500 rounded-lg mr-4 w-auto px-6 h-10 text-sm font-bold text-danger-500 hover:bg-opacity-90">Voltar etapa</a>
      <button type="submit" class="bg-danger-500 rounded-lg w-auto px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90">Salvar e Continuar</button>

    </form>
  </div>

  <script>
    // Show/Hide donation container
    function isDonation(val) {
      var donationContainer = document.getElementById('donation');
      if (val) {
        donationContainer.classList.remove('hidden');
      } else {
        donationContainer.classList.add('hidden');
      }
    }

    // Donation Percentage
    var donationValInput = document.getElementById('donationPercentage');

    function getVal() {
      var val = donationValInput.value.replace(/\D/g, "");;
      return val;
    }

    function increaseDonation() {
      var currentVal = Number(getVal());
      if (currentVal < 100) {
        donationValInput.value = currentVal + 5 + '%';
      }
    }

    function decreaseDonation() {
      var currentVal = Number(getVal());
      if (currentVal > 0) {
        donationValInput.value = currentVal - 5 + '%';
      }
    }
  </script>
  </x-dashboard-layouts.minimal>

<script>
  function openConfig(type) {
    
    const input = document.getElementById('goal');
    const inputDesc = document.getElementById('description');

    if(type == true){
      //input.setAttribute('required', '');
      //inputDesc.setAttribute('required', '');
      document.getElementById("config").classList.remove('hidden');
      //document.getElementById("accordion-collapse").classList.remove('hidden');
    }else{
      //input.removeAttribute('required');
      //inputDesc.removeAttribute('required');
      document.getElementById("config").classList.add('hidden');
      document.getElementById("accordion-collapse").classList.add('hidden');
    }
    
  }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script type="text/javascript">
  $(".real").mask('#.##0,00', {reverse: true});
</script>