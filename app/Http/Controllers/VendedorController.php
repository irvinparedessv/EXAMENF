<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Hash;
use Auth;
class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $vendedor=Vendedor::where('id_usuario', $userId)->first();
        if($vendedor){
          
            $isaudi=false;
            }else{
           
            $isaudi=true;
            }
        $Vendedors = Vendedor::paginate(15);

        return response()->json(['message' => 'success', 'Vendedors'=>$Vendedors,'isaudi'=>$isaudi]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //CREATE AUDITORES
        $user = new User();
        $user->password = Hash::make('123456789');
        $user->email = $request['email'];
        $user->name = $request['email'];
        $user->save();
        
        return response()->json(['message'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendedor  $Vendedors
     * @return \Illuminate\Http\Response
     */
    public function show(Vendedor $Vendedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendedor  $Vendedors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendedor $Vendedor)
    {
        Vendedor::where('id', $Vendedor->id)->update($request->except(['grade_name']));
        return response()->json(["message"=>"success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendedor  $Vendedors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendedor $Vendedor)
    {
        Vendedor::where('id', $Vendedor->id)->delete();
        return response()->json(["message"=>"success"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function VendedorByDUI(Request $request)
    {
        $Vendedor = Vendedor::where(['dui'=>$request->dui])->first();

        return response()->json(['message' => 'success', 'Vendedor'=>$Vendedor]);
    }
}
