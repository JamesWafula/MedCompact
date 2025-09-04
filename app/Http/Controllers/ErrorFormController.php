<?php

namespace App\Http\Controllers;

use Redirect;
use App\Models\ReportedError;
use Inertia\Inertia;
use App\Http\Requests\StoreErrorFormRequest;
use App\Models\Incident;
use App\Models\Locations;
use App\Models\Occupation;
use App\Models\Outcome;
use App\Models\PossibleFactor;
use App\Models\Preventability;
use App\Models\TypeOfError;
use App\Models\SpecificLocation;

class ErrorFormController extends Controller
{
    public function load_form()
    {
        return Inertia::render('Welcome',[
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
    
   public function post_error(StoreErrorFormRequest $request)
    {
        // dd($request->all());
        // dd(auth()->user()->id); 
        $user_id = (int) $request->user_id;

        if($request->user_id == null){
            Reportederror::create([  
            'ip' => $request->ipOrOpNumber,
            'email' => $request->email,
            'gender' => $request->gender,
            'date' => $request->date, 
            'time' => $request->time,
            'age' => $request->age,
            'location_of_error_id' => $request->locationOfError,
            'diagnosis' => $request->diagnosis,
            'incident_id' =>$request->incident,
            'type_of_error_id' => $request->typeOfError,
            'possible_factor_id' => $request->possibleFactors,
            'specific_location_id' => $request->specificLocation,
            'specific_location_by_user' => $request->specifyLocationByUser,
            'outcome' => $request->outcome,
            'preventability_id' =>$request->preventability,
            'suggestions' =>$request->suggestedPreventiveMeasures,
            'outcome_id' =>$request->outcome,
            'occupation_id' => $request->occupation,
        ]);
        }else{
            Reportederror::create([
            'ip' => $request->ipOrOpNumber,
            'email' => $request->email,
            'gender' => $request->gender,
            'date' => $request->date, 
            'time' => $request->time,
            'age' => $request->age,
            'location_of_error_id' => $request->locationOfError,
            'diagnosis' => $request->diagnosis,
            'incident_id' =>$request->incident,
            'type_of_error_id' => $request->typeOfError,
            'possible_factor_id' => $request->possibleFactors,
            'specific_location_id' => $request->specificLocation,
            'specific_location_by_user' => $request->specifyLocationByUser,
            'outcome' => $request->outcome,
            'preventability_id' =>$request->preventability,
            'suggestions' =>$request->suggestedPreventiveMeasures,
            'outcome_id' =>$request->outcome,
            'occupation_id' => $request->occupation,
            'user_id' => $user_id
        ]);
        }
     

        return Inertia::render('Success', ['success' => 'Your error has been reported.']);

    }
}
