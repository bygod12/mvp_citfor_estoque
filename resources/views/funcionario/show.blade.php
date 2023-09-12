@extends('layouts.app')

@section('content')
    <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Criar Novo Produto</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('funcionario.update', $funcionario->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Usando o método PUT para atualização -->

                                <div class="row mb-3">
                                    <label for="cargo" class="col-md-4 col-form-label text-md-end">Cargo</label>

                                    <div class="col-md-6">
                                        <input id="cargo" type="text" class="form-control @error('cargo') is-invalid @enderror" name="cargo" required value="{{old('cargo',$funcionario->cargo)}}">

                                        @error('cargo')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="numero" class="col-md-4 col-form-label text-md-end">Número</label>

                                    <div class="col-md-6">
                                        <input id="numero" type="text" class="form-control @error('numero') is-invalid @enderror" name="numero" required value="{{old('numero',$funcionario->numero)}}">

                                        @error('numero')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="cpf" class="col-md-4 col-form-label text-md-end">CPF</label>

                                    <div class="col-md-6">
                                        <input id="cpf" type="text" class="form-control @error('password') is-invalid @enderror" name="cpf" required value="{{old('cpf',$funcionario->cpf)}}">

                                        @error('cpf')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
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
