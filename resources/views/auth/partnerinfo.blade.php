@include('layouts.header')
    <div class="container-fluid">
        <div class="row flex-nowrap" style="height:100vh">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                @include('layouts.sidebar')
            </div>
            <div class="col py-3">
                <h4>CAC Partners</h4>
                <br>
                @if (session('accept'))
                    <h4>{{ session('accept') }}</h4>
                @endif
                <h5>Filter By</h5>
                <div class="row">
                    <div class="col">
                        <label for="state">State</label>
                        <select name="state[]" id="state" class="form-control" multiple data-live-search="true">
                            @foreach ($states as $state)
                            <option value="{{$state->id}}">{{$state->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="dist">District</label>
                        <select name="dist[]" id="dist" class="form-control" multiple data-live-search="true">
                        </select>
                    </div>
                    <div class="col">
                        <label for="org">Organisation Type</label>
                        <select name="orgtype" id="orgtype" class="form-control">
                            <option value='' selected>Select Organisation Type</option>
                            @foreach ($orgtype as $checkop)
                            <option value="{{$checkop->check_val}}">{{$checkop->check_val}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="pstatus">Partner Status</label>
                        <select name="pstatus" id="pstatus" class="form-control">
                            <option value="" selected>Select Status</option>
                            <option value="y">Active</option>
                            <option value="n">Inactive</option>
                            <option value="p">Pending</option>
                            <option value="d">Rejected</option>
                        </select>
                    </div>
                </div>
                 
                <br>
                <table class="table table-bordered" id="pinfos">
                    <thead>
                        <tr>
                            <td>Portal ID</td>
                            <td>Name</td>
                            <td>State</td>
                            <td>Status</td>
                            <td>Created Dt</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    
                    @foreach ($partners as $partner)
                    <tr>
                    <td>{{$partner->portal_id}}</td>
                    <td>{{$partner->partner_name}}</td>
                    <td>
                    @php
                        $dists = App\Http\Controllers\PartnerInfoController::getStateNames($partner->state);
                    @endphp

                    @foreach ($dists as $dist)
                        {{ $dist->state }},
                    @endforeach
                    </td>
                    <td>{{($partner->status == 'y') ? 'Active' : 'Inactive'}}</td>
                    <td>{{$partner->created_at->todatestring()}}</td>
                    <td style="display:flex;">
                        @if ($partner->status == 'y')
                        <a class="btn btn-sm btn-primary" href="{{ route('partner.view', $partner->partner_id) }}"><i class="bi bi-eye"></i></a>
                        @elseif ($partner->status == 'n')
                        <a class="btn btn-sm btn-primary" href="{{ route('partner.view', $partner->partner_id) }}"><i class="bi bi-eye"></i></a>&nbsp;
                        <button id="btnDelete" onclick="acceptPartner('{{$partner->partner_name}}','{{$partner->partner_id}}', 'd')"><i class="bi bi-trash"></i></button>
                        @elseif ($partner->status == 'p')
                        <button class="btn btn-sm btn-success" onclick="acceptPartner('{{$partner->partner_name}}','{{$partner->partner_id}}', 'y')"><i class="bi bi-hand-thumbs-up-fill"></i></button>&nbsp;
                        <button class="btn btn-sm btn-danger" onclick="acceptPartner('{{$partner->partner_name}}','{{$partner->partner_id}}', 'n')"><i class="bi bi-hand-thumbs-down-fill"></i></button>
                        @else
                        <a class="btn btn-sm btn-dark" href="{{ route('partner.view', $partner->partner_id) }}"><i class="bi bi-eye"></i></a>
                        @endif
                    </td>
                    </tr>
                    @endforeach
                </table>
                <div id="pgn">{!! $partners->withQueryString()->links('pagination::bootstrap-5') !!}</div>
            </div>
        </div>

    </div>
    <script>
    function acceptPartner (pname,pid,act) {
        //alert(pid);
        
        if (confirm("Do you want to update " + pname + "status?")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('statusAction') }}",
                type: "POST",
                data: {
                    pid: pid,
                    act: act,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (resp) {
                    alert('Status updated successfully');
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    }

    function deletePartner (pname) {
        //alert(pname);
        if (confirm("Do you really want to delete " + pname + "?")) {
            alert(pname +' deleted successfully');
        }
    }

    $('#state').selectpicker({
        nonSelectedText: 'Select State',
        includeSelectAllOption: true,
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true
    });

    $('#dist').selectpicker({
        nonSelectedText: 'Select District',
        includeSelectAllOption: true,
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true
    });

    // Filter with partner status
    $("#pstatus").on('change', function () {
        //alert('hello');
        var status = $("#pstatus").val();
        $("#pinfos").html('');
        $("#pgn").html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('statusfilter') }}",
            type: "POST",
            data: {
                status: status,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(res) {
                //console.log(res.pinfos);
                var status = '';
                var actn = '';
                var tdr = '<thead><tr><td>ID</td><td>Portal ID</td><td>Name</td><td>Status</td><td>Created Dt</td><td>Action</td></tr></thead>';
                $("#pinfos").append(tdr);
                $.each(res.pinfos, function (key, val) {
                    var crdt = new Date(val.created_at).toLocaleDateString();
                    if (val.status == 'y') {
                        status = 'Active';
                        actn = '<a href="partner-view/'+val.partner_id+'" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>';
                    } else if (val.status == 'n') {
                        status = 'Inactive';
                        actn = '<a href="partner-view/'+val.partner_id+'" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>&nbsp;<button onclick="acceptPartner('+"'"+val.partner_name+"'"+','+val.partner_id+','+"'d'"+')" class="btn btn-dark btn-sm"><i class="bi bi-trash"></i></button>';
                    } else if (val.status == 'p') {
                        status = 'Pending';
                        actn = '<button onclick="acceptPartner('+"'"+val.partner_name+"'"+','+val.partner_id+','+"'y'"+')" class="btn btn-success btn-sm"><i class="bi bi-hand-thumbs-up-fill"></i></button>&nbsp;<button onclick="acceptPartner('+"'"+val.partner_name+"'"+','+val.partner_id+','+"'n'"+')" class="btn btn-danger btn-sm"><i class="bi bi-hand-thumbs-down-fill"></i></button>';
                    } else {
                        status = 'Deleted';
                    }
                    $("#pinfos").append('<tr><td>'+val.partner_id+'</td><td>'+val.portal_id+'</td><td>'+val.partner_name+'</td><td>'+status+'</td><td>'+crdt+'</td><td>'+actn+'</td></tr>');
                });
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // filter with state and load district
    $("#state").on('change', function() {
        var state = $("#state").val();
        //alert(stName);
        $("#pinfos").html('');
        $("#dist").html('');
        $("#pgn").html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('partner.state') }}",
            type: "POST",
            data: {
                stid: state,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (res) {
                //console.log(res.pinfos);
                var tdr = '<thead><tr><td>ID</td><td>Portal ID</td><td>Name</td><td>Status</td><td>Created Dt</td><td>Action</td></tr></thead>';
                $("#pinfos").append(tdr);
                var actn = '';
                $.each(res.pinfos, function (key, val) {
                    var crdt = new Date(val.created_at).toLocaleDateString();
                    if (val.status == 'y') {
                        status = 'Active';
                        actn = '<a href="partner-view/'+val.partner_id+'" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>';
                    } else if (val.status == 'n') {
                        status = 'Inactive';
                        actn = '<a href="partner-view/'+val.partner_id+'" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>&nbsp;<button onclick="acceptPartner('+"'"+val.partner_name+"'"+','+val.partner_id+','+"'d'"+')" class="btn btn-dark btn-sm"><i class="bi bi-trash"></i></button>';
                    } else if (val.status == 'p') {
                        status = 'Pending';
                        actn = '<button onclick="acceptPartner('+"'"+val.partner_name+"'"+','+val.partner_id+','+"'y'"+')" class="btn btn-success btn-sm"><i class="bi bi-hand-thumbs-up-fill"></i></button>&nbsp;<button onclick="acceptPartner('+"'"+val.partner_name+"'"+','+val.partner_id+','+"'n'"+')" class="btn btn-danger btn-sm"><i class="bi bi-hand-thumbs-down-fill"></i></button>';
                    } else {
                        status = 'Deleted';
                    }
                    $("#pinfos").append('<tr><td>'+val.partner_id+'</td><td>'+val.portal_id+'</td><td>'+val.partner_name+'</td><td>'+status+'</td><td>'+crdt+'</td><td>'+actn+'</td></tr>');
                });
                
                //$('#dist').html('<option value="">Select District</option>');
                $.each(res.dists, function (k,v) {
                    $("#dist").append('<option value="' + v.id + '">' + v.name + '</option>');
                });
                $("#dist").selectpicker("refresh");
                $('.bs-select-all').html("All");
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // filter with state and district
    $("#dist").on('change', function () {
        var distid = $("#dist").val();
        var statid = $("#state").val();
        $("#pinfos").html('');
        $("#pgn").html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('partner.statedist') }}",
            type: "POST",
            data: {
                statid: statid,
                distid: distid,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (resp) {
                var tdr = '<thead><tr><td>ID</td><td>Portal ID</td><td>Name</td><td>Status</td><td>Created Dt</td><td>Action</td></tr></thead>';
                $("#pinfos").append(tdr);
                $.each(resp.infos, function (key, val) {
                    var crdt = new Date(val.created_at).toLocaleDateString();
                    if (val.status == 'y') {
                        status = 'Active';
                        actn = '<a href="partner-view/'+val.partner_id+'" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>';
                    } else if (val.status == 'n') {
                        status = 'Inactive';
                        actn = '<a href="partner-view/'+val.partner_id+'" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>&nbsp;<button onclick="acceptPartner('+"'"+val.partner_name+"'"+','+val.partner_id+','+"'d'"+')" class="btn btn-dark btn-sm"><i class="bi bi-trash"></i></button>';
                    } else if (val.status == 'p') {
                        status = 'Pending';
                        actn = '<button onclick="acceptPartner('+"'"+val.partner_name+"'"+','+val.partner_id+','+"'y'"+')" class="btn btn-success btn-sm"><i class="bi bi-hand-thumbs-up-fill"></i></button>&nbsp;<button onclick="acceptPartner('+"'"+val.partner_name+"'"+','+val.partner_id+','+"'n'"+')" class="btn btn-danger btn-sm"><i class="bi bi-hand-thumbs-down-fill"></i></button>';
                    } else {
                        status = 'Deleted';
                    }
                    $("#pinfos").append('<tr><td>'+val.partner_id+'</td><td>'+val.portal_id+'</td><td>'+val.partner_name+'</td><td>'+status+'</td><td>'+crdt+'</td><td>'+actn+'</td></tr>');
                });
                console.log(resp);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // Filter by state, district and Orgtype
    $("#orgtype").on('change', function() {
        var org = $("#orgtype").val();
        var distid = $("#dist").val();
        var statid = $("#state").val();
        
        $("#pinfos").html('');
        $("#pgn").html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var pdata = [];
        if (statid != null && distid != null && org != null) {
            pdata = [{
                'org':org,
                'statid':statid,
                'distid':distid
            }];
        } else if (statid != null && distid == null && org != null) {
            pdata = [{
                'org':org,
                'statid':statid
            }];
        } else if (statid == null && distid == null && org != null) {
            pdata = [{
                'org':org
            }];
        }
        //alert(org+','+distid+','+statid);
        console.log(pdata);
        $.ajax({
            url: "{{ route('partner.orgtype') }}",
            type: "POST",
            data: {
                stid: pdata,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (res) {
                console.log(res);
                var tdr = '<thead><tr><td>ID</td><td>Portal ID</td><td>Name</td><td>Status</td><td>Created Dt</td><td>Action</td></tr></thead>';
                $("#pinfos").append(tdr);
                $.each(res.pinfos, function (key, val) {
                    if (val.status == 'y') {
                        status = 'Active';
                        actn = '<a href="partner-view/'+val.partner_id+'" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>';
                    } else if (val.status == 'n') {
                        status = 'Inactive';
                        actn = '<a href="partner-view/'+val.partner_id+'" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>&nbsp;<button onclick="acceptPartner('+"'"+val.partner_name+"'"+','+val.partner_id+','+"'d'"+')" class="btn btn-dark btn-sm"><i class="bi bi-trash"></i></button>';
                    } else if (val.status == 'p') {
                        status = 'Pending';
                        actn = '<button onclick="acceptPartner('+"'"+val.partner_name+"'"+','+val.partner_id+','+"'y'"+')" class="btn btn-success btn-sm"><i class="bi bi-hand-thumbs-up-fill"></i></button>&nbsp;<button onclick="acceptPartner('+"'"+val.partner_name+"'"+','+val.partner_id+','+"'n'"+')" class="btn btn-danger btn-sm"><i class="bi bi-hand-thumbs-down-fill"></i></button>';
                    } else {
                        status = 'Deleted';
                    }
                    $("#pinfos").append('<tr><td>'+val.partner_id+'</td><td>'+val.portal_id+'</td><td>'+val.partner_name+'</td><td>'+status+'</td><td>'+val.created_at+'</td><td>'+actn+'</td></tr>');
                });
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });
    </script>
</body>
</html>