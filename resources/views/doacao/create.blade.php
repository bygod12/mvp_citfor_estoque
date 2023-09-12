@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cadastrar nova Doação</div>

                    <div class="card-body">
                            <form method="POST" action="{{ route('doacao.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                    <label for="nome" class="form-label">Nome do Doador</label>
                                    <input type="text" class="form-control" id="nome" name="nomedoador" >
                                    @error('nomedoador') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email do Doador (opcional)</label>
                                    <input type="email" class="form-control" id="email" name="email" >
                                    @error('email') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="bairro" class="form-label">Bairro do Doador (opcional)</label>
                                    <input type="text" class="form-control" id="bairro" name="bairro" >
                                    @error('bairro') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="rua" class="form-label">Rua do Doador (opcional)</label>
                                    <input type="text" class="form-control" id="rua" name="rua" >
                                    @error('rua') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="num_casa" class="form-label">Número da Casa do Doado (opcional)</label>
                                    <input type="text" class="form-control" id="num_casa" name="num_casa" >
                                    @error('num_casa') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="numero_1" class="form-label">Número 1 do Doador (opcional)</label>
                                    <input type="text" class="form-control" id="numero_1" name="numero_1" >
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
                            <div class="mb-3">
                                <label for="produtos" class="form-label">Produtos doados (opcional)</label>
                                <div class="mb-3">
                                    <label for="selectedProduct" class="form-label">Selecione um produto</label>
                                    <select class="form-control selected2Product" name="produtos[]" multiple="multiple">
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            <div class="mb-3">
                                <label for="isProduct" class="form-label">Deseja cadastrar um produto?</label>
                                <input type="checkbox" id="isProduct" name="isProduct">
                            </div>
                            <div id="productForm" style="display: none;">

                                <div class="form-group">
                                    <label for="nome">Nome do Produto</label>
                                    <input type="text" class="form-control" id="nome" name="nome">
                                    @error('nome') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <textarea class="form-control" id="descricao" name="descricao" rows="3" ></textarea>
                                    @error('descricao') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="valor">Valor</label>
                                    <input type="number" class="form-control" id="valor" name="valor" step="0.01" >
                                    @error('valor') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="qtd">Quantidade em Estoque</label>
                                    <input type="number" class="form-control" id="qtd" name="qtd">
                                    @error('qtd') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="categoria_idcategoria">Categoria</label>
                                    <select class="form-control" id="categoria_id" name="categoria_id" >
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                        @endforeach
                                    </select>
                                    @error('categoria_id') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto do Produto (opcional)</label>
                                    <input type="file" class="form-control-file" id="foto" name="foto">
                                    @error('foto') <!-- Exibe o erro de validação para o campo nomedoador -->
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
