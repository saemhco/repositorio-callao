<!--  Modal content for the above example -->
                                <div class="modal fade" id="modal_nuevo" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Nuevo</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div><br>
                                            <form action="#" id="form_nuevo">
                                            <div class="modal-body">
                                                <div class="row floating-labels">
                                                    <div class="form-group col-md-12">
                                                       <input type="text" maxlength="8" class="form-control" name="dni" id="dni" >
                                                       <span class="bar"></span>
                                                       <label for="dni">DNI </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <input type="text" class="form-control" name="nombres" id="nombres" >
                                                       <span class="bar"></span>
                                                       <label for="nombres">Nombres </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <input type="text" class="form-control" name="apellidos" id="apellidos" >
                                                       <span class="bar"></span>
                                                       <label for="apellidos">Apellidos </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <select class="form-control" name="genero">
                                                          <option value=""></option>
                                                          <option value="1">Masculino</option>
                                                          <option value="0">Femenino</option>
                                                       </select>
                                                       <label for="genero">Género </label>
                                                    </div>                                                   
                                                </div>
                                              
                                            </div>
                                            <div class="modal-footer">
                                                <label class="btn btn-success btn-block" type="button" onclick="nuevo()">Guardar</label>
                                            </div>
                                            </form>
                                        </div><!-- /.modal-content -->

                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->