<!--  Modal content for the above example -->
                                <div class="modal fade" id="modal_editar" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Editar</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div><br>
                                            <form action="#" id="form_editar">
                                            <div class="modal-body">
                                                <div class="row floating-labels">
                                                    <div class="form-group col-md-12">
                                                       <input type="text" maxlength="8" class="form-control" name="dni" id="e-dni" value=" ">
                                                       <span class="bar"></span>
                                                       <label for="dni">DNI </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <input type="text" class="form-control" name="nombres" id="e-nombres" value=" ">
                                                       <span class="bar"></span>
                                                       <label for="nombres">Nombres </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <input type="text" class="form-control" name="apellidos" id="e-apellidos" value=" ">
                                                       <span class="bar"></span>
                                                       <label for="apellidos">Apellidos </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <select class="form-control" name="genero" id="e-genero">
                                                          <option value="1">Masculino</option>
                                                          <option value="0">Femenino</option>
                                                       </select>
                                                       <label for="genero">Género </label>
                                                    </div>                                                   
                                                </div>
                                              
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="id" id="id">
                                                <label class="btn btn-success btn-block" type="button" onclick="actualizar()">Actualizar</label>
                                            </div>
                                            </form>
                                        </div><!-- /.modal-content -->

                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->