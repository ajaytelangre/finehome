

<ul class="nav nav-pills flex-column flex-nowrap overflow-hidden">
                <li class="nav-item ">
                    <button class=" btn bg-white text-dark float-right" id="closeside"  href=""><i class="fa fa-window-close"></i> </button>
        
                </li>
                <li class="nav-item">
                    <a class="nav-link text-truncate text-dark" href="{{url('/home')}}"><i class="fa fa-tachometer"></i> <span class=" d-sm-inline">Dashboard</span></a>
        
                </li>

                
                <!-- Services -->
                <li class="nav-item">
                    <a class="nav-link text-truncate text-dark" href="{{url('/service_list')}}"><i class="fa fa-tasks"></i> <span class=" d-sm-inline">Services</span></a>
                </li>
                
                <!-- <li class="nav-item">
                    <a class="nav-link collapsed text-truncate text-dark" href="{{url('/service_list')}}" data-toggle="collapse" data-target="#services"><i class="fa fa-tasks"></i> <span class=" d-sm-inline">Services</span></a>
                    <div class="collapse" id="services" aria-expanded="false">
                        <ul class="flex-column pl-4 nav">
                             
                                <li class="nav-item">
                                            <a class="nav-link text-dark p-1" href="{{url('/service_list')}}">
                                            <i class="fa fa-list-ol"></i> List of Categories </a>
                                </li>
                        </ul>
                    </div>
                </li> -->
                <!-- Services -->

                <li class="nav-item">
                    <a class="nav-link collapsed text-truncate text-dark" href="#products" data-toggle="collapse" data-target="#products"><i class="fa fa-archive"></i> <span class=" d-sm-inline">Bookings</span></a>
                    <div class="collapse" id="products" aria-expanded="false">
                        <ul class="flex-column pl-4 nav">
                                <li class="nav-item">
                                            <a class="nav-link text-dark p-1" href="{{url('/booking_incomplete')}}">
                                            <i class="fa fa-plus-circle"></i> Incomplete </a>
                                </li>
                                <li class="nav-item">
                                            <a class="nav-link text-dark p-1" href="{{url('/booking_complete')}}">
                                            <i class="fa fa-check"></i> Complete </a>
                                </li>
                                <li class="nav-item">
                                            <a class="nav-link text-dark p-1" href="{{url('/booking_reasigne')}}">
                                            <i class="fa fa-refresh"></i> Reasigned </a>
                                </li>
                               
                        </ul>
                    </div>
                </li> 
                <!-- Products -->
             
            
                
                <li class="nav-item">
                    <a class="nav-link text-truncate text-dark" href="{{url('/home')}}"><i class="fa fa-leanpub"></i> <span class=" d-sm-inline">Leads</span></a>
                </li>
                
                <!-- payments -->
                <li class="nav-item">
                    <a class="nav-link collapsed text-truncate text-dark" href="#payments" data-toggle="collapse" data-target="#payments"><i class="fa fa-money"></i> <span class=" d-sm-inline">Payments</span></a>
                    <div class="collapse" id="payments" aria-expanded="false">
                        <ul class="flex-column pl-4 nav">
                                <li class="nav-item">
                                            <a class="nav-link text-dark p-1" href="#">
                                            <i class="fa fa-eye"></i> Payment Display</a>
                                </li>
                                <li class="nav-item">
                                            <a class="nav-link text-dark p-1" href="#">
                                            <i class="fa fa-check"></i> Payment Pending </a>
                                </li>
                                <li class="nav-item">
                                            <a class="nav-link text-dark p-1" href="#">
                                            <i class="fa fa-check"></i> Payment Complete </a>
                                </li>
                               
                        </ul>
                    </div>
                </li> 

                <!-- payments -->
              
            
                <!-- user -->
                <li class="nav-item">
                    <a class="nav-link collapsed text-truncate text-dark" href="#submenu2" data-toggle="collapse" data-target="#submenu2"><i class="fa fa-user"></i> <span class=" d-sm-inline">User</span></a>
                    <div class="collapse" id="submenu2" aria-expanded="false">
                        <ul class="flex-column pl-4 nav">
                                <li class="nav-item">
                                            <a class="nav-link text-dark p-1" href="{{url('/partner_list')}}">
                                            <i class="fa fa-users"></i> Partner </a>
                                </li>
                                <li class="nav-item">
                                            <a class="nav-link text-dark p-1" href="{{url('/user_list')}}">
                                            <i class="fa fa-user"></i> User </a>
                                </li>
                        </ul>
                    </div>
                </li>
                <!-- user -->
                <li class="nav-item">
                    <a class="nav-link text-truncate text-dark" href="{{url('/job_history')}}"><i class="fa fa-history"></i> <span class="d-sm-inline">Job History</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-truncate text-dark" href="{{url('/ui')}}"><i class="fa fa-android"></i> <span class=" d-sm-inline">UI App Home Page</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-truncate text-dark" href="{{url('/home')}}"><i class="fa fa-comments"></i> <span class=" d-sm-inline">Chat Bot</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-truncate text-dark" href="{{url('/home')}}"><i class="fa fa-leanpub"></i> <span class=" d-sm-inline">Kyc Lead</span></a>
                </li>
                <!-- checkout -->
                <li class="nav-item">
                    <a class="nav-link collapsed text-truncate text-dark" href="#submenu2" data-toggle="collapse" data-target="#submenu3"><i class="fa fa-check-circle-o"></i> <span class=" d-sm-inline">checkout</span></a>
                    <div class="collapse" id="submenu3" aria-expanded="false">
                        <ul class="flex-column pl-4 nav">
                                <li class="nav-item">
                                            <a class="nav-link text-dark p-1" href="#">
                                            <i class="fa fa-inr"></i> Currecy or Tax </a>
                                </li>
                               
                        </ul>
                    </div>
                </li>
                <!-- checkout close -->
               
                
            </ul>