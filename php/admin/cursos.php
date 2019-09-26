<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../admin/admin.php' );
    }
?>

<!-- Modal Agregar Curso -->
<div class="modal fade" id="modalCurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitulo">Agregar Curso</h5>
      </div>
      <div class="modal-body">
            <div class="container-fluid">
                <!--div class="row mt-0 mb-3">
                     <div class="col-12 d-flex justify-content-center" id="divMensaje"></div>
                </div-->

                <form id="formCurso">

                    <div class="row" id="divDatosCurso">
                        <div class="col-12 col-lg-12">

                            <div class="row mt-3">                     
                                <div class="col-lg-3">
                                    <label for="txt_titulo" class="col-form-label">Título: </label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="txt_titulo">
                                </div>
                             </div>


                            <div class="row mt-2">
                                <div class="col-lg-3">
                                    <label for="txt_description" class="col-form-label">Descripción: </label>
                                </div>
                                <div class="col-lg-9">
                                    <textarea name="" id="txt_description"  rows="2" class="form-control"></textarea>
                                </div>
                            </div>


                            <div class="row mt-2">                     
                                <div class="col-lg-3">
                                    <label for="txt_cantidad" class="col-form-label">Asistentes:</label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="number" class="form-control" id="txt_cantidad">
                                </div>
                            </div>


                            <div class="row mt-2">                     
                                <div class="col-lg-3">
                                    <label for="txt_requisitos" class="col-form-label">Requisitos: </label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="txt_requisitos">
                                </div>
                            </div>


                            <div class="row mt-2">                     
                                <div class="col-lg-3 col-sm-12">
                                    <label for="select_tActividad" class="col-form-label">Tipo de Actividad: </label>
                                </div>
                                <div class="col-lg-9 col-sm-12" id="divselect_tActividad" >
                                    <!--select id="select_tActividad" name = "select_tActividad" class="form-control">
                                    </select-->
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-3">
                                    <label for="txt_dirigido" class="col-form-label">Dirigído: </label>
                                </div>
                                <div class="col-lg-9">
                                    <textarea name="" id="txt_dirigido"  rows="2" class="form-control"></textarea>
                                </div>
                            </div>


                            <div class="row mt-4">
                                <div class="col-sm-11 col-lg-11 d-flex justify-content-center">
                                    <h6 class="text-center">Requerimiento (s)</h6>                        
                                </div>

                                <div class="col-sm-1 col-lg-1 d-flex justify-content-center" >
                                    <button class="btn" type="button" id="btn_agregarReq"><i class="fas fa-plus"></i>
                                </div>
                            </div>


                            <div class="row mt-2">
                                <table class="table">
                                    <thead>
                                        
                                    </thead>
                                    <tbody id="divReq">                     
                                    </tbody>
                                </table>
                            </div>


                            <div class="row mb-4 mt-2">
                                <div class="col-12 d-flex justify-content-center" >
                                    <div class="row mt-2" id="MaterialesVacio">
                                        <div class="col-12 col-lg-12">
                                            <label>¿El participante debe llevar materiales? </label>
                                            <label><input type="radio" id="cbox1" value="true" name="confMaterial"> Si</label>
                                            <input type="radio" id="cbox2" value="false" name="confMaterial"> <label for="cbox2"> No </label> 
                                        </div>
                                        
                                    </div>  
                                </div>
                            </div>


                            

                            <!--Parte del seleccionador del Material -->
                            <div class="row" id="divMaterialConf">
                                <div class="col-12">
                                    <div class="row mt-2" id="">
                                        <div class="col-sm-11 col-lg-11 d-flex justify-content-center">
                                            <h6 class="text-center">Material(s)</h6>                        
                                        </div>

                                        <div class="col-sm-1 col-lg-1 d-flex justify-content-center" >
                                            <button class="btn" type="button" id="btn_agregarMaterial"><i class="fas fa-plus"></i>
                                        </div>    
                                    </div>


                                    <div class="row mt-2">
                                        <table class="table">
                                            <thead>
                                                <tr class="text-center titulo-tabla">
                                                    <th>Material</th>
                                                    <th>Cantidad</th>
                                                </tr>
                                            </thead>
                                            <tbody id="divMaterial">
                                                  
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>


                            <div class="row mt-0 mb-3">
                                 <div class="col-12 d-flex justify-content-center" id="divMensajeDatosCurso" ></div>
                            </div>


                            <div class="row mb-4 mt-2">
                                <div class="col-12 col-lg-12 d-flex justify-content-center">
                                    <span class="btn btn-success mx-2 col-4" id="btn_AceptarDatosCurso">Aceptar</span>
                                    <span class="btn btn-secondary mx-2 col-4" id="btn_salirDatos">Salir</span>
                                </div>
                            </div>

                        </div>    
                    </div>

                    

                    <!--Parte del seleccionador de los Requerimientos -->

                                 

                    <!--Parte del seleccionador del profesor -->
                    <div class="row" id="divProfesorConf">
                        <div class="col-12 col-lg-12">
                            <div class="row mt-2">
                                <div class="col-sm-11 col-lg-11 d-flex justify-content-center">
                                    <h6 class="text-center">Profesor(res)</h6>                        
                                </div>

                                <div class="col-sm-1 col-lg-1 d-flex justify-content-center" >
                                    <button class="btn" type="button" id="btn_agregarProfesor"><i class="fas fa-plus"></i>
                                </div>    
                            </div>

                            <div class="row mt-2">
                                <table class="table">
                                    <thead>                                    
                                    </thead>
                                    <tbody id="divProfesor">

                                        
                                    </tbody>

                                </table>                         
                            </div>


                            <div class="row mt-0 mb-3">
                                 <div class="col-12 d-flex justify-content-center" id="divMensajeProfesor" ></div>
                            </div>


                            <div class="row mb-4 mt-2">
                                <div class="col-12 col-lg-12 d-flex justify-content-center">
                                    <span class="btn btn-success mx-2 col-4" id="btn_AceptarProfesor">Aceptar</span>
                                    <span class="btn btn-primary mx-2 col-4" id="btn_regresarProfesor">Regresar</span>
                                    <span class="btn btn-secondary mx-2 col-4" id="btn_salirProfesor">Salir</span>
                                </div>
                            </div>

                        </div>
                    </div>             

                    <!--Parte del seleccionador del Responsable -->
                    <div class="row" id="divRespConf">
                        <div class="col-12 col-lg-12">
                            <div class="row mt-2" id="">
                                <div class="col-sm-11 col-lg-11 d-flex justify-content-center">
                                    <h6 class="text-center">Responsable(s)</h6>                        
                                </div>

                                <div class="col-sm-1 col-lg-1 d-flex justify-content-center" >
                                    <button class="btn" type="button" id="btn_agregarResponsable"><i class="fas fa-plus"></i>
                                </div>    
                            </div>

                            <div class="row mt-2">
                                <table class="table">
                                    <thead>                                    
                                    </thead>
                                    <tbody id="divResponsable">         
                                    </tbody>
                                </table>
                            </div>

                            <div class="row mt-0 mb-3">
                                 <div class="col-12 d-flex justify-content-center" id="divMensajeResp" ></div>
                            </div>

                            <div class="row mb-4 mt-2">
                                <div class="col-12 col-lg-12 d-flex justify-content-center">
                                    <span class="btn btn-success mx-2 col-4" id="btn_AceptarResp">Aceptar</span>
                                    <span class="btn btn-primary mx-2 col-4" id="btn_regresarResp">Regresar</span>
                                    <span class="btn btn-secondary mx-2 col-4" id="btn_salirResp">Salir</span>
                                </div>
                            </div>

                        </div>                    
                    </div>

                    

                    <div class="row" id="divHorarioConf">
                        <div class="col-12 col-lg-12">
                            <div id="msg_error_horario" class="row d-flex justify-content-center">                                            
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-11 col-lg-11 d-flex justify-content-center">
                                    <h6 class="text-center pl-1">Horario(s)</h6>                        
                                </div>

                                

                                <div class="col-sm-1 col-lg-1 d-flex justify-content-center" id="div_btn_agregarHorario">
                                    <!--button class="btn" type="button" id="btn_agregarHorario"><i class="fas fa-plus"></i-->
                                </div>    
                            </div>

                            <div class="row mt-2 d-flex justify-content-center" id="tablaHorario">
                                <table class="table" >
                                    <thead class="titulo-tabla" id = "tableHeadHorario">

                                    </thead>

                                    <tbody id = "tableBodyHorario">
                                        
                                    </tbody>
                                </table>     
                            </div>


                            <div class="row mb-4 mt-2" id = "divBotonCalcularHorario">
                                <!--div class="col-12 col-lg-12 d-flex justify-content-center">
                                    <span class="btn btn-secondary mx-2 col-4" id="btn_CalcularHorario">Verificar Lugar</span>
                                    <span class="btn btn-secondary mx-2 col-4" id="btn_RegresarVerificar">Regresar</span>
                                </div-->
                            </div>

                            <div class="row mb-4 mt-2" id = "divBotonesHorario">
                                <div class="col-12 col-lg-12 d-flex justify-content-center">
                                    <span class="btn btn-success mx-2 col-3" id="btn_AceptarHorario">Aceptar</span>
                                    <span class="btn btn-warning mx-2 col-3" id="btn_ReiniciarHorario">Reiniciar</span>
                                    <span class="btn btn-primary mx-2 col-3" id="btn_regresarHorario">Regresar</span>
                                    <span class="btn btn-secondary mx-2 col-3" id="btn_salirHorario">Salir</span>
                                </div>
                            </div>

                        </div>
                    </div>

                
                
                    <div class="row mt-0 mb-3">
                         <div class="col-12 d-flex justify-content-center" id="divMensaje" ></div>
                    </div>


                    <div class="row" id="divConfirmarCurso">
                        <div class="col-12 col-lg 12">

                            <div class="row mt-2">  

                                <div class="col-sm-11 col-lg-11 d-flex justify-content-center">
                                    <h6 class="text-center">¿Desea agregar el curso?</h6>                        
                                </div> 

                            </div>


                            <div class="row mt-0 mb-3">
                                <div class="col-12 d-flex justify-content-center" id="divMensajeFinal" ></div>
                            </div>
                            


                            <div class="row mt-4 form-inline">
                                <div class="col-lg-4 col-sm-12 mt-2 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-danger col-sm-8 col-lg-8" id="btn_aceptar">Agregar</button>
                                </div>

                                <div class="col-lg-4 col-sm-12 mt-2 d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary col-sm-8 col-lg-8" id="btn_regresarGuardarCurso">Regresar</button>
                                </div>

                                <div class="col-lg-4 col-sm-12 mt-2 d-flex justify-content-center">
                                    <button type="button" class="btn btn-secondary col-sm-8 col-lg-8" data-dismiss="modal" id="btn_cancelar">Cancelar</button>
                                </div>
                            </div>

                            

                        </div>
                    </div>

                
                </form>
            </div>
      </div>

    </div>
  </div>
