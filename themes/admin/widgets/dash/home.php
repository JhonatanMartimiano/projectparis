<?php $v->layout("_admin"); ?>
    <!--App-Content-->
    <div class="app-content  my-3 my-md-5">
        <div class="side-app">
            <div class="page-header">
                <h4 class="page-title">Dashboard</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card overflow-hidden bg-danger">
                        <div class="card-body iconfont text-center">
                            <h5 class="text-white">Atrasados 24H+</h5>
                            <div class="d-flex justify-content-center">
                                <h5 class="mb-0 text-white mt-1"><?= $post24hour; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card overflow-hidden bg-success">
                        <div class="card-body iconfont text-center">
                            <h5 class="text-white">Pedidos Finalizados</h5>
                            <div class="d-flex justify-content-center">
                                <h5 class="mb-0 text-white mt-1"><?= $completedOrders; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card overflow-hidden bg-warning">
                        <div class="card-body iconfont text-center">
                            <h5 class="text-white">Aguardando</h5>
                            <div class="d-flex justify-content-center">
                                <h5 class="mb-0 text-white mt-1"><?= $waiting; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card overflow-hidden bg-info">
                        <div class="card-body iconfont text-center">
                            <h5 class="text-white">Em Negociação</h5>
                            <div class="d-flex justify-content-center">
                                <h5 class="mb-0 text-white mt-1"><?= $inNegotiations; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <?php /*
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card overflow-hidden">
                        <div class="card-body iconfont text-center">
                            <h5>Total de Clientes</h5>
                            <div class="d-flex justify-content-center">
                                <h5 class="mb-0 mt-1"><?= $totalClients; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (user()->level >= 5): ?>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="card overflow-hidden">
                            <div class="card-body iconfont text-center">
                                <h5>Total de Vendedores</h5>
                                <div class="d-flex justify-content-center">
                                    <h5 class="mb-0 mt-1"><?= $totalSellers; ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card overflow-hidden">
                        <div class="card-body iconfont text-center">
                            <h5>Total em Negociação</h5>
                            <div class="d-flex justify-content-center">
                                <h5 class="mb-0 mt-1"><?= $totalInNegotiations; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card overflow-hidden">
                        <div class="card-body iconfont text-center">
                            <h5>Total em Atraso</h5>
                            <div class="d-flex justify-content-center">
                                <h5 class="mb-0 mt-1"><?= $totalInDelay; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                */ ?>
            </div>
            <!-- Revenue Chart -->
            <!--            <div class="card card-chart">-->
            <!--                <div class="card-header">-->
            <!--                    <div class="row align-items-center">-->
            <!--                        <div class="col-12">-->
            <!--                            <h5 class="card-title">Etapas/Clientes:</h5>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="card-body">-->
            <!--                    <div id="chart"></div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!-- /Revenue Chart -->
            <?php if (user()->level >= 5): ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered border-top mb-0">
                                        <thead>
                                        <tr align="center">
                                            <th>Cliente</th>
                                            <th>Vendedor</th>
                                            <th colspan="2">
                                                1° Contato
                                                <div class="d-flex justify-content-between">
                                                    <p>Etapa</p>
                                                    <p>Data</p>
                                                </div>
                                            </th>
                                            <th colspan="2">
                                                2° Contato
                                                <div class="d-flex justify-content-between">
                                                    <p>Etapa</p>
                                                    <p>Data</p>
                                                </div>
                                            </th>g
                                            <th colspan="2">
                                                3° Contato
                                                <div class="d-flex justify-content-between">
                                                    <p>Etapa</p>
                                                    <p>Data</p>
                                                </div>
                                            </th>
                                            <th>Descrição</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($allNegotiations as $allNegotiation): ?>
                                            <?php if (date_diff_panel($negotiation->getClientIDNeg($allNegotiation->id_neg)->next_contact) < -1): ?>
                                                <tr class="bg-danger text-white">
                                                    <td><a href="<?= url('/admin/negotiations/negotiation/'.$negotiation->getClientIDNeg($allNegotiation->id_neg)->client_id); ?>"><?= $allNegotiation->cliente; ?></a></td>
                                                    <td><?= $allNegotiation->vendedor; ?></td>
                                                    <td><?= $allNegotiation->etapa1; ?></td>
                                                    <td><?= date_fmt_br($allNegotiation->data1); ?></td>
                                                    <td><?= $allNegotiation->etapa2; ?></td>
                                                    <td><?= date_fmt_br($allNegotiation->data2); ?></td>
                                                    <td><?= $allNegotiation->etapa3; ?></td>
                                                    <td><?= date_fmt_br($allNegotiation->data3); ?></td>
                                                    <td><?= $allNegotiation->obs3; ?></td>
                                                </tr>
                                            <?php elseif ($negotiation->getClientIDNeg($allNegotiation->id_neg)->contact_type == "PFinalizado"): ?>
                                                <tr class="bg-success text-white">
                                                    <td><a href="<?= url('/admin/negotiations/negotiation/'.$negotiation->getClientIDNeg($allNegotiation->id_neg)->client_id); ?>"><?= $allNegotiation->cliente; ?></a></td>
                                                    <td><?= $allNegotiation->vendedor; ?></td>
                                                    <td><?= $allNegotiation->etapa1; ?></td>
                                                    <td><?= date_fmt_br($allNegotiation->data1); ?></td>
                                                    <td><?= $allNegotiation->etapa2; ?></td>
                                                    <td><?= date_fmt_br($allNegotiation->data2); ?></td>
                                                    <td><?= $allNegotiation->etapa3; ?></td>
                                                    <td><?= date_fmt_br($allNegotiation->data3); ?></td>
                                                    <td><?= $allNegotiation->obs3; ?></td>
                                                </tr>
                                            <?php elseif ($negotiation->getClientIDNeg($allNegotiation->id_neg)->contact_type == "APagamento"): ?>
                                                <tr class="bg-warning text-white">
                                                    <td><a href="<?= url('/admin/negotiations/negotiation/'.$negotiation->getClientIDNeg($allNegotiation->id_neg)->client_id); ?>"><?= $allNegotiation->cliente; ?></a></td>
                                                    <td><?= $allNegotiation->vendedor; ?></td>
                                                    <td><?= $allNegotiation->etapa1; ?></td>
                                                    <td><?= date_fmt_br($allNegotiation->data1); ?></td>
                                                    <td><?= $allNegotiation->etapa2; ?></td>
                                                    <td><?= date_fmt_br($allNegotiation->data2); ?></td>
                                                    <td><?= $allNegotiation->etapa3; ?></td>
                                                    <td><?= date_fmt_br($allNegotiation->data3); ?></td>
                                                    <td><?= $allNegotiation->obs3; ?></td>
                                                </tr>
                                            <?php elseif ($negotiation->getClientIDNeg($allNegotiation->id_neg)->contact_type == "NRespondeu"): ?>
                                                <tr class="bg-warning text-white">
                                                    <td><a href="<?= url('/admin/negotiations/negotiation/'.$negotiation->getClientIDNeg($allNegotiation->id_neg)->client_id); ?>"><?= $allNegotiation->cliente; ?></a></td>
                                                    <td><?= $allNegotiation->vendedor; ?></td>
                                                    <td><?= $allNegotiation->etapa1; ?></td>
                                                    <td><?= date_fmt_br($allNegotiation->data1); ?></td>
                                                    <td><?= $allNegotiation->etapa2; ?></td>
                                                    <td><?= date_fmt_br($allNegotiation->data2); ?></td>
                                                    <td><?= $allNegotiation->etapa3; ?></td>
                                                    <td><?= date_fmt_br($allNegotiation->data3); ?></td>
                                                    <td><?= $allNegotiation->obs3; ?></td>
                                                </tr>
                                            <?php elseif (date_diff_panel($negotiation->getClientIDNeg($allNegotiation->id_neg)->next_contact) >= 0): ?>
                                                <tr class="bg-info text-white">
                                                    <td><a href="<?= url('/admin/negotiations/negotiation/'.$negotiation->getClientIDNeg($allNegotiation->id_neg)->client_id); ?>"><?= $allNegotiation->cliente; ?></a></td>
                                                    <td><?= $allNegotiation->vendedor; ?></td>
                                                    <td><?= $allNegotiation->etapa1; ?></td>
                                                    <td><?= date_fmt_br($allNegotiation->data1); ?></td>
                                                    <td><?= $allNegotiation->etapa2; ?></td>
                                                    <td><?= date_fmt_br($allNegotiation->data2); ?></td>
                                                    <td><?= $allNegotiation->etapa3; ?></td>
                                                    <td><?= date_fmt_br($allNegotiation->data3); ?></td>
                                                    <td><?= $allNegotiation->obs3; ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!--/App-Content-->

<?php $v->start("scripts"); ?>
    <script>
        $(document).ready(function () {
            // Area chart
            var options = {
                series: [{
                    name: 'Primeiro Contato',
                    data: [0],
                    color: "#05a01f"
                },
                    {
                        name: 'Briefing',
                        data: [50],
                        color: "#ffa22b"
                    },
                    {
                        name: 'Compra',
                        data: [50],
                        color: "#ff382b"
                    }
                ],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + '%';
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },

                xaxis: {
                    categories: ["Primeiro Contato", "Briefing", "Compra"],
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: '0D47A1',
                            gradient: {
                                colorFrom: '#D8E3F0',
                                colorTo: '#BED1E6',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: false,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function (val) {
                            return val + '%';
                        }
                    }

                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>
<?php $v->end("scripts"); ?>