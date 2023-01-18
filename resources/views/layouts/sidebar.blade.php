<div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    
    <h4>CAC Admin</h4>
    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
        
        <li>
            <a href="{{ route('dashboard') }}" class="nav-link px-0 align-middle">
                <i class="bi bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
        </li>
        <li>
            <a href="{{ route('partner.info') }}" class="nav-link px-0 align-middle">
                <i class="bi bi-person-rolodex"></i> <span class="ms-1 d-none d-sm-inline">Partners</span></a>
        </li>
        <li>
            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                <i class="bi bi-people-fill"></i> <span class="ms-1 d-none d-sm-inline">Users</span></a>
            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                <li class="w-100">
                    <a href="all-users" class="nav-link px-0"> <span class="d-none d-sm-inline">All Users</span></a>
                </li>
                <li>
                    <a href="{{ route('register-user') }}" class="nav-link px-0"> <span class="d-none d-sm-inline">Add User</span></a>
                </li>
            </ul>
        </li>
        <!-- <li>
            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                <i class="bi bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                <li class="w-100">
                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 1</a>
                </li>
                <li>
                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 2</a>
                </li>
                <li>
                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 3</a>
                </li>
                <li>
                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 4</a>
                </li>
            </ul>
        </li> -->
        <li>
            <a href="{{ route('partner.settings') }}" class="nav-link px-0 align-middle"><i class="bi bi-gear-fill"></i> &nbsp;Settings</a>
        </li>
        <li><a href="{{ route('signout') }}" class="nav-link px-0"><i class="bi bi-box-arrow-left"></i> &nbsp;Logout</a></li>
    </ul>
    
</div>