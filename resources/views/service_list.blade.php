@include('head')


    
        <div class="row">
            <div class="col-12">
                @include('navbar')
            </div>
        </div>
         <div class="row">
            <div class="col-5 col-md-2 col-lg-2 bg-white sidbar_height" id="sidebar">
                @include('sidebar')
            </div>
            <div class="col"> <!--col- 10 --> 
                
				<!-- sidibar button -->
				<div class="ml-4 mt-2">
					 <button class="btn bg-light" id="showsidebar"> <i class="fa fa-bars" aria-hidden="true"></i> </button>
				</div>
				<!-- sidibar button -->
                <!-- page content -->
                <div class="container"> <!--Container --> 
                    <div class="row mt-3"><!--row --> 
                        <div class="col-8 col-lg-10  col-md-10 col-sm-9"><!--col-10 --> 
                            <h3> Services</h3>
                           
                        </div><!--col-9 --> 
                        <div class="col col-lg-2 col-md-2 col-sm-3"><!--col-2 --> 
                            <!-- <a type="button" href="{{url('/add_services')}}" class="btn btn-secondary btn-sm">Add Service</a> -->

                            <!-- model start -->
                                                                
                                                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Services
                                </button>

                                <!-- Modal -->
                                <form action="{{url('/upload')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Services</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body"> <!-- modell body -->
                                                <div class="input-group mb-3">  <!--input group --> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="">Service Name</span>
                                                    </div>
                                                    <input type="text" name="service_name" id="service_name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                                </div> <!--input group --> 

                                                <div class="input-group mb-3">  <!--input group --> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="">Upload image</span>
                                                    </div>
                                                    <input type="file" name="img" id="img" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                                </div> <!--input group --> 
                                            </div> <!-- modell body -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </form>
                            <!-- model  end-->
                        </div><!--col-9 --> 
                    </div><!--row --> 
                    <div class="row justify-content-center">

                        @if(Session::has('success'))
                            <div class="error text-center alert alert-success">{{Session::get('success')}} </div>
                        @endif
                        @if($errors->any())
                            <div class="error text-center alert alert-danger">{{$errors->first()}} </div>
                        @endif

                        @if(Session::has('fail'))
                            <div class="error text-center alert alert-danger">{{Session::get('fail')}} </div>
                        @endif
                    </div>
                  
                    <div class="row  "> <!--row --> 
                     
                        @foreach($services as $serv)
                        <div class="col-12 col-lg-3 col-md-3"> <!--col --> 
                            <div class="card mt-3" style=""> <!--card --> 
                                <div class="row justify-content-center">
                                    <div class="text-center" style="width: 9rem;">
                                        <img class="card-img-top mt-2 text-center service_image_height" src="{{asset('/storage/services/'.$serv->img)}}" alt="Card image cap">
                                    </div>
                                </div>
                                <div class="card-body pl-2 ml-2"> <!--card body --> 
                                    <h5 class="text-muted ml-2 text-center">{{$serv->service_name}}</h5>
                                    <div class="row">
                                        <div class="col-6 border-right border-top">
                                        <a type="button" href="{{url('/edit_service/'.$serv->id)}}" class="btn btn-light btn-sm btn-block"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-6 border-top">
                                             <button type="button" class="btn btn-light btn-sm btn-block  " data-toggle="modal" data-target="#delete{{$serv->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                    <!-- delete model -->
                                    <div class="modal" id="delete{{$serv->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete Service</h4>
                                    
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    Service Name: {{$serv->service_name}}

                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                                    <a href="{{url('/delete_service/'.$serv->id)}}" type="button" class="btn btn-danger" >Delete</a>
                                                </div>

                                                </div>
                                            </div>
                                    </div>

                                    <!-- delete model -->
                                </div> <!--card body --> 
                                <div class="card-footer text-muted"> <!--card footer --> 
                                <div class="row">
                                        <div class="col-12 border-right ">
                                        <a type="button" href="{{url('/sub_service/'.$serv->id)}}" class="btn btn-light btn-sm btn-block"></i>Sub Service</a>
                                        </div>
                                    
                                    </div>
                                </div><!--card footer -->
                            </div> <!--card --> 
                        </div> <!--col --> 

                        @endforeach
                    </div><!--row --> 
                </div> <!--Container --> 
                <!-- page content end -->
            </div>  <!--col- 10 --> 
         </div><!--row --> 
        







@include('jslink')