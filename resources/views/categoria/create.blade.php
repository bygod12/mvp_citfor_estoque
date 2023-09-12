
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Criar Nova Categoria</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('categoria.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="nome">Nome da Categoria</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="nome">Descricao (opcional)</label>
                                <input type="text" class="form-control" id="descricao" name="descricao">
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
