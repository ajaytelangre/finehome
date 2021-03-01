
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
                    <div class="container  mt-2"> <!--container  --> 
                        <div class="col-lg-4 col-md-4 col">
							<div class="card">
                                <div class="card-body">
                                    <h5>Home Screen</h5>
								</div>
								<div class="">
                                    <img class="img-fluid p-1" src="{{asset('/storage/slider/IpAaQSXLJbol9cU6tQkRb9bpqQB6mGud5PYW9M6M.png')}}">
								</div>
								<div class="mt-1 mb-2">
									<b class="ml-2">Best Offers</b>
                                    <img class="img-fluid p-1" src="{{asset('/storage/slider/i9KCAqnAu1EGJGnBfTIoq9FUZXf4HIQ8p7fJlhgz.png')}}">
								</div>
								<div class="">
									<a href="{{url('/ui-form')}}" type="button" class=" btn btn-block btn-lg btn-secondary  text-white"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
								</div>
                                
                            </div>
                        </div>
                    </div> <!--container  -->
                <!-- page content end -->
			   </div><!--row --> 
            </div>  <!--col- 10 --> 
         </div><!--row --> 
        
@include('jslink')







