@include('layouts.header')
    
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                @include('layouts.sidebar')
            </div>
            <div class="col py-3">
                <h2>CAC Partners Dashboard</h2>
                <br>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Active Partners
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Total number of Active Partners</h5>
                                <p class="card-text">
                                    Number of active partners - {{ $partners['y'] }}
                                </p>
                                <a href="{{ route('partners.active') }}" class="btn btn-primary">View Active Partners</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Pending Partners
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Total number of Pending Partners</h5>
                                <p class="card-text">
                                    Number of pending partners - {{ $partners['n'] }}
                                </p>
                                <a href="{{ route('partners.inactive') }}" class="btn btn-primary">View Pending Partners</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Registered Partners
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Total number of Registered Partners</h5>
                                <p class="card-text">
                                    Number of pending partners - {{ $partners['r'] }}
                                </p>
                                <a href="{{ route('partners.registered') }}" class="btn btn-primary">View Registered Partners</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>