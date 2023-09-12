<div>
    <div class="mb-3">
        <label for="isDonation" class="form-label">É uma Doação?</label>
        <input type="checkbox"  wire:model="isDonation" id="isDonation">
    </div>

    @if ($isDonation)
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Doador</label>
            <input type="text" class="form-control" id="nome">
            @error('nome') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email do Doador</label>
            <input type="email" class="form-control" id="email">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="bairro" class="form-label">Bairro do Doador</label>
            <input type="text" class="form-control" id="bairro">
            @error('bairro') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="rua" class="form-label">Rua do Doador</label>
            <input type="text" class="form-control" id="rua">
            @error('rua') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="num_casa" class="form-label">Número da Casa do Doador</label>
            <input type="text" class="form-control" id="num_casa">
            @error('num_casa') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="numero_1" class="form-label">Número 1 do Doador</label>
            <input type="text" class="form-control" id="numero_1">
            @error('numero_1') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="numero_2" class="form-label">Número 2 do Doador</label>
            <input type="text" class="form-control" id="numero_2">
            @error('numero_2') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="hora_entrega" class="form-label">Hora de Entrega</label>
            <input type="datetime-local" class="form-control" id="hora_entrega">
            @error('hora_entrega') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="entregue" class="form-label">Entregue</label>
            <input type="checkbox" id="entregue">
        </div>
    @endif
</div>
