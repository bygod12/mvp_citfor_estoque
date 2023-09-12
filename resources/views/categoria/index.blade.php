@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Listagem de Categorias</h1>
        <a href="{{ route('categoria.create') }}" class="btn btn-primary mb-4">Cadastrar categoria</a>
        <table id="categorias-table" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('#categorias-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('categoria.dados') }}',
                columns: [
                    { data: 'nome', name: 'nome' },
                    { data: 'descricao', name: 'descricao' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json' // Tradução para Português do DataTables
                }
            });
        });
    </script>
@endpush
