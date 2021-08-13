<?php $v->layout("_admin"); ?>
<!--App-Content-->
<?php if (!$client): ?>
    <div class="app-content  my-3 my-md-5">
        <div class="side-app">
            <div class="page-header">
                <h4 class="page-title">Clientes</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= url('/admin/dash/home'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= url('/admin/clients/home'); ?>">Clientes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Criar Cliente</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-20">
                        <div class="card-header">
                            <h3 class="card-title">Criar Cliente</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= url('/admin/clients/client'); ?>" method="post">
                                <input type="hidden" name="action" value="create">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" class="form-control" name="name"
                                                   placeholder="Digite seu nome">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Cidade</label>
                                        <input type="text" class="form-control" name="city"
                                               placeholder="Digite sua cidade">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Estado</label>
                                        <input type="text" class="form-control" name="state"
                                               placeholder="Digite seu estado">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control mask-phone" name="phone"
                                               placeholder="Digite seu telefone">
                                    </div>
                                    <?php if ($sellers): ?>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Vendedor</label>
                                                <select class="form-control" name="seller_id" required>
                                                    <?php foreach ($sellers as $seller): ?>
                                                        <option value="<?= $seller->id; ?>"><?= $seller->name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($funnels): ?>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Etapa</label>
                                                <select class="form-control" name="funnel_id" required>
                                                    <?php foreach ($funnels as $funnel): ?>
                                                        <option value="<?= $funnel->id; ?>"><?= $funnel->title; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group col-md-6">
                                        <label>Data do Contato</label>
                                        <input type="text" class="form-control mask-date" name="contact_date"
                                               placeholder="Digite sua data">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success ">Criar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="app-content  my-3 my-md-5">
        <div class="side-app">
            <div class="page-header">
                <h4 class="page-title">Clientes</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= url('/admin/dash/home'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= url('/admin/clients/home'); ?>">Clientes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Cliente</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-20">
                        <div class="card-header">
                            <h3 class="card-title">Editar Cliente</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= url('/admin/clients/client/' . $client->id); ?>" method="post">
                                <input type="hidden" name="action" value="update">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" class="form-control" name="name"
                                                   value="<?= $client->name; ?>"
                                                   placeholder="Digite seu nome">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Cidade</label>
                                        <input type="text" class="form-control" name="city"
                                               value="<?= $client->city; ?>"
                                               placeholder="Digite sua cidade">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Estado</label>
                                        <input type="text" class="form-control" name="state"
                                               value="<?= $client->state; ?>"
                                               placeholder="Digite seu estado">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control mask-phone" name="phone"
                                               value="<?= $client->phone; ?>"
                                               placeholder="Digite seu telefone">
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Vendedor</label>
                                            <select class="form-control" name="seller_id" required>
                                                <?php foreach ($sellers as $seller): ?>
                                                    <option value="<?= $seller->id; ?>" <?= ($seller->id == $sellerSelected) ? "selected" : ""; ?>><?= $seller->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Etapa</label>
                                            <select class="form-control" name="funnel_id" required>
                                                <?php foreach ($funnels as $funnel): ?>
                                                    <option value="<?= $funnel->id; ?>" <?= ($funnel->id == $funnelSelected) ? "selected" : ""; ?>><?= $funnel->title; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Data do Contato</label>
                                        <input type="text" class="form-control mask-date" name="contact_date"
                                               value="<?= date_fmt($client->contact_date, "d/m/Y"); ?>"
                                               placeholder="Digite sua data">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success ">Atualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<!--/App-Content-->