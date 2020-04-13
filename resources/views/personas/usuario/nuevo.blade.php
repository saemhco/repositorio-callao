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
                                                       <input type="text" class="form-control" name="nombres" id="nombres" onkeypress="validar_dom('#nombres')">
                                                       <span class="bar"></span>
                                                       <label for="nombres">Nombres
                                                          <small id="nombres_error" style="color: red; display: none"> *este campo es obligatorio</small>
                                                       </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <input type="text" class="form-control" name="apellidos" id="apellidos" onkeypress="validar_dom('#apellidos')">
                                                       <span class="bar"></span>
                                                       <label for="apellidos">Apellidos
                                                         <small id="apellidos_error" style="color: red; display: none"> *este campo es obligatorio</small>
                                                       </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <input type="email" class="form-control" name="email" id="email" onkeypress="validar_dom('#email');">
                                                       <span class="bar"></span>
                                                       <label for="email">E-mail
                                                          <small id="email_error" style="color: red; display: none"> *este campo es obligatorio</small>
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <input type="text" maxlength="15" class="form-control" maxlength="15" name="username" id="username" onkeypress=" validar_dom('#username');">
                                                       <span class="bar"></span>
                                                       <label for="username">Usuario
                                                          <small id="username_error" style="color: red; display: none"> *este campo es obligatorio</small>
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <input type="text" maxlength="15" class="form-control" name="password" id="password" onkeypress=" validar(event); validar_dom('#password');">
                                                       <span class="bar"></span>
                                                       <label for="password">Contraseña
                                                          <small id="password_error" style="color: red; display: none"> *este campo es obligatorio</small>
                                                        </label>
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