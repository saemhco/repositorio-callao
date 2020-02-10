@extends('layouts.horizontal')
@section('search')
<ul class="mega-dropdown-menu row">
        <li class="col-lg-3 col-xlg-2 mb-4">
            <h4 class="mb-3">CAROUSEL</h4>
            <!-- CAROUSEL -->
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <div class="container"> <img class="d-block img-fluid"
                            src="{{asset('material-pro/assets/images/big/img1.jpg')}}" alt="First slide"></div>
                    </div>
                    <div class="carousel-item">
                        <div class="container"><img class="d-block img-fluid"
                            src="{{asset('material-pro/assets/images/big/img2.jpg')}}" alt="Second slide">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container"><img class="d-block img-fluid"
                            src="{{asset('material-pro/assets/images/big/img3.jpg')}}" alt="Third slide"></div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls"
                    role="button" data-slide="prev"> <span
                        class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span> </a>
                <a class="carousel-control-next" href="#carouselExampleControls"
                    role="button" data-slide="next"> <span
                        class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span> </a>
            </div>
            <!-- End CAROUSEL -->
        </li>
        <li class="col-lg-3 mb-4">
            <h4 class="mb-3">ACCORDION</h4>
            <!-- Accordian -->
            <div id="accordion" class="nav-accordion" role="tablist"
                aria-multiselectable="true">
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" data-parent="#accordion"
                                href="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                                Collapsible Group Item #1
                            </a>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" role="tabpanel"
                        aria-labelledby="headingOne">
                        <div class="card-body"> Anim pariatur cliche reprehenderit, enim
                            eiusmod high. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingTwo">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse"
                                data-parent="#accordion" href="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                                Collapsible Group Item #2
                            </a>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" role="tabpanel"
                        aria-labelledby="headingTwo">
                        <div class="card-body"> Anim pariatur cliche reprehenderit, enim
                            eiusmod high life accusamus terry richardson ad squid. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingThree">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse"
                                data-parent="#accordion" href="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                                Collapsible Group Item #3
                            </a>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" role="tabpanel"
                        aria-labelledby="headingThree">
                        <div class="card-body"> Anim pariatur cliche reprehenderit, enim
                            eiusmod high life accusamus terry richardson ad squid. </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="col-lg-3  mb-4">
            <h4 class="mb-3">CONTACT US</h4>
            <!-- Contact -->
            <form>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputname1"
                        placeholder="Enter Name"> </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <textarea class="form-control" id="exampleTextarea" rows="3"
                        placeholder="Message"></textarea>
                </div>
                <button type="submit" class="btn btn-info">Submit</button>
            </form>
        </li>
        <li class="col-lg-3 col-xlg-4 mb-4">
            <h4 class="mb-3">List style</h4>
            <!-- List style -->
            <ul class="list-style-none">
                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                        You can give link</a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                        Give link</a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                        Another Give link</a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                        Forth link</a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                        Another fifth link</a></li>
            </ul>
        </li>
    </ul>
@endsection
@section('hearder-result')
<div class="col-md-5 col-12 align-self-center">
    <h3 class="text-themecolor mb-0 mt-0">Dashboard</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
</div>
<div class="col-md-7 col-12 align-self-center d-none d-md-block">
    <div class="d-flex mt-2 justify-content-end">
        <div class="d-flex mr-3 ml-2">
            <div class="chart-text mr-2">
                <h6 class="mb-0"><small>THIS MONTH</small></h6>
                <h4 class="mt-0 text-info">$58,356</h4></div>
            <div class="spark-chart">
                <div id="monthchart"></div>
            </div>
        </div>
        <div class="d-flex mr-3 ml-2">
            <div class="chart-text mr-2">
                <h6 class="mb-0"><small>LAST MONTH</small></h6>
                <h4 class="mt-0 text-primary">$48,356</h4></div>
            <div class="spark-chart">
                <div id="lastmonthchart"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('results')
    <h4 class="card-title">Se han encontrado resultados</h4>
    <h6 class="card-subtitle">Cerca de 700 resultados encontrado</h6>
    <hr>
    <ul class="search-listing">
        <li>
            <div class="row">
                
                <div class="col-2" align="center">
                    <span style="font-size: 60px; color:red; ">
                        <i class="fas fa-book fa-lg"></i>
                    </span><br>Tesis
                </div>
                <div class="col-10">
                    <p><label style="font-size: 17px;"><b> Título:</b></label> dfsdf</p>
                    <p><label style="font-size: 17px;"><b> Integrantes:</b></label> dfsdf</p>
                    
                </div>

            </div>
        </li>
        <li>
            <h3><a href="javacript:void(0)">AngularJS — Superheroic JavaScript MVW Framework</a></h3>
            <a href="javascript:void(0)" class="search-links">http://www.google.com/angularjs</a>
            <p>Lorem Ipsum viveremus probamus opus apeirian haec perveniri, memoriter.Praebeat pecunias viveremus probamus opus apeirian haec perveniri, memoriter.</p>
        </li>
        <li>
            <h3><a href="javacript:void(0)">AngularJS Tutorial - W3Schools</a></h3>
            <a href="javascript:void(0)" class="search-links">http://www.google.com/angularjs</a>
            <p>Lorem Ipsum viveremus probamus opus apeirian haec perveniri, memoriter.Praebeat pecunias viveremus probamus opus apeirian haec perveniri, memoriter.</p>
        </li>
        <li>
            <h3><a href="javacript:void(0)">Introduction to AngularJS - W3Schools</a></h3>
            <a href="javascript:void(0)" class="search-links">http://www.google.com/angularjs</a>
            <p>Lorem Ipsum viveremus probamus opus apeirian haec perveniri, memoriter.Praebeat pecunias viveremus probamus opus apeirian haec perveniri, memoriter.</p>
        </li>
    </ul>
    <nav aria-label="Page navigation example" class="mt-4">
        <ul class="pagination">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
@endsection