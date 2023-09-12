
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Listagem de Produtos</h1>
        <a href="{{route('produto.create')}}" class="btn btn-primary mb-4">Cadastrar produto</a>
        <table id="produtos-table" class="table table-bordered">
            <thead>
            <tr>
                <th>Foto</th>
                <th>Data inserção</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Quantidade</th>
                <th>Categoria</th>
                <th>Doador</th>

                <th>Ações</th> <!-- Coluna para botões de ação -->
            </tr>
            </thead>
        </table>
    </div>


@endsection
