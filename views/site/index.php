<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Estudiante</th>
        <th scope="col">Edad</th>
        <th scope="col">Curso</th>
        <th scope="col">Celular</th>
        <th scope="col">Correo</th>
        <th scope="col">Direccion</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>


<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Estudiantes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Correo</th>
                        <th scope="col">direccion</th>
                        <th scope="col">Acudiente</th>
                    </tr>
                    </thead>
                    <tbody id="dataa">
                    <tr>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Estudiante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Grado</th>
                        <th scope="col">Jornada</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Andres</td>
                        <td>Barrera</td>
                        <td>3115470450</td>
                        <td>j@gmail.com</td>
                        <td>6</td>
                        <td>Tarde</td>
                        <td>
                            <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Modificar</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Estudiantes</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script class="u-script" type="text/javascript" src="js/jquery-1.9.1.min.js" defer=""></script>
<script class="u-script" type="text/javascript" src="js/nicepage.js" defer=""></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function estudiantes(id) {
        $.ajax({
            method: "get",
            url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/estudiantes') ?>",
            data: { cur: id },
            success : function(json) {
                var a = JSON.parse(json)
                $("#dataa").children().remove();
                a.forEach(es);
            },
        });
    }

    function matricula(id) {
        $.ajax({
            method: "get",
            url: "<?= Yii::$app->getUrlManager()->createUrl('recurso/matricula') ?>",
            data: { cur: id },
            success : function(json) {
                Swal.fire({
                    icon: 'success',
                    title: 'Aprobado!',
                    text: 'estudiante aprobado!',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                })
            },
        });
    }

    function es(item, index) {
        $("#dataa").append("<tr>");
        $("#dataa").append("<td>"+item['nombre']+"</td>");
        $("#dataa").append("<td>"+item['apellido']+"</td>");
        $("#dataa").append("<td>"+item['celular']+"</td>");
        $("#dataa").append("<td>"+item['correo']+"</td>");
        $("#dataa").append("<td>"+item['direccion']+"</td>");
        $("#dataa").append("<td>"+item['foto']+"</td>");
        $("#dataa").append("</tr>");
    }
</script>