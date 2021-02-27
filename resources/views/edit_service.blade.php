

@include('head')
    
        <div class="row">
            <div class="col-12">
                @include('navbar')
            </div>
        </div>
         <div class="row">
            <div class="col-2 bg-white sidbar_height">
                @include('sidebar')
            </div>
            
            <div class="col-10"> <!--col- 10 --> 
                <!-- page content -->
                <div class="container"> <!--Container --> 
                    <div class="row mt-3 justify-content-center"><!--row --> 
                        <div class="col-12">
                            <h1 class="text-center"> Edit Services</h1></br>

                            
                        </div>
                    
                       
                        <div class="col-6 bg-white p-5"><!--col-6 --> 
                        <form action="{{url('/edit_service')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{$service->id}}"/>
                            @if($errors->has('service_name')) 
                                <label class=" text-center text-danger">* {{ $errors->first('service_name') }}</label>
                            @endif

                            @if(Session::has('success'))
                                <label class=" text-center text-success"> {{ Session::get('success') }}</label>
                            @endif

                            @if(Session::has('fail'))
                                <label class=" text-center text-danger"> {{ Session::get('fail') }}</label>
                            @endif

                            @csrf
                            <div class="input-group mb-3">  <!--input group --> 
                                
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Service Name</span>
                                </div>
                                <input type="text" name="service_name" id="service_name" class="form-control" value="{{$service->service_name}}" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div> <!--input group --> 

                            <div class="input-group mb-3">  <!--input group --> 
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Upload image</span>
                                </div>
                                <input type="file" name="img" id="img" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div> <!--input group --> 

                           
                            <button type="submit" class="btn btn-primary btn-sm btn-block text-white mt-2">Submit</button>
                        </form>
                        </div><!--col-6 --> 
                      
                    </div><!--row --> 
                </div> <!--Container --> 
                <!-- page content end -->
            </div>  <!--col- 10 --> 
           
         </div><!--row --> 
        









@include('jslink')