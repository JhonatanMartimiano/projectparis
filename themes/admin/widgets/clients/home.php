<?php $v->layout("_admin"); ?>
<!--App-Content-->
<div class="app-content  my-3 my-md-5">
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Clientes</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= url('/admin/dash/home') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <h3 class="card-title">Clientes</h3>
                            <div>
                                <a href="<?= url('/admin/clients/client'); ?>" class="btn btn-pill btn-success"><i
                                        class="fa fa-plus"></i> Adicionar Cliente</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form class="form-inline mb-1" action="<?= url('/admin/clients/home'); ?>" method="post">
                                <div class="nav-search">
                                    <input type="search" class="form-control header-search" name="s"
                                        value="<?= $search; ?>" placeholder="Buscar…" aria-label="Search">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                            <table class="table table-bordered border-top mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Cidade</th>
                                        <th>Estado</th>
                                        <th>Vendedor</th>
                                        <th>Data do Cadastro</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($clients): ?>
                                        <?php foreach ($clients as $client): ?>
                                            <tr>
                                                <th scope="row"><?= $client->id; ?></th>
                                                <td><?= $client->name; ?></td>
                                                <td><?= $client->city; ?></td>
                                                <td><?= $client->state; ?></td>
                                                <td><?= $client->sellerName(); ?></td>
                                                <td><?= date_fmt($client->registration_date, "d/m/Y"); ?></td>
                                                <td align="center">
                                                    <a href="<?= url('/admin/clients/client/'.$client->id); ?>"
                                                       class="btn btn-info btn-sm" title="Editar"><i
                                                                class="fa fa-pencil"></i></a>

                                                    <a href="#" class="btn btn-danger btn-sm"
                                                       data-post="<?= url("/admin/clients/client/{$client->id}"); ?>"
                                                       data-action="delete"
                                                       data-confirm="ATENÇÃO: Tem certeza que deseja excluir o cliente e todos os dados relacionados a ele? Essa ação não pode ser feita!"
                                                       data-client_id="<?= $client->id; ?>" title="Excluir"><i
                                                                class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <?= $paginator; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/App-Content-->