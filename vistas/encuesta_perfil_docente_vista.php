<?php
$usuario = $_SESSION['id_persona'];


?>
<!DOCTYPE html>
<html>

<head>

    <!--     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title></title>
</head>



<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-around flex-row bd-highlight row">
                        <div class="card " style="width:420px;border-color:gray;" id="parrafo_encuesta">
                            <div class="card-body">
                                <h4 class="card-title">Preferencia Docente en Base a Experiencias Profesionales</h4>
                                <div class="card-text">
                                    <button type="button" id="btn_modal1" class="btn btn-info " onclick="pregunta1();">Pregunta 1</button>
                                    <button type="button" id="btn_modal2" class="btn btn-info " onclick="pregunta2();">Pregunta 2</button>
                                    <button type="button" id="btn_modal3" class="btn btn-info " onclick="pregunta3();">Pregunta 3</button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- modal encuesta -->
                <div class="modal fade" id="modalencuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalencuesta">Pregunta 1</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">

                                <!--  <div class="card " style="width:420px;border-color:gray;"> -->

                                <div style="text-align:left">


                                    <h5 style="font-weight: bold; font-size: 15px"> 1. ¿En que áreas de la carrera imparte clases?</h5>
                                    <div class="form-check">
                                        <?php

                                        if ($row1 != $row2) {
                                            // echo '<input type="checkbox"  name="" value="' . $id["id_pref_area_doce"] . '">' . $id["area_docente"];

                                            foreach ($row2 as $id) {
                                                echo '<br>';
                                                echo '<input class="pregunta1" type="checkbox" checked = "checked" name="areas[]" value="' . $id["id_pref_area_doce"] . '">' . $id["area_docente"];
                                            }

                                            foreach ($row3 as $id) {

                                                echo '<br>';
                                                echo '<input class="pregunta1" type="checkbox" name="areas[]" value="' . $id["id_area"] . '">' . $id["areas_vacias"];
                                            }
                                        } else {
                                            foreach ($row1 as $id) {
                                                echo '<br>';
                                                echo '<input  class="pregunta1" type="checkbox" name="areas[]" value="' . $id["id_area"] . '">' . $id["area"];
                                            }
                                        };

                                        ?>
                                    </div>


                                </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" value="pregunta1" class="btn btn-primary" onclick="enviarpregunta1()">Guardar</button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalencuesta2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalencuesta">Pregunta 2</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div style="text-align:left">
                                    <h5 style="font-weight: bold; font-size: 15px">2. ¿Seleccione una o dos áreas de la informática en la que tiene mayor experiencia y se siente más cómodo en la docencia?</h5>
                                    <div class="form-check">
                                        <?php


                                        if ($row4 != $row5) {
                                            // echo '<input type="checkbox"  name="" value="' . $id["id_pref_area_doce"] . '">' . $id["area_docente"];

                                            foreach ($row5 as $id) {
                                                echo '<br>';
                                                echo '<input class="pregunta2" type="checkbox" checked = "checked" name="areas2[]" value="' . $id["area_docente"] . '">' . $id["area_docente"];
                                            }

                                            foreach ($row6 as $id) {

                                                echo '<br>';
                                                echo '<input class="pregunta2" type="checkbox" name="areas2[]" value="' . $id["id_area"] . '">' . $id["expe_areas_vacias"];
                                            }
                                        } else {

                                            foreach ($row4 as $area) {
                                                echo '<br>';
                                                echo '<input  class="pregunta2" type="checkbox" name="areas2[]" value="' . $area["id_area"] . '">' . $area["area"];
                                            }
                                        };

                                        ?>

                                    </div>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" onclick="enviarpregunta2();">Guardar</button>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalencuesta3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalencuesta">Pregunta 3</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <!--  <div class="card " style="width:420px;border-color:gray;"> -->

                                <div style="text-align:left">

                                    <h5 style="font-weight: bold; font-size: 15px">3. Basado en la respuesta de la pregunta anterior ¿Selecciones la(s) Asignatura(s)
                                        en la que tiene mayor experiencia?</h5>
                                    <div class="form-check">
                                        <?php


                                        if ($row != $row7) {

                                            foreach ($row7 as $id) {
                                                echo '<br>';
                                                echo '<input class="pregunta3" type="checkbox" checked = "checked" name="asignatura3[]" value="' . $id["id_pref_asig_docen"] . '">' . $id["asig_docente"];
                                            }

                                            foreach ($row8 as $id) {

                                                echo '<br>';
                                                echo '<input class="pregunta3" type="checkbox" name="asignatura3[]" value="' . $id["id_asignatura"] . '">' . $id["asig_vacias"];
                                            }
                                        } else {

                                            foreach ($row as $id) {
                                                echo '<br>';
                                                echo '<input  required class="pregunta3" type="checkbox" name="asignatura3[]" value="' . $id["Id_asignatura"] . '">' . $id["asignatura"];
                                            }
                                        };

                                        ?>
                                    </div>
                                    <br><br>

                                    <h5 style="font-weight: bold; font-size: 15px"> 4. ¿Selecciones la(s) Asignatura(s) en la que desea de impartir? </h5>
                                    <div class="form-check">

                                        <?php

                                        if ($row9 != $row10) {

                                            foreach ($row10 as $id) {
                                                echo '<br>';
                                                echo '<input class="pregunta4" type="checkbox" checked = "checked" name="asignatura4[]" value="' . $id["id_desea_asig_doce"] . '">' . $id["desea_asig"];
                                            }

                                            foreach ($row11 as $id) {

                                                echo '<br>';
                                                echo '<input class="pregunta4" type="checkbox" name="asignatura4[]" value="' . $id["id_asignatura"] . '">' . $id["asig_vacias"];
                                            }
                                        } else {
                                            foreach ($row9 as $id) {
                                                echo '<br>';
                                                echo '<input required class="pregunta4" type="checkbox" name="asignatura4[]" value="' . $id["Id_asignatura"] . '">' . $id["asignatura"];
                                            }
                                        };

                                        ?>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary" onclick="enviarpregunta3();enviarpregunta4();">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>

</html>