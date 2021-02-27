
@include('head')



<script>
    function showdata(a,id){

        var t_body="tdata"+a;
        var info={"lead_id":id}
        $.ajax({
             headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
               type:'POST',
               url:'{{url("/getmsg")}}',
               dataType : 'json',
               data:info,
               success:function(data) {
                   lead=data[0];
                  
                  var b=0;
                  var c=1;
                  html="";
                  for(x in data)
                    { 
                       
                        html+="<tr>";
                        html+="<td>"+c+"</td>";
                        html+="<td>"+data[b]['sub_service']+"</td>";
                        html+="<td>"+data[b]['price']+"</td>";
                        html+="<td>"+data[b]['quantity']+"</td>";
                        html+="</tr>";
                        var b=b+1;
                        var c=c+1;
                    }
            
                 document.getElementById(t_body).innerHTML=html;
               }
            });
    }

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
							<form action="{{url('/view_history/'.$info->id)}}" method="get">
							<div class="input-group mb-3">
							  <input type="text" class="form-control" name="data" placeholder="Search Here" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
                        <div class="col ml-2 mr-2">
                            <h3 class="text-muted mt-2 text-center">Partner History </h3>
                            <div class="card">
                                <div class="card-body text-center">
                                   <h5>Partner Name: {{$info->partner_name}}</h5>
                                   <label>Service Name: {{$info->work_name}}</label> <br>
                                   <label>Id: {{$info->id}}</label>
                                   
                                </div>
                             </div>
                            @if(Session::has('success'))
                                <div class="text-success">
                                    {{Session::get('success')}}
                                </div>
                             @endif
                        </div>
                        
                    </div> <!-- row -->
					<div class="row justify-content-center"> <!-- row -->
                        <div class="col ml-2 mr-2">

                        
                         <div class="table-responsive-xl">
                         <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                    <th scope="col">Lead id</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Job Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Job History</th>
                                   
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $a=1 ?>
                                    @foreach($partner as $part)
                                        <tr>
                                        <th scope="row">{{$part->id}}</th>
                                        <td>{{$part->username}}</td>
                                        <td>{{$part->address}}</td>
                                        <td>{{$part->total_price}}</td>
                                        <td>{{$part->status}}</td>
                                        <td>{{$part->updated_at}}</td>
                                        <td><button type="button" class="btn btn-primary btn-sm " onclick="showdata('{{$a}}','{{$part->id}}')" data-toggle="collapse" href="#data{{$a}}" role="button" aria-expanded="false" aria-controls="collapseExample" >View</button</td>
                                      
                                        </tr>
                                        <tr>
                                        <td colspan="9">
                                                <div class="collapse" id="data{{$a}}">
                                                    <div class="card card-body">
                                                        <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                    <th scope="col">SR.NO</th>
                                                                    <th scope="col">Sub Service</th>
                                                                    <th scope="col">Price </th>
                                                                    <th scope="col">Quantity</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tdata{{$a}}">
                                                                    
                                                                    
                                                                </tbody>
                                                            </table>
                                                    </div>
                                                </div>
                                        </td>
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







