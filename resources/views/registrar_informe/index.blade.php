@extends('layouts.horizontal2')

@section('css')
<link href="{{asset('material-pro/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{asset('material-pro/assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css')}}" id="theme" rel="stylesheet">
<link href="{{asset('material-pro/assets/plugins/wizard/steps.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet"href="{{asset('material-pro/assets/plugins/html5-editor/bootstrap-wysihtml5.css')}}" />
<link href="{{asset('material-pro/assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('material-pro/assets/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('title','Registrar')
@section('routes')
<li class="breadcrumb-item active">Registrar</li>
@endsection
@section('content')
<div class="card">
   <pre>
   {{var_dump($attr)}}
   </pre>
   <div class="card-body">
      {{-- Modal start --}}
      <!-- Full width modal content -->
      <div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog"
      aria-labelledby="fullWidthModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-full-width">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="fullWidthModalLabel">Modal Heading</h4>
               <button type="button" class="close" data-dismiss="modal"
               aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
               {{-- wizard --}}
               <div class="card-body wizard-content">
                  <form action="#" class="tab-wizard vertical wizard-circle">
                     <!-- Step 1 -->
                     <h6>Generalidades</h6>
                     <section>
                        <div class="row">
                           <div class="col-md-6 floating-labels mt-4">
                              <div class="form-group col-md-12"> <!-- title -->
                                 <textarea class="form-control" rows="2" id="titulo"></textarea>
                                 <span class="bar"></span>
                                 <label for="titulo">Título </label>
                              </div><br>
                              <div class="row">
                                 <div class="form-group col-md-6"> <!-- faculty -->
                                    <select class="custom-select form-control" id="fac" name="asd">
                                    </select>
                                    <span class="bar"></span>
                                    <label for="fac">Seleccione Facultad </label>
                                 </div>
                                 <div class="form-group col-md-6"> <!-- type -->
                                    <select class="custom-select form-control" id="prog" name="a-program-type">
                                       <option value=""></option>
                                       @foreach($attr['tipo_programa'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="prog">Nivel académico </label>
                                 </div>
                              </div>
                              <div class="form-group col-md-12"> <!-- ¿? -->
                                 <select class="custom-select form-control" id="prog_d" name="location">
                                    <option value=""></option>
                                    <option value="Amsterdam">SEGUNDA ESPECIALIDAD PROFESIONAL</option>
                                    <option value="Berlin">MAESTRÍA</option>
                                    <option value="Frankfurt">DOCTORADO</option>
                                 </select>
                                 <span class="bar"></span>
                                 <label for="prog_d">Descripción del programa</label>
                              </div><br>
                              <div class="row">
                                 <div class="form-group col-md-6 col-sm-12"> <!-- date -->
                                    <input type="date" value="{{date('Y-m-d')}}" class="form-control" id="fecha">
                                    <span class="bar"></span>
                                    <label for="fecha">Fecha de sustentación</label>
                                 </div>
                                 <div class="form-group col-md-6 col-sm-12"> <!-- modality -->
                                    <select class="custom-select form-control" id="mod" name="a-research-modality">
                                       <option value=""></option>
                                       @foreach($attr['modalidad'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="mod">Seleccione Modalidad </label>
                                 </div>
                                 <div class="form-group col-md-6 col-sm-12"> <!-- line -->
                                    <select class="custom-select form-control" id="linea" name="a-research-line">
                                       <option value=""></option>
                                       @foreach($attr['linea_general'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                       @foreach($attr['linea_fisica'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                       @foreach($attr['linea_enfermeria'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="linea">Linea de investigación UNAC</label>
                                 </div>
                                 <div class="form-group col-md-6 col-sm-12"> <!-- priority -->
                                    <select class="custom-select form-control" id="prioridad" name="a-research-priority">
                                       <option value=""></option>
                                       @foreach($attr['prioridad'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="prioridad">Prioridad nacional de salud</label>
                                 </div>
                              </div>


                           </div>
                           <div class="col-md-6">
                              <div class="form-group col-md-12">
                                 <label for="fac">Objetivo General </label>
                                 <textarea class="form-control" id="textarea_editor1" placeholder="Escribir aquí ..."></textarea>
                              </div>
                              <div class="form-group col-md-12">
                                 <label for="fac">Objetivos Específicos</label>
                                 <textarea class="form-control" id="textarea_editor2" placeholder="Escribir aquí ..."></textarea>
                              </div>
                           </div>
                        </div>

                     </section>
                     <!-- Step 2 -->
                     <h6>Autores</h6>
                     <section>
                        <div class="row">
                           <a href="#" class="col-12">
                              <i class="fa fa-plus"></i> Ir al módulo USUARIOS
                           </a><br><br><br>
                           <div class="col-md-7">
                              <select class="select2 form-control"  style="width: 100%">
                                 <option>Autores</option>
                                 <option value="AK">Nombres y Apellidos 1</option>
                                 <option value="HI">Nombres y Apellidos 2</option>
                                 <option value="CA">Nombres y Apellidos 3</option>
                                 <option value="NV">Nombres y Apellidos 4</option>
                                 <option value="OR">Nombres y Apellidos 5</option>
                                 <option value="WA">Nombres y Apellidos 6</option>
                              </select>
                           </div>
                           <select class="form-control col-md-3">
                              <option>Responsabilidad</option>
                              <option value="AK">Autor</option>
                              <option value="HI">Coautor</option>
                              <option value="CA">Estudiante</option>
                           </select>
                           <div class="col-md-2">
                              <button class="btn btn-primary">Añadir</button>
                           </div>
                           <table id="myTable2" class="table table-bordered table-striped no-wrap col-sm-12">
                              <thead>
                                 <tr>
                                    <th>DNI</th>
                                    <th>Nombres y Apellidos</th>
                                    <th>Responsabilidad</th>
                                    <th>Acciones</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>901234</td>
                                    <td>Venacio Perez Bonilla</td>
                                    <td>Coautor</td>
                                    <td><a href="#">Editar</a></td>
                                 </tr>
                                 <tr>
                                    <td>567890</td>
                                    <td>Zaza Quiñones Culantres</td>
                                    <td>Estudiante</td>
                                    <td><a href="#">Editar</a> <a href="#">Eliminar</a></td>
                                 </tr>
                              </tbody>
                           </table><br><br><br><br><br>

                           <div class="col-md-7">
                              <select class="select2 form-control"  style="width: 100%">
                                 <option>Jurados</option>
                                 <option value="AK">Nombres y Apellidos 1</option>
                                 <option value="HI">Nombres y Apellidos 2</option>
                                 <option value="CA">Nombres y Apellidos 3</option>
                                 <option value="NV">Nombres y Apellidos 4</option>
                                 <option value="OR">Nombres y Apellidos 5</option>
                                 <option value="WA">Nombres y Apellidos 6</option>
                              </select>
                           </div>
                           <div class="col-md-3">
                              <select class="select2 form-control" style="width: 100%">
                                 <option>Responsabilidad</option>
                                 <option value="AK">Presidente</option>
                                 <option value="HI">Secretario</option>
                                 <option value="CA">Vocal</option>
                              </select>
                           </div>
                           <div class="col-md-2">
                              <button class="btn btn-primary">Añadir</button>
                           </div>
                           <table id="myTable2" class="table table-bordered table-striped no-wrap col-sm-12">
                              <thead>
                                 <tr>
                                    <th>DNI</th>
                                    <th>Nombres y Apellidos</th>
                                    <th>Responsabilidad</th>
                                    <th>Acciones</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>901234</td>
                                    <td>Venacio Perez Bonilla</td>
                                    <td>Presidente</td>
                                    <td><a href="#">Editar</a></td>
                                 </tr>
                                 <tr>
                                    <td>567890</td>
                                    <td>Zaza Quiñones Culantres</td>
                                    <td>Vocal</td>
                                    <td><a href="#">Editar</a> <a href="#">Eliminar</a></td>
                                 </tr>
                              </tbody>
                           </table><br><br><br><br><br>
                           <div class="col-md-8">
                              <select class="select2 form-control"  style="width: 100%">
                                 <option>Asesor</option>
                                 <option value="AK">Nombres y Apellidos 1</option>
                                 <option value="HI">Nombres y Apellidos 2</option>
                                 <option value="CA">Nombres y Apellidos 3</option>
                                 <option value="NV">Nombres y Apellidos 4</option>
                                 <option value="OR">Nombres y Apellidos 5</option>
                                 <option value="WA">Nombres y Apellidos 6</option>
                              </select>
                           </div>
                           <div class="col-md-4">
                              <button class="btn btn-primary">Añadir</button>
                           </div>
                           <table id="myTable2" class="table table-bordered table-striped no-wrap col-sm-12">
                              <thead>
                                 <tr>
                                    <th>DNI</th>
                                    <th>Nombres y Apellidos</th>
                                    <th>Acciones</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>901234</td>
                                    <td>Venacio Perez Bonilla</td>
                                    <td><a href="#">Editar</a></td>
                                 </tr>
                              </tbody>

                           </table><br><br><br><br><br>
                        </div>
                     </section>
                     <!-- Step 3 -->
                     <h6>Financiamiento y población</h6>
                     <section>
                        <div class="row">
                           <div class="col-md-6 floating-labels mt-4">
                              <div class="row">
                                 <div class="form-group col-md-12">
                                    <select class="custom-select form-control" id="departamento" name="location">
                                       <option value=""></option>
                                       <option value="Amsterdam">Departamento 1</option>
                                       <option value="Berlin">Departamento 2</option>
                                       <option value="Frankfurt">Departamento 3</option>
                                       <option value="Frankfurt">Departamento 4</option>
                                       <option value="Frankfurt">Departamento 5</option>
                                    </select>
                                    <span class="bar"></span>
                                    <label for="departamento">Departamento </label>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <select class="custom-select form-control" id="Provincia" name="location">
                                       <option value=""></option>
                                       <option value="Amsterdam">Provincia 1</option>
                                       <option value="Berlin">Provincia 2</option>
                                       <option value="Frankfurt">Provincia 3</option>
                                       <option value="Frankfurt">Provincia 4</option>
                                       <option value="Frankfurt">Provincia 5</option>
                                    </select>
                                    <span class="bar"></span>
                                    <label for="Provincia">Provincia </label>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <select class="custom-select form-control" id="Distrito" name="location">
                                       <option value=""></option>
                                       <option value="Amsterdam">Distrito 1</option>
                                       <option value="Berlin">Distrito 2</option>
                                       <option value="Frankfurt">Distrito 3</option>
                                       <option value="Frankfurt">Distrito 4</option>
                                       <option value="Frankfurt">Distrito 5</option>
                                    </select>
                                    <span class="bar"></span>
                                    <label for="Distrito">Distrito </label>
                                 </div>
                                 <div class="form-group col-md-6"> <!-- population -->
                                    <select class="custom-select form-control" id="fac" name="a-research-population">
                                       <option value=""></option>
                                       @foreach($attr['poblacion'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="fac">Población </label>
                                 </div>
                                 <div class="form-group col-md-6"> <!-- sample -->
                                    <select class="custom-select form-control" id="prog" name="a-research-sample">
                                       <option value=""></option>
                                       @foreach($attr['muestra'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="prog">Muestra </label>
                                 </div>
                              </div><br>
                           </div>
                           <div class="col-md-6 floating-labels mt-4">
                              <div class="form-group col-md-12">
                                 <input type="text" class="form-control" rows="2" id="titulo"></input>
                                 <span class="bar"></span>
                                 <label for="titulo">Presupuesto </label>
                              </div>
                              <div class="row">
                                 <div class="form-group col-md-12"> <!-- fund budget -->
                                    <select class="custom-select form-control" id="fac" name="location">
                                       <option value=""></option>
                                       @foreach($attr['fuente_financiamiento'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="fac">Fuente de financiamiento </label>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <input type="text" class="form-control" rows="2" id="otra_fuente"></input>
                                    <span class="bar"></span>
                                    <label for="otra_fuente">Otra fuente de financiamiento </label>
                                 </div>
                                 <div class="form-group col-md-6"> <!-- product -->
                                    <select class="custom-select form-control" id="prod" name="product">
                                       <option value=""></option>
                                       @foreach($attr['producto'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="prod">Producto</label>
                                 </div>
                                 <div class="form-group col-md-6"> <!-- other product -->
                                    <input type="text" id="otro" class="form-control">
                                    <span class="bar"></span>
                                    <label for="otro">Otro producto</label>
                                 </div>
                              </div><br>
                           </div>
                        </div>
                     </section>
                     <!-- Step 4 -->
                     <h6>Otros</h6>
                     <section>
                        <div class="row">
                           <div class="col-md-12 floating-labels mt-4">
                              <div class="row">
                                 <div class="form-group col-md-4"> <!-- nature -->
                                    <select class="custom-select form-control" id="naturaleza" name="c-nature">
                                       <option value=""></option>
                                       @foreach($attr['naturaleza'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="naturaleza">Naturaleza </label>
                                 </div>
                                 <div class="form-group col-md-4"> <!-- approach -->
                                    <select class="custom-select form-control" id="enfoque" name="c-approach">
                                       <option value=""></option>
                                       @foreach($attr['enfoque'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="enfoque">Enfoque</label>
                                 </div>
                                 <div class="form-group col-md-4"> <!-- cut -->
                                    <select class="custom-select form-control" id="corte" name="c-cut">
                                       <option value=""></option>
                                       @foreach($attr['corte'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="corte">Corte</label>
                                 </div>
                                 <div class="form-group col-md-6"> <!-- design -->
                                    <select class="custom-select form-control" id="diseño" name="c-design">
                                       <option value=""></option>
                                       @foreach($attr['diseno'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="diseño">Diseño</label>
                                 </div>
                                 <div class="form-group col-md-6"> <!-- level -->
                                    <select class="custom-select form-control" id="diseño" name="">
                                       <option value=""></option>
                                       @foreach($attr['nivel'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="diseño">Nivel</label>
                                 </div>
                                 <div class="form-group col-md-6"> <!-- area -->
                                    <select class="custom-select form-control" id="area" name="c-area">
                                       <option value=""></option>
                                       @foreach($attr['area_estudio'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                                    </select>
                                    <span class="bar"></span>
                                    <label for="area">Área de estudio</label>
                                 </div>
                                 <div class="form-group col-md-6"> <!-- other area -->
                                    <input type="text" id="area_otros" class="form-control" name="">
                                    <span class="bar"></span>
                                    <label for="area_otro">Otra área de estudio</label>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12 floating-labels mt-12">
                              <h3>Unidad de análisis</h3>
                              <div class="row">
                                 <div class="form-group col-md-12 demo-checkbox">
                                    @foreach($attr['unidad_analisis'] as $k=>$v)
                                    <input name="c-analysis_unity-{{$k}}" id="c-au-{{$k}}" type="checkbox" class="filled-in chk-col-light-blue" value="{{$v->id}}">
                                    <label for="c-au-{{$k}}" class="checkbox col-md-3" style="vertical-align: middle; text-align: left;">{{$v->descripcion}}</label>
                                    @endforeach
                                 </div>
                              </div><br>
                           </div>

                        </div>
                     </section>
                  </form>
               </div>
               {{-- wizard FIN--}}
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light"
               data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary">Save changes</button>
            </div>
         </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
   {{-- Modal End --}}
   <h4 class="card-title"><button class="btn btn-success btn-md" data-toggle="modal" data-target="#full-width-modal">
      <i class="fa fa-plus"></i> Nuevo</button></h4>
      <h6 class="card-subtitle">Registrar nuevo documento</h6>
      <div class="table-responsive mt-4">
         <table id="myTable" class="table table-bordered table-striped no-wrap">
            <thead>
               <tr>
                  <th>Título</th>
                  <th>Fecha Reg.</th>
                  <th>Programa</th>
                  <th>Facultad</th>
                  <th>Escuela</th>
                  <th>Acciones</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
               </tr>
               <tr>
                  <td>Garrett Winters</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>63</td>
                  <td>2011/07/25</td>
                  <td>$170,750</td>
               </tr>
               <tr>
                  <td>Thor Walton</td>
                  <td>Developer</td>
                  <td>New York</td>
                  <td>61</td>
                  <td>2013/08/11</td>
                  <td>$98,540</td>
               </tr>
               <tr>
                  <td>Finn Camacho</td>
                  <td>Support Engineer</td>
                  <td>San Francisco</td>
                  <td>47</td>
                  <td>2009/07/07</td>
                  <td>$87,500</td>
               </tr>
               <tr>
                  <td>Serge Baldwin</td>
                  <td>Data Coordinator</td>
                  <td>Singapore</td>
                  <td>64</td>
                  <td>2012/04/09</td>
                  <td>$138,575</td>
               </tr>
               <tr>
                  <td>Zenaida Frank</td>
                  <td>Software Engineer</td>
                  <td>New York</td>
                  <td>63</td>
                  <td>2010/01/04</td>
                  <td>$125,250</td>
               </tr>
               <tr>
                  <td>Zorita Serrano</td>
                  <td>Software Engineer</td>
                  <td>San Francisco</td>
                  <td>56</td>
                  <td>2012/06/01</td>
                  <td>$115,000</td>
               </tr>
               <tr>
                  <td>Jennifer Acosta</td>
                  <td>Junior Javascript Developer</td>
                  <td>Edinburgh</td>
                  <td>43</td>
                  <td>2013/02/01</td>
                  <td>$75,650</td>
               </tr>
               <tr>
                  <td>Cara Stevens</td>
                  <td>Sales Assistant</td>
                  <td>New York</td>
                  <td>46</td>
                  <td>2011/12/06</td>
                  <td>$145,600</td>
               </tr>
            </tbody>
            <tfoot>
               <tr>
                  <th>Título</th>
                  <th>Fecha Reg.</th>
                  <th>Programa</th>
                  <th>Facultad</th>
                  <th>Escuela</th>
                  <th>Acciones</th>
               </tr>
            </tfoot>
         </table>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-body">
      <h4 class="card-title">Data Table</h4>
      <h6 class="card-subtitle">Data table example</h6>
      <div class="table-responsive mt-4"><label>s34</label>
      </div>
   </div>
</div>
@endsection
@section('js')
<!-- This is data table -->
<script src="{{ asset('material-pro/assets/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('material-pro/assets/plugins/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->
{{-- Wizard --}}
<script src="{{asset('material-pro/assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('material-pro/assets/plugins/wizard/jquery.steps.min.js')}}"></script>
<script src="{{asset('material-pro/assets/plugins/wizard/jquery.validate.min.js')}}"></script>
<!-- wysuhtml5 Plugin JavaScript -->
<script src="{{asset('material-pro/assets/plugins/html5-editor/wysihtml5-0.3.0.js')}}"></script>
<script src="{{asset('material-pro/assets/plugins/html5-editor/bootstrap-wysihtml5.js')}}"></script>
{{-- Select2 --}}
<script src="{{asset('material-pro/assets/plugins/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('material-pro/assets/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
{{-- SweetAlert --}}
<script src="{{asset('material-pro/assets/plugins/sweetalert/sweetalert.min.js')}}"></script>

<script>
   $(document).ready(function() {
      $('#textarea_editor1').wysihtml5();
      $('#textarea_editor2').wysihtml5();
      // For select 2
      $(".select2").select2();

   });
</script>
<script>
   $(function () {
      var table = $('#myTable').DataTable({
         'language' : {'url':'/js/latino.json'},
         'order': [[ 1, "desc" ]]
      });
   });
</script>
<script>
   //Custom design form example
   $(".tab-wizard").steps({
      headerTag: "h6",
      bodyTag: "section",
      transitionEffect: "fade",
      titleTemplate: '<span class="step">#index#</span> #title#',
      labels: {
         finish: "Submit"
      },
      onFinished: function (event, currentIndex) {
         swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");

      }
   });

   var form = $(".validation-wizard").show();
   $(".validation-wizard").steps({
      headerTag: "h6",
      bodyTag: "section",
      transitionEffect: "fade",
      titleTemplate: '<span class="step">#index#</span> #title#',
      labels: {
         finish: "Submit"
      },
      onStepChanging: function (event, currentIndex, newIndex) {
         return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
      },
      onFinishing: function (event, currentIndex) {
         return form.validate().settings.ignore = ":disabled", form.valid()
      },
      onFinished: function (event, currentIndex) {
         swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
      }
   }), $(".validation-wizard").validate({
      ignore: "input[type=hidden]",
      errorClass: "text-danger",
      successClass: "text-success",
      highlight: function (element, errorClass) {
         $(element).removeClass(errorClass)
      },
      unhighlight: function (element, errorClass) {
         $(element).removeClass(errorClass)
      },
      errorPlacement: function (error, element) {
         error.insertAfter(element)
      },
      rules: {
         email: {
            email: !0
         }
      }
   })
</script>
@endsection
