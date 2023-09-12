@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cadastrar nova Doação</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('doacao.update', $doador->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Usando o método PUT para atualização -->
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome do Doador</label>
                                <input type="text" class="form-control" id="nome" name="nomedoador" value="{{old('nomedoador',$doador->nomedoador)}}">
                                @error('nomedoador') <!-- Exibe o erro de validação para o campo nomedoador -->
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email do Doador (opcional)</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email',$doador->email)}}">
                                @error('email') <!-- Exibe o erro de validação para o campo nomedoador -->
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bairro" class="form-label">Bairro do Doador (opcional)</label>
                                <input type="text" class="form-control" id="bairro" name="bairro" value="{{old('bairro',$doador->bairro)}}">
                                @error('bairro') <!-- Exibe o erro de validação para o campo nomedoador -->
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="rua" class="form-label">Rua do Doador (opcional)</label>
                                <input type="text" class="form-control" id="rua" name="rua" value="{{old('rua',$doador->rua)}}">
                                @error('rua') <!-- Exibe o erro de validação para o campo nomedoador -->
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="num_casa" class="form-label">Número da Casa do Doado (opcional)</label>
                                <input type="text" class="form-control" id="num_casa" name="num_casa" value="{{old('num_casa',$doador->num_casa)}}">
                                @error('num_casa') <!-- Exibe o erro de validação para o campo nomedoador -->
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="numero_1" class="form-label">Número 1 do Doador (opcional)</label>
                                <input type="text" class="form-control" id="numero_1" name="numero_1" value="{{old('numero_1',$doador->numero_1)}}">
                                @error('numero_1') <!-- Exibe o erro de validação para o campo nomedoador -->
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="numero_2" class="form-label">Número 2 do Doador (opcional)</label>
                                <input type="text" class="form-control" id="numero_2" name="numero_2" value="{{old('numero_2',$doador->numero_2)}}">
                                @error('numero_2') <!-- Exibe o erro de validação para o campo nomedoador -->
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="hora_entrega" class="form-label">Hora de Entrega</label>
                                <input type="datetime-local" class="form-control" id="hora_entrega" name="hora_entrega" value="{{old('hora_entrega', \Carbon\Carbon::parse(optional($doador->hora_entrega)->format('Y-m-d\TH:i'))) }}">
                                @error('hora_entrega') <!-- Exibe o erro de validação para o campo nomedoador -->
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="entregue" class="form-label">Entregue</label>
                                <input type="checkbox" id="entregue" name="entregue" @if(optional($doador->entregue)) checked @endif>
                                @error('entregue') <!-- Exibe o erro de validação para o campo nomedoador -->
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="produtos" class="form-label">Produtos doados</label>
                                <div class="mb-3">
                                    <label for="selectedProduct" class="form-label">Selecione um produto</label>
                                    <select class="form-control select2 selected2Product" name="produtos[]" multiple="multiple">
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto->id }}"
                                                {{ in_array($produto->id, old('produtos', [])) ? 'selected' : '' }}>
                                                {{ $produto->nome }}
                                            </option>
                                        @endforeach
                                        @foreach($produtos_doador as $produto)
                                                <option value="{{ $produto->id }}" selected>
                                                    {{ $produto->nome }}
                                                </option>
                                        @endforeach

                                    </select>
                                </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
