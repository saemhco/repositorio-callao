<!-- Full width modal content -->
      <div id="modal_editar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-full-width">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="fullWidthModalLabel">Editar registro</h4>
               <button type="button" class="close" data-dismiss="modal"
               aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
             {{-- wizard --}}
               <div class="card-body wizard-content">
                  <form action="#" class="tab-wizard wizard-circle" id="form_editar">
                     <!-- Step 1 -->
                     <h6>Generalidades</h6>
                     <section>
                        <div class="row floating-labels mt-4">
                              <div class="form-group col-md-12">
                                 <input type="text" class="form-control" name="titulo" id="e-titulo" value=" ">
                                 <span class="bar"></span>
                                 <label for="e-titulo">Título </label>
                              </div><br>
                              <div class="form-group col-md-3"> <!-- facultad -->
                                {!!Form::select('facultad',$facultades,1,['id'=>'e-fac','class'=>'form-control set_programa'])!!}
                                <span class="bar"></span>
                                <label for="e-fac">Seleccione Facultad</label>
                              </div>
                              <div class="form-group col-md-3"> <!-- nivel académico -->
                                {!!Form::select('nivel_acad',$attr['tipo_programa']->pluck('descripcion','id'),1,['id'=>'e-nivel_acad','class'=>'form-control set_programa'])!!}
                                <span class="bar"></span>
                                <label for="e-nivel_acad">Nivel académico </label>
                              </div>
                              <div class="form-group col-md-6"> <!-- programa -->
                                 {!!Form::select('programa',$ep,12,['id'=>'e-programa_academico','class'=>'form-control required'])!!}
                                 <span class="bar"></span>
                                 <label for="e-programa_academico">Programa</label>
                              </div><br>     
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6"><br>
                             <label for="textarea_editor1"> Resumen </label><br>
                             <textarea class="form-control" id="e-textarea_editor1" placeholder="Escribir aquí ..." name="resumen"></textarea>
                          </div>
                          <div class="form-group col-md-6"><br>
                             <label for="fac">Objetivo General</label><br>
                             <textarea class="form-control" id="e-textarea_editor2" placeholder="Escribir aquí ..." name="objetivos"></textarea>
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
                                    <input type="date" class="form-control" id="e-cronograma_inicio" name="cronograma_inicio">
                                 </div>
                                 <div class="form-group col-md-4 col-sm-12">
                                    <label for="cronograma_fin">Cronograma - Fin</label>
                                    <input type="date" class="form-control" id="e-cronograma_fin" name="cronograma_fin">
                                 </div>
                                 <div class="form-group col-md-4 col-sm-12"> <!-- date -->
                                    <label for="fecha">Fecha de sustentación</label><br>
                                    <input type="date" class="form-control required" id="e-fecha" name="fecha">
                                 </div>
                               </div>
                               <div class="floating-labels row">
                                 <div class="form-group col-md-6 col-sm-12"> <!-- modality -->
                                    {!!Form::select('modalidad',$attr['modalidad']->pluck('descripcion','id'),5,['id'=>'e-modalidad','class'=>'form-control required'])!!}
                                    </select>
                                    <span class="bar"></span>
                                    <label for="e-modalidad">Modalidad </label>
                                 </div>
                                 <div class="form-group col-md-6 col-sm-12">
                                 	{!!Form::select('linea_general',$attr['linea_general']->pluck('descripcion','id'),101,['id'=>'e-linea','class'=>'form-control required'])!!}
                                    <span class="bar"></span>
                                    <label for="e-linea">Linea de investigación UNAC</label>
                                 </div>
                                 <div class="form-group col-md-6 col-sm-12">
                                 	{!!Form::select('prioridad',$attr['prioridad']->pluck('descripcion','id'),43,['id'=>'e-prioridad','class'=>'form-control required'])!!}
                                    <span class="bar"></span>
                                    <label for="e-prioridad">Prioridad nacional de salud</label>
                                 </div>
                                 <div class="form-group col-md-6">
                                    {!!Form::select('area_estudio',$attr['area_estudio']->pluck('descripcion','id'),1,['id'=>'e-area_estudio','class'=>'form-control mostrar_ocultar_otros required','data-div'=>'#e-otro_area_estudio'])!!}
                                    <span class="bar"></span>
                                    <label for="e-area_estudio">Área de estudio</label>
                                 </div>
                                 <div class="form-group col-md-12" id="e-otro_area_estudio" style="display:none">
                                    <input type="text" id="e-area_otros" class="form-control" name="area_otros" value=" ">
                                    <span class="bar"></span>
                                    <label for="otro_area_estudio">Mencione</label>
                                 </div>
                                 <div class="form-group col-md-4"> <!-- nature -->
                                    <select class="form-control required" id="e-naturaleza" name="naturaleza">
                                       @foreach($attr['naturaleza'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="e-naturaleza">Naturaleza </label>
                                 </div>
                                 <div class="form-group col-md-4"> <!-- approach -->
                                    <select class="form-control required" id="e-enfoque" name="enfoque">
                                       @foreach($attr['enfoque'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="e-enfoque">Enfoque</label>
                                 </div>
                                 <div class="form-group col-md-4"> <!-- cut -->
                                    <select class="form-control required" id="e-corte" name="corte">
                                       @foreach($attr['corte'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="e-corte">Corte</label>
                                 </div>
                                 <div class="form-group col-md-4"> <!-- design -->
                                    <select class="form-control required" id="e-temporalidad" name="temporalidad">
                                       @foreach($attr['temporalidad'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="e-temporalidad">Temporalidad</label>
                                 </div>
                                 <div class="form-group col-md-4"> <!-- design -->
                                    <select class="form-control required" id="e-diseño" name="disenio">
                                       @foreach($attr['diseno'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="e-diseño">Diseño</label>
                                 </div>
                                 <div class="form-group col-md-4"> <!-- level -->
                                    <select class="custom-select form-control required" id="e-nivel" name="nivel">
                                       @foreach($attr['nivel'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="e-nivel">Nivel</label>
                                 </div>
                              </div><br>
                           </div>
                           <div class="col-md-6 floating-labels mt-4">
                              <div class="row">
                                 <div class="form-group col-md-12">
                                    <label>Lugar de estudio</label><br><br>
                                    {!!Form::select('ubigeo',$ubigeo,1,['id'=>'e-ubigeo','class'=>'form-control select2 required', 'placeholder'=>'Distrio - Provincia - Departamento','style'=>'width: 100%'])!!}
                                  </div> 
                                 <div class="form-group col-md-6"> <!-- population -->
                                    <select class="form-control required" id="e-poblacion" name="poblacion">
                                       @foreach($attr['poblacion'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="e-poblacion">Población </label>
                                 </div>
                                 <div class="form-group col-md-6">
                                    <select class="form-control required" id="e-muestra" name="muestra">
                                       @foreach($attr['muestra'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="e-muestra">Muestra </label>
                                 </div>
                                 <div class="form-group col-md-6">
                                    <input type="number" value="0" min="0" class="form-control required" id="e-presupuesto" name="presupuesto" min="-1">
                                    </input>
                                    <span class="bar"></span>
                                    <label for="e-presupuesto">Presupuesto</label>
                                 </div>
                                 <div class="form-group col-md-6">
                                    {!!Form::select('fuente_financiamiento',$attr['fuente_financiamiento']->pluck('descripcion','id'),1,['id'=>'e-fuente_financiamiento','class'=>'form-control mostrar_ocultar_otros required','data-div'=>'#e-otra_fuente'])!!}
                                    <span class="bar"></span>
                                    <label for="e-fuente_financiamiento">Fuente de financiamiento </label>
                                 </div>
                                 <div class="form-group col-md-12" id="e-otra_fuente" style="display: none;">
                                    <input type="text" class="form-control" rows="2" name="otra_fuente" id="e-fuente_otro" value="  "></input>
                                    <span class="bar"></span>
                                    <label for="e-otra_fuente">Mencione Otra fuente de financiamiento </label>
                                 </div>
                                 <div class="form-group col-md-6"> 
                                    {!!Form::select('producto',$attr['producto']->pluck('descripcion','id'),1,['id'=>'e-producto','class'=>'form-control mostrar_ocultar_otros required','data-div'=>'#e-otro_producto'])!!}
                                    <span class="bar"></span>
                                    <label for="e-producto">Producto</label>
                                 </div>
                                 <div class="form-group col-md-6" id="e-otro_producto" style="display: none;">
                                    <input type="text" class="form-control" name="otro_producto" id="e-producto_otro" value=" ">
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
                                    <input type="text" class="form-control" name="url" id="e-url" value=" ">
                                    <span class="bar"></span>
                                    <label for="e-url">URL</label>
                                 </div>
                                 <h3>Unidad de análisis</h3>
                                 <div class="form-group col-md-12 demo-checkbox" align="center">
                                    @foreach($attr['unidad_analisis'] as $k=>$v)
                                    <input name="unidad_analisis[]" id="e-c-ua-{{$v->id}}" type="checkbox" class="filled-in chk-col-light-blue mostrar_ocultar_otros_cb" value="{{$v->id}}">
                                    <label for="e-c-ua-{{$v->id}}" class="checkbox col-md-3" style="vertical-align: middle; text-align: left;">{{$v->descripcion}}</label>
                                    @endforeach
                                 </div>
                                 <div class="form-group col-md-12" id="e-otro_unidad" style="display: none;">
                                    <input type="text" class="form-control" name="otro_unidad" id="e-unidad_otro" value=" ">
                                    <span class="bar"></span>
                                    <label for="otro_unidad">Mencione otros</label>
                                 </div>
                              </div><br>
                           </div>
                        </div>
                     </section>
                     <input type="hidden" name="id" id="e-id">
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

               