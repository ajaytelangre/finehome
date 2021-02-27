
@include('head')



<script>

</script>
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
                
                <div class="row">  <!--row --> 
				<!-- sidibar button -->
                <div class="col-12">
                    <div class="ml-4 mt-2">
                        <button class="btn bg-light" id="showsidebar"> <i class="fa fa-bars" aria-hidden="true"></i> </button>
                    </div>
                </div>
				<!-- sidibar button -->
				 <!-- page content -->
                  <div class="col"> <!-- col -->
                    <div class="row"> <!-- row -->
                        <div class="col">
                            <h3 class="text-muted mt-2 text-center">Partner List </h3>
                            @if(Session::has('success'))
                                <div class="text-success">
                                    {{Session::get('success')}}
                                </div>
                             @endif
                        </div>
                        
                    </div> <!-- row -->
					<div class="row justify-content-center"> <!-- row -->
                        <div class="col">

                        
                         <div class="table-responsive-xl">
                         <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Work Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $a=1 ?>
                                    @foreach($partner as $part)
                                        <tr>
                                        <th scope="row">{{$part->id}}</th>
                                        <td>{{$part->partner_name}}</td>
                                        <td>{{$part->mobile}}</td>
                                        <td>{{$part->email}}</td>
                                        <td>{{$part->work_name}}</td>
                                        <td>{{$part->address}}</td>
                                        <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{$a}}">Edit</button</td>
                                        <td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$a}}">Delete</button</td>
                                        </tr>
                                        <!-- delete model  -->
                                        <div class="modal fade" id="delete{{$a}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <Label>Name: {{$part->partner_name}}</Label> <br>
                                                    <Label>Id: {{$part->id}}</Label>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <a type="button" href="{{url('/delete_partner/'.$part->id)}}"  class="btn btn-danger">Delete</a>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        <!--delete model  -->

                                        <!-- edit model  -->
                                        <div class="modal fade" id="edit{{$a}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Partner Info</h5>

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{url('/edit_partner')}}" method="post">
                                                 @csrf
                                                <input type="hidden" name="id" value="{{$part->id}}"/>
                                                <div class="modal-body"> <!--  modal-body -->
                                                    <label for="partner_name"> Partner Name:</label>
                                                    <input type="text" class="form-control" name="name" value="{{$part->partner_name}}" Required></input>
                                                    <label for="partner_name"> Mobile:</label>
                                                    <input type="text" class="form-control" name="mobile" value="{{$part->mobile}}" Required></input>
                                                    <label for="partner_name"> Email:</label>
                                                    <input type="text" class="form-control" name="email" value="{{$part->email}}" Required></input>
                                                    <label for="partner_name"> Work Name:</label>
                                                    <input type="text" class="form-control" name="work_name" value="{{$part->work_name}}" Required></input>
                                                    <label for="partner_name"> Address:</label>
                                                    <textarea type="text" class="form-control" name="address" value="" Required>{{$part->address}}</textarea>

                                                    
                                                </div> <!--  modal-body -->
                                                <div class="modal-footer">  <!--  modal-footer -->
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit"   class="btn btn-info">Submit</button>
                                                </div>  <!--  modal-footer -->
                                                </form>
                                                </div>
                                            </div>
                                            </div>
                                        <!--edit model  -->
                                        <?php $a++ ?>
                                    @endforeach
                                </tbody>
                                </table>
                                </div>
                        </div>
                        
                    </div> <!-- row -->
                  </div> <!-- col -->
                <!-- page content end -->
			   </div><!--row --> 
            </div>  <!--col- 10 --> 
         </div><!--row --> 
        
@include('jslink')







