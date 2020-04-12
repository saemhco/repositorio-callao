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
                                                       <input value=" " type="text" class="form-control" name="nombres" id="e-nombres" onkeypress="validar_dom('#e-nombres')">
                                                       <span class="bar"></span>
                                                       <label for="nombres">Nombres
                                                          <small id="e-nombres_error" style="color: red; display: none"> *este campo es obligatorio</small>
                                                       </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <input value=" " type="text" class="form-control" name="apellidos" id="e-apellidos" onkeypress="validar_dom('#e-apellidos')">
                                                       <span class="bar"></span>
                                                       <label for="e-apellidos">Apellidos
                                                         <small id="e-apellidos_error" style="color: red; display: none"> *este campo es obligatorio</small>
                                                       </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <input value=" " type="text" class="form-control" name="email" id="e-email" onkeypress="validar_dom('#e-email');">
                                                       <span class="bar"></span>
                                                       <label for="e-email">E-mail
                                                          <small id="e-email_error" style="color: red; display: none"> *este campo es obligatorio</small>
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <input value=" " type="text" class="form-control" id="e-username" onkeypress=" validar_dom('#e-username');" disabled="none">
                                                       <span class="bar"></span>
                                                       <label for="e-username">Usuario
                                                          <small id="e-username_error" style="color: red; display: none"> *este campo es obligatorio</small>
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <input type="password" maxlength="8" class="form-control" name="password">
                                                       <span class="bar"></span>
                                                       <label for="e-password">Contraseña (opcional)
                                                        </label>
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