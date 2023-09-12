<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Categorium;
use Illuminate\Http\Request;

class CategoriumController extends Controller
{
    public function index($id)
    {

        $refeicoes = Categorium::whereHas('user', function ($query) use($id) {
            $query->where('id','=', $id); // Filtra as refeições para usuários com ID 11
        })
            ->with('alimentos') // Carrega a relação de alimentos
            ->get();

        return response()->json($refeicoes, 200);
    }

    public function show($id)
    {
        return Categorium::findOrFail($id);
    }

    public function store(Request $request)
    {
        $refeicao = Categorium::create($request->all());
        return response()->json($refeicao, 201);
    }

    public function update(Request $request, $id)
    {
        $refeicao = Categorium::findOrFail($id);
        $refeicao->update($request->all());
        return response()->json($refeicao, 200);
    }

    public function destroy($id)
    {
        Categorium::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
