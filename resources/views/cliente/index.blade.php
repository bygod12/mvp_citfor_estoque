
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Listagem dos Clientes</h1>
        <a href="{{route('cliente.create')}}" class="btn btn-primary mb-4">Cadastrar Cliente</a>
        <table id="clientes-table" class="table table-bordered">
            <thead>
            <tr>
                <th>Data inserção</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Número</th>
                <th>Observações</th>
                <th>Ações</th> <!-- Coluna para botões de ação -->
            </tr>
            </thead>
        </table>
    </div>


@endsection
