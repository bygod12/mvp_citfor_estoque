<?php

namespace App\Http\Controllers;

use App\Models\Categorium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CategoriumController extends Controller
{
    public function index()
    {

        return view('categoria.index');
    }

    public function create()
    {
        return view('categoria.create');
    }

    public function store(Request $request)
    {
        // Validação dos campos do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        // Criação de uma nova categoria com os dados do formulário
        $categoria = new Categorium();
        $categoria->nome = $request->input('nome');
        $categoria->descricao = $request->input('descricao');
        $user = Auth::user();
        $categoria->loja_id = $user->funcionario->loja->id;
        // Salvar a categoria no banco de dados
        $categoria->save();

        return redirect()->route('categoria.index')->with('success', 'Categoria criada com sucesso!');
    }

    public function show($idcategoria)
    {
        $categoria = Categorium::find($idcategoria);
        return view('categoria.show', ['categoria' => $categoria]);
    }



    public function update(Request $request, $idcategoria)
    {
        // Validação dos campos do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
        ]);

        // Recupere a categoria existente
        $categoria = Categorium::find($idcategoria);

        // Atualize os dados da categoria com os dados do formulário
        $categoria->nome = $request->nome;
        $categoria->descricao = $request->descricao;

        // Salvar as alterações no banco de dados
        $categoria->save();

        return redirect()->route('categoria.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy($idcategoria)
    {
        // Encontre a categoria e exclua-a
        $categoria = Categorium::find($idcategoria);
        $categoria->delete();

        return redirect()->route('categoria.index')->with('success', 'Categoria excluída com sucesso!');
    }

    public function dados()
    {
        $user = Auth::user();
        $id = $user->funcionario->loja->id;

        $categorias = Categorium::query()->whereHas('loja', function ($query) use($id) {
            $query->where('loja_id','=', $id); // Filtra as refeições para usuários com ID 11
        });

        return DataTables::of($categorias)
            ->addColumn('action', function ($categoria) {
                return '
                <a href="' . route('categoria.show', $categoria->id) . '" class="btn btn-primary btn-sm">Mostrar</a>
                <form action="' . route('categoria.destroy', $categoria->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                </form>
            ';
            })
            ->make(true);
    }
}
