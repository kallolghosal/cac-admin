@include('layouts.header')
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                @include('layouts.sidebar')
            </div>
            <div class="col py-3">
                <h4>CAC Partners Detail</h4>
                <form action="{{ route('partner.update') }}" class="form-control" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="portalid">Portal ID</label>
                            <input type="text" name="portalid" class="form-control" value="{{ $pview[0]->portal_id }}">
                        </div>
                        <div class="col">
                            <label for="partnername">Name of Partner</label>
                            <input type="text" name="partnername" class="form-control" value="{{$pview[0]->partner_name}}">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="englead">Engagement Lead</label>
                            <input type="text" name="englead" class="form-control" value="{{$pview[0]->engagement_lead}}">
                        </div>
                        <div class="col">
                            <label for="pstatus">Partner Status</label>
                            <select name="pstatus" id="" class="form-control">
                                <option value="y" {{ ($pview[0]->partner_status == 'y') ? 'selected' : '' }}>Active</option>
                                <option value="n" {{ ($pview[0]->partner_status == 'n') ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="createdat">Created At</label>
                            <input type="text" name="createdat" class="form-control" value="{{$pview[0]->created_at}}" disabled>
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
                                    @if (strpos($pview[0]->due_diligence, ',') == true)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="duedilligence[]" {{ (in_array($opv->check_val, explode(',', $pview[0]->due_diligence))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @else
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="duedilligence[]" {{ ($pview[0]->due_diligence == $opv->check_val) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div class="col">
                            <label for="">Stakeholder Type</label>
                            @foreach ($checkops as $opk=>$opv)
                                @if ($opv->check_ops == 'stakeholder_type')
                                    @if (strpos($pview[0]->stakeholder_type, ',') == true)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="stakeholdertype[]" {{ (in_array($opv->check_val, explode(',', $pview[0]->stakeholder_type))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @else
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="stakeholdertype[]" {{ ($pview[0]->stakeholder_type == $opv->check_val) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div class="col">
                            <label for="">Partner Type</label>
                            @foreach ($checkops as $opk=>$opv)
                                @if ($opv->check_ops == 'partner_type')
                                    @if (strpos($pview[0]->partner_type, ','))
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="partnertype[]" {{ (in_array($opv->check_val, explode(',', $pview[0]->partner_type))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @else
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="partnertype[]" {{ ($pview[0]->partner_type == $opv->check_val) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div class="col">
                            <label for="">Organisation Type</label>
                            @foreach ($checkops as $opk=>$opv)
                                @if ($opv->check_ops == 'org_type')
                                    @if (strpos($pview[0]->org_type, ','))
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="orgtype[]" {{ (in_array($opv->check_val, explode(',', $pview[0]->org_type))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @else
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="orgtype[]" {{ ($pview[0]->org_type == $opv->check_val) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <hr class="hr" />
                    <div class="row">
                        <div class="col">
                            <label for="">Category Type</label>
                            @foreach ($checkops as $opk=>$opv)
                                @if ($opv->check_ops == 'cat_type')
                                    @if (strpos($pview[0]->category_type, ','))
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="categorytype[]" {{ (in_array($opv->check_val, explode(',', $pview[0]->category_type))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @else
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="categorytype[]" {{ ($pview[0]->category_type == $opv->check_val) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div class="col">
                            <label for="">VP Category</label>
                            @foreach ($checkops as $opk=>$opv)
                                @if ($opv->check_ops == 'vp_cat')
                                    @if (strpos($pview[0]->vp_category, ','))
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="vpcategory[]" {{ (in_array($opv->check_val, explode(',', $pview[0]->vp_category))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @else
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="vpcategory[]" {{ ($pview[0]->vp_category == $opv->check_val) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div class="col">
                            <label for="">Primary Thematic Area</label>
                            @foreach ($checkops as $opk=>$opv)
                                @if ($opv->check_ops == 'pri_theme_area')
                                    @if (strpos($pview[0]->primary_theme, ','))
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="pritheme[]" {{ (in_array($opv->check_val, explode(',', $pview[0]->primary_theme))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @else
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="pritheme[]" {{ ($pview[0]->primary_theme == $opv->check_val) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div class="col">
                            <label for="">Secondary Thematic Area</label>
                            @foreach ($checkops as $opk=>$opv)
                                @if ($opv->check_ops == 'sec_theme_area')
                                    @if (strpos($pview[0]->secondary_theme, ','))
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="sectheme[]" {{ (in_array($opv->check_val, explode(',', $pview[0]->secondary_theme))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @else
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="sectheme[]" {{ ($pview[0]->secondary_theme == $opv->check_val) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div class="col">
                            <label for="">Founding Year</label>
                            <input type="text" name="foundingyear" class="form-control" value="{{ $pview[0]->founding_year }}">
                        </div>
                    </div>
                    <br>
                    <hr class="hr" />
                    <div class="row">
                        <div class="col">
                            <label for="addr">Address</label>
                            <textarea name="addr" id="" cols="30" rows="10" class="form-control">{{ $pview[0]->addr }}</textarea>
                        </div>
                        <div class="col">
                            <label for="dist">State</label>
                            <select name="state" id="drstate" class="form-select">
                                <option>Select State</option>
                                @foreach ($states as $state)
                                <option value="{{ $state->id }}" <?php if($state->id == $pview[0]->State) { echo 'selected'; } ?>>{{ $state->name }}</option>
                                @endforeach
                            </select>
                            <br>
                            <label for="dist">District</label>
                            <select name="drdist" id="drdist" class="form-select"></select>
                        </div>
                        <div class="col">
                            <label for="dist">POC Name</label>
                            <input type="text" name="pocname" id="" class="form-control" value="{{$pview[0]->poc_name}}">
                            <br>
                            <label for="dist">Alternate POC Name</label>
                            <input type="text" name="altpocname" id="" class="form-control" value="{{$pview[0]->alt_poc_name}}">
                            <br>
                            <label for="dist">POC Designation</label>
                            <input type="text" name="pocdesg" id="" class="form-control" value="{{$pview[0]->poc_designation}}">
                            <br>
                            <label for="dist">Website</label>
                            <input type="text" name="website" id="" class="form-control" value="{{$pview[0]->website}}">
                        </div>
                        <div class="col">
                            <label for="dist">Email</label>
                            <input type="email" name="email" id="" class="form-control" value="{{$pview[0]->Email}}">
                            <br>
                            <label for="dist">Mobile</label>
                            <input type="text" name="mobile" id="" class="form-control" value="{{$pview[0]->Mobile}}">
                            <br>
                            <label for="dist">Alternate POC Email</label>
                            <input type="email" name="altpocemail" id="" class="form-control" value="{{$pview[0]->alt_poc_email}}">
                            <br>
                            <label for="dist">Alternate POC Mobile</label>
                            <input type="text" name="altpocmobile" id="" class="form-control" value="{{$pview[0]->alt_poc_mobile}}">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="partnerbio">Partner Bio</label>
                            <textarea name="partnerbio" id="" cols="30" rows="10" class="form-control">{{$pview[0]->partner_bio}}</textarea>
                        </div>
                    </div>
                    <br>
                    <hr class="hr" />
                    <div class="row">
                        <div class="col">
                            <label for="">Node Type</label>
                            @foreach ($checkops as $opk=>$opv)
                                @if ($opv->check_ops == 'node_type')
                                    @if (strpos($pview[0]->node_type, ',') == true)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="nodetype[]" {{ (in_array($opv->check_val, explode(',',$pview[0]->node_type))) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{ $opv->check_val }}
                                            </label>
                                        </div>
                                    @else
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $opv->check_val }}" name="nodetype[]" {{ ($pview[0]->node_type == $opv->check_val) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opv->check_val }}
                                        </label>
                                    </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div class="col">
                            <label for="">Node Status</label>
                            <select class="form-select" name="nodestatus">
                                <option selected>Select Node Status</option>
                                @foreach ($checkops as $opk=>$opv)
                                    @if ($opv->check_ops == 'node_status')
                                    <option value="{{$opv->check_val}}" {{ ($pview[0]->node_status == $opv->check_val) ? 'selected' : '' }}>{{$opv->check_val}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <br>
                            <label for="">Hear About Us</label>
                            <input type="text" name="hereaboutus" class="form-control" value="{{ $pview[0]->hear_about_us }}">
                            <br>
                            <label for="">Total Reach In A Year</label>
                            <input type="text" name="reachperyear" class="form-control" value="{{ $pview[0]->reach_per_year }}">
                        </div>
                        <div class="col">
                            <label for="">Referrals</label>
                            <textarea name="referrals" id="" cols="30" rows="10" class="form-control">{{$pview[0]->referrals}}</textarea>
                            <input type="hidden" name="distname" id="distname" value="{{$pview[0]->District}}">
                            <input type="hidden" name="partnerid" value="{{$pview[0]->partner_id}}">
                        </div>
                    </div>
                    <br>
                    <hr class="hr">
                    <!-- <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" name="mou" type="checkbox" value="y" id="flexCheckDefault" required />
                                <label class="form-check-label" for="flexCheckDefault"> I agree to the <span style="color:red">MOU &amp; Charter</span></label>
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
                    </div> -->
                    <br>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Save" class="btn btn-primary"> &nbsp; <a href="{{ route('partner.info') }}" class="btn btn-primary">Cancel</a>
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
                        if (value.id == distname) {
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