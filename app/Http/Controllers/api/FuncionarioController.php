<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Categorium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuncionarioController extends Controller
{
    public function index($id)
    {

        $user = Auth::user();
        $id = $user->funcionario->loja->id;

        $categorias = Categorium::query()->whereHas('loja', function ($query) use($id) {
            $query->where('loja_id','=', $id); // Filtra as refeições para usuários com ID 11
        });


        return response()->json($categorias, 200);
    }

    public function show($id)
    {
        return Categorium::findOrFail($id);
    }

    public function store(Request $request)
    {
        $categoria = Categorium::create($request->all());
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
