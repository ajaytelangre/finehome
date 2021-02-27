
@include('head')



<script>

</script>
        <div class="row">
            <div class="col-12 pr-2">
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
                    <div class="container  mt-2"> <!--container  --> 
						<div class="row pl-3 justify-content-end">
							<div class="col-lg-2 col-md-2 col-12 mb-2 mr-2"> 
                                   <button type="button" class="btn btn-secondary  btn-block" data-toggle="modal" data-target="#slider">
                                   <i class="fa fa-plus" aria-hidden="true"></i> Add slider image</button>
							</div>
                            <!-- add slider modal -->
							<form action="{{url('/upload_slider')}}" method="post" enctype='multipart/form-data'>
							@csrf
                            
                            <div class="modal fade" id="slider" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Slider Image</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body"> <!-- modal-body  -->
												<input  name="img" type="file" class="form-control drag_drop"/>
												<input type="text" name="tag" class="form-control mt-2 " placeholder="Tag"/>
												
                                        </div><!-- modal-body  -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="btn" class="btn btn-primary" value="slider">Save</button>
                                        </div>
                                        </div>
                                    </div>
                              </div>
							  </form>
                            <!-- add slider modal -->

							<div class="col-lg-2 col-md-2 col-12  mb-2 mr-2">
                                 <button type="button" class="btn btn-secondary  btn-block" data-toggle="modal" data-target="#offer"><i class="fa fa-plus" aria-hidden="true"></i> Add offers</button>
							</div>
							
							<!-- add slider modal -->
							<form action="{{url('/upload_slider')}}" method="post" enctype='multipart/form-data'>
							@csrf
                            <div class="modal fade" id="offer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Offer's Image</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body"> <!-- modal-body  -->
												<input  name="img" type="file" class="form-control drag_drop"/>
												<input type="text" name="tag" class="form-control mt-2 " placeholder="Tag"/>
												
                                        </div><!-- modal-body  -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="btn" value="offer" class="btn btn-primary">Save</button>
                                        </div>
                                        </div>
                                    </div>
                              </div>
							  </form>
                            <!-- add slider modal -->
						</div>
                        <div class="row">
							<div class="col-12 text-center">
								@if(Session::has('success'))
										<div class="alert alert-success">{{Session::get('success')}}</div>
								@endif
								
								
								@if($errors->any())
									@foreach($errors->all() as $error)
									<div class="alert alert-danger">{{$error}}</div>
									@endforeach
								@endif
							</div>
                        <?php $a=1?>
                        @foreach($slider as $slide)
                       
                        <div class="col-lg-4 col-md-4 col mb-2">  <!-- col-lg-4  -->
							<div class="card"> <!--card  -->
								<div class="card-header">
										<div  class="row">
											<div class="col-lg-8 col-md-8 col">
		
												<h5 class="card-title mb-0">Slider {{$a}}</h5>
											</div>
											<div class="col-lg-4 col-md-4 col">
												<a href="{{url('/remove_slider/'.$slide->id)}}" class="btn btn-sm mb-0">Remove</a>
											</div>
										</div>
								</div>
                                <div class="card-body"> <!--card-body -->
									<div>
										<img class="img-fluid p-1" src="{{asset('/storage/'.$slide->img)}}">
									</div>
									<span class="label text-muted ">Tag</span>
                                    <input class="form-control mt-2" value="{{$slide->tag}}" type="text">
                                    <button class="btn btn-secondary mt-2 float-right pl-4 pr-4">Save</button>
					
									
								</div> <!--card-body -->
                            </div>  <!--card  -->
                        </div> <!-- col-lg-4  -->
						
                       <?php $a++?>
                        @endforeach
                      </div>
					  
					  <div class="row "> <!-- offers row-->
						<?php $a=1 ?>
						@foreach($offer as $offers)
							<div class="col-lg-4 col-md-4 col mb-2">  <!-- col-lg-4  -->
							<div class="card"> <!--card  -->
								<div class="card-header">
										<div  class="row">
											<div class="col-lg-8 col-md-8 col">
		
												<h5 class="card-title mb-0">Offer {{$a}} </h5>
											</div>
											<div class="col-lg-4 col-md-4 col">
                                            <a href="{{url('/remove_slider/'.$offers->id)}}" class="btn btn-sm mb-0">Remove</a>
											</div>
										</div>
								</div>
                                <div class="card-body"> <!--card-body -->
									<div>
										<img class="img-fluid p-1" src="{{asset('/storage/'.$offers->img)}}">
									</div>
									<span class="label text-muted ">Tag</span>
                                    <input class="form-control mt-2" value="{{$offers->tag}}" type="text">
                                    <button class="btn btn-secondary mt-2 float-right pl-4 pr-4">Save</button>
					
									
								</div> <!--card-body -->
                            </div>  <!--card  -->
                        </div> <!-- col-lg-4  -->
						<?php $a++?>
						@endforeach
					  </div> <!-- offers row-->
					  
                    </div> <!--container  -->
                <!-- page content end -->
			   </div><!--row --> 
            </div>  <!--col- 10 --> 
         </div><!--row --> 
        
@include('jslink')







