<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendaController extends Controller
{
    public function index($id)
    {

        $vendas = Venda::with('produtos')->get();


        return response()->json($vendas, 200);
    }

    public function show($id)
    {
        return Venda::findOrFail($id);
    }

    public function store(Request $request)
    {
        $venda = Venda::create($request->all());
        return response()->json($venda, 201);
    }

    public function update(Request $request, $id)
    {
        $venda = Venda::findOrFail($id);
        $venda->update($request->all());
        return response()->json($venda, 200);
    }

    public function destroy($id)
    {
        Venda::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
