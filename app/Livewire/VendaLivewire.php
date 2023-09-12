<?php

namespace App\Livewire;

use Livewire\Component;

class VendaLivewire extends Component
{
    public $produtos;
    public $items = [];
    public $selectedOptions = [];

    public function mount()
    {
        // Inicialize $selectedOptions como um array vazio
        $this->selectedOptions = [];
    }

    public function updatedItems($index)
    {
        // Verifique se o índice existe em $this->items antes de acessá-lo
        if (isset($this->items[$index])) {
            foreach ($this->items as $i => $item) {
                if ($i != $index) {
                    $this->selectedOptions[$i] = $this->items[$index]['produtoId'];
                }
            }

            // Adicione o produto selecionado à lista de produtos selecionados
            $selectedProductId = $this->items[$index]['produtoId'];
            if ($selectedProductId !== null) {
                $this->selectedOptions[$index] = $selectedProductId;
                // Remova o produto selecionado da lista de produtos disponíveis
                $this->produtos = collect($this->produtos)->filter(function ($produto) use ($selectedProductId) {
                    return $produto->id !== $selectedProductId;
                });
            }
        }
    }

    public function render()
    {
        return view('livewire.venda-livewire');
    }

    public function cloneItem()
    {
        $a = [
            'produtoId' => null,
            'quant' => null,
            'valor' => null,
        ];
        array_push($this->items, $a);
    }

    public function removeItem($index)
    {
        // Resto do código permanece inalterado
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }
}
