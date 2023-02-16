@include('layouts.header')
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                @include('layouts.sidebar')
            </div>
            <div class="col py-3">
                <h4>CAC Partners Detail</h4>
                <table class="table table-bordered">
                @foreach ($pview as $p)
                <tr>
                    <td>Portal ID</td>
                    <td>{{$p->portal_id}}</td>
                </tr>
                <tr>
                    <td>Partner Name</td>
                    <td>{{$p->partner_name}}</td>
                </tr>
                <tr>
                    <td>Engagement Lead</td>
                    <td>{{$p->engagement_lead}}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{$p->status}}</td>
                </tr>
                <tr>
                    <td>Due Diligence</td>
                    <td>{{$p->due_diligence}}</td>
                </tr>
                <tr>
                    <td>Stakeholder Type</td>
                    <td>{{$p->stakeholder_type}}</td>
                </tr>
                <tr>
                    <td>Partner Type</td>
                    <td>{{$p->partner_type}}</td>
                </tr>
                <tr>
                    <td>Organization Type</td>
                    <td>{{$p->organization_type}}</td>
                </tr>
                <tr>
                    <td>Category Type</td>
                    <td>{{$p->category_type}}</td>
                </tr>
                <tr>
                    <td>VP Category</td>
                    <td>{{$p->vp_category}}</td>
                </tr>
                <tr>
                    <td>Primary Theme</td>
                    <td>{{$p->primary_theme}}</td>
                </tr>
                <tr>
                    <td>Secondary Theme</td>
                    <td>{{$p->secondary_theme}}</td>
                </tr>
                <tr>
                    <td>Founding Year</td>
                    <td>{{$p->founding_year}}</td>
                </tr>
                <tr>
                    <td>State</td>
                    <td>
                    @php
                        $states = App\Http\Controllers\PartnerInfoController::getStateNames($p->state);
                    @endphp

                    @foreach ($states as $state)
                        {{ $state->state }},
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td>District</td>
                    <td>
                    @php
                        $dists = App\Http\Controllers\PartnerInfoController::getDistrictNames($p->district);
                    @endphp

                    @foreach ($dists as $dist)
                        {{ $dist->district }},
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Registered Office</td>
                    <td>{{$p->registered_office}}</td>
                </tr>
                <tr>
                    <td>Communication Address</td>
                    <td>{{$p->communication_address}}</td>
                </tr>
                <tr>
                    <td>POC Name</td>
                    <td>{{$p->poc_name}}</td>
                </tr>
                <tr>
                    <td>POC Designation</td>
                    <td>{{$p->poc_designation}}</td>
                </tr>
                <tr>
                    <td>Alternate POC</td>
                    <td>{{$p->alt_poc}}</td>
                </tr>
                <tr>
                    <td>Mobile</td>
                    <td>{{$p->mobile}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{$p->email}}</td>
                </tr>
                <tr>
                    <td>Alternate POC Name</td>
                    <td>{{$p->alt_poc_name}}</td>
                </tr>
                <tr>
                    <td>Alternate POC Phone</td>
                    <td>{{$p->alt_poc_phone}}</td>
                </tr>
                <tr>
                    <td>Alternate POC Designation</td>
                    <td>{{$p->alt_poc_designation}}</td>
                </tr>
                <tr>
                    <td>Alternate POC Email</td>
                    <td>{{$p->alt_poc_email}}</td>
                </tr>
                <tr>
                    <td>Website</td>
                    <td>{{$p->website}}</td>
                </tr>
                <tr>
                    <td>Partner BIO</td>
                    <td>{{$p->partner_bio}}</td>
                </tr>
                <tr>
                    <td>Node Type</td>
                    <td>{{$p->node_type}}</td>
                </tr>
                <tr>
                    <td>Node Status</td>
                    <td>{{$p->node_status}}</td>
                </tr>
                <tr>
                    <td>Hear About Us</td>
                    <td>{{$p->hear_about_us}}</td>
                </tr>
                <tr>
                    <td>Referrals</td>
                    <td>{{$p->referrals}}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{$p->created_at}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td><a href="{{ route('partner.edit', $p->partner_id) }}" class="btn btn-primary">Edit</a> <a href="" class="btn btn-primary">Delete</a></td>
                </tr>
                @endforeach
                </table>
            </div>
        </div>

    </div>
</body>
</html>