
@include('head')



<script>

</script>
        <div class="row">
            <div class="col-12">
                @include('navbar')
            </div>
        </div>
         <div class="row">
            <div class="col-5 col-lg-2 col-md-2 col-sm-2  bg-white sidbar_height" id="sidebar">
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
				
				<div class="col-12 mt-2 pr-lg-5 pl-5">
					<div class="row justify-content-end">
						<div class="col-lg-6 col-md-6 col-12 ">
							<form action="{{url('/job_history')}}" method="get">
							<div class="input-group mb-3">
							  <input type="text" class="form-control" name="id" placeholder="Search Here" aria-label="Recipient's username" aria-describedby="basic-addon2">
							  <div class="input-group-append">
								<button class="btn btn-outline-secondary" name="submit" type="submit" value="search"><i class="fa fa-search" aria-hidden="true"></i></button>
							  </div>
							</div>
							</form>
						</div>
					</div>
				</div>
				
                
				 <!-- page content -->
                  <div class="col"> <!-- col -->
                    <div class="row"> <!-- row -->
                        <div class="col">
                            <h3 class="text-muted mt-2 text-center">Partner History </h3>
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
                         <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Work Name</th>
                                    <th scope="col">Job History</th>
                                   
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $a=1 ?>
                                    @foreach($partner as $part)
                                        <tr>
                                        <th scope="row">{{$part->id}}</th>
                                        <td>{{$part->partner_name}}</td>
                                        <td>{{$part->mobile}}</td>
                                        <td>{{$part->work_name}}</td>
                                        <td><a type="button" href="{{url('/view_history/'.$part->id)}}" class="btn btn-primary btn-sm " >View</a></td>
                                      
                                        </tr>
                                  

                                 
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







