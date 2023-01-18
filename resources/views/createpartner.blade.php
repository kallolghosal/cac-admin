@include('layouts.header')
    <div class="container">
        <div class="row flex-nowrap">
            
            <div class="col py-3">
                <h4>Add New Partner</h4>
                <form action="{{ route('add.partner') }}" class="form-control" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="partnername">Name of Partner</label>
                            <input type="text" name="partnername" class="form-control @error('partnername') is-invalid @enderror" value="{{ old('partnername') }}">
                            @error('partnername')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <hr class="hr" />
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="">Due Diligence</label>
                            @foreach ($checkops as $opk=>$opv)
                                @if ($opv->check_ops == 'due_dilligence')
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" {{ (is_array(old('duedilligence')) and in_array($opv->check_val, old('duedilligence'))) ? ' checked' : '' }} name="duedilligence[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                            @error('duedilligence')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col">
                            <label for="">Organisation Type</label>
                            @foreach ($checkops as $opk=>$opv)
                                @if ($opv->check_ops == 'org_type')
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" {{ (is_array(old('orgtype')) and in_array($opv->check_val, old('orgtype'))) ? ' checked' : '' }} name="orgtype[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                            @error('orgtype')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="">Category Type</label>
                            @foreach ($checkops as $opk=>$opv)
                                @if ($opv->check_ops == 'cat_type')
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" {{ (is_array(old('categorytype')) and in_array($opv->check_val, old('categorytype'))) ? ' checked' : '' }} name="categorytype[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                            @error('categorytype')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="">VP Category</label>
                            @foreach ($checkops as $opk=>$opv)
                                @if ($opv->check_ops == 'vp_cat')
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" {{ (is_array(old('vpcategory')) and in_array($opv->check_val, old('vpcategory'))) ? ' checked' : '' }} name="vpcategory[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                            @error('vpcategory')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <hr class="hr" />
                    <div class="row">
                        
                        <div class="col">
                            <label for="">Primary Thematic Area</label>
                            @foreach ($checkops as $opk=>$opv)
                                @if ($opv->check_ops == 'pri_theme_area')
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" {{ (is_array(old('pritheme')) and in_array($opv->check_val, old('pritheme'))) ? ' checked' : '' }} name="pritheme[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                            @error('pritheme')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="">Secondary Thematic Area</label>
                            @foreach ($checkops as $opk=>$opv)
                                @if ($opv->check_ops == 'sec_theme_area')
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" {{ (is_array(old('sectheme')) and in_array($opv->check_val, old('sectheme'))) ? ' checked' : '' }} name="sectheme[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                            @error('sectheme')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="">Founding Year</label>
                            <input type="text" name="foundingyear" class="form-control">
                        </div>
                    </div>
                    <br>
                    <hr class="hr" />
                    <div class="row">
                        <div class="col">
                            <label for="addr">Address</label>
                            <textarea name="addr" id="" cols="30" rows="10" class="form-control @error('addr') is-invalid @enderror"></textarea>
                            @error('addr')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="state">State</label>
                            <select name="state" id="drstate" class="form-select @error('state') is-invalid @enderror">
                                <option>Select State</option>
                                @foreach ($states as $state)
                                <option value="{{ $state->id }}" {{ old('state') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                @endforeach
                            </select>
                            @error('state')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                            <br>
                            <label for="dist">District</label>
                            <select name="drdist" id="drdist" class="form-select @error('state') is-invalid @enderror"></select>
                            @error('drdist')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="dist">POC Name</label>
                            <input type="text" name="pocname" id="" class="form-control @error('pocname') is-invalid @enderror">
                            <br>
                            <label for="dist">Alternate POC Name</label>
                            <input type="text" name="altpocname" id="" class="form-control">
                            <br>
                            <label for="dist">POC Designation</label>
                            <input type="text" name="pocdesg" id="" class="form-control">
                            <br>
                            <label for="dist">Website</label>
                            <input type="text" name="website" id="" class="form-control">
                        </div>
                        <div class="col">
                            <label for="dist">Email</label>
                            <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                            <br>
                            <label for="dist">Mobile</label>
                            <input type="text" name="mobile" id="" class="form-control @error('mobile') is-invalid @enderror">
                            @error('mobile')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                            <br>
                            <label for="dist">Alternate POC Email</label>
                            <input type="email" name="altpocemail" id="" class="form-control">
                            <br>
                            <label for="dist">Alternate POC Mobile</label>
                            <input type="text" name="altpocmobile" id="" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="partnerbio">Partner Bio</label>
                            <textarea name="partnerbio" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <br>
                    <hr class="hr" />
                    <div class="row">
                        <div class="col">
                            <label for="">Node Type</label>
                            @foreach ($checkops as $opk=>$opv)
                                @if ($opv->check_ops == 'node_type')
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="nodetype[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="col">
                            <label for="">Node Status</label>
                            <select class="form-select" name="nodestatus">
                                <option selected>Select Node Status</option>
                                @foreach ($checkops as $opk=>$opv)
                                    @if ($opv->check_ops == 'node_status')
                                    <option value="{{$opv->check_val}}">{{$opv->check_val}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <br>
                            <label for="">Hear About Us</label>
                            <input type="text" name="hereaboutus" class="form-control">
                            <br>
                            <label for="">Total Reach In A Year</label>
                            <input type="text" name="reachperyear" class="form-control">
                        </div>
                        <div class="col">
                            <label for="">Referrals</label>
                            <textarea name="referrals" id="" cols="30" rows="10" class="form-control"></textarea>
                            <input type="hidden" name="distname" id="distname">
                            <input type="hidden" name="partnerid">
                        </div>
                    </div>
                    <br>
                    <hr class="hr">
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" name="mou" type="checkbox" value="y" id="flexCheckDefault" required />
                                <label class="form-check-label" for="flexCheckDefault">I agree to the <span style="color:red">MOU &amp; Charter</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" name="consent" type="checkbox" value="y" id="flexCheckDefault" required />
                                <label class="form-check-label" for="flexCheckDefault">I/We hereby declare that I/we neither support nor are associated with any act which promotes: 1. Human trafficking; 2. Smoking / Chewing tobacco; 3. Violence / terrorism 4. Child labour / Child Marriage 5. Discrimination based color, race, religion, caste, disability & sexual orientation 6. Mining 7. Terrorism 8. Abortion counselling referrals, advocate to decriminalise abortion or expand abortion services.</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Save" class="btn btn-primary"> &nbsp; <a href="" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            // State on function
            $("#drstate").on('change', function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var stateName = this.value;
                $("#drdist").html('');
                $.ajax({
                    url: "{{ url('get-district') }}",
                    type: "POST",
                    data: {
                        state_id: stateName,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        //alert(res.cities[0].name);
                        $('#drdist').html('<option value="">Select District</option>');
                        $.each(res.cities, function (key, value) {
                            $("#drdist").append('<option value="' + value.id + '">' + value.name + '</option>');
                            //console.log(value);
                        });
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // Load districts of selected state
            var stateId = $("#drstate").find(":selected").val();
            var distname = $("#distname").val();
            //alert(distname);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('get-district') }}",
                type: "POST",
                data: {
                    state_id: stateId,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    //alert(res.cities[0].name);
                    $('#drdist').html('<option value="">Select District</option>');
                    $.each(res.cities, function (key, value) {
                        if (value.name == distname) {
                            $("#drdist").append('<option value="' + value.id + '" selected="selected">' + value.name + '</option>');
                        } else {
                            $("#drdist").append('<option value="' + value.id + '" >' + value.name + '</option>');
                        }
                        //console.log(value);
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