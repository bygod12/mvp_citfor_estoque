@extends('layouts.app')

@section('content')
    <div class="container">
        @if(!$produtos->isEmpty())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Criar Nova Venda</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('venda.store') }}" enctype="multipart/form-data" id="formulario">
                                @csrf

                                <input type="button" id="novoProd" value="Novo produto" class="btn btn-outline-primary"/>
                                <button type="submit" class="btn btn-primary" id="salvarBtn" disabled>Salvar</button>
                                <hr>
                                <div id="cliente_select">
                                    <label>Selecione o cliente:</label>
                                    <select class="form-select" name="clienteId" id="cliente_to_select"  required>
                                        <option value="000">...</option>
                                        @foreach($clientes as $cliente)
                                            <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="isCliente" class="form-label">Deseja cadastrar um Cliente?</label>
                                    <input type="checkbox" id="isCliente" name="isCliente">
                                </div>

                                <div id="clienteForm" style="display: none;">
                                    <div class="form-group">
                                        <label for="nome">Nome do Cliente</label>
                                        <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome')}}" required>
                                        @error('nome') <!-- Exibe o erro de validação para o campo nomedoador -->
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nome">Email do cliente (opcional)</label>
                                        <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}" >
                                        @error('email') <!-- Exibe o erro de validação para o campo nomedoador -->
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nome">Número do cliente (opcional)</label>
                                        <input type="text" class="form-control" id="numero" name="numero" value="{{old('numero')}}" >
                                        @error('numero') <!-- Exibe o erro de validação para o campo nomedoador -->
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="descricao">Observações (opcional)</label>
                                        <textarea class="form-control" id="observacao" name="observacao" rows="3" >{{old('nome')}}</textarea>
                                        @error('observacao') <!-- Exibe o erro de validação para o campo nomedoador -->
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                            <div class="form-group d-none">
                                <div id="item" class="item">

                                    <label>Selecione o produto:</label>
                                    <select class="form-select select_label" name="produtoId[]" required>
                                        <option>...</option>
                                        @foreach($produtos as $produto)
                                            <option value="{{$produto->id}}">{{$produto->nome}}</option>
                                        @endforeach
                                    </select>
                                    <label>Quantidade:</label>
                                    <input type="number" name="quant[]" class="input_small" required/>
                                    <label>Valor:</label>
                                    <input type="number" name="valor[]" class="input_small" required/>
                                    <button type="button" class="btn btn-danger fechar-item">Remover produto</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-primary" role="alert">
                Para cadastrar uma venda é necessário que tenha ao menos um <a href="{{route('produto.index')}}">produto</a>.
            </div>
        @endif
    </div>
@endsection
