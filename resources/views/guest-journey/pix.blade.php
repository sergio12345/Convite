<x-layout title="Valor do presente">

  <x-nav.mobile-nav backLink="/convite/{{$token_event}}/confirm"  guest="true"></x-nav.mobile-nav>

  <div class="container pt-10 pb-6 hidden lg:block">
    <img class="h-14 mx-auto mb-10" src="{{ asset('/img/logo-horizontal.png') }}" alt="maisconvite">
    <a href="/convite/{{$token_event}}/confirm" class="text-center pt-2 text-primary-500  hover:opacity-90 text-sm font-bold">
      <i class="bi bi-arrow-left mr-3"></i>Voltar
    </a>
  </div>
  <div class="container bg-white rounded-xl lg:shadow-lg shadow-purple-100 relative mb-10 -mt-6 lg:mt-0">
    <div class="lg:w-2/4 mx-auto text-center px-5 lg:px-12 py-10 lg:py-16">
      
      <h1 id="paymentPending" class="@if($status_payment == 'true') hidden @endif font-bold lg:text-2xl mb-4 lg:mb-8 px-8 lg:px-0">Efetue a transferência para confirmar a contribuição! 😉</h1>
      <h1 id="paymentTextSuccess" class="@if($status_payment == 'false') hidden @endif font-bold lg:text-2xl mb-4 lg:mb-8 px-8 lg:px-0">Obrigado por contribuir com o presente! 😉</h1>
      
      <span class="text-xs text-dark-500 font-bold">Valor total</span>
      <h2 class="text-primary-500 font-bold text-xl lg:text-2xl real">{{ $pix->amount }}</h2>

      <div id="paymentContentPending" class="@if($status_payment == 'true') hidden @endif">
        <div class="text-center pt-3 lg:py-4">
          <img class="inline-block" src="{{ $qrcode }}">
        </div>

        <div class="mr-3 relative my-5 inline-block lg:w-2/3">
          <button onclick="copyToClipboard();" class="text-xs font-bold absolute w-24 h-10 lg:h-12 text-primary-500 right-4">Copiar código</button>
          <input id="copyText" class="px-5 pr-32 border-0 bg-primary-100 text-xs font-medium text-primary-500 h-10 lg:h-12 rounded-xl w-full" type="text" value="{{ $pix->brcode }}">
        </div>

        <ol class="text-dark-500 font-bold text-xs leading-8 mb-8 text-left lg:text-center">
          <li>1. Acesse seu internet banking ou app de pagamentos.</li>
          <li>2. Escolha a opção Pix.</li>
          <li>3. Escaneie o QR Code ou cole o código.</li>
          <li>4. Sua contribuição ser enviada na hora.</li>
        </ol>
    
      </div>

      <div id="paymentContentSuccess" class="@if($status_payment == 'false') hidden @endif">
        <span class="text-xs font-bold block mb-2.5 text-dark-500" style="padding: 100px; font-size: 16px; color: green">Pagamento Confirmado!</span>
      </div>
      <a href="{{ route('journey.success', ['id'=> $token_event, 'invitee'=> $invitee]) }}"  class="inline-flex items-center bg-danger-500 rounded-lg w-auto px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90 mb-4">Finalizar</a>

    </div>
  </div>

  <img class="fixed bottom-0 -left-0 -z-10 w-40 md:w-72 xl:w-80" alt="gift box" src="{{ asset('/img/decoration-balloon.png') }}">
  <img class="fixed bottom-0 right-0 -z-10 w-40 md:w-72 xl:w-80" alt="gift box" src="{{ asset('/img/gift-box.png') }}">


  <x-slot:scripts>
    
  </x-slot:scripts>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
  <script type="text/javascript">
    $(".real").mask('#.##0,00', {reverse: true});
  </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script>
    var csrf_token = "{{ csrf_token() }}";
    var timer;
    var doneTime = 3000;

    function getData(){
      $.ajax({
        url: "/verifyPixPayment",
        type: 'POST',
        data: {
          'pix_id': <?php echo $pix->id; ?>,
          "_token": csrf_token
        }
      }).then(function(result){
        console.log(result);
        if(result == 'success'){
          document.getElementById('paymentPending').classList.add('hidden');
          document.getElementById('paymentTextSuccess').classList.remove('hidden');
          document.getElementById('paymentContentPending').classList.add('hidden');
          document.getElementById('paymentContentSuccess').classList.remove('hidden');
          clearTimeout(timer);
        }
      }).fail(function(error){
        console.log(error);
      });
    }

    $(document).ready(function() {
      timer = setInterval(getData, doneTime);
    });
  </script>

</x-layout>