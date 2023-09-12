@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Categoria</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('categoria.update', $categoria->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Usando o método PUT para atualização -->

                            <div class="form-group">
                                <label for="nome">Nome da Categoria</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome',$categoria->nome) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="descricao">Descrição (opcional)</label>
                                <input type="text" class="form-control" id="descricao" name="descricao" value="{{ old('descricao',$categoria->descricao)  }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