</div>

<!-- Modal Editar Curso -->
<div class="modal fade" id="modalEditarCurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitulo">Agregar Curso</h5>
      </div>
      <div class="modal-body">
            <div class="container-fluid">
                <!--div class="row mt-0 mb-3">
                     <div class="col-12 d-flex justify-content-center" id="divMensaje"></div>
                </div-->

                <form id="formCurso">

                    <div class="row" id="divDatosCurso">
                        <div class="col-12 col-lg-12">

                            <div class="row mt-3">                     
                                <div class="col-lg-3">
                                    <label for="txt_titulo" class="col-form-label">Título: </label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="txt_titulo">
                                </div>
                             </div>


                            <div class="row mt-2">
                                <div class="col-lg-3">
                                    <label for="txt_description" class="col-form-label">Descripción: </label>
                                </div>
                                <div class="col-lg-9">
                                    <textarea name="" id="txt_description"  rows="2" class="form-control"></textarea>
                                </div>
                            </div>


                            <div class="row mt-2">                     
                                <div class="col-lg-3">
                                    <label for="txt_cantidad" class="col-form-label">Asistentes:</label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="number" class="form-control" id="txt_cantidad">
                                </div>
                            </div>


                            <div class="row mt-2">                     
                                <div class="col-lg-3">
                                    <label for="txt_requisitos" class="col-form-label">Requisitos: </label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="txt_requisitos">
                                </div>
                            </div>


                            <div class="row mt-2">                     
                                <div class="col-lg-3 col-sm-12">
                                    <label for="select_tActividad" class="col-form-label">Tipo de Actividad: </label>
                                </div>
                                <div class="col-lg-9 col-sm-12" id="divselect_tActividad" >
                                    <!--select id="select_tActividad" name = "select_tActividad" class="form-control">
                                    </select-->
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-3">
                                    <label for="txt_dirigido" class="col-form-label">Dirigído: </label>
                                </div>
                                <div class="col-lg-9">
                                    <textarea name="" id="txt_dirigido"  rows="2" class="form-control"></textarea>
                                </div>
                            </div>


                            <div class="row mt-4">
                                <div class="col-sm-11 col-lg-11 d-flex justify-content-center">
                                    <h6 class="text-center">Requerimiento (s)</h6>                        
                                </div>

                                <div class="col-sm-1 col-lg-1 d-flex justify-content-center" >
                                    <button class="btn" type="button" id="btn_agregarReq"><i class="fas fa-plus"></i>
                                </div>
                            </div>


                            <div class="row mt-2">
                                <table class="table">
                                    <thead>
                                        
                                    </thead>
                                    <tbody id="divReq">                     
                                    </tbody>
                                </table>
                            </div>


                            <div class="row mb-4 mt-2">
                                <div class="col-12 d-flex justify-content-center" >
                                    <div class="row mt-2" id="MaterialesVacio">
                                        <div class="col-12 col-lg-12">
                                            <label>¿El participante debe llevar materiales? </label>
                                            <label><input type="radio" id="cbox1" value="true" name="confMaterial"> Si</label>
                                            <input type="radio" id="cbox1" value="false" name="confMaterial"> <label for="cbox2"> No </label> 
                                        </div>
                                        
                                    </div>  
                                </div>
                            </div>


                            

                            <!--Parte del seleccionador del Material -->
                            <div class="row" id="divMaterialConf">
                                <div class="col-12">
                                    <div class="row mt-2" id="">
                                        <div class="col-sm-11 col-lg-11 d-flex justify-content-center">
                                            <h6 class="text-center">Material(s)</h6>                        
                                        </div>

                                        <div class="col-sm-1 col-lg-1 d-flex justify-content-center" >
                                            <button class="btn" type="button" id="btn_agregarMaterial"><i class="fas fa-plus"></i>
                                        </div>    
                                    </div>


                                    <div class="row mt-2">
                                        <table class="table">
                                            <thead>
                                                <tr class="text-center titulo-tabla">
                                                    <th>Material</th>
                                                    <th>Cantidad</th>
                                                </tr>
                                            </thead>
                                            <tbody id="divMaterial">
                                                  
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>


                            <div class="row mt-0 mb-3">
                                 <div class="col-12 d-flex justify-content-center" id="divMensajeDatosCurso" ></div>
                            </div>


                            <div class="row mb-4 mt-2">
                                <div class="col-12 col-lg-12 d-flex justify-content-center">
                                    <span class="btn btn-success mx-2 col-4" id="btn_AceptarDatosCurso">Aceptar</span>
                                    <span class="btn btn-secondary mx-2 col-4" id="btn_salirDatos">Salir</span>
                                </div>
                            </div>

                        </div>    
                    </div>

                    

                    <!--Parte del seleccionador de los Requerimientos -->

                                 

                    <!--Parte del seleccionador del profesor -->
                    <div class="row" id="divProfesorConf">
                        <div class="col-12 col-lg-12">
                            <div class="row mt-2">
                                <div class="col-sm-11 col-lg-11 d-flex justify-content-center">
                                    <h6 class="text-center">Profesor(res)</h6>                        
                                </div>

                                <div class="col-sm-1 col-lg-1 d-flex justify-content-center" >
                                    <button class="btn" type="button" id="btn_agregarProfesor"><i class="fas fa-plus"></i>
                                </div>    
                            </div>

                            <div class="row mt-2">
                                <table class="table">
                                    <thead>                                    
                                    </thead>
                                    <tbody id="divProfesor">

                                        
                                    </tbody>

                                </table>                         
                            </div>


                            <div class="row mt-0 mb-3">
                                 <div class="col-12 d-flex justify-content-center" id="divMensajeProfesor" ></div>
                            </div>


                            <div class="row mb-4 mt-2">
                                <div class="col-12 col-lg-12 d-flex justify-content-center">
                                    <span class="btn btn-success mx-2 col-4" id="btn_AceptarProfesor">Aceptar</span>
                                    <span class="btn btn-primary mx-2 col-4" id="btn_regresarProfesor">Regresar</span>
                                    <span class="btn btn-secondary mx-2 col-4" id="btn_salirProfesor">Salir</span>
                                </div>
                            </div>

                        </div>
                    </div>             

                    <!--Parte del seleccionador del Responsable -->
                    <div class="row" id="divRespConf">
                        <div class="col-12 col-lg-12">
                            <div class="row mt-2" id="">
                                <div class="col-sm-11 col-lg-11 d-flex justify-content-center">
                                    <h6 class="text-center">Responsable(s)</h6>                        
                                </div>

                                <div class="col-sm-1 col-lg-1 d-flex justify-content-center" >
                                    <button class="btn" type="button" id="btn_agregarResponsable"><i class="fas fa-plus"></i>
                                </div>    
                            </div>

                            <div class="row mt-2">
                                <table class="table">
                                    <thead>                                    
                                    </thead>
                                    <tbody id="divResponsable">         
                                    </tbody>
                                </table>
                            </div>

                            <div class="row mt-0 mb-3">
                                 <div class="col-12 d-flex justify-content-center" id="divMensajeResp" ></div>
                            </div>

                            <div class="row mb-4 mt-2">
                                <div class="col-12 col-lg-12 d-flex justify-content-center">
                                    <span class="btn btn-success mx-2 col-4" id="btn_AceptarResp">Aceptar</span>
                                    <span class="btn btn-primary mx-2 col-4" id="btn_regresarResp">Regresar</span>
                                    <span class="btn btn-secondary mx-2 col-4" id="btn_salirResp">Salir</span>
                                </div>
                            </div>

                        </div>                    
                    </div>

                    

                    <div class="row" id="divHorarioConf">
                        <div class="col-12 col-lg-12">
                            <div id="msg_error_horario" class="row d-flex justify-content-center">                                            
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-11 col-lg-11 d-flex justify-content-center">
                                    <h6 class="text-center pl-1">Horario(s)</h6>                        
                                </div>

                                

                                <div class="col-sm-1 col-lg-1 d-flex justify-content-center" id="div_btn_agregarHorario">
                                    <!--button class="btn" type="button" id="btn_agregarHorario"><i class="fas fa-plus"></i-->
                                </div>    
                            </div>

                            <div class="row mt-2 d-flex justify-content-center" id="tablaHorario">
                                <table class="table" >
                                    <thead class="titulo-tabla" id = "tableHeadHorario">

                                    </thead>

                                    <tbody id = "tableBodyHorario">
                                        
                                    </tbody>
                                </table>     
                            </div>


                            <div class="row mb-4 mt-2" id = "divBotonCalcularHorario">
                                <!--div class="col-12 col-lg-12 d-flex justify-content-center">
                                    <span class="btn btn-secondary mx-2 col-4" id="btn_CalcularHorario">Verificar Lugar</span>
                                    <span class="btn btn-secondary mx-2 col-4" id="btn_RegresarVerificar">Regresar</span>
                                </div-->
                            </div>

                            <div class="row mb-4 mt-2" id = "divBotonesHorario">
                                <div class="col-12 col-lg-12 d-flex justify-content-center">
                                    <span class="btn btn-success mx-2 col-3" id="btn_AceptarHorario">Aceptar</span>
                                    <span class="btn btn-warning mx-2 col-3" id="btn_ReiniciarHorario">Reiniciar</span>
                                    <span class="btn btn-primary mx-2 col-3" id="btn_regresarHorario">Regresar</span>
                                    <span class="btn btn-secondary mx-2 col-3" id="btn_salirHorario">Salir</span>
                                </div>
                            </div>

                        </div>
                    </div>

                
                
                    <div class="row mt-0 mb-3">
                         <div class="col-12 d-flex justify-content-center" id="divMensaje" ></div>
                    </div>


                    <div class="row" id="divConfirmarCurso">
                        <div class="col-12 col-lg 12">

                            <div class="row mt-2">  

                                <div class="col-sm-11 col-lg-11 d-flex justify-content-center">
                                    <h6 class="text-center">¿Desea agregar el curso?</h6>                        
                                </div> 

                            </div>


                            <div class="row mt-0 mb-3">
                                <div class="col-12 d-flex justify-content-center" id="divMensajeFinal" ></div>
                            </div>
                            


                            <div class="row mt-4 form-inline">
                                <div class="col-lg-4 col-sm-12 mt-2 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-danger col-sm-8 col-lg-8" id="btn_aceptar">Agregar</button>
                                </div>

                                <div class="col-lg-4 col-sm-12 mt-2 d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary col-sm-8 col-lg-8" id="btn_regresarGuardarCurso">Regresar</button>
                                </div>

                                <div class="col-lg-4 col-sm-12 mt-2 d-flex justify-content-center">
                                    <button type="button" class="btn btn-secondary col-sm-8 col-lg-8" data-dismiss="modal" id="btn_cancelar">Cancelar</button>
                                </div>
                            </div>

                            

                        </div>
                    </div>

                
                </form>
            </div>
      </div>

    </div>
  </div>
