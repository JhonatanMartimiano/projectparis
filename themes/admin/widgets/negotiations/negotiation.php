<?php $v->layout("_admin"); ?>
<!--App-Content-->
<div class="app-content  my-3 my-md-5">
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Negociações</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= url('/admin/dash/home'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= url('/admin/negotiations/home'); ?>">Negociações</a></li>
                <li class="breadcrumb-item active" aria-current="page">Criar Negociação</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card m-b-20">
                    <div class="card-header">
                        <h3 class="card-title">Criar Negociação</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= url('/admin/negotiations/negotiation'); ?>" method="post">
                            <input type="hidden" name="action" value="create">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" class="form-control" value="<?= $client->name; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <input type="text" class="form-control" value="<?= $client->state; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Cidade</label>
                                        <input type="text" class="form-control" value="<?= $client->city; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control mask-phone" value="<?= $client->phone; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label>Data de Contato</label>
                                        <input type="text" class="form-control" value="<?= date_fmt($client->contact_date, 'd/m/Y'); ?>" readonly>
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
                                <div class="form-group col-md-12">
                                    <label>Descrição</label>
                                    <textarea name="description" rows="5"
                                              class="form-control" placeholder="Digite sua descrição"></textarea>
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
<!--/App-Content-->