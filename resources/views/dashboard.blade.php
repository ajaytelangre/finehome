
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

<!-- 
    <script>
	    var botmanWidget = {
	        aboutText: 'ssdsd',
	        introMessage: "✋ Hi! I'm form codechief.org"
	    };
    </script> -->
  
    
            <div class="col"> <!--col- 10 --> 
                
                <div class="row">  <!--row --> 


				<!-- sidibar button -->
				<div class="ml-4 mt-2">
					 <button class="btn bg-light" id="showsidebar"> <i class="fa fa-bars" aria-hidden="true"></i> </button>
				</div>
				<!-- sidibar button -->
				 <!-- page content -->
                  <!-- cards -->
			
					 <div class="container mt-2 "> <!--container --> 
						<h3 class="text-muted">Dashboard</h3>
						<div class="row mt-2"><!--row -->
						  <div class="col-12 col-lg-4 col-md-4 "> <!--col-6 -->
							<div class="card " > <!--card-->
								  <div class="card-body"> <!--card body-->
										<div class="row"> <!--row-->
										  <div class="col-6"> <!--col-8-->
											<h1>37</h1>
											<label>Products</label>
										  </div> <!--col-8-->
										  <div class="col-4"> <!--col-4-->
											<img src="img/icons/Products.png" class="icon_size" style="opacity:0.5;" alt="Products">
										  </div> <!--col-8-->
										</div> 
								  </div> <!--card body-->
								<div class="card-footer text-muted text-center"> <!--card footer-->
									   <a href="#"> More Info <i class="fa fa-angle-double-right" aria-hidden="true"></i> </a>
								</div> <!--card footer-->
							 </div><!--card-->
						 </div><!--col-6 -->

             <div class="col-12 col-lg-4 col-md-4 "> <!--col-6 -->
							<div class="card " > <!--card-->
								  <div class="card-body"> <!--card body-->
										<div class="row"> <!--row-->
										  <div class="col-6"> <!--col-8-->
											<h1>7</h1>
											<label>Categories</label>
										  </div> <!--col-8-->
										  <div class="col-4"> <!--col-4-->
											<img src="img/icons/Categories.png" class="icon_size" style="opacity:0.5;" alt="Products">
										  </div> <!--col-8-->
										</div> 
								  </div> <!--card body-->
								<div class="card-footer text-muted text-center"> <!--card footer-->
									   <a href="#"> More Info <i class="fa fa-angle-double-right" aria-hidden="true"></i> </a>
								</div> <!--card footer-->
							 </div><!--card-->
						 </div><!--col-6 -->

             <div class="col-12 col-lg-4 col-md-4 "> <!--col-6 -->
							<div class="card " > <!--card-->
								  <div class="card-body"> <!--card body-->
										<div class="row"> <!--row-->
										  <div class="col-6"> <!--col-8-->
											<h1>5</h1>
											<label>Users</label>
										  </div> <!--col-8-->
										  <div class="col-4"> <!--col-4-->
											<img src="img/icons/Users.png" class="icon_size" style="opacity:0.5;" alt="Products">
										  </div> <!--col-8-->
										</div> 
								  </div> <!--card body-->
								<div class="card-footer text-muted text-center"> <!--card footer-->
									   <a href="#"> More Info <i class="fa fa-angle-double-right" aria-hidden="true"></i> </a>
								</div> <!--card footer-->
							 </div><!--card-->
						 </div><!--col-6 -->

					  </div> <!--row -->
					  
					</div> <!--container close -->
				</div><!--row --> 
                <!-- page content end -->
            </div>  <!--col- 10 --> 
         </div><!--row --> 
        

@include('jslink')







