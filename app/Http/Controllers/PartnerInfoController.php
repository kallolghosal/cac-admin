<?php

namespace App\Http\Controllers;

use App\Models\PartnerInfo;
use App\Models\PartnerAddr;
use App\Models\PartnerDesc;
use App\Models\PartnerType;
use App\Models\CheckOps;
use App\Models\PartnerMaster;
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
        $partners = PartnerMaster::paginate(10);
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
        $pMaster = new PartnerMaster;

        $validatefields = $request->validate([
            'partnername' => 'required',
            'duedilligence' => 'required',
            'orgtype' => 'required',
            'categorytype' => 'required',
            'vpcategory' => 'required',
            'pritheme' => 'required',
            'sectheme' => 'required',
            'addr' => 'required',
            'regoffice' => 'required',
            'drdist' => 'required',
            'state' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'mou' => 'required',
            'consent' => 'required'
        ],[
            'partnername.required' => 'Please enter name of partner',
            'duedilligence.required' => 'Please select Due Diligence',
            'orgtype.required' => 'Please select Organisation Type',
            'categorytype.required' => 'Please select Category Type',
            'vpcategory.required' => 'Please select VP Category',
            'pritheme.required' => 'Please select Primary Theme',
            'sectheme.required' => 'Please select Secondary Theme',
            'addr.required' => 'Please enter Communication Address',
            'regoffice.required' => 'Please enter Registered Office Address',
            'drdist.required' => 'Please select District',
            'state.required' => 'Please select State',
            'email.required' => 'Please enter Email',
            'mobile.required' => 'Please enter Mobile number'
        ]);

        $pMaster->partner_name = $request->partnername;
        $pMaster->due_diligence = implode(',',$request->duedilligence);
        $pMaster->organization_type = implode(',',$request->orgtype);
        $pMaster->category_type = implode(',',$request->categorytype);
        $pMaster->vp_category = implode(',',$request->vpcategory);
        $pMaster->primary_theme = implode(',',$request->pritheme);
        $pMaster->secondary_theme = implode(',',$request->sectheme);
        $pMaster->founding_year = $request->foundingyear;
        $pMaster->communication_address = $request->addr;
        $pMaster->registered_office = $request->regoffice;
        $pMaster->district = implode(',', $request->drdist);
        $pMaster->state = implode(',', $request->state);
        $pMaster->poc_name = $request->pocname;
        $pMaster->poc_designation = $request->pocdesg;
        $pMaster->alt_poc_designation = $request->altpocdesg;
        $pMaster->mobile = $request->mobile;
        $pMaster->email = $request->email;
        $pMaster->alt_poc_name = $request->altpocname;
        $pMaster->alt_poc_email = $request->altpocemail;
        $pMaster->alt_poc_phone = $request->altpocmobile;
        $pMaster->website = $request->website;
        $pMaster->partner_bio = $request->partnerbio;
        $pMaster->reach_per_year = $request->reachperyear;
        $pMaster->hear_about_us = $request->hereaboutus;
        $pMaster->referrals = $request->referrals;
        $pMaster->mou_charter = $request->mou;
        $pMaster->consent = $request->consent;
        $pMaster->save();

        return \Redirect::route('new.partner');
        //return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PartnerInfo  $partnerInfo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partner = PartnerMaster::where('partner_id', $id)->get();
        return view('auth.partnerview', ['pview' => $partner]);
    }

    /**
     * Method to show comma separated
     * names of states in partner-view page
     */
    public static function getStateNames ($ids) {
        $ids = explode(',', $ids);
        $stnames = State::select(DB::raw('CONCAT(name) as state'))->whereIn('id', $ids)->get();
        return $stnames;
    }

    /**
     * Method to show comma separated
     * names of districts in partner-view page
     */
    public static function getDistrictNames ($ids) {
        $ids = explode(',', $ids);
        $distnames = City::select(DB::raw('CONCAT(name) as district'))->whereIn('id', $ids)->get();
        return $distnames;
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
            $partner = PartnerMaster::where('partner_id', $id)->get();
            $states = State::get();
            $checkops = CheckOps::get();
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
            $partnerMaster = new PartnerMaster;

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

            if ($req->pritheme == '') {
                $pritheme = '';
            } else {
                $pritheme = implode(',', $req->pritheme);
            }

            if ($req->sectheme == '') {
                $sectheme = '';
            } else {
                $sectheme = implode(',', $req->sectheme);
            }

            if ($req->nodetype == '') {
                $nodetype = '';
            } else {
                $nodetype = implode(',', $req->nodetype);
            }

            $partnerMaster
                ->where('partner_id', $req->partnerid)
                ->update([
                    'partner_name' => $req->partnername, 
                    'engagement_lead' => $req->englead, 
                    'status' => $req->pstatus,
                    'portal_id' => $req->portalid,
                    'due_diligence' => implode(',',$req->duedilligence), 
                    'stakeholder_type' => $stakeholdertype, 
                    'partner_type' => $partnertypadata, 
                    'organization_type' => implode(',',$req->orgtype), 
                    'category_type' => implode(',',$req->categorytype),
                    'vp_category' => implode(',',$req->vpcategory), 
                    'primary_theme' => $pritheme, 
                    'secondary_theme' => $sectheme, 
                    'founding_year' => $req->foundingyear,
                    'registered_office' => $req->regoffice,
                    'communication_address' => $req->commaddr,
                    'district' => implode(',',$req->drdist),
                    'state' => implode(',',$req->state),
                    'poc_name' => $req->pocname,
                    'poc_designation' => $req->pocdesg,
                    'alt_poc' => $req->altpoc,
                    'mobile' => $req->mobile,
                    'email' => $req->email,
                    'alt_poc_name' => $req->altpocname,
                    'alt_poc_email' => $req->altpocemail,
                    'alt_poc_phone' => $req->altpocmobile,
                    'alt_poc_designation' => $req->altpocdesig,
                    'website' => $req->website,
                    'partner_bio' => $req->partnerbio,
                    'node_type' => $nodetype,
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
    public function destroy(PartnerMaster $partnerMaster)
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
        $data['pinfos'] = PartnerMaster::whereIn('state', $request->stid)->get();
        $data['dists'] = City::whereIn('state_id', $request->stid)->get();
        return response()->json($data);
    }

    public function orgFilter (Request $request) {
        $data = [];
        if (array_key_exists('statid', $request->stid[0]) && array_key_exists('distid', $request->stid[0]) && array_key_exists('org', $request->stid[0])) {
            $data['pinfos'] = PartnerMaster::where('state', $request->stid[0]["statid"])->where('district', $request->stid[0]["distid"])->where('organization_type', $request->stid[0]['org'])->get();
        } else if (array_key_exists('statid', $request->stid[0]) && array_key_exists('org', $request->stid[0])) {
            $data['pinfos'] = PartnerMaster::where('state', $request->stid[0]["statid"])->where('organization_type', $request->stid[0]['org'])->get();
        } else if (array_key_exists('org', $request->stid[0])) {
            $data['pinfos'] = PartnerMaster::where('organization_type', $request->stid[0]['org'])->get();
        }
        
        return response()->json($data);
    }

    public function stateDistFilter (Request $request) {
        $data['infos'] = PartnerMaster::where('state', $request->statid)->where('district', $request->distid)->get();
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
        $partners = PartnerMaster::where('status', 'y')->paginate(10);
        $states = State::get();
        $checkops = CheckOps::where('check_ops', 'org_type')->get();
        return view('auth.activepartner', ['partners' => $partners, 'states' => $states, 'orgtype' => $checkops]);
    }

    public function inactivePartners () {
        $partners = PartnerMaster::where('status', 'p')->paginate(10);
        return view('auth.inactivepartner', ['partners' => $partners]);
    }

    public function registeredPartners () {
        $partners = PartnerMaster::paginate(10);
        return view('auth.registeredpartner', ['partners' => $partners]);
    }

    /**
     * Method to filter partner data with status
     * 
     * Return json data
     */
    public function statusFilter (Request $req) {
        $data['pinfos'] = PartnerMaster::where('status', $req->status)->get();
        return response()->json($data);
    }

    /**
     * Method to update status
     * 
     * from partnerinfo page
     */
    public function statusAction (Request $request) {
        $pstatus = PartnerMaster::where('partner_id', $request->pid)->update([
            'status' => $request->act
        ]);
        return response()->json(['accept' => 'Partner status updated successfully']);
    }

    /**
     * Method to update partner status from partner-listing page
     * 
     * using ajax request
     */
    public function updateStatus (Request $request) {
        $partners = PartnerMaster::where('partner_id', $request->id)->update([
            'status' => $request->status
        ]);
        return response()->json('success', 'Partner status updated successfully');
    }
}
