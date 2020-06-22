<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\math;
use Redirect,Response;

class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*return employee::all();*/
        $res = math::orderBy('id','desc')->paginate(5);
        return view('mathresult.index')->with('res', $res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(true){
            /*Digit of result more than digit of value1-3 so N must be 1*/
            if(strlen("NEUES") > strlen("HIER") and strlen("NEUES") > strlen("GIBT") and strlen("NEUES") > strlen("ES")){
                $N = 1;
                /*ER+BT+ES=ES so ER+BT must be 100*/
                for ($R = 2; $R <= 8; $R++) {
                    for ($T = 2; $T <= 8; $T++) {
                        if($R+$T == 10 and $R != $T){
                            for ($E = 2; $E <= 8; $E++){
                                for ($B = 2; $B <= 8; $B++){
                                    if($E+$B+1 == 10 and $E != $B and $E != $R and $E != $T and $B != $R and $B != $T){
                                        /*I+I+1 = U and U < 10*/
                                        for ($I = 2; $I <= 4; $I++){
                                            for ($U = 4; $U <= 9; $U++){
                                                if($I+$I+1 == $U and $I != $U and $I != $E and $I != $B and $I != $R and $I != $T and $U != $E and $U != $B and $U != $R and $U != $T){
                                                    /*H+G must be 1E*/
                                                    for ($H = 2; $H <= 9; $H++){
                                                        for ($G = 2; $G <= 9; $G++){
                                                            if($H+$G == (10+$E) and $H != $G and $H != $I and $H != $U and $H != $E and $H != $B and $H != $R and $H != $T and $G != $I and $G != $U and $G != $E and $G != $B and $G != $R and $G != $T){
                                                                /*Find S*/
                                                                for($S = 0; $S <= 9; $S++) {
                                                                    if($S != $H and $S != $I and $S != $E and $S != $R and $S != $G and $S != $B and $S != $T and $S != $N and $S != $U){
                                                                        $res = new math;
                                                                        $val1 = $H . $I . $E . $R;
                                                                        $val2 = $G . $I . $B . $T;
                                                                        $val3 = $E . $S;
                                                                        $results = $N . $E . $U . $E . $S;
        
                                                                        $res->value1 = intval($val1);
                                                                        $res->value2 = intval($val2);
                                                                        $res->value3 = intval($val3);
                                                                        $res->result = intval($results);
                                                                        $res->save();
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {   

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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = math::find($id);

        if ($res){
            $res->delete();
        }

        return redirect()->back();
    }
}
