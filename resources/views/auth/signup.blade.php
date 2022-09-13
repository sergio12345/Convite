<x-auth.auth-layout title="Seja bem-vindo!" backButton="true" description="Introdução. Lorem ipsum dolor sit amet, consectetur adipiscing elit.">
  <x-jet-validation-errors class="mb-4" />  
  <form method="POST" action="{{ route('register') }}" class="mb-7">
    @csrf
    <div class="mb-4">
      <input type="text" id="name" name="name" placeholder="Nome" class="border border-dark-100 rounded-lg h-10 lg:h-11 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200" required>
    </div>
    <!-- <div class="mb-4">
      <input type="tel" placeholder="Telefone" class="border border-dark-100 rounded-lg h-10 lg:h-11 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
    </div> -->
    <div class="mb-4">
      <input type="email" id="email" name="email" placeholder="E-mail" class="border border-dark-100 rounded-lg h-10 lg:h-11 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200" required>
    </div>
    <div class="relative mb-6">
      <button type="button" class="absolute text-sm right-5 top-0 h-10 lg:h-11 text-dark-500" onclick="showHidePassword(this)"><i class="bi bi-eye"></i></button>
      <button type="button" class="absolute text-sm right-5 top-0 h-10 lg:h-11 hidden text-dark-500" onclick="showHidePassword(this)"><i class="bi bi-eye-slash"></i></button>
      <input type="password" id="password" name="password" placeholder="Senha" class="border border-dark-100 rounded-lg h-10 lg:h-11 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200" required>
    </div>
    <div class="relative mb-6">
      <button type="button" class="absolute text-sm right-5 top-0 h-10 lg:h-11 text-dark-500" onclick="showHidePassword(this)"><i class="bi bi-eye"></i></button>
      <button type="button" class="absolute text-sm right-5 top-0 h-10 lg:h-11 hidden text-dark-500" onclick="showHidePassword(this)"><i class="bi bi-eye-slash"></i></button>
      <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirme a Senha" class="border border-dark-100 rounded-lg h-10 lg:h-11 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200" required>
    </div>
    <button type="submit" class="bg-danger-500 rounded-lg w-full h-10 lg:h-11 text-sm font-bold text-white hover:bg-opacity-90">Criar sua conta</button>
  </form>
  <p class="text-xs lg:text-sm text-dark-500 mb-6">Já possui conta? <a href="/" class="text-primary-500 font-bold underline">Faça seu login</a></p>

</x-auth.auth-layout>