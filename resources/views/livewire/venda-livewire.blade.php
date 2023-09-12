<div>
    <input type="button" wire:click="cloneItem" value="Novo produto" class="btn btn-outline-primary"/>
    @foreach($items as $index => $item)
        <div class="form-group mt-2">
            <label>Selecione o produto:</label>
            <select wire:model="items.{{ $index }}.produtoId" class="form-select" name="produtoId[]"
                    wire:change="$emitSelf('updatedItems({{ $index }})')">
                <option value="0">...</option>
                @foreach($produtos as $produto)
                    @if (!in_array($produto->id, $selectedOptions))
                        <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                    @endif
                @endforeach
            </select>
            <label>Quantidade:</label>
            <input wire:model="items.{{ $index }}.quant" type="number" name="quant[]" class="input_small"/>
            <label>Valor:</label>
            <input wire:model="items.{{ $index }}.valor" type="number" name="valor[]" class="input_small"/>
            <button type="button" wire:click="removeItem({{ $index }})" class="btn btn-danger fechar-item">Remover produto</button>
            <script>
                $('.select_label{{$index}}').select2();
            </script>
        </div>
    @endforeach
</div>
