<x-dashboard-layout.settings title="Minha Chave Pix" name="{{ $user->name }}" email="{{ $user->email }}" phone="{{ $phone }}" initials="{{ $initials }}">
  @if (\Session::has('success'))
    <div id="toast-success" class="flex absolute top-5 right-5 items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">Alterações salvas!</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>
  @endif
  @if (\Session::has('error'))
    <div id="toast-danger" class="flex absolute top-5 right-5 items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
      <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Error icon</span>
      </div>
      <div class="ml-3 text-sm font-normal">Ocorreu um erro. Tente novamente.</div>
      <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
          <span class="sr-only">Close</span>
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
      </button>
    </div>
  @endif
  <form action="{{ route('post.details.bank') }}" method="POST">
      @csrf

    <span class="font-medium text-dark-500">Banco</span>
    <div class="mb-5">
      <select id="countries" name="bank" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        @foreach($banks as $key => $bank)
          <option value="{{$bank['code']}}" @if($bank['code'] == $user->bank) selected @endif>{{$bank['code']}} - {{$bank['name']}}</option>
        @endforeach
      </select>
    </div>
    
    
    <span class="font-medium text-dark-500">Chave Pix</span>
    <div class="mb-5">
      <input type="text" name="pix_key" value="{{ $user->pix_key }}" placeholder="Chave Pix" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
    </div>

    <span class="font-medium text-dark-500">CPF ou CNPJ</span>
    <div class="mb-5">
      <input type="text" name="cpf" value="{{ $user->cpf }}" placeholder="CPF ou CNPJ" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
      <!-- <input type="text" name="cpf" onkeypress="return allowOnlyNumbers(event)" value="{{ $user->cpf }}" placeholder="CPF ou CNPJ" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200"> -->
    </div>

    <span class="font-medium text-dark-500">Telefone</span>
    <div class="mb-5">
      <input type="text" name="phone" value="{{ $user->phone }}" placeholder="Telefone" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
    </div>
    <input type="hidden" name="email" value="{{ $user->email }}">
    <div>
      <button type="button" class="bg-white border border-danger-500 rounded-lg mr-4 w-auto px-6 h-10 text-sm font-bold text-danger-500 hover:bg-opacity-90">Cancelar</button>
      <button type="submit" class="bg-danger-500 rounded-lg w-auto px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90">Salvar alterações</button>
    </div>
  </form>

  <script>
    function allowOnlyNumbers(e) {
        var tecla = (window.event) ? event.keyCode : e.which;
        if ((tecla > 47 && tecla < 58) || tecla == 45) return true;
        else {
            if (tecla == 8 || tecla == 0 || tecla == 45) return true;
            else return false;
        }
    }
  </script>
</x-dashboard-layout.settings>