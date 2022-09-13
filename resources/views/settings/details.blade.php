<x-dashboard-layout.settings title="Meus Dados" name="{{ $name }}" email="{{ $email }}" phone="{{ $phone }}" initials="{{ $initials }}">
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
  <form action="{{ route('post.details.account') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- <div class="grid grid-cols-4 items-center mb-10">
      <div id="show" class="bg-light-600 rounded-full mr-6">
        @-if(isset($image))
          <img src="{{ asset($image) }}" class="w-20 h-20 rounded-full">
        @-else
          <div id="preview-placeholder" class="inline-flex overflow-hidden relative justify-center items-center w-20 h-20 bg-primary-500 rounded-full">
            <span class="font-bold text-white">{{ $initials }}</span>
          </div>
          <img src="" id="preview-img" class="w-20 h-20 rounded-full hidden">
        @-endif
      </div>
      <div class="col-span-3">
        <input type="file" name="image" style="font-size: 12px;">
      </div>
    </div> -->

    <div class="mb-5">
      <span class="font-medium text-dark-500">Nome</span>
      <input type="text" placeholder="Nome" minlength="3" name="name" value="{{ $name }}" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200" required>
    </div>
    <div class="mb-5">
      <span class="font-medium text-dark-500">Email</span>
      <input type="text" placeholder="Email" name="email" value="{{ $email }}" readonly class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
    </div>
    <div class="mb-5">
      <span class="font-medium text-dark-500">Telefone</span>
      <input type="text" placeholder="Telefone" name="phone" value="{{ $phone }}" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
    </div>
    <div>
      <button type="button" class="bg-white border border-danger-500 rounded-lg mr-4 w-auto px-6 h-10 text-sm font-bold text-danger-500 hover:bg-opacity-90">Cancelar</button>
      <button type="submit" class="bg-danger-500 rounded-lg w-auto px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90">Salvar alterações</button>
    </div>
    
    
  </form>
</x-dashboard-layout.settings>