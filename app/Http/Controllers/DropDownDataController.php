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


class DropDownDataController extends Controller
{
    public function index(){
        return Inertia::render('Fields', [
            'all_errors' => ReportedError::all(),
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

     public function post_incidents(Request $request)
    {
        $request->validate([
            'fielditem' => 'required|string|max:255',
        ]);
        Incident::create([
            'incident' => $request->fielditem,
            'user_id' =>  auth()->user()->id
        ]);
        return redirect()->back();
    }
    
    public function post_locations(Request $request)
    {
        $request->validate([
            'fielditem' => 'required|string|max:255',
        ]);
        Locations::create([
            'location' => $request->fielditem,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->back();
    }
    
    public function post_occupation(Request $request)
    {
        $request->validate([
            'fielditem' => 'required|string|max:255',
        ]);
        Occupation::create([
            'user_id' =>  auth()->user()->id,
            'occupation' => $request->fielditem,
        ]);

        return redirect()->back();
    }
    
    public function post_outcome(Request $request)
    {
        $request->validate([
            'fielditem' => 'required|string|max:255',
        ]);
        Outcome::create([
            'outcome' => $request->fielditem,
            'user_id' =>  auth()->user()->id,
        ]);
        return redirect()->back();
    }

    public function post_possiblefactors(Request $request)
    {
        $request->validate([
            'fielditem' => 'required|string|max:255',
        ]);
        PossibleFactor::create([
            'possible_factor' => $request->fielditem,
            'user_id' =>  auth()->user()->id,
        ]);
        return redirect()->back();
    }
    
    public function post_preventability(Request $request)
    {
        $request->validate([
            'fielditem' => 'required|string|max:255',
        ]);
        Preventability::create([
            'preventability' => $request->fielditem,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->back();
    }
    
    public function post_typeoferror(Request $request)
    {
        $request->validate([
            'fielditem' => 'required|string|max:255',
            'id' => 'required',
        ]);
        TypeOfError::create([
            'type_of_error' => $request->fielditem,
            'user_id' => auth()->user()->id,
            'incident_id' => $request->id,
        ]);
        return redirect()->back();
    }

     public function post_specificlocation(Request $request)
    {
        $request->validate([
            'fielditem' => 'required|string|max:255',
            'id' => 'required',
        ]);
        SpecificLocation::create([
            'specific_location' => $request->fielditem,
            'user_id' => auth()->user()->id,
            'location_id' => $request->id,
        ]);
        return redirect()->back();
    }


    public function delete_incidents(Request $request,$id){
        Incident::destroy($id);
        return redirect()->back();
    }

    public function delete_locations(Request $request,$id){
        Locations::destroy($id);
        return redirect()->back();
    }

    public function delete_occupation(Request $request,$id){
        Occupation::destroy($id);
        return redirect()->back();
    }

    public function delete_outcome(Request $request, $id){
        Outcome::destroy($id);
        return redirect()->back();
    }

    public function delete_possiblefactors(Request $request, $id){
        PossibleFactor::destroy($id);
        return redirect()->back();
    }

    public function delete_preventability(Request $request, $id){
        Preventability::destroy($id);
        return redirect()->back();
    }

    public function delete_typeoferror(Request $request, $id){
        TypeOfError::destroy($id);
        return redirect()->back();
    }
    public function delete_specificlocation(Request $request, $id){
        SpecificLocation::destroy($id);
        return redirect()->back();
    }
}
