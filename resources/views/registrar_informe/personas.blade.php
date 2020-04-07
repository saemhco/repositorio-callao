<!--  Modal content for the above example -->
                                <div class="modal fade" id="personas" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Personas </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href="#" class=" btn btn-success btn-xs">
                                                            <i class="fa fa-plus"></i> Ir al módulo PERSONAS
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6" align="right">
                                                        <button class=" btn btn-success btn-xs" id="btn_refrescar">
                                                            <i class="fa fa-sync-alt"></i> Refrescar
                                                        </button>  
                                                    </div>
                                                   <div class="col-12"><br></div>
                                                   <div class="col-md-6">
                                                        <select name="persona" id="persona" class="form-control" style="width: 100%">
                                                            <option val=''>DNI Nombres y Apellidos</option>
                                                        </select>
                                                   </div>
                                                   {!!Form::select('condicion_persona',
                                                      [
                                                          'Autores'  => $attr['condicion_autor']->pluck('descripcion','id'),
                                                          'Asesor' => $attr['asesor']->pluck('descripcion','id')
                                                      ]
                                                      ,null,['id'=>'condicion_persona','class'=>'form-control col-md-4'])!!}
                                                   <div class="col-md-2">
                                                      <button class="btn btn-primary" id="btn_guardar">Añadir</button>
                                                   </div>
                                                </div><br>
                                                   <table id="tabla_personas" class="table color-bordered-table info-bordered-table">
                                                      <thead>
                                                         <tr>
                                                            <th>DNI</th>
                                                            <th>Nombres y Apellidos</th>
                                                            <th>Responsabilidad</th>
                                                            <th>Eliminar</th>
                                                         </tr>
                                                      </thead>
                                                      <tbody></tbody>
                                                   </table>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->