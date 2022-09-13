<div id="shareEventModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full bg-primary-500 bg-opacity-50">
  <div class="relative md:p-4 w-full max-w-2xl h-full md:h-auto">
    <!-- Modal content -->
    <div class="relative bg-white lg:rounded-lg shadow h-full">
      <!-- Modal header -->
      <div class="flex justify-end items-center p-5 pb-0">
        <button type="button" class="w-11 h-11 rounded-full px-3  ring-0" data-modal-toggle="shareEventModal">
          <svg aria-hidden="true" class="w-7 h-7 text-danger-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="px-5 text-center">
        <h3 class="block w-full text-primary-500 text-center text-lg lg:text-xl font-bold mb-4">Compartilhe copiando o link</h3>
        <div class="mr-3 relative my-1 inline-block w-64">
          <button onclick="copyToClipboard();" class="text-xs absolute w-10 h-10 lg:h-12 text-primary-500"><i class="bi bi-clipboard"></i></button>
          <input id="copyText" class="px-5 pl-10 border-0 bg-primary-100 text-xs font-bold text-primary-500 h-10 lg:h-12 rounded-xl w-full" type="text" value="@if(isset($url)) {{ $url }} @endif">
        </div>

        <div class="border-t border-primary-200 mt-8 py-12 -mx-5 text-left px-5 lg:px-12">
          <label for="" class="text-xs font-bold block mb-1.5">Envie por e-mail</label>
          <div class="md:flex">
            <input required id="email_from" type="text" placeholder="email@example.org, email@example.com" style="width: 90%;" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200 lg:mr-4 mb-4 md:mb-0">
            
            <!-- <button onclick="sendEmailEvent({{ $event }})" class="bg-danger-500 rounded-lg px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90 truncate w-52">Enviar e-mail</button>
            <div role="status" id="loading" class="text-left hidden" style=" padding-top: 4px; padding-left: 3px; ">
              <svg aria-hidden="true" class="mr-2 w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                  <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
              </svg>
            </div> -->

            <button onclick="sendEmailEvent({{ $event }})" class="bg-danger-500 rounded-lg px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90 truncate w-52">
                <svg aria-hidden="true" id="loading" role="status" class="hidden inline mr-3 w-4 h-4 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                  <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                </svg>
                <span id="change_status">Enviar</span>
            </button>

          </div>

          <label id="email_empty" for="" class="hidden mr-3 relative my-1 inline-block w-64 italic" style="color: red; padding-top: 7px; font-size:12px;">Digite o E-mail!</label>
          <label id="send_email_success" for="" class="hidden mr-3 relative my-1 inline-block w-64 italic" style="color: green; padding-top: 7px; font-size:12px;">E-mail enviado !</label>

        </div>

      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script>
    function sendEmailEvent(event_id){
      var contact_email = document.getElementById("email_from").value;
      if(contact_email.length > 6){
        document.getElementById("email_empty").classList.add('hidden');
        document.getElementById("loading").classList.remove('hidden');
        document.getElementById("change_status").innerHTML = "Enviando";
        $.ajax({
          url: "/sendEmailEvent",
          type: 'POST',
          data: {
            'event_id': event_id,
            'email': contact_email,
            "_token":"{{ csrf_token() }}"
          },
          error : function(err) {
            console.log('Error!', err);
            document.getElementById("send_email_success").classList.add('hidden');
            document.getElementById("loading").classList.add('hidden');
          },
          success: function(data) {
            console.log("success", data);
            document.getElementById("email_from").value = "";
            document.getElementById("send_email_success").classList.remove('hidden');
            document.getElementById("loading").classList.add('hidden');
            document.getElementById("change_status").innerHTML = "Enviar";
          }
        });
        
      }else{
        document.getElementById("email_empty").classList.remove('hidden');
        document.getElementById("send_email_success").classList.add('hidden');
        document.getElementById("change_status").innerHTML = "Enviar";
      }
    }
  </script>