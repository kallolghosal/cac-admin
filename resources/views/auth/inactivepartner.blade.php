@include('layouts.header')
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                @include('layouts.sidebar')
            </div>
            <div class="col py-3">
                <h4>Pending CAC Partners</h4>
                 
                <br>
                <table class="table table-bordered" id="pinfos">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Portal ID</td>
                            <td>Name</td>
                            <td>Status</td>
                            <td>Created Dt</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    
                    @foreach ($partners as $partner)
                    <tr>
                    <td>{{$partner->partner_id}}</td>
                    <td>{{$partner->portal_id}}</td>
                    <td>{{$partner->partner_name}}</td>
                    <td>{{($partner->status == 'n') ? 'Inactive' : 'Active'}}</td>
                    <td>{{$partner->created_at->todatestring()}}</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('partner.view', $partner->partner_id) }}"><i class="bi bi-eye"></i></a> 
                        <button id="btnDelete" onclick="deletePartner('{{$partner->partner_name}}')" class="btn btn-sm btn-primary"><i class="bi bi-trash"></i></button>
                    </td>
                    </tr>
                    @endforeach
                </table>
                {!! $partners->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>

    </div>
</body>
</html>