<x-dashboard-layout.settings title="Saldo" name="{{ $name }}" email="{{ $email }}" initials="{{ $initials }}">
  <form action="">

    <span class="font-medium text-dark-200">Valor total arrecadado</span>
    <div class="mb-10">
      <input type="text" placeholder="total arrecadado" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
    </div>
    
    <span class="font-medium text-dark-200">Valor resgatado</span>
    <div class="mb-10">
      <input type="text" placeholder="valor resgatado" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
    </div>

    <span class="font-medium text-dark-200">Saldo</span>
    <div class="mb-10">
      <input type="text" placeholder="saldo" class="border border-dark-100 rounded-lg h-10 py-4 px-4 text-xs w-full focus:border-primary-500 focus:text-primary-500 focus:bg-primary-200 focus:ring-0 placeholder:text-dark-200">
    </div>

    <div>
      <button type="button" class="bg-white border border-danger-500 rounded-lg mr-4 w-auto px-6 h-10 text-sm font-bold text-danger-500 hover:bg-opacity-90">Cancelar</button>
      <button type="submit" class="bg-danger-500 rounded-lg w-auto px-6 h-10 text-sm font-bold text-white hover:bg-opacity-90">Salvar alterações</button>
    </div>
  </form>
</x-dashboard-layout.settings>