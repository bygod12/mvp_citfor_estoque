<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $user;
    public $loja;
    public $funcionario;
    public $cargo;

    // Propriedades para os formulários
    public $nomeLoja;
    public $bairroLoja;
    public $ruaLoja;
    public $numCasaLoja;
    public $numeroFuncionario;
    public $cpfFuncionario;

    public function mount()
    {
        $this->user = Auth::user();
        $this->funcionario = $this->user->funcionario;
        $this->loja = $this->funcionario->loja;
        $this->cargo = $this->funcionario->cargo;
    }

    // Métodos para salvar as alterações nos formulários
    public function salvarAlteracoesLoja()
    {
        // Validação dos dados do formulário
        $this->validate([
            'nomeLoja' => 'string|max:80',
            'bairroLoja' => 'string|max:80',
            'ruaLoja' => 'string|max:80',
            'numCasaLoja' => 'string|max:10',
        ]);

        // Atualize os dados da loja
        $this->loja->update([
            'nome' => $this->nomeLoja,
            'bairro' => $this->bairroLoja,
            'rua' => $this->ruaLoja,
            'num_casa' => $this->numCasaLoja,
        ]);

        // Em seguida, redirecione ou exiba uma mensagem de sucesso, conforme necessário.
    }

    public function salvarAlteracoesFuncionario()
    {
        // Validação dos dados do formulário
        $this->validate([
            'numeroFuncionario' => 'string|max:45',
            'cpfFuncionario' => 'string|max:45',
        ]);

        // Atualize os dados do funcionário
        $this->funcionario->update([
            'numero' => $this->numeroFuncionario,
            'cpf' => $this->cpfFuncionario,
        ]);

        // Em seguida, redirecione ou exiba uma mensagem de sucesso, conforme necessário.
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
