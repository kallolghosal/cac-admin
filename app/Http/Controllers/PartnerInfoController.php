<?php

namespace App\Http\Controllers;

use App\Models\PartnerInfo;
use App\Models\PartnerAddr;
use App\Models\PartnerDesc;
use App\Models\PartnerType;
use App\Models\CheckOps;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class PartnerInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = PartnerInfo::paginate(10);
        $states = State::get();
        $checkops = CheckOps::where('check_ops', 'org_type')->get();
        return view('auth.partnerinfo', ['partners' => $partners, 'states' => $states, 'orgtype' => $checkops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $checkops = CheckOps::get();
        $states = State::get();
        return view('createpartner', ['checkops' => $checkops, 'states' => $states]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $partnerInfo = new PartnerInfo;
        // $partnertype = new PartnerType;
        // $partneraddr = new PartnerAddr;
        // $partnerdesc = new PartnerDesc;

        // $validatefields = $request->validate([
        //     'partnername' => 'required',
        //     'duedilligence' => 'required',
        //     'orgtype' => 'required',
        //     'categorytype' => 'required',
        //     'vpcategory' => 'required',
        //     'pritheme' => 'required',
        //     'addr' => 'required',
        //     'drdist' => 'required',
        //     'state' => 'required',
        //     'email' => 'required',
        //     'mobile' => 'required',
        //     'mou' => 'required',
        //     'consent' => 'required'
        // ],[
        //     'partnername.required' => 'Please enter name of partner',
        //     'duedilligence.required' => 'Please select Due Diligence',
        //     'orgtype.required' => 'Please select Organisation Type',
        //     'categorytype.required' => 'Please select Category Type',
        //     'vpcategory.required' => 'Please select VP Category',
        //     'pritheme.required' => 'Please select Primary Theme',
        //     'addr.required' => 'Please enter Address',
        //     'drdist.required' => 'Please select District',
        //     'state.required' => 'Please select State',
        //     'email.required' => 'Please enter Email',
        //     'mobile.required' => 'Please enter Mobile number'
        // ]);

        // $partnerInfo->partner_name = $request->partnername;
        // $partnerInfo->save();

        // $partnerid = $partnerInfo->id;

        // $partnertype->partner_id = $partnerid;
        // $partnertype->due_diligence = implode(',',$request->duedilligence);
        // $partnertype->org_type = implode(',',$request->orgtype);
        // $partnertype->category_type = implode(',',$request->categorytype);
        // $partnertype->vp_category = implode(',',$request->vpcategory);
        // $partnertype->primary_theme = implode(',',$request->pritheme);
        // $partnertype->secondary_theme = implode(',',$request->sectheme);
        // $partnertype->founding_year = $request->foundingyear;
        // $partnertype->save();

        // $partneraddr->partner_id = $partnerid;
        // $partneraddr->addr = $request->addr;
        // $partneraddr->district = implode(',', $request->drdist);
        // $partneraddr->state = implode(',', $request->state);
        // $partneraddr->poc_name = $request->pocname;
        // $partneraddr->poc_designation = $request->pocdesg;
        // $partneraddr->mobile = $request->mobile;
        // $partneraddr->email = $request->email;
        // $partneraddr->alt_poc_name = $request->altpocname;
        // $partneraddr->alt_poc_email = $request->altpocemail;
        // $partneraddr->alt_poc_mobile = $request->altpocmobile;
        // $partneraddr->website = $request->website;
        // $partneraddr->partner_bio = $request->partnerbio;
        // $partneraddr->save();

        // $partnerdesc->partner_id = $partnerid;
        // $partnerdesc->node_type = implode(',', $request->nodetype);
        // $partnerdesc->node_status = $request->nodestatus;
        // $partnerdesc->reach_per_year = $request->reachperyear;
        // $partnerdesc->hear_about_us = $request->hereaboutus;
        // $partnerdesc->referrals = $request->referrals;
        // $partnerdesc->mou_charter = $request->mou;
        // $partnerdesc->consent = $request->consent;
        // $partnerdesc->save();

        // return \Redirect::route('new.partner');
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PartnerInfo  $partnerInfo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check()) {
            //$partner = DB::table('partnerinfos')->where('partner_id', $id)->get();
            $partner = DB::table('partnerinfos')
                                ->join('partner_types', 'partnerinfos.partner_id', '=', 'partner_types.partner_id')
                                ->join('partner_addrs', 'partnerinfos.partner_id', '=', 'partner_addrs.partner_id')
                                ->join('partner_desc', 'partnerinfos.partner_id', '=', 'partner_desc.partner_id')
                                ->select('partnerinfos.partner_id', 'partnerinfos.portal_id as Portal ID', 'partnerinfos.partner_name as Partner Name', 'partnerinfos.engagement_lead as Engagement Lead', 'partnerinfos.partner_status as Status', 'partnerinfos.created_at as Created At', 
                                'partner_types.due_diligence as Due Diligence', 'partner_types.stakeholder_type as Stakeholder Type', 'partner_types.partner_type as Partner Type', 'partner_types.org_type as Organisation Type', 'partner_types.category_type as Category Type', 'partner_types.vp_category as VP Category', 'partner_types.primary_theme as Primary Theme', 'partner_types.secondary_theme as Secondary Theme', 'partner_types.founding_year as Founding Year', 
                                'partner_addrs.addr as Address', 'partner_addrs.district as District', 'partner_addrs.state as State', 'partner_addrs.poc_name as POC Name', 'partner_addrs.poc_designation as POC Designation', 'partner_addrs.mobile as Mobile', 'partner_addrs.email as Email', 'partner_addrs.alt_poc_name as Alternate POC Name', 'partner_addrs.alt_poc_email as Alternate POC Email', 'partner_addrs.alt_poc_mobile as Alternate POC Mobile', 'partner_addrs.website as Website', 'partner_addrs.partner_bio as Partner BIO', 
                                'partner_desc.node_type as Node Type', 'partner_desc.node_status as Node Status', 'partner_desc.reach_per_year as Reach Per Year', 'partner_desc.hear_about_us as Here About Us', 'partner_desc.referrals as Referrals', 'partner_desc.mou_charter as MOU Charter')
                                ->where('partnerinfos.partner_id', $id)
                                ->get();
            return view('auth.partnerview', ['pview' => $partner]);
        }
        return redirect("login")->withErrors('Please login to see the page');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PartnerInfo  $partnerInfo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()) {
            $partner = DB::table('partnerinfos')
                                ->join('partner_types', 'partnerinfos.partner_id', '=', 'partner_types.partner_id')
                                ->join('partner_addrs', 'partnerinfos.partner_id', '=', 'partner_addrs.partner_id')
                                ->join('partner_desc', 'partnerinfos.partner_id', '=', 'partner_desc.partner_id')
                                ->select('partnerinfos.partner_id', 'partnerinfos.portal_id', 'partnerinfos.partner_name', 'partnerinfos.engagement_lead', 'partnerinfos.partner_status', 'partnerinfos.created_at', 
                                'partner_types.due_diligence', 'partner_types.stakeholder_type', 'partner_types.partner_type', 'partner_types.org_type', 'partner_types.category_type', 'partner_types.vp_category', 'partner_types.primary_theme', 'partner_types.secondary_theme', 'partner_types.founding_year', 
                                'partner_addrs.addr', 'partner_addrs.district as District', 'partner_addrs.state as State', 'partner_addrs.poc_name', 'partner_addrs.poc_designation', 'partner_addrs.mobile as Mobile', 'partner_addrs.email as Email', 'partner_addrs.alt_poc_name', 'partner_addrs.alt_poc_email', 'partner_addrs.alt_poc_mobile', 'partner_addrs.website', 'partner_addrs.partner_bio', 
                                'partner_desc.node_type', 'partner_desc.node_status', 'partner_desc.reach_per_year', 'partner_desc.hear_about_us', 'partner_desc.referrals', 'partner_desc.mou_charter as MOU Charter')
                                ->where('partnerinfos.partner_id', $id)
                                ->get();
            $states = DB::table('states')->get();
            $checkops = DB::table('check_ops')->get();
            return view('auth.partneredit')->with('pview', $partner)->with('states', $states)->with('checkops', $checkops);
        }
        return redirect("login")->withErrors('Please login to see the page');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PartnerInfo  $partnerInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        if (Auth::check()) {
            $partnerInfo = new PartnerInfo;
            $partnertype = new PartnerType;
            $partneraddr = new PartnerAddr;
            $partnerdesc = new PartnerDesc;

            $partnerInfo
                ->where('partner_id', $req->partnerid)
                ->update([
                    'partner_name' => $req->partnername, 
                    'engagement_lead' => $req->englead, 
                    'partner_status' => $req->pstatus,
                    'portal_id' => $req->portalid
                ]);

            if ($req->stakeholdertype == '') {
                $stakeholdertype = '';
            } else {
                $stakeholdertype = implode(',',$req->stakeholdertype);
            }

            if ($req->partnertype == '') {
                $partnertypadata = '';
            } else {
                $partnertypadata = implode(',',$req->partnertype);
            }
            $partnertype
                ->where('partner_id', $req->partnerid)
                ->update([
                    'due_diligence' => implode(',',$req->duedilligence), 
                    'stakeholder_type' => $stakeholdertype, 
                    'partner_type' => $partnertypadata, 
                    'org_type' => implode(',',$req->orgtype), 
                    'category_type' => implode(',',$req->categorytype),
                    'vp_category' => implode(',',$req->vpcategory), 
                    'primary_theme' => implode(',',$req->pritheme), 
                    'secondary_theme' => implode(',',$req->sectheme), 
                    'founding_year' => $req->foundingyear
                ]);

            $partneraddr
                ->where('partner_id', $req->partnerid)
                ->update([
                    'addr' => $req->addr,
                    'district' => $req->drdist,
                    'state' => $req->state,
                    'poc_name' => $req->pocname,
                    'poc_designation' => $req->pocdesg,
                    'mobile' => $req->mobile,
                    'email' => $req->email,
                    'alt_poc_name' => $req->altpocname,
                    'alt_poc_email' => $req->altpocemail,
                    'alt_poc_mobile' => $req->altpocmobile,
                    'website' => $req->website,
                    'partner_bio' => $req->partnerbio
                ]);

            $partnerdesc
                ->where('partner_id', $req->partnerid)
                ->update([
                    'node_type' => implode(',',$req->nodetype),
                    'node_status' => $req->nodestatus,
                    'reach_per_year' => $req->reachperyear,
                    'hear_about_us' => $req->hereaboutus,
                    'referrals' => $req->referrals
                ]);

            return \Redirect::route('partner.edit',$req->partnerid);
        } else {
            return redirect("login")->withErrors('Please login to see the page');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PartnerInfo  $partnerInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(PartnerInfo $partnerInfo)
    {
        //
    }

    public function getState() {
        $data['states'] = State::get(['id', 'name']);
        return view('auth.partneredit', $data);
    }

    /**
     * Method to load list of districts in create-partner page
     * for multiselect dropdown list
     */
    public function getDistrict(Request $request) {
        $data['cities'] = City::whereIn('state_id', $request->state_id)->get();
        return response()->json($data);
        //return $request;
    }

    /**
     * Method to load list of districts in partner-edit page
     * 
     * with selected district
     */
    public function getDistrictList (Request $request) {
        $data['cities'] = City::where('state_id', $request->state_id)->get();
        return response()->json($data);
    }

    public function newpartner () {
        return view('newpartner');
    }

    public function partnerSettings () {
        $checkops = DB::table('check_ops')->select('check_ops')->groupby('check_ops')->get();
        $allops = DB::table('check_ops')->paginate(10);
        return view('auth.partnerSettings', ['checkops' => $checkops, 'allops' => $allops]);
    }

    public function opsFilter (Request $request) {
        if ($request->check_ops == 'all') {
            $opsvals['opvs'] = DB::table('check_ops')->get();
        } else {
            $opsvals['opvs'] = DB::table('check_ops')->where('check_ops', $request->check_ops)->get();
        }
        
        return response()->json($opsvals);
    }

    public function addOption (Request $req) {

        $validateOptions = $req->validate([
            'cops' => 'required',
            'opval' => 'required'
        ],[
            'cops.required' => 'Please select option name',
            'opval.required' => 'Please enter option value'
        ]);

        $addOps = DB::table('check_ops')->insert([
            'check_ops' => $req->cops,
            'check_val' => $req->opval
        ]);

        return \Redirect::route('partner.settings')->with(['message' => 'Option added successfully']);
        //return $req;
    }

    public function filterState (Request $request) {
        $data['pinfos'] = DB::table('partnerinfos')->join('partner_addrs', 'partnerinfos.partner_id', '=', 'partner_addrs.partner_id')
            ->select('partnerinfos.*')->where('partner_addrs.state', $request->stid)->get();
        
        $data['dists'] = City::where('state_id', $request->stid)->get();
        return response()->json($data);
    }

    public function orgFilter (Request $request) {
        $data = [];
        if (array_key_exists('statid', $request->stid[0]) && array_key_exists('distid', $request->stid[0]) && array_key_exists('org', $request->stid[0])) {
            $data['pinfos'] = DB::table('partnerinfos')
                ->join('partner_types', 'partnerinfos.partner_id', '=', 'partner_types.partner_id')
                ->join('partner_addrs', 'partnerinfos.partner_id', '=', 'partner_addrs.partner_id')
                ->select('partnerinfos.*')
                ->where('partner_addrs.state', $request->stid[0]["statid"])
                ->where('partner_addrs.district', $request->stid[0]["distid"])
                ->whereRaw("find_in_set('".$request->stid[0]['org']."', partner_types.org_type)")
                ->get();
        } elseif (array_key_exists('statid', $request->stid[0]) && array_key_exists('org', $request->stid[0])) {
            $data['pinfos'] = DB::table('partnerinfos')
                ->join('partner_types', 'partnerinfos.partner_id', '=', 'partner_types.partner_id')
                ->join('partner_addrs', 'partnerinfos.partner_id', '=', 'partner_addrs.partner_id')
                ->select('partnerinfos.*')
                ->where('partner_addrs.state', $request->stid[0]["statid"])
                ->whereRaw("find_in_set('".$request->stid[0]['org']."', partner_types.org_type)")
                ->get();
        } elseif (array_key_exists('org', $request->stid[0])) {
            $data['pinfos'] = DB::table('partnerinfos')
                ->join('partner_types', 'partnerinfos.partner_id', '=', 'partner_types.partner_id')
                ->join('partner_addrs', 'partnerinfos.partner_id', '=', 'partner_addrs.partner_id')
                ->select('partnerinfos.*')
                ->whereRaw("find_in_set('".$request->stid[0]['org']."', partner_types.org_type)")
                ->get();
        }
        
        return response()->json($data);
    }

    public function stateDistFilter (Request $request) {
        $data['infos'] = DB::table('partnerinfos')->join('partner_addrs', 'partnerinfos.partner_id', '=', 'partner_addrs.partner_id')
            ->select('partnerinfos.*')->where([
                ['partner_addrs.state', $request->statid],
                ['partner_addrs.district', $request->distid]
            ])->get();
        return response()->json($data);
    }

    public function stateDistOrgFilter (Request $request) {
        $data['pinfos'] = DB::table('partnerinfos')
            ->join('partner_addrs', 'partnerinfos.partner_id', '=', 'partner_addrs.partner_id')
            ->join('partner_types', 'partnerinfos.partner_id', '=', 'partner_types.partner_id')
            ->select('partnerinfos.*')
            ->where([
                ['partner_addrs.state', $request->statid],
                ['partner_addrs.district', $request->distid]
            ])->whereRaw("find_in_set('$request->orgtype', partner_types.org_type)")->get();
        return response()->json($data);
    }

    public function activePartners () {
        $partners = PartnerInfo::where('partner_status', 'y')->paginate(10);
        $states = State::get();
        $checkops = CheckOps::where('check_ops', 'org_type')->get();
        return view('auth.activepartner', ['partners' => $partners, 'states' => $states, 'orgtype' => $checkops]);
    }

    public function inactivePartners () {
        $partners = PartnerInfo::where('partner_status', 'n')->paginate(10);
        return view('auth.inactivepartner', ['partners' => $partners]);
    }

    public function registeredPartners () {
        $partners = PartnerInfo::paginate(10);
        return view('auth.registeredpartner', ['partners' => $partners]);
    }

    /**
     * Method to filter partner data with status
     * 
     * Return json data
     */
    public function statusFilter (Request $req) {
        $data['pinfos'] = PartnerInfo::where('partner_status', $req->status)->get();
        return response()->json($data);
    }

    /**
     * Method to update partner status from partner-listing page
     * 
     * using ajax request
     */
    public function updateStatus (Request $request) {
        $partners = PartnerInfo::where('partner_id', $request->id)->update([
            'partner_status' => $request->status
        ]);
        return response()->json('success', 'Partner status updated successfully');
    }
}
