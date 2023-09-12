<?php

namespace App\Http\Controllers;

use App\Models\Categorium;
use App\Models\Doador;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DoadorController extends Controller
{
    public function index()
    {
        return view('doacao.index');
    }

    public function create()
    {
        $user = Auth::user();
        $id = $user->funcionario->loja->id;

        $produtos = Produto::whereHas('loja', function ($query) use($id) {
            $query->where('loja_id','=', $id);
        })->whereNull('doador_id')->get();
        $categorias = Categorium::whereHas('loja', function ($query) use($id) {
            $query->where('loja_id','=', $id);
        })->get();

        return view('doacao.create', ['produtos' => $produtos, 'categorias' => $categorias]);
    }

    public function store(Request $request)
    {
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

        if ($request->isProduct){
            // Validação dos campos do formulário
            $request->validate([
                'nome' => 'required|string|max:255',
                'descricao' => 'nullable|string',
                'valor' => 'required|numeric',
                'qtd' => 'required|integer',
                'categoria_id' => 'required|integer',
                'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', ]);
            // Exemplo para validação de imagem
                if ($request->hasFile('foto')) {
                    $requestImage = $request->file('foto');
                    $extension = $requestImage->extension();
                    $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
                    $requestImage->move(public_path('img/produtos'), $imageName);
                } else {
                    $imageName = null; // Caso não seja fornecida uma imagem
                }
                $produto = new Produto();

                // Salvar o produto no banco de dados
                $produto->nome = $request->nome;
                $produto->descricao = $request->descricao;
                $produto->valor = $request->valor;
                $produto->qtd = $request->qtd;
                $produto->categoria_id = $request->categoria_id;
                $produto->doador_id = $doador->id;
                $produto->foto = $imageName;
                $user = Auth::user();
                $produto->loja_id = $user->funcionario->loja->id;

                $produto->save();
            }

        if (!is_null($request->produtos) && count($request->produtos) > 0) {
            foreach ($request->produtos as $produtoId) {
                $produto = Produto::find($produtoId);
                $produto->doador_id = $doador->id;
                $produto->save();
            }
        }
        return redirect()->route('doacao.index')->with('success', 'Doação criado com sucesso!');
    }

    public function show($id)
    {
        $user = Auth::user();
        $idloja = $user->funcionario->loja->id;


        $produtos_doador = Produto::where('doador_id', $id)->get();

        $produtos = Produto::whereHas('loja', function ($query) use($idloja) {
            $query->where('loja_id','=', $idloja);
        })->whereNull('doador_id')->get();
        $categorias = Categorium::whereHas('loja', function ($query) use($idloja) {
            $query->where('loja_id','=', $idloja);
        })->get();
        $doador = Doador::find($id);

        return view('doacao.show', ['produtos' => $produtos,
                                         'doador' => $doador,
                                         'produtos_doador' =>$produtos_doador,
                                         'categorias' => $categorias]);
    }

    public function update(Request $request, $iddoador)
    {
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
        $doador = Doador::find($iddoador);
        $doador->nomedoador = $request->nomedoador;
        $doador->email = $request->email;
        $doador->bairro = $request->bairro;
        $doador->rua = $request->rua;
        $doador->num_casa = $request->num_casa;
        $doador->numero_1 = $request->numero_1;
        $doador->numero_2 = $request->numero_2;
        $doador->hora_entrega = $request->hora_entrega;
        $doador->entregue = $entregado;
        $doador->save();

        $produtos_doador = Produto::where('doador_id', $iddoador)->get();
        foreach ($produtos_doador as $produto){
            $produto->doador_id = null;
            $produto->save();
        }


        if (!is_null($request->produtos) && count($request->produtos) > 0) {
            foreach ($request->produtos as $produtoId) {
                $produto = Produto::find($produtoId);
                $produto->doador_id = $doador->id;
                $produto->save();
            }
        }
        return redirect()->route('doacao.index')->with('success', 'Doação atualizado com sucesso!');
    }

    public function destroy($iddoador)
    {
        $doador = Doador::find($iddoador);
        $doador->delete();

        return redirect()->route('doacao.index')->with('success', 'Doação excluído com sucesso!');
    }

    public function dados()
    {
        $user = Auth::user();
        $id = $user->funcionario->loja->id;

        $doador = Doador::query()->whereHas('loja', function ($query) use($id) {
            $query->where('id','=', $id); // Filtra as refeições para usuários com ID 11
        }); // Carrega as relações categoria e doador

        return DataTables::of($doador)
            ->addColumn('action', function($doador) {
                return '
                <a href="' . route('doacao.show', $doador->id) . '" class="btn btn-primary btn-sm">Mostrar</a>
                <form action="'.route('doacao.destroy', $doador->id).'" method="POST" style="display:inline;">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                </form>
            ';
            })
            ->make(true);
    }
}
