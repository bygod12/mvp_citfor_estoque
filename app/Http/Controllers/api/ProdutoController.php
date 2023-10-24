<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Categorium;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $id = $user->funcionario->loja->id;

        $produtos = Produto::query()->whereHas('loja', function ($query) use($id) {
            $query->where('id','=', $id); // Filtra as refeições para usuários com ID 11
        })->with(['categoria', 'doador', 'loja'])->get(); // Carrega as relações categoria e doador


        return response()->json($produtos, 200);
    }

    public function show($id)
    {
        return Produto::findOrFail($id);
    }

    public function store(Request $request)
    {
        $produto = Produto::create($request->all());
        return response()->json($produto, 201);
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->update($request->all());
        return response()->json($produto, 200);
    }

    public function destroy($id)
    {
        Produto::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
