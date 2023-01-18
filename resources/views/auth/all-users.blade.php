@include('layouts.header')
    
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                @include('layouts.sidebar')
            </div>
            <div class="col py-3">
                <h2>All Users</h2>
                <a href="{{ route('register-user') }}" class="btn btn-primary btn-sm">Add User</a>
                <br><br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Role</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role_as }}</td>
                        <td><a href="{{ route('edit.user', $user->id) }}" class="btn btn-primary btn-sm">Edit</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</body>
</html>