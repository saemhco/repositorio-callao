<!-- Full width modal content -->
      <div id="modal_nuevo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-full-width">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="fullWidthModalLabel">Nuevo registro</h4>
               <button type="button" class="close" data-dismiss="modal"
               aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
             {{-- wizard --}}
               <div class="card-body wizard-content">
                  <form action="#" class="tab-wizard wizard-circle" id="form_nuevo">
                     <!-- Step 1 -->
                     <h6>Generalidades</h6>
                     <section>
                        <div class="row floating-labels mt-4">
                              <div class="form-group col-md-12">
                                 <input type="text" class="form-control required" name="titulo" id="titulo">
                                 <span class="bar"></span>
                                 <label for="titulo">Título </label>
                              </div><br>
                              <div class="form-group col-md-3"> <!-- facultad -->
                                {!!Form::select('facultad',$facultades,1,['id'=>'fac','class'=>'form-control set_programa'])!!}
                                <span class="bar"></span>
                                <label for="fac">Seleccione Facultad</label>
                              </div>
                              <div class="form-group col-md-3"> <!-- nivel académico -->
                                {!!Form::select('nivel_acad',$attr['tipo_programa']->pluck('descripcion','id'),1,['id'=>'nivel_acad','class'=>'form-control set_programa'])!!}
                                <span class="bar"></span>
                                <label for="nivel_acad">Nivel académico </label>
                              </div>
                              <div class="form-group col-md-6"> <!-- programa -->
                                 {!!Form::select('programa',$ep,12,['id'=>'programa_academico','class'=>'form-control required'])!!}
                                 <span class="bar"></span>
                                 <label for="programa_academico">Programa</label>
                              </div><br>     
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6"><br>
                             <label for="textarea_editor1"> Resumen </label><br>
                             <textarea class="form-control" id="textarea_editor1" placeholder="Escribir aquí ..." name="resumen"></textarea>
                          </div>
                          <div class="form-group col-md-6"><br>
                             <label for="fac">Objetivos (General y Especìficos)</label><br>
                             <textarea class="form-control" id="textarea_editor2" placeholder="Escribir aquí ..." name="objetivos"></textarea>
                          </div>
                        </div>
                        <div class="row">
                            {{-- <div class="col-12" align="right">
                              <button class="btn btn-light">Anterior</button>
                              <button href="#next" class="btn btn-primary" onclick="save_form_step('1')">Siguiente</button>
                            </div> --}}
                          
                        </div>
                    </section>
                     
                     <!-- Step 2 -->
                     <h6>Detalles</h6>
                     <section>
                        <div class="row">
                           <div class="col-md-6 mt-4">
                              <div class="row">
                                 <div class="form-group col-md-4 col-sm-12">
                                    <label for="cronograma_inicio">Cronograma - Inicio</label>
                                    <input type="date" class="form-control required" id="cronograma_inicio" name="cronograma_inicio">
                                 </div>
                                 <div class="form-group col-md-4 col-sm-12">
                                    <label for="cronograma_fin">Cronograma - Fin</label>
                                    <input type="date" class="form-control required" id="cronograma_fin" name="cronograma_fin">
                                 </div>
                                 <div class="form-group col-md-4 col-sm-12"> <!-- date -->
                                    <label for="fecha">Fecha de sustentación</label><br>
                                    <input type="date" class="form-control required" id="fecha" name="fecha">
                                 </div>
                               </div>
                               <div class="floating-labels row">
                                 <div class="form-group col-md-6 col-sm-12"> <!-- modality -->
                                    <select class="form-control required" id="modalidad" name="modalidad">
                                       <option value=""></option>
                                       @foreach($attr['modalidad'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="modalidad">Modalidad </label>
                                 </div>
                                 <div class="form-group col-md-6 col-sm-12"> <!-- line -->
                                    <select class="form-control required" id="linea" name="linea_general">
                                       <option value=""></option>
                                       @foreach($attr['linea_general'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="linea">Linea de investigación UNAC</label>
                                 </div>
                                 <div class="form-group col-md-6 col-sm-12"> <!-- priority -->
                                    <select class="form-control required" id="prioridad" name="prioridad">
                                       <option value=""></option>
                                       @foreach($attr['prioridad'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="prioridad">Prioridad nacional de salud</label>
                                 </div>

                                 <div class="form-group col-md-6">
                                    {!!Form::select('area_estudio',$attr['area_estudio']->pluck('descripcion','id'),1,['id'=>'area_estudio','class'=>'form-control mostrar_ocultar_otros required', 'placeholder'=>'','data-div'=>'#otro_area_estudio'])!!}
                                    <span class="bar"></span>
                                    <label for="area_estudio">Área de estudio</label>
                                 </div>
                                 <div class="form-group col-md-12" id="otro_area_estudio" style="display:none">
                                    <input type="text" id="area_otros" class="form-control" name="area_otros">
                                    <span class="bar"></span>
                                    <label for="area_otro">Mencione</label>
                                 </div>
                                 <div class="form-group col-md-4"> <!-- nature -->
                                    <select class="form-control required" id="naturaleza" name="naturaleza">
                                       <option value=""></option>
                                       @foreach($attr['naturaleza'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="naturaleza">Naturaleza </label>
                                 </div>
                                 <div class="form-group col-md-4"> <!-- approach -->
                                    <select class="form-control required" id="enfoque" name="enfoque">
                                       <option value=""></option>
                                       @foreach($attr['enfoque'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="enfoque">Enfoque</label>
                                 </div>
                                 <div class="form-group col-md-4"> <!-- cut -->
                                    <select class="form-control required" id="corte" name="corte">
                                       <option value=""></option>
                                       @foreach($attr['corte'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="corte">Corte</label>
                                 </div>

                                 <div class="form-group col-md-4"> <!-- design -->
                                    <select class="form-control required" id="temporalidad" name="temporalidad">
                                       <option value=""></option>
                                       @foreach($attr['temporalidad'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="temporalidad">Temporalidad</label>
                                 </div>
                                 <div class="form-group col-md-4"> <!-- design -->
                                    <select class="form-control required" id="diseño" name="disenio">
                                       <option value=""></option>
                                       @foreach($attr['diseno'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="diseño">Diseño</label>
                                 </div>
                                 <div class="form-group col-md-4"> <!-- level -->
                                    <select class="custom-select form-control required" id="nivel" name="nivel">
                                       <option value=""></option>
                                       @foreach($attr['nivel'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="nivel">Nivel</label>
                                 </div>
                              </div><br>
                           </div>
                           <div class="col-md-6 floating-labels mt-4">
                              <div class="row">
                                 <div class="form-group col-md-12">
                                    <label>Lugar de estudio</label><br><br>
                                    {!!Form::select('ubigeo',$ubigeo,1,['id'=>'ubigeo','class'=>'form-control select2 required', 'placeholder'=>'Distrio - Provincia - Departamento','style'=>'width: 100%'])!!}
                                  </div> 
                                
                                 <div class="form-group col-md-6"> <!-- population -->
                                    <select class="form-control required" id="poblacion" name="poblacion">
                                       <option value=""></option>
                                       @foreach($attr['poblacion'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="poblacion">Población </label>
                                 </div>
                                 <div class="form-group col-md-6">
                                    <select class="form-control required" id="muestra" name="muestra">
                                       <option value=""></option>
                                       @foreach($attr['muestra'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="muestra">Muestra </label>
                                 </div>
                                 <div class="form-group col-md-6">
                                    <input type="number" min="0" class="form-control required" id="presupuesto" name="presupuesto" min="-1">
                                    </input>
                                    <span class="bar"></span>
                                    <label for="presupuesto">Presupuesto</label>
                                 </div>
                                 <div class="form-group col-md-6">
                                    {!!Form::select('fuente_financiamiento',$attr['fuente_financiamiento']->pluck('descripcion','id'),1,['id'=>'fuente_financiamiento','class'=>'form-control mostrar_ocultar_otros required', 'placeholder'=>'','data-div'=>'#otra_fuente'])!!}
                                    <span class="bar"></span>
                                    <label for="fuente_financiamiento">Fuente de financiamiento </label>
                                 </div>
                                 <div class="form-group col-md-12" id="otra_fuente" style="display: none;">
                                    <input type="text" class="form-control" rows="2" name="otra_fuente"></input>
                                    <span class="bar"></span>
                                    <label for="otra_fuente">Mencione Otra fuente de financiamiento </label>
                                 </div>
                                 <div class="form-group col-md-6"> 
                                    {!!Form::select('producto',$attr['producto']->pluck('descripcion','id'),1,['id'=>'producto','class'=>'form-control mostrar_ocultar_otros required', 'placeholder'=>'','data-div'=>'#otro_producto'])!!}
                                    <span class="bar"></span>
                                    <label for="producto">Producto</label>
                                 </div>
                                 <div class="form-group col-md-6" id="otro_producto" style="display: none;">
                                    <input type="text" class="form-control" name="otro_producto">
                                    <span class="bar"></span>
                                    <label for="otro_producto">Mencione otro producto</label>
                                 </div>
                              </div><br>
                           </div>
                        </div>
                     </section>
                     <!-- Step 3 -->
                     <h6>Unidad de análisis</h6>
                     <section>
                        <div class="row">
                           <div class="col-md-12 floating-labels mt-12">
                              <div class="row">
                                 <div class="form-group col-md-12">
                                    <input type="text" class="form-control" name="url" id="url">
                                    <span class="bar"></span>
                                    <label for="url">URL</label>
                                 </div>
                                 <h3>Unidad de análisis</h3>
                                 <div class="form-group col-md-12 demo-checkbox" align="center">
                                    @foreach($attr['unidad_analisis'] as $k=>$v)
                                    <input name="unidad_analisis[]" id="c-ua-{{$k}}" type="checkbox" class="filled-in chk-col-light-blue mostrar_ocultar_otros_cb" value="{{$v->id}}">
                                    <label for="c-ua-{{$k}}" class="checkbox col-md-3" style="vertical-align: middle; text-align: left;">{{$v->descripcion}}</label>
                                    @endforeach
                                 </div>
                                 <div class="form-group col-md-12" id="otro_unidad" style="display: none;">
                                    <input type="text" class="form-control" name="otro_unidad">
                                    <span class="bar"></span>
                                    <label for="otro_unidad">Mencione otros</label>
                                 </div>
                              </div><br>
                           </div>
                        </div>
                     </section>
                  </form>
               </div>
               {{-- wizard FIN--}}
              
            </div>
            {{-- <div class="modal-footer">
               <button type="button" class="btn btn-light"
               data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
         </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
   {{-- Modal End --}}

               