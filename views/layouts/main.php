<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php
$session = Yii::$app->session;
if ($session->isActive and isset(Yii::$app->user->identity->nombre)) {
?>
<?php $this->beginPage() ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academy</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= Yii::$app->getUrlManager()->createUrl('css/all.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= Yii::$app->getUrlManager()->createUrl('css/adminlte.min.css') ?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php echo $this->render("_header") ?>

    <?php echo $this->render("_sidebar-left"); ?>
    <?php $this->beginBody() ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <?php echo $content ?>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php $this->endBody() ?>
    <?php echo $this->render("_footer"); ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= Yii::$app->getUrlManager()->createUrl('js/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= Yii::$app->getUrlManager()->createUrl('js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= Yii::$app->getUrlManager()->createUrl('js/adminlte.min.js') ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    /* Estilo para los elementos seleccionados en el menú */
    a.nav-link.active {
        !important;background-color: rgba(255,255,255,.9); /* Cambia esto al color gris deseado */
        color: #000; /* Cambia el color del texto si es necesario */
    }

    nav-link.active {
    !important;background-color: rgba(255,255,255,.9); /* Cambia esto al color gris deseado */
        color: #000; /* Cambia el color del texto si es necesario */
    }

</style>
<script>

    function calcularnotafinal(){
        var vcorte1 = ($('#corte1').val() * ($('#materiacorte1').val()/100));
        var vcorte2 = ($('#corte2').val() * ($('#materiacorte2').val()/100));
        var vcorte3 = ($('#corte3').val() * ($('#materiacorte3').val()/100));
        $('#final').val(vcorte1+vcorte2+vcorte3);
    }

    $(document).ready(function(){
            var currentUrl = window.location.href;
            $(".nav-link").each(function() {
            var linkUrl = $(this).attr("href");
                if (currentUrl.includes(linkUrl)) {
                    $(this).addClass("active");
                    $(this).parents(".nav-item").addClass("menu-open");
                }
             });



        $('#corte1').change(function() {
            calcularnotafinal();
        });

        $('#corte2').change(function() {
            calcularnotafinal();
        });

        $('#corte3').change(function() {
            calcularnotafinal();
        });

        $('#proyectouser').change(function() {
            var valorProyecto = $(this).val();

            if (valorProyecto !== "") {
                $('#materiasuser').val("0");
            }
        });

        $('#materiasuser').change(function() {
            var valorMateria = $(this).val();

            if (valorMateria !== "") {
                $('#proyectouser').val("0");
            }
        });

        $.ajax({
            method: "get",
            url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/listestudiantes') ?>",
            success : function(json) {
                JSON.parse(json).forEach(element => $("#estudiantes").append("<option value='"+element["idUsuario"]+"'> "+element["nombre"]+" "+element["apellido"]+"</option>"));
            },
        });

        $.ajax({
            method: "get",
            url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/listprofesores') ?>",
            success : function(json) {
                JSON.parse(json).forEach(element => $("#profesores").append("<option value='"+element["idUsuario"]+"'> "+element["nombre"]+" "+element["apellido"]+"</option>"));
            },
        });

        $.ajax({
            method: "get",
            url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/listmaterias') ?>",
            success : function(json) {
                JSON.parse(json).forEach(element => $("#materias").append("<option value='"+element["idmateria"]+"'> "+element["nombre"]+" "+element["codigo"]+"</option>"));
            },
        });

        $.ajax({
            method: "get",
            url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/listproyectos') ?>",
            success : function(json) {
                JSON.parse(json).forEach(element => $("#proyecto").append("<option value='"+element["idProyecto"]+"'> "+element["nombre"]+" "+element["descripcion"]+"</option>"));
            },
        });

        $.ajax({
            method: "get",
            url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/listproyectos') ?>",
            success : function(json) {
                JSON.parse(json).forEach(element => $("#proyecto1").append("<option value='"+element["idProyecto"]+"'> "+element["nombre"]+" "+element["descripcion"]+"</option>"));
            },
        });

        $.ajax({
            method: "get",
            url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/listmateriasuser') ?>",
            success : function(json) {
                JSON.parse(json).forEach(element => $("#materiasuser").append("<option value='"+element["idmateria"]+"'> "+element["nombre"]+" "+element["codigo"]+"</option>"));
            },
        });

        $.ajax({
            method: "get",
            url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/listproyectosuser') ?>",
            success : function(json) {
                JSON.parse(json).forEach(element => $("#proyectouser").append("<option value='"+element["idProyecto"]+"'> "+element["nombre"]+" "+element["descripcion"]+"</option>"));
            },
        });

    });

    function proyectoestudiante(idestudiante,proyecto,estudiante,action,anteriorproyecto){

        if (action == 0){
            $.ajax({
                method: "get",
                url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/updateproyectoestudiante') ?>",
                data: { proyecto: $("#proyecto1").val() ,
                    estudiante: $("#estudiante1").val()  ,
                },
                success : function(json) {
                    if (json == "ok"){
                        Swal.fire({
                            icon: 'success',
                            title: 'Cambio de proyecto!',
                            text: 'Registro Actualizado!',
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    }else{
                        Swal.fire(
                            'Oh no!',
                            'Algo salio mal!',
                            'error'
                        )
                    }
                },
            });
        }
        if (action == 1){
            $("#estudiante1").children().remove();
            $("#estudiante1").append("<option value='"+idestudiante+"' selected> "+estudiante+"</option>");
            $("#proyectoafter").children().remove();
            $("#proyectoafter").append("<option value='"+anteriorproyecto+"' selected> "+anteriorproyecto+"</option>");
        }
    }
    function preupdatenotas(data,update){
        if (update){
            $.ajax({
                method: "get",
                url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/registronotas') ?>",
                data: { proyectonotas: $("#proyectonotas").val() ,
                    materiasnotas: $("#materiasnotas").val()  ,
                    estudiantenotas: $("#estudiantenotas").val()  ,
                    corte1: $("#corte1").val()  ,
                    corte2: $("#corte2").val()  ,
                    corte3: $("#corte3").val()  ,
                    final: $("#final").val()  ,
                    idnotas: $("#idnotas").val()  ,
                    idcurso: $("#idcurso").val()  ,
                },
                success : function(json) {
                    if (json == "ok"){
                        Swal.fire({
                            icon: 'success',
                            title: 'notas Actualizadas!',
                            text: 'Registro Actualizado!',
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    }else{
                        Swal.fire(
                            'Oh no!',
                            'Algo salio mal!',
                            'error'
                        )
                    }
                },
            });
        }else{
            $.ajax({
                method: "get",
                url: "<?= Yii::$app->getUrlManager()->createUrl('notas/cargueupdate') ?>",
                data: { data: data ,
                },
                success : function(json) {
                    json = JSON.parse(json);
                    $("#proyectonotas").children().remove();
                    $("#materiasnotas").children().remove();
                    $("#estudiantenotas").children().remove();
                    $("#proyectonotas").append("<option value='"+json[0]["nombre_proyecto"]+"'> "+json[0]["nombre_proyecto"]+"</option>");
                    $("#materiasnotas").append("<option value='"+json[0]["nombre_materia"]+"'> "+json[0]["nombre_materia"]+"</option>");
                    $("#estudiantenotas").append("<option value='"+json[0]["nombre_estudiante"]+"'> "+json[0]["nombre_estudiante"]+"</option>");
                    $("#corte1").val(json[0]["corte1"]) ;
                    $("#corte2").val(json[0]["corte2"]);
                    $("#corte3").val(json[0]["corte3"]);
                    $("#materiacorte1").val(json[0]["vcorte1"]) ;
                    $("#materiacorte2").val(json[0]["vcorte2"]);
                    $("#materiacorte3").val(json[0]["vcorte3"]);
                    $("#final").val(json[0]["nota"]);
                    $("#idcurso").val(json[0]["idcurso"]);
                    $("#idnotas").val(json[0]["idnotas"]);
                    },
            });
        }
    }
    function enviargrupos(){
        $.ajax({
            method: "get",
            url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/registro') ?>",
            data: { estudiante: $("#estudiantes").val() ,
                profesor: $("#profesores").val()  ,
                materia: $("#materias").val()  ,
                proyecto: $("#proyecto").val()  ,
            },
            success : function(json) {
                if (json == "ok"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Inscrito!',
                        text: 'Registro completo!',
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    })
                }else{
                    Swal.fire(
                        'Oh no!',
                        'Algo salio mal!',
                        'error'
                    )
                }
            },
        });
    }


        function materiaprofesor() {
            $("#tablemodalmaterias").children(0).remove();
            var materias = $("#materias").val();

            if (Array.isArray(materias)) {
                materias.forEach(function (materia, indice) {
                    if (materia != "Selecciona las Materias") {
                        $.ajax({
                            method: "get",
                            url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/listprofesoreselect') ?>",
                            data: {
                            },
                            success: function (html) {
                                $.ajax({
                                    method: "get",
                                    url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/materiaid') ?>",
                                    data: {
                                        id: materia,
                                    },
                                    success: function (json) {
                                        var a = JSON.parse(json);
                                        $("#tablemodalmaterias").append("<tr><td><input class='valmateria' hidden value='" + materia + "' id='materiaid" + indice + "'>" + a[0]["nombre"] + " </td><td>"+html+" </td></tr>");
                                    },
                                });
                            },
                        });
                    }
                });
            }
        }

    function sendata() {

        var matprof = [];
        $('#tablemodalmateriaprofe tr').each(function(index, fila) {
            // Obtener el valor seleccionado del select en la segunda columna
            var valorSelect = $(fila).find('td:eq(1) select').val();
            var valorInput = $(fila).find('.valmateria').val();
            var parValores = [valorSelect, valorInput];
            matprof.push(parValores);
        });
        $.ajax({
            method: "get",
            url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/materiaprofe') ?>",
            data: {
                estudiante: $("#estudiantes").val(),
                matprof: matprof,
                proyecto: $("#proyecto").val(),
            },
            success: function (json) {
                if (json == "ok") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Inscrito!',
                        text: 'Registro completo!',
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    })
                } else {
                    Swal.fire(
                        'Oh no!',
                        'Algo salio mal!',
                        'error'
                    )
                }
            },
        });
    }


</script>
</body>
<?php $this->endPage() ?>
<?php } else { ?>
    <?php $this->beginPage() ?>
    <?php $this->beginBody() ?>
    <?php echo $this->render("index"); ?>
    <?php $this->endBody() ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function sedes(item, index) {
            $("#sede").append("<option value='"+item["idSede"]+"'> "+item["nombre"]+"</option>");
        }
        function cursos(item, index) {
            $("#curso").append("<option value='"+item["idCurso"]+"'> "+item["curso"]+"</option>");
        }
        function jornadas(item, index) {
            $("#jornada").append("<option value='"+item["idJornada"]+"'> "+item["nombre"]+"</option>");
        }
        function td(item, index) {
            $("#td").append("<option value='"+item["idTipo_Documento"]+"'> "+item["tipo"]+"</option>");
        }
        function sedes(item, index) {
            $("#estudiantes").append("<option value='"+item["idSede"]+"'> "+item["nombre"]+"</option>");
        }


        $(document).ready(function(){
            $.ajax({
                method: "get",
                url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/estudiantes') ?>",
                success : function(json) {
                    JSON.parse(json).forEach(element => $("#estudiantes").append("<option value='"+element["idGenero"]+"'> "+element["nombre"]+"</option>"));
                },
            });

        });


        function enviar(){
            $.ajax({
                method: "get",
                url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/persona') ?>",
                data: { cc: $("#cc").val() ,
                    name: $("#name").val()  ,
                    last: $("#last").val()  ,
                    user: $("#user").val()  ,
                    email: $("#email").val()  ,
                    password: $("#password").val()  ,
                },
                success : function(json) {
                    if (json == "ok"){
                        Swal.fire({
                            icon: 'success',
                            title: 'Inscrito!',
                            text: 'Registro completo!',
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    }else{
                        Swal.fire(
                            'Oh no!',
                            'Algo salio mal!',
                            'error'
                        )
                    }
                },
            });

        }

    </script>
    <?php $this->endPage() ?>
<?php } ?>