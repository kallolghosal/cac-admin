@include('layouts.header')
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                @include('layouts.sidebar')
            </div>
            <div class="col py-3">
                <h4>CAC Partners Detail</h4>
                @empty ($pview[0])
                <p>Empty dataset</p>
                @else
                <table class="table table-bordered">
                @foreach ($pview[0] as $k=>$v)
                @if ($k == 'partner_id')
                @continue
                @endif
                <tr>
                    <td>{{$k}}</td>
                    <td>{{$v}}</td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td><a href="{{ route('partner.edit', $pview[0]->partner_id) }}" class="btn btn-primary">Edit</a> <a href="" class="btn btn-primary">Delete</a></td>
                </tr>
                </table>
                @endempty
            </div>
        </div>

    </div>
</body>
</html>