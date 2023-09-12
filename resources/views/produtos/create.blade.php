@extends('layouts.app')

@section('content')
    <div class="container">
        @if(!$categorias->isEmpty())

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Criar Novo Produto</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('produto.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="nome">Nome do Produto</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                                @error('nome') <!-- Exibe o erro de validação para o campo nomedoador -->
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                                @error('descricao') <!-- Exibe o erro de validação para o campo nomedoador -->
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="valor">Valor</label>
                                <input type="number" class="form-control" id="valor" name="valor" step="0.01" required>
                                @error('valor') <!-- Exibe o erro de validação para o campo nomedoador -->
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="qtd">Quantidade em Estoque</label>
                                <input type="number" class="form-control" id="qtd" name="qtd" required>
                                @error('qtd') <!-- Exibe o erro de validação para o campo nomedoador -->
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="categoria_idcategoria">Categoria</label>
                                <select class="form-control" id="categoria_id" name="categoria_id" required>
                                    @foreach($categorias as $categoria)
                                        <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                    @endforeach
                                </select>
                                @error('categoria_id') <!-- Exibe o erro de validação para o campo nomedoador -->
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="isDonation" class="form-label">É uma Doação?</label>
                                <input type="checkbox" id="isDonation" name="isDonation">
                            </div>
                            <div id="doacaoForm" style="display: none;">

                                <div class="mb-3">
                                    <label for="nome" class="form-label">Nome do Doador</label>
                                    <input type="text" class="form-control" id="nome" name="nomedoador">
                                    @error('nomedoador') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email do Doador (opcional)</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    @error('email') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="bairro" class="form-label">Bairro do Doador (opcional)</label>
                                    <input type="text" class="form-control" id="bairro" name="bairro">
                                    @error('bairro') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="rua" class="form-label">Rua do Doador (opcional)</label>
                                    <input type="text" class="form-control" id="rua" name="rua">
                                    @error('rua') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="num_casa" class="form-label">Número da Casa do Doado (opcional)</label>
                                    <input type="text" class="form-control" id="num_casa" name="num_casa">
                                    @error('num_casa') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="numero_1" class="form-label">Número 1 do Doador (opcional)</label>
                                    <input type="text" class="form-control" id="numero_1" name="numero_1">
                                    @error('numero_1') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="numero_2" class="form-label">Número 2 do Doador (opcional)</label>
                                    <input type="text" class="form-control" id="numero_2" name="numero_2">
                                    @error('numero_2') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="hora_entrega" class="form-label">Hora de Entrega</label>
                                    <input type="datetime-local" class="form-control" id="hora_entrega" name="hora_entrega">
                                    @error('hora_entrega') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="entregue" class="form-label">Entregue</label>
                                    <input type="checkbox" id="entregue" name="entregue">
                                    @error('entregue') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="foto">Foto do Produto (opcional)</label>
                                <input type="file" class="form-control-file" id="foto" name="foto">
                                @error('foto') <!-- Exibe o erro de validação para o campo nomedoador -->
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="alert alert-primary" role="alert">
                Para cadastrar um produto é necessario que tenha ao menos uma <a href="{{route('categoria.index')}}"> categoria </a>
            </div>
        @endif
    </div>

@endsection
