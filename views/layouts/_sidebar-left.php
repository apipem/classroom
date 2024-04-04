<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        Academy
        <img src="<?= Yii::$app->getUrlManager()->createUrl('img/AdminLTELogo.png') ?>" alt="ACADEMY" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://picsum.photos/200/200?random" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <?php $session = Yii::$app->session; if ($session->isActive) { ?>
                    <a href="#" class="d-block"><?= Yii::$app->user->identity->nombre." ".Yii::$app->user->identity->apellido  ?></a>
                <?php }?>
                <a href="" style="color:white;"><?= Yii::$app->user->identity->rol?></a>

            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <?php if(Yii::$app->user->identity->nombre == "admin"): ?>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Estudiantes
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>inscritos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>pre-matriculados</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>matriculado</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rechazado</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Expulsados</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Egresados</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            <?php endif;?>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="<?= Yii::$app->getUrlManager()->createUrl('') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            INICIO
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <?php if (Yii::$app->user->identity->rol == "profesor"){?>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Materias
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= Yii::$app->getUrlManager()->createUrl('materia/create') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Yii::$app->getUrlManager()->createUrl('materia/index') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Administrar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Proyectos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/proyecto') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mis proyectos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/index') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Listar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/grupos') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>grupos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/general') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>inscripcion</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Notas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= Yii::$app->getUrlManager()->createUrl('notas/index') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Consultar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } else { ?>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Proyectos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/proyecto') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mis proyectos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/grupos') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>grupos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
