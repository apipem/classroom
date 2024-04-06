<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Yii::$app->getUrlManager()->createUrl('') ?>" class="brand-link">
        <img src="<?= Yii::$app->getUrlManager()->createUrl('img/AdminLTELogo.png') ?>" alt="ACADEMY Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">ClassRoom</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://picsum.photos/200/200?random" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <div class="text-white"><?= Yii::$app->user->identity->nombre." ".Yii::$app->user->identity->apellido ?></div>
                <div class="text-white"><?= Yii::$app->user->identity->rol?></div>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Buscar">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- INICIO -->
                <li class="nav-item">
                    <a href="<?= Yii::$app->getUrlManager()->createUrl('') ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>INICIO</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Materias
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= Yii::$app->getUrlManager()->createUrl('materia/index') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mis Materias</p>
                            </a>
                        </li>
                        <?php if (Yii::$app->user->identity->rol == "profesor"): ?>
                            <li class="nav-item">
                                <a href="<?= Yii::$app->getUrlManager()->createUrl('materia/listado') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="<?= Yii::$app->getUrlManager()->createUrl('contenido/index') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Recursos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-project-diagram"></i>
                        <p>
                            Proyectos
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/proyecto') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mis proyectos</p>
                            </a>
                        </li>
                        <?php if (Yii::$app->user->identity->rol == "profesor"): ?>
                            <li class="nav-item">
                                <a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/index') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/grupos') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Grupos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Notas -->
                <li class="nav-item">
                    <a href="<?= Yii::$app->getUrlManager()->createUrl('notas/notas') ?>" class="nav-link">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>Notas</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
