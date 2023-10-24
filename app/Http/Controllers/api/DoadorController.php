<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Categorium;
use App\Models\Doador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoadorController extends Controller
{
    public function index($id)
    {

        $user = Auth::user();
        $id = $user->funcionario->loja->id;

        $doadores = Doador::query()->whereHas('loja', function ($query) use($id) {
            $query->where('id','=', $id); // Filtra as refeições para usuários com ID 11
        }); // Carrega as relações categoria e doador


        return response()->json($doadores, 200);
    }

    public function show($id)
    {
        return Doador::findOrFail($id);
    }

    public function store(Request $request)
    {
        $doador = Doador::create($request->all());
        return response()->json($doador, 201);
    }

    public function update(Request $request, $id)
    {
        $doador = Doador::findOrFail($id);
        $doador->update($request->all());
        return response()->json($doador, 200);
    }

    public function destroy($id)
    {
        Doador::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
