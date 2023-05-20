<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Área del Cliente - <?php echo $this->config->item('app_name') ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?php echo $this->config->item('app_name') . ' - ' . $this->config->item('app_subname') ?>">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-style.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-media.css" />
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fullcalendar.css" />
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/sweetalert.min.js"></script>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/faviconAppleWhiteBox.png">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!--Header-part-->
    <div id="header">
        <h1><a href="dashboard.html"><?php echo $this->config->item('app_name'); ?></a></h1>
    </div>
    <!--close-Header-part-->

    <!--top-Header-menu-->
    <div class="navebarn" style="margin-top: -60px;height: 25px;margin-bottom: 15px">
        <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class='bx bx-user-circle iconN1'></i> <?= $this->session->userdata('nome') ?> </a>
                    <ul class="dropdown-menu">
                        <li class=""><a title="Mi Perfil" href="<?php echo base_url() ?>index.php/mine/conta"><i class="fas fa-user"></i> <span class="text">Mi Perfil</span></a></li>
                        <li class="divider"></li>
                        <li class=""><a title="Salir" href="<?php echo base_url() ?>index.php/mine/sair"><i class="fas fa-sign-out-alt"></i> <span class="text">Salir</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <nav id="sidebar">
        <div id="newlog">
            <div class="icon2">
                <img src="<?php echo base_url() ?>assets/img/faviconAppleWhiteBox.png">
            </div>
            <div class="title1">
                <?= $configuration['app_theme'] == 'white' ? '<img src="' . base_url() . 'assets/img/logos/2.png">' : '<img src="' . base_url() . 'assets/img/logos/iconLargoEGwhite.png">'; ?>
            </div>
        </div>
        <a href="#" class="visible-phone">
            <div class="mode">
                <div class="moon-menu">
                    <i class='bx bx-chevron-right iconX open-2'></i>
                    <i class='bx bx-chevron-left iconX close-2'></i>
                </div>
            </div>
        </a>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links" style="position: relative;">
                    <li class="<?php if (isset($menupanel)) {
                        echo 'active';
                    }; ?>"><a class="tip-bottom" title="" href="<?php echo base_url() ?>index.php/mine/panel"><i class='bx bx-home-alt iconX'></i> <span class="title">Panel</span></a></li>
                    <li class="<?php if (isset($menuConta)) {
                        echo 'active';
                    }; ?>"><a class="tip-bottom" title="" href="<?php echo base_url() ?>index.php/mine/conta"><i class="bx bx-user-circle iconX"></i> <span class="title">Mis cuentas</span></a></li>
                    <li class="<?php if (isset($menuOs)) {
                        echo 'active';
                    }; ?>"><a class="tip-bottom" title="" href="<?php echo base_url() ?>index.php/mine/os"><i class='bx bx-spreadsheet iconX'></i> <span class="title">Ordenes de Servicio</span></a></li>
                    <li class="<?php if (isset($menuVendas)) {
                        echo 'active';
                    }; ?>"><a class="tip-bottom" title="" href="<?php echo base_url() ?>index.php/mine/compras"><i class='bx bx-cart-alt iconX'></i> <span class="title">Compras</span></a></li>
                    <li class="<?php if (isset($menuCobrancas)) {
                        echo 'active';
                    }; ?>"><a class="tip-bottom" title="" href="<?php echo base_url() ?>index.php/mine/cobrancas"><i class='bx bx-credit-card-front iconX'></i> <span class="title">Cobranzas</span></a></li>
                </ul>
            </div>

            <div class="botton-content">
                <li class="">
                    <a class="tip-bottom" title="" href="<?= site_url('login/sair'); ?>">
                        <i class='bx bx-log-out-circle iconX'></i>
                        <span class="title">Salir</span></a>
                </li>
            </div>

        </div>
    </nav>

    <div style="background: #f3f4f6" id="content">
        <div class="content-header" id="content-header">
            <div id="breadcrumb"><a href="<?php echo base_url(); ?>index.php/mine/panel" title="panel" class="tip-bottom"><i class="fas fa-home"></i> Panel</a></div>
        </div>

        <div class="container-fluid">
            <div class="row-fluid">

                <div class="span12">
                    <?php if ($var = $this->session->flashdata('success')) : ?><script>
                            swal("Éxito", "<?php echo str_replace('"', '', $var); ?>", "success");
                        </script><?php endif; ?>
                    <?php if ($var = $this->session->flashdata('error')) : ?><script>
                            swal("Falha!", "<?php echo str_replace('"', '', $var); ?>", "error");
                        </script><?php endif; ?>
                    <?php if (isset($output)) {
                        $this->load->view($output);
                    } ?>

                </div>
            </div>

        </div>
    </div>
    <!--Footer-part-->
    <div class="row-fluid">
        <div id="footer" class="span12" style="padding: 10px"> <a class="pecolor" href="https://electronicagambino.com" target="_blank">
                <?= date('Y') ?> &copy; MI iPhone - Versión: <?= $this->config->item('app_version'); ?>
    </div>

    <!-- javascript
================================================== -->

    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/matrix.js"></script>
</body>
</html>
