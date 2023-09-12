
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Listagem de Funcionario</h1>
        <a href="{{route('funcionario.create')}}" class="btn btn-primary mb-4">Cadastrar funcionnario</a>
        <table id="funcionario-table" class="table table-bordered">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Cargo</th>
                <th>Cpf</th>
                <th>Numero</th>
                <th>Ações</th> <!-- Coluna para botões de ação -->
            </tr>
            </thead>
        </table>
    </div>


@endsection
