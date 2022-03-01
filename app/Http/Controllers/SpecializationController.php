<?php

namespace App\Http\Controllers;


use App\Http\Requests\SpecializationRequest;
use App\Models\Specialization;
use Illuminate\Http\Response;

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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $specializations = Specialization::with('jobs')
            ->where('company_id', null)
            ->orWhere('company_id', getCompanyId())
            ->orderBy('id', 'DESC')->get();

        return view('specialization.list', compact('specializations'));
    }

    /**
     * @param SpecializationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SpecializationRequest $request){

        if ($request->has('id')) {
            $specialization = Specialization::find($request->id);

            $specialization->update(
                [
                    'name' => $request->name
                ]
            );

            $msg = "You have successfully updated a specialization";

        }
        $specialization = Specialization::create(
            [
                'name' => $request->name,
                'company_id' => getCompanyId()
            ]
        );

        $msg = "You have successfully created a specialization";
        if ($request->background_callback) {
            
            return response()->json(
                [
                        'status'=> Response::HTTP_OK,
                        'data' => $specialization
                    ], Response::HTTP_OK
            );
        } 
        
        return redirect()->route('specialization')->with('success', $msg);

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id)
    {
        $specialization = Specialization::find($id);

        return view('specialization.update', compact('specialization'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $specialization = Specialization::find($id);
        if ($specialization->company_id == getCompanyId()) {
            Specialization::destroy($specialization->id);
            return redirect()->back()->with(
                'success', 
                "You have successfully deleted a specialization"
            );
        }
        return redirect()->back()->with(
            'error', 
            'Sorry you cannot delete this specialization'
        );
    }
            

    
}
