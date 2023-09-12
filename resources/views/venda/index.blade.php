
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Listagem das Vendas</h1>
        <a href="{{route('venda.create')}}" class="btn btn-primary mb-4">Cadastrar nova venda</a>
        <table id="venda-table" class="table table-bordered">
            <thead>
            <tr>
                <th>Codigo</th>
                <th>Data</th>
                <th>Valor total</th>
                <th>qtd produtos</th>
                <th>Ações</th> <!-- Coluna para botões de ação -->
            </tr>
            </thead>
        </table>
    </div>


@endsection
