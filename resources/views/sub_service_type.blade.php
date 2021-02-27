@include('head')
        <div class="row">
            <div class="col-12">
                @include('navbar')
            </div>
        </div>
         <div class="row">
            <div class="col-5 col-lg-2 col-md-2 bg-white sidbar_height" id="sidebar">
                @include('sidebar')
            </div>
            <div class="col"> <!--col- 10 --> 
                <!-- page content -->
				<div class="row">
                	<!-- sidibar button -->
				<div class="ml-4 mt-2">
					 <button class="btn bg-light" id="showsidebar"> <i class="fa fa-bars" aria-hidden="true"></i> </button>
				</div>
				<!-- sidibar button -->
				
                <div class="container mt-2"> <!--Container --> 
                    <div class="row mt-3"><!--row --> 
                        <div class="col-8 col-lg-10  col-md-10 col-sm-9 col-12"><!--col-10 --> 
                            <h3>Sub Services Type</h3>
                           
                        </div><!--col-9 --> 
                        <div class="col-3 col-lg-2 col-md-2 col-sm-3 col-12"><!--col-2 --> 
                            <!-- <a type="button" href="{{url('/add_services')}}" class="btn btn-secondary btn-sm">Add Service</a> -->

                            <!-- model start -->
                                                                
                                                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add 
                                </button>

                                <!-- Modal -->
                                <form action="{{url('/add_sub_service_type')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Sub Services Type</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body"> <!-- modell body -->
                                                <div class="input-group mb-3">  <!--input group --> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id=""> Name</span>
                                                    </div>
                                                    <input type="text" name="name" id="name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                                   
                                                    
                                                   
                                                   
                                                    <input type="hidden" name="service_id" value="{{$services->id}}">
                                                    <input type="hidden" name="sub_service_id" value="{{$sub_services->id}}">
                                                    

                                                   
                                                </div> <!--input group --> 
                                                <div class="input-group mb-3">  <!--input group --> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id=""> Price</span>
                                                    </div>
                                                    <input type="text" name="price" id="price" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                                   
                                                </div> <!--input group --> 

                                                <div class="input-group mb-3">  <!--input group --> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id=""> Image</span>
                                                    </div>
                                                    <input type="file" name="img" id="img" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                                   
                                                </div> <!--input group --> 

                                                <div class="input-group mb-3">  <!--input group --> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id=""> Rating</span>
                                                    </div>
                                                    <input type="text" name="rating" id="rating" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                                   
                                                </div> <!--input group --> 

                                                <div class="input-group mb-3">  <!--input group --> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id=""> Description</span>
                                                    </div>
                                                    <input type="text" name="description" id="description" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                                   
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
                    <div class="row justify-content-center mt-3"> <!--row --> 
                            <div class="col-12 col-md-8 .col-lg-8 bg-white text-center">
                                <h5 class="pt-2 ">Service Name : {{$services->service_name}} </br>
                                  
                                </h5>
                                <label> Service Id : {{$services->id}}</label>
                                <h5 class="pt-2 ">Sub Service Name : {{$sub_services->sub_service_name}} </br>
                                  
                                  </h5>
                                  <label>Sub Service Id : {{$sub_services->id}}</label>
                            </div>
                    </div> <!--row --> 
                    <div class="row justify-content-center"> <!--row --> 

                        @if(Session::has('success'))
                            <div class="error text-center alert alert-success">{{Session::get('success')}} </div>
                        @endif
                        @if($errors->any())
                            <div class="error text-center alert alert-danger">{{$errors->first()}} </div>
                        @endif

                        @if(Session::has('fail'))
                            <div class="error text-center alert alert-danger">{{Session::get('fail')}} </div>
                        @endif
                    </div> <!--row --> 

                    <div class="row justify-content-center mt-3"> <!--row --> 
                         <div class="col-md-8 .col-lg-8 .col-12">  <!--col-md-8 -->  
                            <div class="table-responsive"> <!--table-responsive-->  
                                 <table class="table table-bordered"> <!--table--> 
                                    <thead>
                                        <tr>
                                        <th scope="col">SR.No</th>
                                        <th scope="col">Id</th>
                                        <th scope="col">Type Name</th>
                                        
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $a=1; ?>
                                        @if(sizeof($services_type)==0)
                                        <tr >
                                        <td class="text-center" colspan="6">No Sub service Added</td>
                                        </tr >
                                        @else
                                        @foreach($services_type as $sub)
                                        <tr>
                                        <th scope="row">{{$a}}</th>
                                        <td>{{$sub->id}}</td>
                                        <td>{{$sub->sub_type}}</td>
                                       
                                        <td><a type="button" class="btn  btn-sm " data-toggle="modal" data-target="#edit{{$a}}"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a></td>
                                        <td><a type="button" class="btn  btn-sm" href="{{url('/delete_service_type/'.$sub->id)}}"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a></td>
                                        </tr>

                                        <!-- Modal -->
                                        <form action="{{url('/update_sub_service_type')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal fade" id="edit{{$a}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="input-group mb-3">  <!--input group --> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id=""> Name</span>
                                                    </div>
                                                    <input type="text" name="name" id="name" value="{{$sub->sub_type}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                                   
                                                    
                                                   
                                                   
                                                    <input type="hidden" name="service_id" value="{{$services->id}}">
                                                    <input type="hidden" name="sub_service_id" value="{{$sub_services->id}}">
                                                    <input type="hidden" name="sub_service_type_id" value="{{$sub->id}}">

                                                   
                                                </div> <!--input group --> 
                                                <div class="input-group mb-3">  <!--input group --> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id=""> Price</span>
                                                    </div>
                                                    <input type="text" name="price" id="price" value="{{$sub->price}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                                   
                                                </div> <!--input group --> 

                                                <div class="input-group mb-3">  <!--input group --> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id=""> Image</span>
                                                    </div>
                                                    <input type="file" name="img" id="img" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                                   
                                                </div> <!--input group --> 

                                                <div class="input-group mb-3">  <!--input group --> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id=""> Rating</span>
                                                    </div>
                                                    <input type="text" name="rating" id="rating" class="form-control" value="{{$sub->rating}}" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                                   
                                                </div> <!--input group --> 

                                                <div class="input-group mb-3">  <!--input group --> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id=""> Description</span>
                                                    </div>
                                                    <input type="text" name="description" id="description" class="form-control" value="{{$sub->description}}" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                                   
                                                </div> <!--input group --> 
                                                

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            </form>
                                            <!-- Modal -->
                                         <?php $a++;?>
                                        @endforeach
                                        @endif
                                    </tbody>
                                 </table> <!--table--> 
                            </div> <!--table-responsive--> 
                         </div>   <!--col-md-8 -->  
                       
                    </div> <!--row --> 
                
                </div> <!--Container --> 
				
				</div>
                <!-- page content end -->
            </div>  <!--col- 10 --> 
         </div><!--row --> 
        








@include('jslink')