<?php

namespace App\Http\Controllers;


use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth', ['except' => []]);
    }

    public function index(){

        $specializations = Specialization::with('jobs')->orderBy('id', 'DESC')->get();

        return view('specialization.list', compact('specializations'));
    }


    public function store(Request $request){

        if($request->has('id')){
            $specialization = Specialization::find($request->id);

            $specialization->update([
                'name' => $request->name
            ]);

            $msg = "You have successfully updated a specialization";

        } else {
            Specialization::create([
                'name' => $request->name
            ]);

            $msg = "You have successfully created a specialization";
        }


        return redirect()->back()->with('success', $msg);

    }

    public function update($id){

        $specialization = Specialization::find($id);

        return view('specialization.update', compact('specialization'));
    }

    public function delete($id){
        Specialization::destroy($id);

        return redirect()->back()->with('success', "You have successfully deleted a specialization");
    }
            

    
}
