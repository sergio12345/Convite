<x-auth.auth-layout title="Recuperar senha" description="Verifique em sua caixa de email as instruções para resetar a senha.">
  <x-jet-validation-errors class="mb-4" />  
  @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
      {{ session('status') }}
    </div>
  @endif
  <form method="POST" action="{{ route('password.email') }}" class="mb-8 lg:mb-7">
    @csrf
    <div class="mb-4">
      <input type="text" name="email" id="email" placeholder="E-mail" class="border border-dark-100 rounded-lg h-10 lg:h-11 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200" required autofocus>
    </div>
    
    <!-- <div class="mb-6 text-right">
      <a href="{{ route('password.request') }}" class="text-xs font-bold text-danger-500">Recuperar senha</a>
    </div> -->
    <button type="submit" class="bg-danger-500 rounded-lg w-full h-10 lg:h-11 text-sm font-bold text-white hover:bg-opacity-90">Resetar</button>
  </form>
  <p class="text-xs lg:text-sm text-dark-500 mb-8 lg:mb-6">Ir para página de <a href="/" class="text-primary-500 font-bold underline">Login</a></p>
  
</x-auth.auth-layout>