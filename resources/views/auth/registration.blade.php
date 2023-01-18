@include('layouts.header')
    
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                @include('layouts.sidebar')
            </div>
            <div class="col py-3">
                <h2>Add New Users</h2>
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                <div class="card">
                <h3 class="card-header text-center">Add User</h3>
                <div class="card-body">
                <form action="{{ route('register.custom') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                required autofocus>
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                </div>
                <div class="form-group mb-3">
                <input type="text" placeholder="Email" id="email_address" class="form-control"
                name="email" required autofocus>
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                </div>
                <div class="form-group mb-3">
                <input type="password" placeholder="Password" id="password" class="form-control"
                name="password" required>
                @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
                </div>
                <div class="form-group mb-3">
                <div class="checkbox">
                <label><input type="checkbox" name="remember"> Remember Me</label>
                </div>
                </div>
                <div class="d-grid mx-auto">
                <button type="submit" class="btn btn-primary btn-block">Sign up</button>
                </div>
                </form>
                </div>
                </div></div>
                    <div class="col"></div>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>