</div>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Insertar Titulo de la página -->
    <title> Cursos </title>

    <!--Códigos fuentes externos -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Estilos propios -->
    <link rel="stylesheet" href="../../css/main.css"> 

    <style>
        .size-tabla{
            font-size: 12px;
        }
    </style>
    
</head>
<body>
    
    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark nav-admin justify-content-between p-2">
            <a href="index.php" class="navbar-brand ml-3 "><small class="nav-letras-admin">Administrador</small></a>
            <a href="cerrarSesion.php"><span class="btn btn-outline-light px-3 py-1 cerrarsesion">Cerrar Sesión</span></a>            
    </nav>


    <!-- Contenido de la página -->

    <div class="container">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <h4 class="d-flex justify-content-center mt-4 "><b>Cursos</b></h4>
            </div>  
        </div>


        <!--div class="row d-flex justify-content-around mt-2">


            <div class="col-lg-3 col-sm-0"></div>
            <div class="col-lg-3 col-sm-4 d-flex justify-content-center mt-2">
                <a href="#" class="btn btn-agregar" data-toggle="modal" data-target="#modalCurso" id ="btn_agregar">Agregar</a>
            </div>

            <div class="col-lg-3 col-sm-4 d-flex justify-content-center mt-2">
                <a href="../admin" class="btn btn-salir">Salir</a>
            </div>

            <div class="col-lg-3 col-sm-0"></div>
        </div-->


        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-lg-8 col-sm-10">
                <form id="formBuscar">
                    <div class="input-group d-flex justify-content-center">
                        <input id="txt_buscar" type="text" class="form-control col-sm-auto" name="txt_buscar" placeholder="Buscar">
                        <span class="btn btn-outline-secondary input-group-append" type="submit" id="btn_buscar"><i class="fas fa-search"></i></span>
                    </div>                        
                </form>
            </div>
        </div>

        <div class="row mt-5">
                <div class="col-lg-0 col-sm-0"></div>
                <div class="col-lg-12 col-sm-12">
                    <!--form method="post" action = "usuario/plantillaUsuario.php"-->
                        <table class="table align-center text-center">
                            <thead>
                                <tr class="texto-tabla">
                                    <th>Título</th>
                                    <th>Ponente(s)</th>
                                    <th>Responsable</th>
                                    <th>Horario</th>
                                    <th class="text-right">Agregar</th>
                                    <th class="text-left"><span data-toggle="modal" data-target="#modalCurso" id ="btn_agregar"><i class="fas fa-plus i_mostrar"></i></span></th>
                                </tr>
                            </thead>
                            <tbody id="tablaCurso" class="size-tabla">

                            </tbody>
                        </table>
                    <!--/form-->  
                </div>
                <div class="col-lg-0 col-sm-0"></div>
        </div>

        
    </div>
    <script src= "../../js/admin/curso/funciones.js"></script>
    <script src= "../../js/admin/curso/agregarCurso.js"></script>
    <script src= "../../js/admin/curso/editarCurso.js"></script>
    <script src= "../../js/admin/curso/agregarCampos.js"></script>
    <script src= "../../js/admin/curso/mostrar.js"></script>
    <script src= "../../js/admin/curso/editar.js"></script>
    <script src= "../../js/admin/curso/eliminar.js"></script>
    <script src= "../../js/admin/curso/buscar.js"></script>

</body>
</html>
