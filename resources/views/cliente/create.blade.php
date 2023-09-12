@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cadastrar Cliente</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('cliente.store') }}" enctype="multipart/form-data">
                            @csrf

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


                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
