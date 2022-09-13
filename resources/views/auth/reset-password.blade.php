<x-auth.auth-layout title="Resetar Senha" description="Introdução. Lorem ipsum dolor sit amet, consectetur adipiscing elit.">
  <x-jet-validation-errors class="mb-4" />  
  @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
      {{ session('status') }}
    </div>
  @endif
  <form method="POST" action="{{ route('password.update') }}" class="mb-8 lg:mb-7">
    @csrf
    <input type="hidden" name="token" value="{{ $request->route('token') }}">
    <div class="mb-4">
      <input type="text" name="email" id="email" placeholder="E-mail" class="border border-dark-100 rounded-lg h-10 lg:h-11 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200" required autofocus>
    </div>
    <div class="relative mb-2">
      <button type="button" class="absolute text-sm right-5 top-0 h-10 lg:h-11 text-dark-500" onclick="showHidePassword(this)"><i class="bi bi-eye"></i></button>
      <button type="button" class="absolute text-sm right-5 top-0 h-10 lg:h-11 hidden text-dark-500" onclick="showHidePassword(this)"><i class="bi bi-eye-slash"></i></button>
      <input type="password" placeholder="Senha" name="password" id="password" required class="border border-dark-100 rounded-lg h-10 lg:h-11 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200" required autofocus>
    </div>
    <div class="relative mb-2">
      <button type="button" class="absolute text-sm right-5 top-0 h-10 lg:h-11 text-dark-500" onclick="showHidePassword(this)"><i class="bi bi-eye"></i></button>
      <button type="button" class="absolute text-sm right-5 top-0 h-10 lg:h-11 hidden text-dark-500" onclick="showHidePassword(this)"><i class="bi bi-eye-slash"></i></button>
      <input type="password" placeholder="Confirme a senha" name="password_confirmation" id="password_confirmation" required class="border border-dark-100 rounded-lg h-10 lg:h-11 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200" required autofocus>
    </div>
    
    <button type="submit" class="bg-danger-500 rounded-lg w-full h-10 lg:h-11 text-sm font-bold text-white hover:bg-opacity-90">Resetar</button>
  </form>

</x-auth.auth-layout>