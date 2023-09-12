<?php

namespace App\Http\Controllers;

use App\Models\Categorium;
use App\Models\Doador;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProdutoController extends Controller
{
    public function index()
    {
        return view('produtos.index');
    }

    public function create()
    {
        $user = Auth::user();
        $id = $user->funcionario->loja->id;


        $categorias = Categorium::whereHas('loja', function ($query) use($id) {
            $query->where('loja_id','=', $id);
        })->get();
        return view('produtos.create', ['categorias' => $categorias]);
    }

    public function store(Request $request)
    {
        // Validação dos campos do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'valor' => 'required|numeric',
            'qtd' => 'required|integer',
            'categoria_id' => 'required|integer',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Exemplo para validação de imagem
        ]);

        $produto = new Produto();

        if ($request->isDonation) {
            // É uma doação, crie um novo doador
            $request->validate([
                'nomedoador' => 'required|string|max:255',
                'email' => 'nullable|email|unique:doador,email',
                'bairro' => 'nullable|string|max:255',
                'rua' => 'nullable|string|max:255',
                'num_casa' => 'nullable|string|max:255',
                'numero_1' => 'nullable|string|max:255',
                'numero_2' => 'nullable|string|max:255',
                'hora_entrega' => 'required|date',
            ]);

            if ($request->entregue == 'on'){
                $entregado = true;
            }else{
                $entregado = false;

            }
            $doador = new Doador();
            $doador->nomedoador = $request->nomedoador;
            $doador->email = $request->email;
            $doador->bairro = $request->bairro;
            $doador->rua = $request->rua;
            $doador->num_casa = $request->num_casa;
            $doador->numero_1 = $request->numero_1;
            $doador->numero_2 = $request->numero_2;
            $doador->hora_entrega = $request->hora_entrega;
            $doador->entregue = $entregado;
            $user = Auth::user();
            $doador->loja_id = $user->funcionario->loja->id;
            $doador->save();

            $produto->doador_id = $doador->id;
        }

        if ($request->hasFile('foto')) {
            $requestImage = $request->file('foto');
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/produtos'), $imageName);
        } else {
            $imageName = null; // Caso não seja fornecida uma imagem
        }
        // Salvar o produto no banco de dados
        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->valor = $request->valor;
        $produto->qtd = $request->qtd;
        $produto->categoria_id = $request->categoria_id;
        $produto->foto = $imageName;
        $user = Auth::user();
        $produto->loja_id = $user->funcionario->loja->id;

        $produto->save();

        return redirect()->route('produto.index')->with('success', 'Produto criado com sucesso!');
    }

    public function show($id)
    {
        $user = Auth::user();
        $idloja = $user->funcionario->loja->id;

        $categorias = Categorium::whereHas('loja', function ($query) use($idloja) {
            $query->where('loja_id','=', $idloja);
        })->get();

        $produto = Produto::find($id);
        return view('produtos.show', ['produto' => $produto, 'categorias' => $categorias ]);
    }

    public function edit($idproduto)
    {
        $produto = Produto::find($idproduto);
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, $idproduto)
    {
        // Validação dos campos do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'valor' => 'required|numeric',
            'qtd' => 'required|integer',
            'categoria_id' => 'required|integer',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Exemplo para validação de imagem
        ]);

        $produto = Produto::find($idproduto);

        if ($request->isDonation) {
            // É uma doação, crie um novo doador
            $request->validate([
                'nomedoador' => 'required|string|max:255',
                'email' => 'nullable|email',
                'bairro' => 'nullable|string|max:255',
                'rua' => 'nullable|string|max:255',
                'num_casa' => 'nullable|string|max:255',
                'numero_1' => 'nullable|string|max:255',
                'numero_2' => 'nullable|string|max:255',
                'hora_entrega' => 'required|date',
            ]);

            if ($request->entregue == 'on'){
                $entregado = true;
            }else{
                $entregado = false;

            }
            $doador = $produto->doador;
            $doador->nomedoador = $request->nomedoador;
            $doador->email = $request->email;
            $doador->bairro = $request->bairro;
            $doador->rua = $request->rua;
            $doador->num_casa = $request->num_casa;
            $doador->numero_1 = $request->numero_1;
            $doador->numero_2 = $request->numero_2;
            $doador->hora_entrega = $request->hora_entrega;
            $doador->entregue = $entregado;
            $user = Auth::user();
            $doador->loja_id = $user->funcionario->loja->id;

            $doador->save();

            $produto->doador_id = $doador->id;
        }

        if ($request->hasFile('foto')) {
            $requestImage = $request->file('foto');
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/produtos'), $imageName);
        } else {
            $imageName = null; // Caso não seja fornecida uma imagem
        }
        // Salvar o produto no banco de dados
        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->valor = $request->valor;
        $produto->qtd = $request->qtd;
        $produto->categoria_id = $request->categoria_id;
        $produto->foto = $imageName;

        $produto->save();


        return redirect()->route('produto.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($idproduto)
    {
        $produto = Produto::find($idproduto);
        $produto->delete();

        return redirect()->route('produto.index')->with('success', 'Produto excluído com sucesso!');
    }

    public function dados(Request $request)
    {
        $user = Auth::user();
        $id = $user->funcionario->loja->id;

        $produtos = Produto::query()->whereHas('loja', function ($query) use($id) {
            $query->where('id','=', $id); // Filtra as refeições para usuários com ID 11
        })->with(['categoria', 'doador', 'loja'])->get(); // Carrega as relações categoria e doador



        return DataTables::of($produtos)
            ->addColumn('action', function($produto) {
                return '
                <a href="' . route('produto.show', $produto->id) . '" class="btn btn-primary btn-sm">Mostrar</a>
                <form action="'.route('produto.destroy', $produto->id).'" method="POST" style="display:inline;">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                </form>
            ';
            })
            ->make(true);
    }

}
