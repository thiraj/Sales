<aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <!--<img src="images/user.png" width="48" height="48" alt="User" />-->
                </div>
                <div class="info-container">
                    <!--<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: red;">John Doe</div>-->
                    
                    <div class="btn-group user-helper-dropdown">
                        <!--<i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>-->
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">WELCOME {{Auth::user()->f_name}}..!</li>
                    <li class="active">
                        <a href="{{ url('/') }}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('profile') }}">
                            <i class="material-icons">text_fields</i>
                            <span>Profile</span>
                        </a>
                    </li>
                    {{--<li>--}}
                        {{--<a href="#">--}}
                            {{--<i class="material-icons">layers</i>--}}
                            {{--<span>Markets</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    <li>
                        <a href="{{url('/agents')}}">
                            <i class="material-icons">widgets</i>
                            <span>Agent Details</span>
                        </a>
                        
                    </li>
                    <li>
                        <a href="{{url('/performance_client')}}">
                            <i class="material-icons">swap_calls</i>
                            <span>Performance</span>
                        </a>
                       
                    </li>

                    <li>
                        <a href="/report_get_user" data-toggle="modal" data-target="#defaultModal">
                            <i class="material-icons">assignment</i>
                            <span>Reports</span>
                        </a>

                    </li>

                    @if(Auth::user()->role == 1 || Auth::user()->role == 2)


                    <li>
                        <a href="{{url('/team')}}">
                            <i class="material-icons">supervisor_account</i>
                            <span>Team</span>
                        </a>

                    </li>

                    @endif
                    @if(Auth::user()->role == 1)
                    <li>
                        <a href="{{url('/users')}}">
                            <i class="material-icons">supervisor_account</i>
                            <span>Users</span>
                        </a>

                    </li>

                    <li>
                        <a href="{{url('/complain')}}">
                            <i class="material-icons">supervisor_account</i>
                            <span>Complain</span>
                        </a>

                    </li>

                     @endif
                   
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; {{date('Y',time())}} <a href="#">Appleholidays.lk</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 2.0.1
                </div>
            </div>
            <!-- #Footer -->
        </aside>


<!-- Default Size -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <h4 class="modal-title" id="defaultModalLabel">Make Report</h4>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>

<script>
    $("#defaultModal").on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget);
        $(this).find(".modal-body").load(link.attr("href"));
    });
</script>
