<x-dashboard-layout.full title="Events" name="{{ $name }}" email="{{ $email }}" initials="AA">

  <x-nav.mobile-nav backLink="/"></x-nav.mobile-nav>

  <div class="lg:p-10 bg-primary-100 lg:bg-white rounded-xl shadow-purple-100 lg:shadow-sm -mt-6 lg:mt-0 lg:mb-10">
    <div class="hidden lg:grid grid-cols-2 items-center  mb-3 lg:mb-5">
      <h2 class="text-lg lg:text-2xl font-bold text-primary-500">{{ $event['name'] }}</h2>
      <div class="flex xl:pl-24">
        <div class="mr-3 w-full relative">
          <button onclick="copyToClipboard();" class="text-xs absolute w-10 h-10 text-primary-500"><i class="bi bi-clipboard"></i></button>
          <input id="copyText" class="px-5 pl-10 border-0 bg-primary-100 text-xs font-bold text-primary-500 h-10 rounded-xl w-full" type="text" value="{{ $event['shareable_link'] }}">
        </div>
        <button class="hidden h-10 w-12 rounded-xl text-primary-500 bg-primary-100" id="dropdownDefault" data-dropdown-toggle="dropdown"><i class="bi bi-three-dots"></i></button>
<!-- configurações ainda sem função
        <div id="dropdown" class="hidden z-10 w-40 bg-white rounded shadow-xl shadow-primary-300">
          <ul class="py-1 text-xs font-medium text-gray-700" aria-labelledby="dropdownDefault">
            <li>
              <a href="#" class="block py-2.5 px-4 hover:bg-primary-100 hover:bg-opacity-50">Action 1</a>
            </li>
            <li>
              <a href="#" class="block py-2.5 px-4 hover:bg-primary-100 hover:bg-opacity-50">Action 2</a>
            </li>
            <li>
              <a href="#" class="block py-2.5 px-4 hover:bg-primary-100 hover:bg-opacity-50">Action 3</a>
            </li>
          </ul>
        </div> -->
        
      </div>
    </div>


    <div class="md:grid grid-cols-8 w-full items-center lg:mb-10">
      <div class="col-span-3 aspect-video lg:aspect-square overflow-hidden flex items-center bg-white">
      
        @if($event['type_template'] == 'image')
          <img src="@if(isset($event['banner'])) {{asset( $event['banner'] )}} @endif" class="object-cover pointer-events-none">
        @else
          <div class="pr-17 text-center z-10 absolute top-56 left-8 w-full lg:static hidden lg:block show-on-template-select">
              <div id="templateSelected" class="md:shadow-lg shadow-primary-300 relative rounded-md py-28 sm:py-35 md:py-35 lg:py-35 xl:py-35 overflow-hidden -mx-5 md:mx-0 preview-placeholder">
                <img class="absolute -top-14 sm:-top-20 md:top-0 left-0 z-10 w-full" src="{{ asset('/templates/'.$event['banner'].'/header.png') }}" alt="">
                <span class="relative z-20">
                  <h2 class="text-lg xl:text-2xl font-bold mb-4">{{ $event['name'] }}</h2>
                  <h3 class="text-md xl:text-xl  mb-2 lg:mb-3">{{ $event['date_event'] }} às {{ $event['hour_event'] }}h</h3>
                  <h3 class="text-md xl:text-xl px-14 lg:px-10 xl:px-14">{{ $event['address'] }}</h3>
                </span>
                <img id="templateFooter" class="absolute -bottom-14 sm:-bottom-20 md:bottom-0 left-0 z-10 w-full" src="{{ asset('/templates/'.$event['banner'].'/footer.png') }}" alt="">
            </div>
          </div>
        @endif
      
      
      </div>
      <div class="col-span-5 lg:pl-5 px-8 lg:px-0 -mt-16 lg:mt-0 relative">
          
        <div class="shadow-xl lg:shadow:md rounded-lg shadow-primary-300 px-5 lg:px-8 py-4 lg:py-6 lg:mr-12 mb-8 bg-white" style="width: 97%;">
          @if($event['finished_event'] == 0)
            <p class="text-center text-sm font-bold mb-2.5">Evento ativo</p>
          @else
            <p class="text-center text-sm font-bold text-red-600 mb-2.5">Evento inativo</p>
          @endif
          @if($event['receive_gifts'])
            <h6 class="text-primary-500 text-xs font-medium -mb-0.5">Arrecadados</h6>
            <div class="flex items-center mb-0.5">
              <div class="w-full bg-primary-300 rounded-full h-1.5">
                <?php $escale = $event['event_pt'] > 100 ? $escale = 100 : $escale = $event['event_pt']; ?>
                <div class="bg-primary-500 h-1.5 rounded-full" style="width: {{$escale}}%"></div>
              </div>
              <span class="w-12 text-sm font-medium pl-2 scale-90 text-right mb-1">{{ $event['event_pt'] }}%</span>
            </div>
          @else
            <h6 class="text-primary-500 text-xs font-medium -mb-0.5">Você configurou para não receber presentes pela plataforma. 
              @if($event['finished_event'] == 0)<a href="/edit-event-step2/{{$event['id']}}">Deseja Alterar ? Clique aqui!</a>@endif
            </h6>
          @endif
          <div class="flex items-center" style="padding-top: 10px;">
            @if($event['receive_gifts'])
              <h5 class="text-xs font-bold">R$</h5><span class="text-xs font-bold real" style="padding-right: 5px;">{{ $event['total_amount'] }}</span> / <span class="inline-block scale-75 opacity-70 real">{{ $event['goal'] }}</span>
            @endif
            <div class="mx-2">
              <!-- <div class="flex -space-x-1.5">
                <img class="w-5 h-5 rounded-full border-2 border-white dark:border-gray-800" src="https://randomuser.me/api/portraits/men/35.jpg">
                <img class="w-5 h-5 rounded-full border-2 border-white dark:border-gray-800" src="https://randomuser.me/api/portraits/women/79.jpg">
              </div> -->
            </div>
            <h5 class="text-xs font-bold">{{ $event['number_of_invitees_confirmed'] }} /<span class="inline-block scale-75 opacity-30">convidados</span></h5>
          </div>
        </div>


        <div class="hidden lg:block">
          <div class="mb-4">
            <span class="text-dark-500 text-xs block mb-0.5">Descrição</span>
            <span class="text-sm font-bold">{{ $event['short_description2'] }}</span>
          </div>

          <div class="flex gap-7">
            <div>
              <span class="text-dark-500 text-xs block mb-0.5">Data do evento</span>
              <span class="text-sm font-bold">{{ $event['date_event'] }} ás {{ $event['hour_event'] }}</span>
            </div>
            <div>
              <span class="text-dark-500 text-xs block mb-0.5">Formato do evento</span>
              <span class="text-sm font-bold">@if($event['type'] == 'presential') Presencial @else Virtual @endif
                <div id="tooltip-event-edit" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                    Editar Evento
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <a href="/edit-event/{{$event['id']}}" data-tooltip-target="tooltip-event-edit">
                  <i class="bi bi-pencil-square ml-6 text-primary-500"></i>
                </a>
              </span>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- TAB -->
    <div class="px-5 lg:px-0 py-4 lg:py-0 rounded-xl my-10 lg:my-0 bg-white">
      <div class="mb-4 border-b border-primary-300">
        <ul class="flex flex-wrap -mb-px text-xs lg:text-sm font-bold text-center text-dark-200" data-tabs-toggle="#TabContent" role="tablist">
          <li class="mr-2" role="presentation">
            <button class="inline-block p-3 rounded-t-lg border-b" id="guests-tab" data-tabs-target="#guests" type="button" role="tab" aria-controls="guests" aria-selected="false">Convidados</button>
          </li>
          <li class="mr-2" role="presentation">
            <button class="inline-block p-3 rounded-t-lg border-b border-transparent hover:text-dark-600 hover:border-gray-300" id="collections-tab" data-tabs-target="#collections" type="button" role="tab" aria-controls="collections" aria-selected="false">Arrecadações</button>
          </li>
          <li class="mr-2" role="presentation">
            <button class="inline-block p-3 rounded-t-lg border-b border-transparent hover:text-gray-600 hover:border-gray-300" id="withdrawals-tab" data-tabs-target="#withdrawals" type="button" role="tab" aria-controls="withdrawals" aria-selected="false">Saques</button>
          </li>
          <li class="mr-2" role="presentation">
            <button class="inline-block p-3 rounded-t-lg border-b border-transparent hover:text-gray-600 hover:border-gray-300" id="details-tab" data-tabs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">Detalhes</button>
          </li>
        </ul>
      </div>
      <div id="TabContent">
        <div class="hidden" id="guests" role="tabpanel" aria-labelledby="guests-tab">
          <div class="hidden lg:grid grid-cols-5 text-sm font-bold text-dark-500 opacity-50 px-3 my-3">
            <span class="col-span-2">Convidado</span>
            <span>Contribuição</span>
            <span class="text-center">Status</span>
          </div>
          
          @foreach($invitees as $key => $invitee)
            <?php 
              if(isset($invitee['pixpayments']) && $invitee['pixpayments'] != null){
                $amount = $invitee['pixpayments']['amount']; 
                $pix_status = $invitee['pixpayments']['status'];
              }else{
                $amount = '0.00'; $pix_status = null;
              }
              
            ?>
            <x-cards.guest-card status="{{$invitee['rsvp']}}" pix="{{$amount}}" pix_status="{{$pix_status}}" name="{{$invitee['name']}}" initials="{{$invitee['initials']}}"></x-cards.guest-card>

          @endforeach
        </div>
        <div class="hidden" id="collections" role="tabpanel" aria-labelledby="collections-tab">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 lg:gap-5 md:pt-2 pb-4">
            
            @foreach($payments as $key => $payment)

              <?php 
                $amount = $payment['amount']; 
                $name = $payment['invitees']['name']; 
                $date = date('d-m-Y h:i:s', strtotime($payment['invitees']['updated_at']));
              ?>
              <x-cards.collection-card name="{{$name}}" amount="{{$amount}}" date="{{$date}}"></x-cards.collection-card>

            @endforeach
          </div>
        </div>
        <div class="hidden" id="withdrawals" role="tabpanel" aria-labelledby="withdrawals-tab">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 lg:gap-5 md:pt-2 pb-4">
            <x-cards.withdrawal-card></x-cards.withdrawal-card>
            <x-cards.withdrawal-card></x-cards.withdrawal-card>
          </div>
        </div>
        <div class="hidden" id="details" role="tabpanel" aria-labelledby="details-tab">
          <ul data-tabs-toggle="#TabContent" role="tablist">
            <li class="mr-2" role="presentation">
                <span class="text-dark-500 text-xs block mb-0.5">Descrição</span>
                <span class="text-gray-500 font-bold" style="font-size: 12px;">{{ $event['short_description'] }}</span>
            </li>
            <li class="mr-2" role="presentation" style="padding-top: 20px;">
                <span class="text-dark-500 text-xs block mb-0.5">Sobre o presente</span>
                @if($event['receive_gifts'] == 1)
                  <span class="text-gray-500 font-bold" style="font-size: 12px;">{{ $event['description'] }}</span>
                @else
                  <span class="text-gray-500 font-bold" style="font-size: 12px;"> Não receber presentes pela plataforma. </span>
                @endif
            </li>
            <li class="mr-2" role="presentation" style="padding-top: 20px;">
                <span class="text-dark-500 text-xs block mb-0.5">Data e formato do Evento</span>
                <span class="text-gray-500 font-bold" style="font-size: 12px;">{{ $event['date_event'] }} às {{ $event['hour_event'] }} - @if($event['type'] == 'presential') Presencial @else Virtual @endif</span>
            </li>
            <li class="mr-2" role="presentation" style="padding-top: 20px;">
                <span class="text-dark-500 text-xs block mb-0.5">Valor do presente</span>
                @if($event['receive_gifts'] == 1)
                  <span class="text-gray-500 font-bold real" style="font-size: 12px;">{{ $event['goal'] }}</span>
                @else
                  <span class="text-gray-500 font-bold" style="font-size: 12px;"> -- </span>
                @endif
            </li>
            <li class="mr-2" role="presentation" style="padding-top: 20px;">
                <span class="text-dark-500 text-xs block mb-0.5">Confirmar presença até</span>
                <span class="text-gray-500 font-bold" style="font-size: 12px;">{{ $event['date_rsvp'] }} às {{ $event['hour_rsvp'] }}</span>
            </li> 
            <li class="mr-2" role="presentation" style="padding-top: 20px;">
                <span class="text-dark-500 text-xs block mb-0.5">Endereço</span>
                <span class="text-gray-500 font-bold" style="font-size: 12px;">{{ $event['address'] }}</span>
            </li>
            <li class="mr-2" role="presentation" style="padding-top: 20px;">
                <span class="text-dark-500 text-xs block mb-0.5">Doar para instituição de caridade</span>
                @if($event['donate_to_charity'] == 1 && $event['receive_gifts'] == 1)
                  <span class="text-gray-500 font-bold" style="font-size: 12px;">{{ $event['institution_name'] }} - {{ $event['tax_charity'] }} %</span>
                @else
                  <span class="text-gray-500 font-bold" style="font-size: 12px;"> -- </span>
                @endif
            </li> 
          </ul>
        </div>
      </div>
    </div>

    <div class="block lg:hidden text-center px-16 pb-10">
      <h4 class="text-sm font-bold mb-3">Chamar mais convidados?</h4>
      <div class="mr-3 w-full relative">
        <button onclick="copyToClipboard();" class="text-xs absolute w-10 h-10 text-primary-500"><i class="bi bi-clipboard"></i></button>
        <input id="copyText" class="px-5 pl-10 border-0 bg-primary-300 lg:bg-primary-100 text-xs font-bold text-primary-500 h-10 rounded-xl w-full" type="text" value="https://prsnt.co/9191029">
      </div>
    </div>

  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
  <script type="text/javascript">
    $(".real").mask('#.##0,00', {reverse: true});
  </script>

</x-dashboard-layout.full>