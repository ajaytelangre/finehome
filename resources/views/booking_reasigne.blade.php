
@include('head')



<script>
var lead={};
    function viewdetails(b,lead_id)
    {
        var a=b;
        var leadId=lead_id;
        var sub_service_id="sub_service"+a;
       // alert(sub_service_id);
       var t_body="tbody"+a;
        var info={"lead_id":leadId}
      //  console.log(info);
 
        
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
                            <h3 class="text-muted mt-2 text-center">Reassigned Bookings </h3>
                        </div>
                    </div> <!-- row -->
					<div class="row justify-content-center"> <!-- row -->
                        <div class="col">
                            <div class="table-responsive pr-3 pl-3">
								<table class="table table-bordered ">
								  <thead>
									<tr>
									  <th scope="col">Sr.NO</th>
									  <th scope="col">User Name</th>
									  <th scope="col">Partner Name</th>
									  <th scope="col">Address</th>
                                      <th scope="col">Mobile</th>
                                      <th scope="col">Details</th>
                                      <th scope="col">Amount</th>
                                      <th scope="col">Payment status</th>
                                      <th scope="col">Date</th>
                                      
									</tr>
								  </thead>
								  <tbody>
                                  <?php $a=1 ?>
                                  @foreach($leads as $lead)
									<tr>
									  <th scope="row">{{$a}}</th>
									  <td>{{$lead->username}}</td>
									  <td >{{$lead->partner_name}}</td>
									  <td>{{$lead->address}}</td>
                                      <td>{{$lead->mobile}}</td>
                                      
									  <td>  <button class="btn btn-primary btn-sm" data-toggle="collapse" onclick="viewdetails('{{$a}}','{{$lead->id}}')" href="#details{{$a}}" role="button" aria-expanded="false" aria-controls="details">
                                                View details
                                            </button>
                                      </td>
									  <td>{{$lead->total_price}}</td>
                                      <td>{{$lead->status}}</td>
									  <td>{{$lead->created_at}}</td>

									</tr>
                                    <tr>
                                    <td colspan="9">
                                    <div class="collapse" id="details{{$a}}">
                                        <div class="card card-body">
                                            <label for="">Service Name: {{$lead->service_name}}</label>
                                            <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">SR.NO</th>
                                                    <th scope="col">Sub Service </th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody{{$a}}">
                                                    
                                                </tbody>
                                                </table>
                                            </div>
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







