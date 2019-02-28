<?php

namespace IAtelier\Atelier\Http\Controllers;

use Illuminate\Http\Request;
use IAtelier\Atelier\People as People;
use IAtelier\Atelier\Name as Name;

use App\Http\Controllers\Controller as Controller;

class PeopleController extends Controller
{
    //
    public function index()
    {
	    return view('people.base');
    }
    
    public function find(Request $request)
    {
	    $value = '%' . $request->input('person') . '%';
	    return Name::where('identifier', 'like', $value)->get();
    }
    
    public function store(Request $request)
    {
	    $person = $request->person;
	    if ( is_numeric($person) )
	    {
		    $name = Name::find($person);
	    } else {
		    if ( Name::where('identifier', $person)->count() == 1 )
		    {
			    $name = Name::where('identifier', $person)->first();
		    } //elseif ( Name::where('identifier', 'like', $person)->count() > ) {
			else {
			    $persons = Name::where('identifier', 'like', $person)->get();
			    $persons = $persons->merge(Name::where('firstname', 'like', $person)->get());
			    $persons = $persons->merge(Name::where('identifier', 'like', $person)->get());
			    $persons = $persons->take(14);
			    return view('people.notfound', ['persons' => $persons, 'person' => $person]);
		    }
	    }
	    return redirect()->route('people.persons', ['id' => $name->id ]);
    }
    
    public function show($id)
    {
	    $person = People::find($id);
	    $rolesCollection = $person->roles()->get()->groupBy('role');
	    return view('people.person', compact('person', 'rolesCollection'));
    }
}
