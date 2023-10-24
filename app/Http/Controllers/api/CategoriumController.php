<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Categorium;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriumController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $id = $user->funcionario->loja->id;
        $categorias = Categorium::whereHas('loja', function ($query) use ($id) {
            $query->where('loja_id', '=', $id);
        })->get();


        return response()->json($categorias, 200);
    }

    public function show($id)
    {
        return Categorium::findOrFail($id);
    }

    public function store(Request $request)
    {

        // Criação de uma nova categoria com os dados do formulário
        $categoria = new Categorium();
        $categoria->nome = $request->nome;
        $categoria->descricao = $request->descricao;

        $user = Auth::user();
        $categoria->loja_id = $user->funcionario->loja->id;

        // Salvar a categoria no banco de dados
        $categoria->save();

        return response()->json($categoria, 201);
    }

    public function update(Request $request, $id)
    {
        $categoria = Categorium::findOrFail($id);
        $categoria->update($request->all());
        return response()->json($categoria, 200);
    }

    public function destroy($id)
    {
        Categorium::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
