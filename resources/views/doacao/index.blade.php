
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Listagem de Doações</h1>
        <a href="{{route('doacao.create')}}" class="btn btn-primary mb-4">Cadastrar doação</a>
        <table id="doacao-table" class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>localizacao</th>
                <th>numero_1</th>
                <th>numero_2</th>
                <th>hora_entrega</th>
                <th>Entregue</th>

                <th>Ações</th> <!-- Coluna para botões de ação -->
            </tr>
            </thead>
        </table>
    </div>


@endsection
