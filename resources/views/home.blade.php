@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-2">
                <!-- Total de Vendas -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-money-bill"></i> Vendas total hoje</h5>
                        <h2 class="card-text">
                            R$ {{ number_format($totalVendasHoje, 2, ',', '.') }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <!-- Total de Pedidos Pendentes -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><i class="far fa-clock"></i> Pedidos Pendentes</h5>
                        <h2 class="card-text">
                            {{ $totalDoacoesParaReceber }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <!-- Total de Pedidos Entregues -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="far fa-check-circle"></i> Pedidos Entregues</h5>
                        <h2 class="card-text">
                            {{ $totalDoacoesRecebidas }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <!-- Roupas recebidas hoje -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Roupas recebidas hoje</h5>
                        <h2 class="card-text">
                            {{ $totalDoacoesAtrasadas }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <!-- Roupas em estoque -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-box"></i> Roupas em estoque</h5>
                        <h2 class="card-text">
                            {{ $totalRoupasEstoque }}
                        </h2>
                    </div>
                </div>
            </div>

        </div>
        <div class="row justify-content-center mb-3">
            <div class="col-lg-5">
                <!-- Gráfico de Vendas -->
                <div class="card">
                    <div class="card-body" style="max-height: 300px;">
                        <h5 class="card-title">Tendência de Vendas</h5>
                        {!! $incomeChartVenda->container() !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <!-- Gráfico de Vendas -->
                <div class="card">
                    <div class="card-body" style="max-height: 300px;">
                        <h5 class="card-title">Doações na semana</h5>
                        {!! $incomeChartDoacao->container() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-3">
            <div class="col-lg-10">
                <!-- Gerenciamento de Produtos -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 align-items-center">
                            <h5 class="card-title">Ultimas vendas</h5>

                            <!-- Botão de Adicionar Nova Venda -->
                            <a href="{{route('venda.create')}}" class="btn btn-primary mb-4">Cadastrar nova venda</a>
                        </div>

                        <!-- Lista de Vendas com Barra de Rolagem -->
                        <div style="max-height: 250px; min-height: 250px; overflow-y: auto;">
                            <table id="venda-dashboard-table" class="table table-bordered">
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
                    </div>
                </div>



            </div>
        </div>

        <div class="row justify-content-center mb-3">
            <div class="col-lg-10">
                <!-- Gerenciamento de Produtos -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 align-items-center">
                            <h5 class="card-title">Produtos</h5>

                            <!-- Botão de Adicionar Nova Venda -->
                            <a href="#" class="btn btn-primary btn-block">Cadastrar novo produto</a>
                        </div>

                        <!-- Lista de Vendas com Barra de Rolagem -->
                        <div style="max-height: 250px; min-height: 250px; overflow-y: auto;">
                            <table id="produtos-dashboard-table" class="table table-bordered">
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
                    </div>
                </div>



            </div>
        </div>

        <div class="row justify-content-center mb-3">

            <!-- Parte das Doações -->
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 align-items-center">
                            <h5 class="card-title">Últimas Doações</h5>

                            <!-- Botão de Adicionar Nova Doação -->
                            <a href="{{route('doacao.create')}}" class="btn btn-primary mb-4">Cadastrar doação</a>
                        </div>

                        <!-- Lista de Doações com Barra de Rolagem -->
                        <div style="max-height: 250px; overflow-y: auto;">
                            <table id="doacao-dashboard-table" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Data_doação</th>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chartscript --}}
    @if($incomeChartVenda)
        {!! $incomeChartVenda->script() !!}
    @endif
    @if($incomeChartDoacao)
        {!! $incomeChartDoacao->script() !!}
    @endif
@endsection
