<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupe;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listgroupe=Groupe::all();
        return view('groupe.index', ['listgroupe' =>$listgroupe]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return   view('groupe.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'groupename' => 'required|string|max:255',
            'groupedescription' => 'required|string|max:255',
            'groupenumberplace' => 'required|numeric|max:255',
            
        ]); 
        
        $infosgroupe=[
            'name'=>$request->input('groupename'),          
            'detail'=>$request->input('groupedescription'),          
            'nbplace'=>$request->input('groupenumberplace'),          
            'author_id'=>Auth::user()->id,          
           
            
        ];
        Groupe::create($infosgroupe);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    //    $listgroupe= Groupe::findOrFail($id);
        // $listgroupe=Groupe::all();
        $listgroupe=Groupe::where('author_id', Auth::user()->id)->get();
        return view('groupe.show', ['listgroupe' =>$listgroupe]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $truc= Groupe::findOrFail($id);
     
     

        return view('groupe.edit', [ 'truc' => $truc ]) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'groupename' => 'required|string|max:255',
            'groupedescription' => 'required|string|max:255',
            'groupenumberplace' => 'required|numeric|max:255',
            
        ]); 
        
        $infosgroupe=[
            'name'=>$request->input('groupename'),          
            'detail'=>$request->input('groupedescription'),          
            'nbplace'=>$request->input('groupenumberplace'),          
            'author_id'=>Auth::user()->id,                     
        ];

        $groupemodify = Groupe::findOrFail($id);
        $groupemodify-> name = $request->input('groupename');
        $groupemodify-> detail = $request->input('groupedescription');
        $groupemodify-> nbplace = $request->input('groupenumberplace');
        $groupemodify->save();

       return redirect(route('groupe.index'))->with('message', 'Groupe modifié avec succès');

    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
