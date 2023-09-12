<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-12">


            <!-- Conteúdo das abas -->
            <div class="tab-content" id="myTabContent">
                <!-- Aba "Informações" -->
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">

                    <div class="row mt-4">

                        <div class="col-lg-6">
                            <!-- Informações do Perfil -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-user"></i> Perfil do Usuário</h5>
                                    <h2 class="card-text">{{ $user->name }}</h2>
                                    <p>Email: {{ $user->email }}</p>
                                    <p>Cargo: {{ $cargo->nome }}</p>
                                    <p>Telefone: {{ $funcionario->numero }}</p>
                                    <p>CPF: {{ $funcionario->cpf }}</p>
                                </div>
                            </div>

                            <!-- Informações da Loja, Funcionário e Cargo -->
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-store"></i> Informações da Loja</h5>
                                    <p>Nome da Loja: {{ $loja->nome }}</p>
                                    <p>Bairro: {{ $loja->bairro }}</p>
                                    <p>Rua: {{ $loja->rua }}</p>
                                    <p>Número da Casa: {{ $loja->num_casa }}</p>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6">
                                <!-- Menu de Navegação -->
                            <ul class="nav nav-pills flex-column mb-3">
                                <div class="d-flex">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-profile editarLoja active" href="editarLoja" >Editar Loja</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-profile editarFuncionario"  href="editarFuncionario">Editar Funcionário</a>
                                    </li>
                                </div>
                            </ul>



                            <!-- Conteúdo Dinâmico -->
                                <div class="tab-content">
                                    <!-- Formulário de Edição da Loja -->
                                    <div class="tab-pane fade show active user-from" id="editarLoja">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><i class="fas fa-edit"></i> Editar Informações da Loja</h5>
                                                <form>
                                                    <div class="form-group">
                                                        <label for="nomeLoja">Nome da Loja</label>
                                                        <input type="text" class="form-control" id="nomeLoja" wire:model="nomeLoja" placeholder="Nome da Loja">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bairroLoja">Bairro</label>
                                                        <input type="text" class="form-control" id="bairroLoja" wire:model="bairroLoja" placeholder="Bairro">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ruaLoja">Rua</label>
                                                        <input type="text" class="form-control" id="ruaLoja" wire:model="ruaLoja" placeholder="Rua">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="numCasaLoja">Número da Casa</label>
                                                        <input type="text" class="form-control" id="numCasaLoja" wire:model="numCasaLoja" placeholder="Número da Casa">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary" wire:click="salvarAlteracoesLoja">Salvar Alterações da Loja</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Formulário de Edição do Funcionário -->
                                    <div class="tab-pane fade user-from" id="editarFuncionario">
                                        <div class="card mt-4">
                                            <div class="card-body">
                                                <h5 class="card-title"><i class="fas fa-edit"></i> Editar Informações do Funcionário</h5>
                                                <form>
                                                    <div class="form-group">
                                                        <label for="numeroFuncionario">Número</label>
                                                        <input type="text" class="form-control" id="numeroFuncionario" wire:model="numeroFuncionario" placeholder="Número">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cpfFuncionario">CPF</label>
                                                        <input type="text" class="form-control" id="cpfFuncionario" wire:model="cpfFuncionario" placeholder="CPF">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary" wire:click="salvarAlteracoesFuncionario">Salvar Alterações do Funcionário</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
