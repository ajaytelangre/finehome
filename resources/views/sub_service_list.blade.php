
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
                        <div class="col-8 col-lg-10  col-md-10 col-sm-9 col-12"><!--col-10 --> 
                            <h3>Sub Services</h3>
                           
                        </div><!--col-9 --> 
                        <div class="col-3 col-lg-2 col-md-2 col-sm-3 col-12"><!--col-2 --> 
                            <!-- <a type="button" href="{{url('/add_services')}}" class="btn btn-secondary btn-sm">Add Service</a> -->

                            <!-- model start -->
                                                                
                                                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#add">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Sub Services
                                </button>

                                <!-- Modal -->
                                <form action="{{url('/add_sub_service')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addLabel">Add Sub Services</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body"> <!-- modell body -->
                                                <div class="input-group mb-3">  <!--input group --> 
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="">Sub Service Name</span>
                                                    </div>
                                                    <input type="text" name="sub_service_name" id="sub_service_name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                                    <input type="hidden" name="service_id" value="{{$services->id}}">
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
                                        <th scope="col">Sub Service Name</th>
                                        <th scope="col">Sub Service Type</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $a=1; ?>
                                        @if(sizeof($sub_services)==0)
                                        <tr >
                                        <td class="text-center" colspan="6">No Sub service Added</td>
                                        </tr >
                                        @else
                                        @foreach($sub_services as $sub)
                                        <tr>
                                        <th scope="row">{{$a}}</th>
                                        <td>{{$sub->id}}</td>
                                        <td>{{$sub->sub_service_name}}</td>
                                        <td><a type="button" href="{{url('sub_service_type/'.$sub->id.'/'.$sub->service_id)}}" class="btn btn-sm"><i class="fa fa-eye mr-2" aria-hidden="true"></i>View</a></td>
                                        <td><a type="button" class="btn  btn-sm " data-toggle="modal" data-target="#edit{{$a}}"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a></td>
                                        <td><a type="button" class="btn  btn-sm" data-toggle="modal" data-target="#delete{{$a}}"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a></td>
                                        </tr>
                                            <!-- Modal -->
                                            <form action="{{url('/update_sub_service')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$sub->id}}"/>
                                            <div class="modal fade" id="edit{{$a}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editLabel">Edit Sub Service</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                
                                                    <div class="input-group mb-3">  <!--input group -->
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="">Sub Service Name</span>
                                                        </div>
                                                        <input type="text" name="sub_service_name" id="sub_service_name" class="form-control" value="{{$sub->sub_service_name}}" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                                    </div> <!--input group --> 
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit"  class="btn btn-primary">Save changes</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            </form>
                                        <!-- Modal -->
                                        
                                        <!--delete Modal -->
                                        <form action="{{url('/delete_sub_service')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$sub->id}}"/>
                                            <div class="modal fade" id="delete{{$a}}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteLabel">Delete Sub Service</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                    <label>Sub Service Name: {{$sub->sub_service_name}}</label> </br>
                                                    <label>Sub Service Id: {{$sub->id}}</label>
                                                    </div>
                        
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit"  class="btn btn-danger">Confirm Delete</button>
                                                
                                                </div>
												</div>
                                            </div>
                                            </div>
											
                                            </form>
                                        <!--Delete Modal -->

                                        
                                        <?php $a++;?>
                                        @endforeach
                                        @endif
                                    </tbody>
                                 </table> <!--table--> 
                            </div> <!--table-responsive--> 
                         </div>   <!--col-md-8 -->  
                       
                    </div> <!--row --> 
                
                </div> <!--Container --> 
                <!-- page content end -->
            </div>  <!--col- 10 --> 
         </div><!--row --> 

		







@include('jslink')
