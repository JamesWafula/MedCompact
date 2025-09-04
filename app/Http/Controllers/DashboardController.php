<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Locations;
use App\Models\Occupation;
use App\Models\Outcome;
use App\Models\PossibleFactor;
use App\Models\Preventability;
use App\Models\ReportedError;
use App\Models\SpecificLocation;
use App\Models\TypeOfError;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class DashboardController extends Controller
{ 
    public function dash_home()
    {
        //total errors
        $all_errors = ReportedError::all();
  
   
        $dbincident = Incident::all();
        $incident_data = $dbincident->map(function($incident){
            return [
                'incident' => $incident->incident,
                'errorCount' => Reportederror::where('incident_id', $incident->id)->count()
            ];
        });

        //gender data
        $maleErrorCount = ReportedError::where('gender', 'Male')->count();
        $femaleErrorCount = ReportedError::where('gender', 'Female')->count();
        $gender_data = [
            'maleErrorCount' => $maleErrorCount,
            'femaleErrorCount' => $femaleErrorCount
        ];

        //location data
        $dblocation = Locations::all();
        $location_data = $dblocation->map(function($location){
            return [
                'location' => $location->location,
                'errorCount' => Reportederror::where('location_of_error_id', $location->id)->count()
            ];
        });

        //possible factors data
        $possible_factors_data = PossibleFactor::all()->map(function($item){
            return [
                'possibleFactor' => $item->possible_factor,
                'errorCount' => Reportederror::where('possible_factor_id', $item->id)->count()
            ];
        });

        // preventability data
        $preventability_data =Preventability::all()->map(function($item){
            return [
                'preventability' => $item->preventability,
                'errorCount' => Reportederror::where('preventability_id', $item->id)->count()
            ];
        });

        // outcome of error data
        $outcome_data = Outcome::all()->map(function($item){
            return [
                'outcome' => $item->outcome,
                'errorCount' => Reportederror::where('outcome_id', $item->id)->count()
            ];
        });

        //occupation data
        $occupation_data = Occupation::all()->map(function($item){
            return [
                'occupation' => $item->occupation,
                'errorCount' => Reportederror::where('occupation_id', $item->id)->count()
            ];
        });
     

        return Inertia::render('Dashboard', [
            'all_errors' => $all_errors,
            'all_users' => User::all(),
            'incident_data' => $incident_data,
            'gender_data' => $gender_data,
            'location_data' => $location_data,
            'possible_factors_data' => $possible_factors_data,
            'preventability_data' =>$preventability_data,
            'outcome_data' =>$outcome_data,
            'occupation_data' =>$occupation_data,
            'all_locations' => Locations::all(),
            'all_possible_factors' => PossibleFactor::all(),
            'all_preventability' =>Preventability::all(),
            'all_outcomes' => Outcome::all(),
            'all_occupations' => Occupation::all(),
            'all_incidents' =>  Incident::all(),
            'all_type_of_error' => TypeOfError::all(),
            'all_specific_locations' => SpecificLocation::all()
        ]);
    }

    public function dash_tables(){
        // dd(ReportedError::with('reported_err_user')->get());
        return Inertia::render('Tables', [
            'all_errors' => ReportedError::all(),
            'all_locations' => Locations::all(),
            'all_possible_factors' => PossibleFactor::all(),
            'all_preventability' =>Preventability::all(),
            'all_outcomes' => Outcome::all(),
            'all_occupations' => Occupation::all(),
            'all_incidents' =>  Incident::all(),
            'all_type_of_error' => TypeOfError::all(),
            'all_specific_locations' => SpecificLocation::all(),
            'all_occupations' => Occupation::all(),
            'all_users' => User::all(),
        ]);
    }

    public function dash_accounts(){
        return Inertia::render('Accounts', [
            'all_users' => User::all(),
        ]);
    }
    public function dash_register_account_post(Request $request){
        // dd('register account');
    
        $request->validate([
            'first_name' => ['required', 'string', 'max:30'],
            'last_name' => ['required', 'string', 'max:30'],
            'title' => ['required', 'string', 'max:255'],
            'personal_number' => ['required', 'string', 'max:50'],
            'occupation' => ['required', 'string', 'max:50'],
            'department_or_unit' => ['required', 'string', 'max:70'],
            'mobile_number' => ['numeric', 'digits:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'account_type' => ['required', 'string', 'max:255'],
        ]);
            // dd( $request['account_type']);
         User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'title' => $request['title'],
            'personal_number' => $request['personal_number'],
            'occupation' => $request['occupation'],
            'department_or_unit' => $request['department_or_unit'],
            'mobile_number' => $request['mobile_number'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'account_type' => $request['account_type'],
        ]);

        return Inertia::render('Accounts', [
            'all_users' => User::all(),
        ]);
    }
    public function dash_register_account(){
        // dd('register account');
      
        return Inertia::render('Register', [
            'all_users' => User::all(),
        ]);
    }
    public function dash_adduser(){
        return Inertia::render('AddUser');
    }

    public function dash_errorform(){
        return Inertia::render('DashboardErrorForm',[
            "incident" => Incident::all(),
            "locations" => Locations::all(),
            "occupations" => Occupation::all(),
            "outcomes" => Outcome::all(),
            "possible_factors" => PossibleFactor::all(),
            "preventability" => Preventability::all(),
            "type_of_error" => TypeOfError::all(),
            'specific_location' => SpecificLocation::all()
        ]);
    }

    public function put_accounttype(Request $request, $id){
        $account = User::find($id);
        $account->account_type = $request->account_type;
        $account->save();
        return redirect()->back();
    }
    public function put_password(Request $request, $id){
        //validate password
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        
        // dd('validated');
        $account = User::find($id);
        $account->password = Hash::make($request->password);
        $account->save();
        return redirect()->back(); 
    }
}
