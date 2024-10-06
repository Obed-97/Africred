<?php

namespace App\Http\Controllers;

use App\Models\Marche;
use App\Models\Recouvrement;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();

        return view('personnel.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $personnel = User::findOrFail($id);
        $roles = Role::all();

        $historiques = Recouvrement::where('user_id', $personnel->id)->latest()->paginate(100);
        $marches  = Marche::get();

        return view('personnel.show', compact('personnel', 'historiques', 'roles', 'marches'));
    }

    public function filtershow(Request $request)
    {
        $personnel = User::findOrFail($request->id);
        $roles = Role::all();

        $historiques = Recouvrement::where('user_id', $personnel->id)->where('marche_id', $request->marche_id)->whereDate('date', $request->date)->get();
        $marches  = Marche::get();

        return view('personnel.show', compact('personnel', 'historiques', 'roles', 'marches'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $personnel = User::where('id', $id)->firstOrFail();

        return view('personnel.edit', compact('personnel','roles'));
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
        $personnel = User::where('id', $id)->firstOrFail();

        $personnel->update([
            'role_id'=>$request->role,
            'nom'=>$request->nom,
            'email'=>$request->email,
            'telephone'=>$request->telephone,
        ]);

        return redirect()->route('personnel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $personnel = User::findOrFail($id);
        $personnel->delete();

        return redirect()->route('personnel.index');
    }


    public function permission()
    {
        $personnels = User::get();

        return view('permissions.index', compact('personnels'));
    }

    public function permission_store(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $user->givePermissionTo(['delete']);
        return redirect()->back();
    }

    public function permission_revok(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $user->revokePermissionTo(['delete']);
        return redirect()->back();
    }
}
