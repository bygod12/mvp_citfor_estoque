@extends('layouts.app')

@section('content')
    <div class="container">
        @if(!$produtos->isEmpty())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Atualizar Venda</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('venda.update', $venda->id) }}" enctype="multipart/form-data" id="formulario">
                                @csrf
                                @method('PUT')
                                <input type="button" id="novoProd" value="Novo produto" class="btn btn-outline-primary"/>
                                <button type="submit" class="btn btn-primary" id="salvarBtn" disabled>Salvar</button>
                                {{-- Loop para exibir produtos relacionados à venda --}}
                                @foreach($venda->produtos as $produto)
                                    <div class="form-group">
                                        <div class="item">
                                            <label>Selecione o produto:</label>
                                            <select class="form-select select_label" name="produtoId[]" required>
                                                <option>...</option>
                                                @foreach($produtos as $produtoDisponivel)
                                                    <option value="{{ $produtoDisponivel->id }}" {{ $produto->id == $produtoDisponivel->id ? 'selected' : '' }}>
                                                        {{ $produtoDisponivel->nome }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label>Quantidade:</label>
                                            <input type="number" name="quant[]" class="input_small" value="{{ $produto->pivot->qtd_vendida }}" required/>
                                            <label>Valor:</label>
                                            <input type="number" name="valor[]" class="input_small" value="{{ $produto->pivot->preco_unitario }}" required/>
                                            <button type="button" class="btn btn-danger fechar-item">Remover produto</button>
                                        </div>
                                    </div>
                                @endforeach

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
