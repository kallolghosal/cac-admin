@include('layouts.header')
    
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                @include('layouts.sidebar')
            </div>
            <div class="col py-3">
                <h2>Edit User</h2>
                <a href="{{ route('register-user') }}" class="btn btn-primary btn-sm">Add User</a>
                <br><br>
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header text-center">
                                Edit User
                            </div>
                            <div class="card-body">
                                <form action="{{ route('update.user') }}" method="POST">
                                    @csrf
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="" class="form-control" value={{ $user->name }}>
                                    <br>
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="" class="form-control" value={{ $user->email }}>
                                    <br>
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="" class="form-control">
                                    <br>
                                    <input type="submit" value="Save" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>