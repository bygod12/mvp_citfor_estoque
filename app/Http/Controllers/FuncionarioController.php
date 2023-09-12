<?php

namespace App\Http\Controllers;

use App\Models\Categorium;
use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FuncionarioController extends Controller
{
    public function index()
    {

        return view('funcionario.index');
    }

    public function create()
    {
        return view('funcionario.create');
    }

    public function store(Request $request)
    {
        // Validação dos campos do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users',
            'password' => 'required|string',
            'cargo' => 'required|string',
            'cpf' => 'required|string',
            'numero' => 'required|string'
        ]);

        // Criação de um novo funcionário com os dados do formulário
        $funcionario = new Funcionario();
        $funcionario->cargo = $request->input('cargo');
        $funcionario->cpf = $request->input('cpf');
        $funcionario->numero = $request->input('numero');

        // Salvar o funcionário no banco de dados
        // Criação de um novo usuário com os dados do formulário
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password')); // Criptografar a senha
        $user->isfuncionario = true;
        $user->save();

        // Salvar o usuário no banco de dados
        $funcionario->user_id = $user->id; // Associe o usuário ao funcionário
        $funcionario->save();
        $user->funcionario_id = $funcionario->id;
        $user->save();

        return redirect()->route('funcionario.index')->with('success', 'Funcionário criado com sucesso!');
    }

    public function show($idfuncionario)
    {
        $funcionario = Funcionario::find($idfuncionario);
        return view('funcionario.show', ['funcionario' => $funcionario]);
    }



    public function update(Request $request, $idfuncionario)
    {
        // Validação dos campos do formulário
        $request->validate([
            'cargo' => 'required|string',
            'cpf' => 'required|string',
            'numero' => 'required|string'
        ]);

        // Recupere a categoria existente
        $funcionario = Funcionario::find($idfuncionario);

        // Atualize os dados da categoria com os dados do formulário
        $funcionario->cargo = $request->cargo;
        $funcionario->cpf = $request->cpf;
        $funcionario->numero = $request->numero;

        // Salvar as alterações no banco de dados
        $funcionario->save();

        return redirect()->route('funcionario.index')->with('success', 'Funcionário atualizada com sucesso!');
    }

    public function destroy($idfuncionario)
    {
        // Encontre o funcionário pelo ID
        $funcionario = Funcionario::find($idfuncionario);

        if (!$funcionario) {
            return redirect()->route('funcionario.index')->with('error', 'Funcionário não encontrado.');
        }
        // Exclua o usuário associado ao funcionário, se existir
        if ($funcionario->auth) {
            $funcionario->auth->delete();
        }

        // Exclua o funcionário
        $funcionario->delete();

        return redirect()->route('funcionario.index')->with('success', 'Funcionario excluída com sucesso!');
    }

    public function dados()
    {
        $funcionario = Funcionario::with('user')->get();

        return DataTables::of($funcionario)
            ->addColumn('action', function ($funcionario) {
                return '
                <a href="' . route('funcionario.show', $funcionario->id) . '" class="btn btn-primary btn-sm">Mostrar</a>
                <form action="' . route('funcionario.destroy', $funcionario->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                </form>
            ';
            })
            ->make(true);
    }
}


