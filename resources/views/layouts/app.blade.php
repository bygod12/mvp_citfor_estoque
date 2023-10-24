<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

</head>
<style>
    .input_small{
        width: 50px;
    }
    label {
        font-weight: bold;
        margin-left: 10px;
    }
    div.item {
        border: 1px solid black;
        padding: 10px;
        margin: 5px;
    }

</style>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Barra Lateral de Navegação -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('produto.index') }}">
                            <i class="fas fa-box"></i> Produtos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categoria.index') }}">
                            <i class="fas fa-box"></i>Categorias
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('venda.index')  }}">
                            <i class="fas fa-dollar-sign"></i> Vendas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('doacao.index') }}">
                            <i class="fas fa-hands-helping"></i> Doações
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('funcionario.index') }}">
                            <i class="fas fa-users"></i> Funcionários
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cliente.index') }}">
                            <i class="fas fa-user-alt"></i> Meus Clientes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">
                            <i class="fas fa-user-circle"></i> Meus dados
                        </a>
                    </li>

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
    <!-- Seu código HTML para os toasts -->
    @if(session('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div id="success-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                <div class="toast-header bg-success text-white">
                    <strong class="me-auto">Sucesso</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div id="error-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="toast-header bg-danger text-white">
                <strong class="me-auto">Erro</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
            </div>
            <div class="toast-body">
                {{ session('error') }}
            </div>
        </div>
    @endif
</div>
<!-- jQuery (deve ser carregado primeiro) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.selected2Product').select2();


        // Obtenha os valores selecionados do elemento "produtos[]"
        var selectedProducts = {!! json_encode(old('produtos', [])) !!};

        // Verifique se há valores selecionados e defina-os no Select2
        if (selectedProducts.length > 0) {
            $('.selected2Product').val(selectedProducts).trigger('change');
        }
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
<!-- Seu código JavaScript -->
<script>
    $(document).ready(function() {
        // Mostrar o toast de sucesso, se houver uma mensagem de sucesso
        @if(session('success'))
        $('#success-toast').toast('show');

        // Esconder automaticamente o toast após 5 segundos
        setTimeout(function() {
            $('#success-toast').toast('hide');
        }, 5000); // 5000 milissegundos (5 segundos)
        @endif

        // Mostrar o toast de erro, se houver uma mensagem de erro
        @if(session('error'))
        $('#error-toast').toast('show');

        // Esconder automaticamente o toast após 5 segundos
        setTimeout(function() {
            $('#error-toast').toast('hide');
        }, 5000); // 5000 milissegundos (5 segundos)
        @endif
    });
</script>

<script>
    $(document).ready(function () {
        $('#doacao-table').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true, // Habilita a barra de rolagem horizontal
            scrollCollapse: true, // Mantém a barra de rolagem visível o tempo todo

            ajax: '{{ route('doacao.dados') }}',
            columns: [
                { data: 'nomedoador', name: 'nomedoador' },
                { data: 'email', name: 'email' },
                {
                    data: 'localizacao',
                    name: 'rua',
                    render: function (data, type, full, meta) {
                        // Verifica se cada propriedade não é nula e substitui por uma string vazia em caso de nulidade
                        var rua = full.rua || '';
                        var num_casa = full.num_casa || '';
                        var bairro = full.bairro || '';

                        // Combina as propriedades para exibição
                        var enderecoCompleto = rua + ' ' + num_casa + ', ' + bairro;

                        // Construa a URL do Google Maps com o endereço
                        var urlGoogleMaps = 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(enderecoCompleto);

                        // Crie o link com o endereço
                        return '<a href="' + urlGoogleMaps + '" target="_blank">' + enderecoCompleto + '</a>';
                    }
                },
                { data: 'numero_1', name: 'numero_1' },
                { data: 'numero_2', name: 'numero_2' },
                { data: 'hora_entrega', name: 'hora_entrega' },
                {
                    data: 'entregue',
                    name: 'entregue',
                    render: function (data, type, full, meta) {
                        var entregaDate = new Date(full.hora_entrega); // Obtém a data de entrega do item
                        var now = new Date(); // Obtém a data atual

                        if (data) {
                            return '<span class="badge bg-success">Entregue</span>';
                        } else {
                            if (entregaDate > now) {
                                return '<span class="badge bg-warning">Está no prazo para buscar</span>';
                            } else {
                                return '<span class="badge bg-danger">Passou o prazo de entrega</span>';
                            }
                        }
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json' // Tradução para Português do DataTables
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#venda-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('venda.dados') }}",
            columns: [
                { data: 'codigo_venda', name: 'codigo_venda' },
                { data: 'data_venda', name: 'data_venda' },
                { data: 'valor_total', name: 'valor_total' },
                { data: 'qtd_produtos', name: 'qtd_produtos' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center', // Centraliza o conteúdo
                },
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json",
            },
        });
    });

</script>

<script>
    $(document).ready(function() {
        $('#produtos-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('produto.dados') }}',
            columns: [
                { data: 'foto', name: 'foto', render: function (data, type, full, meta) {
                        if (data) {
                            return '<img src="{{ asset('img/produtos') }}/' + data + '" width="50" height="50">';
                        } else {
                            return '';
                        }
                    } },
                { data: 'created_at', name: 'created_at' },
                { data: 'nome', name: 'nome' },
                { data: 'descricao', name: 'descricao' },
                { data: 'valor', name: 'valor' },
                { data: 'qtd', name: 'qtd' },
                // Adicione colunas de categoria e doador aqui
                {
                    data: 'categoria',
                    name: 'categoria.nome',
                    render: function (data, type, full, meta) {
                        if (data) {
                            return data.nome;
                        } else {
                            return '';
                        }
                    }
                },
                {
                    data: 'doador',
                    name: 'doador.nomedoador',
                    render: function (data, type, full, meta) {
                        if (data && data.nomedoador !== null) {
                            return data.nomedoador;
                        } else {
                            return '';
                        }
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json' // Tradução para Português do DataTables
            }
        });
    });

</script>
<script>
    $(document).ready(function() {
        $('#clientes-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('cliente.dados') }}',
            columns: [
                { data: 'created_at', name: 'created_at' },
                { data: 'nome', name: 'nome' },
                { data: 'email', name: 'email' },
                { data: 'numero', name: 'numero' },
                { data: 'observacao', name: 'observacao' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json' // Tradução para Português do DataTables
            }
        });
    });

</script>
<script>
    $(document).ready(function() {
        $('#funcionario-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('funcionario.dados') }}',
            columns: [
                {
                    data: 'user.name',
                    name: 'funcionario.auth.name',
                    render: function (data, type, full, meta) {
                        return data;
                    }
                },
                {
                    data: 'user.email',
                    name: 'funcionario.user.email',
                    render: function (data, type, full, meta) {
                        return data;
                    }
                },
                { data: 'cargo', name: 'cargo' },
                { data: 'cpf', name: 'cpf' },
                { data: 'numero', name: 'numero' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json' // Tradução para Português do DataTables
            }
        });
    });

</script>

<script>
    $(document).ready(function () {
        // Verificar o estado da caixa de seleção ao carregar o documento
        if ($('#isDonation').is(':checked')) {
            $('#doacaoForm').show();
        } else {
            $('#doacaoForm').hide();
        }
        $('#isDonation').change(function () {
            if (this.checked) {
                $('#doacaoForm').show();
            } else {
                $('#doacaoForm').hide();
            }
        });
// Verificar o estado da caixa de seleção ao carregar o documento
        if ($('#isCliente').is(':checked')) {
            $('#clienteForm').show();
        } else {
            $('#clienteForm').hide();
        }
        $('#isCliente').change(function () {
            if (this.checked) {
                $('#clienteForm').show();
                $('#cliente_select').hide();
                verificarProdutosSelecionados();


            } else {
                $('#clienteForm').hide();
                $('#cliente_select').show();
                verificarProdutosSelecionados();

            }
        });
        // Verificar o estado da caixa de seleção ao carregar o documento
        if ($('#isProduct').is(':checked')) {
            $('#productForm').show();
        } else {
            $('#productForm').hide();
        }
        $('#isProduct').change(function () {
            if (this.checked) {
                $('#productForm').show();
            } else {
                $('#productForm').hide();
            }
        });
    });
    $('#cliente_to_select').change(function () {
        verificarProdutosSelecionados();
        });
    function verificarProdutosSelecionados() {
        var selectedOptions = $(".select_label").map(function() {
            return $(this).val();
        }).get();
        console.log(selectedOptions);
        var valor = $('#cliente_to_select').val();
        if (valor!=='000' || $('#isCliente').is(":checked")){
            console.log('aaaaaaa');
            if (selectedOptions.length > 2){
                console.log('bbbbbbb');
            }
        }
        // Habilitar o botão "Salvar" se pelo menos um produto for selecionado
        if (selectedOptions.length > 1 && (valor!=='000' || $('#isCliente').is(":checked"))) {
            $("#salvarBtn").prop('disabled', false);
        } else {
            $("#salvarBtn").prop('disabled', true);
        }
    }

</script>

<script>
    $(document).ready(function() {
        // Inicializa o botão "Salvar" desabilitado
        $("#salvarBtn").prop('disabled', true);

        $("#novoProd").click(function() {
            var novoItem = $("#item").clone().removeAttr('id');
            novoItem.children('input').val('');
            var select = novoItem.find("select");

            // Remove as opções já selecionadas
            var selectedOptions = $(".select_label").map(function() {
                return $(this).val();
            }).get();

            selectedOptions.forEach(function(item) {
                select.find("option[value='" + item + "']").remove();
            });

            // Adiciona apenas se houver opções restantes
            if (select.find("option").length > 1) {
                $("#formulario").append(novoItem);
            }

            atualizarInputs();
        });

        // Quando um select for alterado, desabilite essa opção nos outros selects
        $(document).on('change', '.select_label', function() {
            var selectedOption = $(this).val();
            $(".select_label").not(this).find("option[value='" + selectedOption + "']").attr('disabled', 'disabled');
            $(this).find("option[value='" + selectedOption + "']").removeAttr('disabled');
            atualizarInputs();
        });

        // Função para atualizar os inputs
        function atualizarInputs() {
            var selectedOptions = $(".select_label").map(function() {
                return $(this).val();
            }).get();

            // Remover inputs sem valor se todos os produtos forem selecionados
            $(".item").each(function() {
                var select = $(this).find(".select_label");
                var valorInput = $(this).find("input[name='valor[]']");
                var quantInput = $(this).find("input[name='quant[]']");

                if ($.inArray(select.val(), selectedOptions) === -1) {
                    valorInput.val('');
                    quantInput.val('');
                }
            });

            verificarProdutosSelecionados();
        }

        // Remover item quando o botão "Remover produto" é clicado
        $(document).on('click', '.fechar-item', function() {
            var select = $(this).closest(".item").find(".select_label");
            var optionValue = select.val();
            $(this).closest(".item").remove();

            // Habilitar a opção removida nos outros selects
            $(".select_label").not(select).find("option[value='" + optionValue + "']").removeAttr('disabled');

            atualizarInputs();
        });

        // Função para verificar se há produtos selecionados e habilitar/desabilitar o botão "Salvar"
        function verificarProdutosSelecionados() {
            var selectedOptions = $(".select_label").map(function() {
                return $(this).val();
            }).get();
            console.log(selectedOptions);
            var valor = $('#cliente_to_select').val();
            // Habilitar o botão "Salvar" se pelo menos um produto for selecionado
            if (selectedOptions.length > 1 && (valor!=='000' || $('#isCliente').is(":checked"))) {
                $("#salvarBtn").prop('disabled', false);
            } else {
                $("#salvarBtn").prop('disabled', true);
            }
        }
    });

    $(document).ready(function() {
        // // Obtenha o valor do campo oculto e divida-o em um array usando a vírgula como delimitador
        // var produtosSelecionadoss = $("#produtos_selecionados").val().replace(/[\[\]a-zA-Z\s]/g, '').split(',');
        // var produtosSelecionados = [];
        //
        // // Verifique se há valores no array
        // if (produtosSelecionadoss[0] !== "") {
        //     // Copie os valores de produtosSelecionadoss para produtosSelecionados
        //     for (var i = 0; i < produtosSelecionadoss.length; i++) {
        //         produtosSelecionados.push(produtosSelecionadoss[i]);
        //     }
        //     console.log(produtosSelecionados);
        // }
        // // Quando um botão de remoção for clicado, remova a tag da lista
        // $("#selectedTags").on("click", ".badge-selected .bg-danger", function() {
        //     var productId = $(this).parent().data("id");
        //     var id = $(this).attr('id');
        //
        //     var index = produtosSelecionados.indexOf(id);
        //
        //     console.log("Clique no botão de remoção");
        //     console.log("productId:", productId);
        //
        //     if (index !== -1) {
        //         produtosSelecionados.splice(index, 1);
        //     }
        //
        //     $(this).parent().remove();
        //
        //     $("#produtos_selecionados").val('produtos['+produtosSelecionados.join(",")+']');
        //     console.log($("#produtos_selecionados").val());
        //
        // });
        //
        // // Remova o evento change para evitar a duplicação
        // $("#selectedProduct").off("change").on("change", function() {
        //     var productId = $(this).val();
        //     var productName = $(this).find("option:selected").text();
        //
        //     if (productId) {
        //         var index = produtosSelecionados.indexOf(productId);
        //
        //         if (index === -1) {
        //             produtosSelecionados.push(productId);
        //
        //             var tagHtml = '<span class="me-1 badge bg-primary badge-selected d-flex align-items-center" data-id="' + productId + '">' +
        //                 productName +
        //                 '<div class="ms-1 bg-danger cursor-pointer" style="cursor: pointer;" id="' + productId +'">×</div>' +
        //                 '</span>';
        //
        //             $("#selectedTags").append(tagHtml);
        //
        //             // Limpe a seleção
        //             $(this).val('');
        //             $("#produtos_selecionados").val('produtos['+produtosSelecionados.join(",")+']');
        //             console.log($("#produtos_selecionados").val());
        //         }
        //     }else{
        //         $(this).val('');
        //         $("#produtos_selecionados").val('produtos['+produtosSelecionados.join(",")+']');
        //         console.log($("#produtos_selecionados").val());
        //
        //     }
        // });
    });
</script>

<script>
    // $(document).ready(function() {
    //     // Função para inicializar o Select2 em um campo clonado
    //     function initializeSelect2($element) {
    //         $element.select2();
    //     }
    //
    //     $("#novoProd").click(function() {
    //         cloneItem();
    //     });
    //
    //     function cloneItem() {
    //         var novoItem = $("#item").clone().removeAttr('id');
    //         novoItem.children('input').val('');
    //
    //         var selectedOptions = []; // Array para armazenar valores selecionados
    //
    //         var selectInputs = $("#formulario").find('.select_label');
    //
    //         selectInputs.each(function() {
    //             var selectedOption = $(this).find('option:selected').val();
    //             selectedOptions.push(selectedOption);
    //         });
    //
    //         selectInputs.each(function() {
    //             // Remova as opções já selecionadas dos campos clonados
    //             $(this).find('option').each(function() {
    //                 var optionValue = $(this).val();
    //                 if (selectedOptions.indexOf(optionValue) !== -1) {
    //                     $(this).remove();
    //                 }
    //             });
    //         });
    //
    //         $("#formulario").append(novoItem);
    //         initializeSelect2(novoItem.find('.select_label')); // Inicializa o Select2 no novo campo
    //
    //         novoItem.find('.fechar-item').click(function() {
    //             // Adicione de volta as opções quando um campo é removido
    //             selectInputs.each(function() {
    //                 var selectedOption = novoItem.find('.select_label option:selected').val();
    //                 $(this).append('<option value="' + selectedOption + '">' + selectedOption + '</option>');
    //             });
    //             novoItem.remove();
    //         });
    //     }
    //
    // });

</script>

<script>
    $(document).ready(function () {
        $('#doacao-dashboard-table').DataTable({
            processing: true,
            serverSide: true,
            order: [[0, "desc"]], // Ordenar pela primeira coluna (Data) em ordem decrescente
            scrollY: "300px", // Defina a altura máxima da tabela
            scrollCollapse: true, // Ativar rolagem vertical
            lengthChange: false, // Remover a opção de alterar o número de resultados por página
            info: false, // Remover "Mostrando de 1 até 1 de 1 registros"

            ajax: '{{ route('doacao.dados') }}',
            columns: [
                { data: 'created_at', name: 'created_at' },
                { data: 'nomedoador', name: 'nomedoador' },
                { data: 'email', name: 'email' },
                {
                    data: 'localizacao',
                    name: 'rua',
                    render: function (data, type, full, meta) {
                        // Verifica se cada propriedade não é nula e substitui por uma string vazia em caso de nulidade
                        var rua = full.rua || '';
                        var num_casa = full.num_casa || '';
                        var bairro = full.bairro || '';

                        // Combina as propriedades para exibição
                        var enderecoCompleto = rua + ' ' + num_casa + ', ' + bairro;

                        // Construa a URL do Google Maps com o endereço
                        var urlGoogleMaps = 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(enderecoCompleto);

                        // Crie o link com o endereço
                        return '<a href="' + urlGoogleMaps + '" target="_blank">' + enderecoCompleto + '</a>';
                    }
                },
                { data: 'numero_1', name: 'numero_1' },
                { data: 'numero_2', name: 'numero_2' },
                { data: 'hora_entrega', name: 'hora_entrega' },
                {
                    data: 'entregue',
                    name: 'entregue',
                    render: function (data, type, full, meta) {
                        var entregaDate = new Date(full.hora_entrega); // Obtém a data de entrega do item
                        var now = new Date(); // Obtém a data atual

                        if (data) {
                            return '<span class="badge bg-success">Entregue</span>';
                        } else {
                            if (entregaDate > now) {
                                return '<span class="badge bg-warning">Está no prazo para buscar</span>';
                            } else {
                                return '<span class="badge bg-danger">Passou o prazo de entrega</span>';
                            }
                        }
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json' // Tradução para Português do DataTables
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#venda-dashboard-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('venda.dados') }}",
            order: [[1, "desc"]], // Ordenar pela primeira coluna (Data) em ordem decrescente
            scrollY: "300px", // Defina a altura máxima da tabela
            scrollCollapse: true, // Ativar rolagem vertical
            lengthChange: false, // Remover a opção de alterar o número de resultados por página
            info: false, // Remover "Mostrando de 1 até 1 de 1 registros"

            columns: [
                { data: 'codigo_venda', name: 'codigo_venda' },
                { data: 'data_venda', name: 'data_venda' },
                { data: 'valor_total', name: 'valor_total' },
                { data: 'qtd_produtos', name: 'qtd_produtos' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center', // Centraliza o conteúdo
                },
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json",
            },
        });
    });

</script>

<script>
    $(document).ready(function() {
        $('#produtos-dashboard-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('produto.dados') }}',
            order: [[1, "desc"]], // Ordenar pela primeira coluna (Data) em ordem decrescente
            scrollY: "300px", // Defina a altura máxima da tabela
            scrollCollapse: true, // Ativar rolagem vertical
            lengthChange: false, // Remover a opção de alterar o número de resultados por página
            info: false, // Remover "Mostrando de 1 até 1 de 1 registros"
            columns: [
                { data: 'foto', name: 'foto', render: function (data, type, full, meta) {
                        if (data) {
                            return '<img src="{{ asset('img/produtos') }}/' + data + '" width="50" height="50">';
                        } else {
                            return '';
                        }
                    } },
                { data: 'created_at', name: 'created_at' },
                { data: 'nome', name: 'nome' },
                { data: 'descricao', name: 'descricao' },
                { data: 'valor', name: 'valor' },
                { data: 'qtd', name: 'qtd' },
                // Adicione colunas de categoria e doador aqui
                {
                    data: 'categoria',
                    name: 'categoria.nome',
                    render: function (data, type, full, meta) {

                        return data.nome;
                    }
                },
                {
                    data: 'doador',
                    name: 'doador.nomedoador',
                    render: function (data, type, full, meta) {
                        if (data && data.nomedoador !== null) {
                            return data.nomedoador;
                        } else {
                            return '';
                        }
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json' // Tradução para Português do DataTables
            }
        });
    });

</script>
<script>
    $(document).ready(function () {
        // Quando um link de navegação é clicado
        $('.nav-link-profile').on('click', function (e) {
            e.preventDefault(); // Impede o comportamento padrão de carregar uma página
            var target = $(this).attr('href'); // Obtém o valor do atributo href
            $('.user-from').removeClass('show active'); // Remove a classe 'show' e 'active' de todas as abas
            $('.nav-link-profile').removeClass('active')
            $('#'+target).addClass('show active'); // Adiciona a classe 'show' e 'active' à aba alvo
            $('.'+target).addClass(' active'); // Adiciona a classe 'show' e 'active' à aba alvo

        });
    });
</script>
</body>
</html>
