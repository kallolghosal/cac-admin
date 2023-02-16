@include('layouts.header')
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                @include('layouts.sidebar')
            </div>
            <div class="col py-3">
                <h4>Partner Settings - Check Options</h4>
                <div class="row">
                    <div class="col">
                        <select name="cops" id="opsid" class="form-control">
                            <option value="all" selected>All Options</option>
                            @foreach ($checkops as $k=>$v)
                            <option value="{{ $v->check_ops }}">{{ $v->check_ops }}</option>
                            @endforeach
                        </select>
                        <br>
                        <table class="table table-bordered" id="tblops">
                            <thead>
                                <tr>
                                    <td>Option Type</td>
                                    <td>Option Value</td>
                                </tr>
                            </thead>
                            @foreach ($allops as $ak=>$av)
                            <tr>
                                <td>{{ $av->check_ops }}</td>
                                <td>{{ $av->check_val }}</td>
                            </tr>
                            @endforeach
                        </table>
                        <div id="pgn">{!! $allops->withQueryString()->links('pagination::bootstrap-5') !!}</div>
                    </div>
                    <div class="col">
                        <h4>Add New Options</h4>
                        <form action="{{ route('add.option') }}" method="post">
                            @csrf
                            <label for="cops">Select Option Name</label>
                            <select name="cops" class="form-control">
                                <option selected>Select Option</option>
                                @foreach ($checkops as $k=>$v)
                                <option value="{{ $v->check_ops }}">{{ $v->check_ops }}</option>
                                @endforeach
                            </select>
                            @error('check_ops')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                            <br>
                            <label for="opval">Enter Option Value</label>
                            <input type="text" name="opval" class="form-control">
                            @error('check_val')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                            <br>
                            <input type="submit" name="submit" value="Add Option" class="btn btn-primary">
                        </form>
                        @if (session('message'))
                            <h4>{{ session('message') }}</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $("#opsid").on('change', function() {
            var opsid = $("#opsid").val();
            //alert(opsid);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if (opsid !== 'all') {
                $("#pgn").html('');
            }

            $("#tblops").html('');
            $.ajax({
                url: "{{ url('opsFilter') }}",
                type: "POST",
                data: {
                    check_ops: opsid,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    var tdr = '<thead><tr><td>Option Type</td><td>Option Value</td></tr></thead>';
                    $("#tblops").append(tdr);
                    $.each(res.opvs, function (key, value) {
                        $("#tblops").append('<tr><td>' + value.check_ops + '</td><td>' + value.check_val + '</td></tr>');
                        console.log(value);
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