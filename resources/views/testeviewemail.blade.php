<!-- <div id="shareEventModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full bg-primary-500 bg-opacity-50">
  <div class="relative md:p-4 w-full max-w-2xl h-full md:h-auto">
    <div class="relative bg-white lg:rounded-lg shadow h-full">
      
      <div class="px-5 text-center">
        <h3 class="block w-full text-primary-500 text-center text-lg lg:text-xl font-bold mb-4">Compartilhe copiando o link</h3>
        <div class="mr-3 relative my-1 inline-block w-64">
          <button onclick="copyToClipboard();" class="text-xs absolute w-10 h-10 lg:h-12 text-primary-500"><i class="bi bi-clipboard"></i></button>
          <input id="copyText" class="px-5 pl-10 border-0 bg-primary-100 text-xs font-bold text-primary-500 h-10 lg:h-12 rounded-xl w-full" type="text" value="url/fake">
        </div>

        
          <label for="" class="text-xs font-bold block mb-1.5">Envie por e-mail</label>
          <div class="md:flex">
            <input type="text" placeholder="lucaspoliveira@gmail.com, gcalegari@gmail.com..." class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200 lg:mr-4 mb-4 md:mb-0">
            <button onclick="sendEmailEvent('31')" class="bg-danger-500 rounded-lg px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90 truncate w-52">Enviar e-mail</button>
          </div>
        

      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script>
    function sendEmailEvent(event_id){
      $.ajax({
        url: "/sendEmailEvent",
        type: 'POST',
        data: {
          'event_id': 31,
          "_token":"{{ csrf_token() }}"
        },
        error : function(err) {
          console.log('Error!', err)
        },
        success: function(data) {
          console.log("success", data);
        }
      });
    }
  </script>
</div> -->