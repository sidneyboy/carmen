<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Residents;
use App\Models\Complain_type;
use DB;
use Illuminate\Http\Request;

class Barangay_controller extends Controller
{
    public function admin_dashboard()
    {
        $user = User::find(auth()->user()->id);

        if ($user->user_type == 'Super_user') {
            // return view('admin_barangay_officials_registration', [
            //     'user' => $user,
            // ]);

            return redirect('admin_barangay_officials_registration');
        } elseif ($user->user_type == 'Monitoring') {
            // return view('admin_register_residents', [
            //     'user' => $user,
            // ]);

            return redirect('admin_register_residents');
        } else if ($user->user_type == 'Lupon') {
            // return view('admin_add_complain_type', [
            //     'user' => $user,
            // ]);

            return redirect('admin_add_complain_type');
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
            'father' => $request->input('father'),
            'mother' => $request->input('mother'),
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


        // return $resident_gender = DB::table('residents')
        //    ->select('SUM(CASE WHEN dob < 18 THEN 1 ELSE 0 END) AS [Under 18]')
        //    ->select('SUM(CASE WHEN dob BETWEEN 18 AND 24 THEN 1 ELSE 0 END) AS [18-24]')
        //    ->select('SUM(CASE WHEN dob BETWEEN 25 AND 34 THEN 1 ELSE 0 END) AS [25-34]')
        //    ->get();


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



        return view('admin_resident_analytics', [
            'user' => $user,
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

        if ($request->input('father_id') == 'input_father_name') {
            $father_data = 'none';
        } elseif ($request->input('father_id') == 'N/A') {
            return 'none';
        } else {
            $father_data = Residents::find($request->input('father_id'));
        }

        return view('admin_search_father', [
            'father_data' => $father_data,
        ])->with('father_image', $request->input('father_image'));
    }

    public function admin_search_mother(Request $request)
    {
        if ($request->input('mother_id') == 'input_father_name') {
            $mother_data = 'none';
        } elseif ($request->input('mother_id') == 'N/A') {
            return 'none';
        } else {
            $mother_data = Residents::find($request->input('mother_id'));
        }

        return view('admin_search_mother', [
            'mother_data' => $mother_data,
        ])->with('father_image', $request->input('mother_name'));
    }

    public function show_father_data($father_id)
    {
        return $father_id;
    }
}
