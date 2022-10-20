<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Residents;
use App\Models\Complain_type;
use App\Models\Complain;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Barangay_controller extends Controller
{
    public function login()
    {
        Auth::logout();
        return view('auth/login');
    }

    public function admin_dashboard()
    {
        $user = User::find(auth()->user()->id);

        if ($user->user_status == 'disabled') {
            return redirect('/')->with('error', 'Account Deactivated');
        } else {
            if ($user->user_type == 'Super_user') {
                return redirect('admin_barangay_officials_registration');
            } elseif ($user->user_type == 'Monitoring') {
                return redirect('admin_register_residents');
            } else if ($user->user_type == 'Lupon') {
                return redirect('lupon_complain');
            } else if ($user->user_type == 'Live Monitoring') {
                return redirect('admin_register_residents');
            }
        }
    }

    public function admin_user_type()
    {
        return view('admin_user_type');
    }

    public function admin_barangay_officials_registration()
    {
        $user = User::find(auth()->user()->id);
        $user_list = User::where('id', '!=', auth()->user()->id)->get();
        return view('admin_barangay_officials_registration', [
            'user_list' => $user_list,
            'user' => $user,
        ]);
    }

    public function admin_barangay_officials_registration_process(Request $request)
    {
        // return $request->input();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user_type' => ['required', 'string'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $new_user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'user_type' => $request->input('user_type'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'gender' => $request->input('gender'),
            'dob' => $request->input('dob'),
        ]);

        $new_user->save();

        return redirect()->route('admin_barangay_officials_registration')->with('success', 'Success');
    }

    public function admin_register_residents()
    {
        $user = User::find(auth()->user()->id);
        $residents = Residents::select('id', 'first_name', 'middle_name', 'last_name', 'resident_image')->get();
        return view('admin_register_residents', [
            'user' => $user,
            'residents' => $residents,
        ]);
    }

    public function admin_registration_residents_generate_number_of_childrens(Request $request)
    {
        //return $request->input();
        return view('admin_registration_residents_generate_number_of_childrens')
            ->with('number_of_childrens', $request->input('number_of_childrens'));
    }

    public function admin_register_residents_process(Request $request)
    {
        //dd($request->all());

        $validated = $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->input('father') == 'input_father_name') {
            $father_data = $request->input('specific_father_name');
        } elseif ($request->input('father' == 'N/A')) {
            $father_data = 'none';
        } else {
            $father_data = $request->input('father');
        }

        if ($request->input('mother') == 'input_father_name') {
            $mother_data = $request->input('specific_mother_name');
        } elseif ($request->input('mother' == 'N/A')) {
            $mother_data = 'none';
        } else {
            $mother_data = $request->input('mother');
        }


        $resident_image = $request->file('resident_image');
        $resident_image_name = 'resident_image-' . time() . '.' . $resident_image->getClientOriginalExtension();
        $path_resident_image = $resident_image->storeAs('public', $resident_image_name);

        $new_residents = new Residents([
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'nickname' => $request->input('nickname'),
            'dob' => $request->input('dob'),
            'place_of_birth' => $request->input('place_of_birth'),
            'zone' => $request->input('zone'),
            'sex' => $request->input('sex'),
            'father' => $father_data,
            'mother' => $mother_data,
            'nationality' => $request->input('nationality'),
            'civil_status' => $request->input('civil_status'),
            'pwd' => $request->input('pwd'),
            'pwd_description' => $request->input('pwd_description'),
            'latitude' => $request->input('longitude'),
            'longitude' => $request->input('latitude'),
            'resident_image' => $resident_image_name,
            'status' => $request->input('status'),
            'permanent_address' => $request->input('permanent_address'),
            'current_address' => $request->input('current_address'),
            'occupation' => $request->input('occupation'),
            'sub_zone' => $request->input('sub_zone'),
            'relationship_to_household_head' => $request->input('relationship_to_household_head'),
            'senior_citizen' => $request->input('senior_citizen'),
        ]);

        $new_residents->save();


        return redirect()->route('admin_register_residents')->with('success', 'Success');
    }

    public function admin_resident_list()
    {
        $user = User::find(auth()->user()->id);
        $residents = Residents::get();

        return view('admin_resident_list', [
            'user' => $user,
            'residents' => $residents,
        ]);
    }

    public function admin_resident_show_map($id)
    {
        $residents = Residents::find($id);
        $user = User::find(auth()->user()->id);

        return view('admin_resident_show_map', [
            'residents' => $residents,
            'user' => $user,
        ]);
    }

    public function admin_add_complain_type()
    {
        $user = User::find(auth()->user()->id);
        $complain_type = Complain_type::get();
        return view('admin_add_complain_type', [
            'user' => $user,
            'complain_type' => $complain_type,
        ]);
    }

    public function admin_complain_type_process(Request $request)
    {
        $new = new Complain_type([
            'complain_type' => $request->input('complain_type'),
        ]);

        $new->save();
        return redirect()->route('admin_add_complain_type')->with('success', 'Success');
    }

    public function complain_type_edit(Request $request)
    {
        Complain_type::where('id', $request->input('complain_id'))
            ->update(['complain_type' => $request->input('complain_type')]);

        return redirect()->route('admin_add_complain_type')->with('success', 'Success');
    }

    public function complain()
    {
        $user = User::find(auth()->user()->id);
        $residents = Residents::get();
        $complain_type = Complain_type::get();
        $lupon = User::where('user_type', 'Lupon')->get();
        return view('complain', [
            'user' => $user,
            'residents' => $residents,
            'complain_type' => $complain_type,
            'lupon' => $lupon,
        ]);
    }

    public function admin_resident_analytics()
    {
        $user = User::find(auth()->user()->id);

        $resident_per_zone = DB::table('residents')
            ->select('zone', DB::raw('count(*) as total'))
            ->groupBy('zone')
            ->get()
            ->toArray();



        if (count($resident_per_zone) != 0) {
            foreach ($resident_per_zone as $key => $row) {
                $resident_per_zone_label[] = $row->zone;
                $resident_per_zone_total[] = $row->total;
            }
        } else {
            $resident_per_zone_label[] = 0;
            $resident_per_zone_total[] = 0;
        }

        $resident_gender = DB::table('residents')
            ->select('sex', DB::raw('count(*) as total'))
            ->groupBy('sex')
            ->get()
            ->toArray();


        if (count($resident_gender) != 0) {
            foreach ($resident_gender as $key => $row) {
                $resident_gender_label[] = $row->sex;
                $resident_gender_total[] = $row->total;
            }
        } else {
            $resident_gender_label[] = 0;
            $resident_gender_total[] = 0;
        }

        $pwd_per_zone = Residents::selectRaw('zone, pwd, COUNT(*) as total')
            ->where('pwd', 'Yes')
            ->groupBy('zone')
            ->groupBy('pwd')
            ->get();

        if (count($pwd_per_zone) != 0) {
            foreach ($pwd_per_zone as $key => $row) {
                $pwd_per_zone_label[] = $row->zone;
                $pwd_per_zone_total[] = $row->total;
            }
        } else {
            $pwd_per_zone_label[] = 0;
            $pwd_per_zone_total[] = 0;
        }

        $resident_age_bracket = DB::table('residents')
            ->select('dob', DB::raw('count(*) as total'))
            ->groupBy('dob')
            ->get()
            ->toArray();

        if (count($resident_age_bracket) != 0) {
            foreach ($resident_age_bracket as $key => $row) {
                $resident_age_bracket_label[] = $row->dob;
                $resident_age_bracket_total[] = $row->total;
            }
        } else {
            $resident_age_bracket_label[] = 0;
            $resident_age_bracket_total[] = 0;
        }

        $complain = DB::table('complains')
            ->select('complain_status', DB::raw('count(*) as total'))
            ->groupBy('complain_status')
            ->get()
            ->toArray();

        if (count($complain) != 0) {
            foreach ($complain as $key => $row) {
                $complain_label[] = $row->complain_status;
                $complain_total[] = $row->total;
            }
        } else {
            $complain_label[] = 0;
            $complain_total[] = 0;
        }




        return view('admin_resident_analytics', [
            'user' => $user,
            'complain_label' => $complain_label,
            'complain_total' => $complain_total,
            'resident_per_zone_label' => $resident_per_zone_label,
            'resident_per_zone_total' => $resident_per_zone_total,
            'resident_gender_label' => $resident_gender_label,
            'resident_gender_total' => $resident_gender_total,
            'pwd_per_zone_label' => $pwd_per_zone_label,
            'pwd_per_zone_total' => $pwd_per_zone_total,
            'resident_age_bracket_label' => $resident_age_bracket_label,
            'resident_age_bracket_total' => $resident_age_bracket_total,
        ]);
    }

    public function admin_search_father(Request $request)
    {

        if ($request->input('father_id') == 'N/A') {
            $father_data = 'none';
        } elseif ($request->input('father_id') == 'input_father_name') {
            $father_data = 'input_father_name';
        } else {
            $father_data = Residents::find($request->input('father_id'));
        }



        return view('admin_search_father', [
            'father_data' => $father_data,
        ])->with('father_image', $request->input('father_image'));
    }

    public function admin_search_mother(Request $request)
    {
        if ($request->input('mother_id') == 'N/A') {
            $mother_data = 'none';
        } elseif ($request->input('mother_id') == 'input_father_name') {
            $mother_data = 'input_father_name';
        } else {
            $mother_data = Residents::find($request->input('mother_id'));
        }


        // return $mother_data;
        return view('admin_search_mother', [
            'mother_data' => $mother_data,
        ])->with('father_image', $request->input('mother_id'));
    }

    public function show_resident_data($id)
    {
        $resident_data = Residents::find($id);
        $user = User::find(auth()->user()->id);

        $complain_many = Complain::where('complainant', $id)
            ->orWhere('respondent', $id)
            ->orderBy('id', 'desc')
            ->get();
        

        return view('show_resident_data', [
            'resident_data' => $resident_data,
            'complain_many' => $complain_many,
            'user' => $user,
        ]);
    }

    public function resident_update_process(Request $request)
    {
        Residents::where('id', $request->input('id'))
            ->update([
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'nickname' => $request->input('nickname'),
                'dob' => $request->input('dob'),
                'place_of_birth' => $request->input('place_of_birth'),
                'sex' => $request->input('sex'),
                'nationality' => $request->input('nationality'),
                'civil_status' => $request->input('civil_status'),
                'pwd' => $request->input('pwd'),
                'pwd_description' => $request->input('pwd_description'),
                'status' => $request->input('status'),
                'permanent_address' => $request->input('permanent_address'),
                'current_address' => $request->input('current_address'),
                'zone' => $request->input('zone'),
                'occupation' => $request->input('occupation'),
                'sub_zone' => $request->input('sub_zone'),
                'relationship_to_household_head' => $request->input('relationship_to_household_head'),
                'senior_citizen' => $request->input('senior_citizen'),
            ]);

        return redirect()->route('show_resident_data', ['id' => $request->input('id')]);
    }

    public function residet_update_image_process(Request $request)
    {

        $resident_image = $request->file('resident_image');
        $resident_image_name = 'resident_image-' . time() . '.' . $resident_image->getClientOriginalExtension();
        $path_resident_image = $resident_image->storeAs('public', $resident_image_name);

        Residents::where('id', $request->input('id'))
            ->update([
                'resident_image' => $resident_image_name,
            ]);

        return redirect()->route('show_resident_data', ['id' => $request->input('id')]);
    }

    public function lupon_complain()
    {
        $user = User::find(auth()->user()->id);
        $complainant = Residents::get();

        return view('lupon_complain', [
            'user' => $user,
            'complainant' => $complainant,
        ]);
    }

    public function lupon_generate_respondent(Request $request)
    {
        $complainant_data = Residents::where('first_name', 'like', '%' . $request->input('complainant') . '%')
            ->orWhere('middle_name', 'like', '%' . $request->input('complainant') . '%')
            ->orWhere('last_name', 'like', '%' . $request->input('complainant') . '%')
            ->get();

        return view('lupon_generate_complainant_data', [
            'complainant_data' => $complainant_data,
        ]);
    }

    public function lupon_show_resident_data($id)
    {
        $resident_data = Residents::find($id);
        $respondent = Residents::whereNotIn('id', [$id])->get();
        $user = User::find(auth()->user()->id);

        $complain = Complain::where('complainant', $id)
            ->orWhere('respondent', $id)
            ->orderBy('id', 'desc')
            ->first();

        $complain_many = Complain::where('complainant', $id)
            ->orWhere('respondent', $id)
            ->where('complain_status', '!=', 'settled')
            ->orderBy('id', 'desc')
            ->get();

        $complain_history = Complain::where('complainant', $id)
            ->orWhere('respondent', $id)
            ->orderBy('id', 'desc')
            ->get();

        return view('lupon_show_resident_data', [
            'complain_many' => $complain_many,
            'complain_history' => $complain_history,
            'respondent_id' => $id,
            'resident_data' => $resident_data,
            'respondent' => $respondent,
            'complain' => $complain,
            'user' => $user,
        ]);
    }

    public function complain_process(Request $request)
    {
        //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $new_complain = new Complain([
            'complainant' => $request->input('complainant_id'),
            'respondent' => $request->input('respondent_id'),
            'reason' => $request->input('reason'),
            'complain_status' => 'On Going',
            'created_at' => $date,
        ]);

        $new_complain->save();

        Residents::where('id', $request->input('complainant_id'))
            ->update(['complain_status' => $new_complain->id]);

        Residents::where('id', $request->input('respondent_id'))
            ->update(['complain_status' => $new_complain->id]);

        return redirect()->route('lupon_show_resident_data', ['id' => $request->input('respondent_id')])->with('success', 'Success');
    }

    public function lupon_change_complain_status($id)
    {
        //return $id;
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        $complain = Complain::find($id);

        Residents::where('id', $complain->complainant)
            ->update(['complain_status' => null]);

        Residents::where('id', $complain->respondent)
            ->update(['complain_status' => null]);

        Complain::where('id', $id)
            ->update([
                'complain_status' => 'settled',
                'updated_at' => $date,
            ]);

        return redirect()->route('lupon_complain')->with('success', 'Success');
    }

    public function disable_user($id)
    {
        User::where('id', $id)
            ->update(['user_status' => 'disabled']);

        return redirect()->route('admin_barangay_officials_registration')->with('success', 'Success');
    }

    public function enable_user($id)
    {
        User::where('id', $id)
            ->update(['user_status' => null]);

        return redirect()->route('admin_barangay_officials_registration')->with('success', 'Success');
    }

    public function edit_location(Request $request)
    {
       // return $request->input();
        Residents::where('id', $request->input('resident_id'))
            ->update([
                'latitude' => $request->input('longitude'),
                'longitude' => $request->input('latitude'),
            ]);

        
        return redirect()->route('show_resident_data', ['id' => $request->input('resident_id')])->with('success', 'Success');
    }
}
