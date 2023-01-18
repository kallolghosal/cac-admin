@include('layouts.header')
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                @include('layouts.sidebar')
            </div>
            <div class="col py-3">
                <h4>Active CAC Partners</h4>
                <br>
                <div class="row">
                    <h5>Filter By</h5>
                    <div class="col">
                        <label for="state">State</label>
                        <select name="state" id="state" class="form-select">
                            <option value='' selected>Select State</option>
                            @foreach ($states as $state)
                            <option value="{{$state->id}}">{{$state->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="dist">District</label>
                        <select name="dist" id="dist" class="form-select">
                            <option value='' selected>Select District</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="org">Organisation Type</label>
                        <select name="orgtype" id="orgtype" class="form-select">
                            <option value='' selected>Select Organisation Type</option>
                            @foreach ($orgtype as $checkop)
                            <option value="{{$checkop->check_val}}">{{$checkop->check_val}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col"></div>
                </div>
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
                    <td>{{$partner->partner_status}}</td>
                    <td>{{$partner->created_at}}</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('partner.view', $partner->partner_id) }}">View</a> 
                        <button id="btnDelete" onclick="deletePartner('{{$partner->partner_name}}')" class="btn btn-sm btn-primary">Delete</button>
                    </td>
                    </tr>
                    @endforeach
                </table>
                {!! $partners->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>

    </div>

    <script>
    function deletePartner (pname) {
        //alert(pname);
        if (confirm("Do you really want to delete " + pname + "?")) {
            alert(pname +' deleted successfully');
        }
    }

    // filter with state and load district
    $("#state").on('change', function() {
        var state = $("#state").val();
        //alert(state);
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
            //url: 'partner-state/' + state,
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
                $.each(res.pinfos, function (key, val) {
                    $("#pinfos").append('<tr><td>'+val.partner_id+'</td><td>'+val.portal_id+'</td><td>'+val.partner_name+'</td><td>'+val.partner_status+'</td><td>'+val.created_at+'</td><td><a href="partner-view/'+val.partner_id+'" class="btn btn-primary btn-sm">edit</a></td></tr>');
                });
                
                $('#dist').html('<option value="">Select District</option>');
                $.each(res.dists, function (k,v) {
                    $("#dist").append('<option value="' + v.id + '">' + v.name + '</option>');
                });
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
                    $("#pinfos").append('<tr><td>'+val.partner_id+'</td><td>'+val.portal_id+'</td><td>'+val.partner_name+'</td><td>'+val.partner_status+'</td><td>'+val.created_at+'</td><td><a href="partner-view/'+val.partner_id+'" class="btn btn-primary btn-sm">edit</a></td></tr>');
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
        if (statid != '' && distid != '' && org != '') {
            pdata = [{
                'org':org,
                'statid':statid,
                'distid':distid
            }];
        } else if (statid != '' && distid == '' && org != '') {
            pdata = [{
                'org':org,
                'statid':statid
            }];
        } else if (statid == '' && distid == '' && org != '') {
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
                    $("#pinfos").append('<tr><td>'+val.partner_id+'</td><td>'+val.portal_id+'</td><td>'+val.partner_name+'</td><td>'+val.partner_status+'</td><td>'+val.created_at+'</td><td><a href="partner-view/'+val.partner_id+'" class="btn btn-primary btn-sm">edit</a></td></tr>');
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