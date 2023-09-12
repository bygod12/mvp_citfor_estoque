<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ClienteController extends Controller
{
    public function index()
    {
        return view('cliente.index');
    }

    public function create()
    {

        return view('cliente.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'observacao' => 'nullable|string',
            'email' => 'nullable|email',
            'numero' => 'nullable|max:60'
        ]);
        $user = Auth::user();
        $id = $user->funcionario->loja->id;

        $cliente = new Cliente();

        $cliente->nome = $request->nome;
        $cliente->observacao = $request->nome;
        $cliente->email = $request->nome;
        $cliente->numero = $request->numero;
        $cliente->loja_id = $id;

        $cliente->save();
        return redirect()->route('cliente.index')->with('success', 'cliente criada com sucesso!');
    }
    public function show($id)
    {

        $cliente = Cliente::find($id);

        return view('cliente.show', ['cliente' => $cliente]);
    }

    public function update(Request $request, $idcliente)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'observacao' => 'nullable|string',
            'email' => 'nullable|string|email',
            'numero' => 'nullable|max:60'
        ]);
        // Encontre a cliente existente
        $cliente = Cliente::find($idcliente);

        if (!$cliente) {
            return redirect()->back()->with('error', 'cliente não encontrada');
        }

        $user = Auth::user();
        $id = $user->funcionario->loja->id;


        $cliente->nome = $request->nome;
        $cliente->observacao = $request->nome;
        $cliente->email = $request->nome;
        $cliente->numero = $request->numero;
        $cliente->loja_id = $id;

        $cliente->save();

        return redirect()->route('cliente.index')->with('success', 'cliente atualizada com sucesso');
    }

    public function destroy($idcliente)
    {
        $cliente = Cliente::find($idcliente);
        // Use o método detach para remover os produtos relacionados a esta cliente

        $cliente->delete();

        return redirect()->route('cliente.index')->with('success', 'cliente excluído com sucesso!');
    }

    public function dados()
    {
        $user = Auth::user();
        $id = $user->funcionario->loja->id;


        $clientes = Cliente::query()->whereHas('loja', function ($query) use($id) {
                $query->where('loja_id','=', $id); // Filtra as refeições para usuários com ID 11
            })->get();


        return DataTables::of($clientes)
            ->addColumn('action', function ($cliente) {
                return '
            <a href="' . route('cliente.show', $cliente->id) . '" class="btn btn-primary btn-sm">Mostrar</a>
            <form action="'.route('cliente.destroy', $cliente->id).'" method="POST" style="display:inline;">
                '.csrf_field().'
                '.method_field('DELETE').'
                <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
            </form>
        ';
            })
            ->make(true);
    }
}
