


<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

            <div class="navbar navbar-expand-lg bg-light navbar-light">
                <div class="container-fluid">
                    <a href="{{route('home')}}" class="navbar-brand">Tabelog</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
        
                    <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                        <div class="navbar-nav ml-auto">
                            <a href="{{route('home')}}" class="nav-item nav-link active">Home</a>
                          
                            
                        @guest
                        <a href="{{route('auth.login')}}" class="nav-item nav-link">Login</a>    
                        <a href="{{route('auth.register')}}" class="nav-item nav-link">Register</a>    
                        @endguest
                            
                            
                            <a href="{{route('booking')}}" class="nav-item nav-link">Booking</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu">
                                    <a href="blog.html" class="dropdown-item">Blog Grid</a>
                                    <a href="single.html" class="dropdown-item">Blog Detail</a>
                                </div>
                            </div>
                            @auth
                            @if(Auth::user()->user_type == 'normal')
                            <a href="{{route('mypage.register_card')}}" class="nav-item nav-link">Get Premium</a>
                            
                            @endif
                            @endauth
                          
                        </div>
                    </div>
                </div>
            </div>