<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Chec;
use App\Models\Checkbox;
use App\Models\Jawaban;
use App\Models\User;
use Illuminate\Http\Request;
use Helpers\Data\DiscHelper;

class CheckboxController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkbox = Checkbox::all();
        return view('dashboard', ['checkbox' => $checkbox]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $answerColumn1 = $request->input('checkbox');
        $answerColumn2 = $request->input('checkbox1');

        $mostValue = DiscHelper::normalizeDiscValue($answerColumn1);
        $leastValue = DiscHelper::normalizeDiscValue($answerColumn2);
        $changeValue = DiscHelper::getChangeValue($mostValue,  $leastValue);

        $formattedMostValue = DiscHelper::formatDiscValue($mostValue);
        $formattedLeastValue = DiscHelper::formatDiscValue($leastValue);
        $formattedChangeValue = DiscHelper::formatDiscValue($changeValue);

        $user = User::find(1);
        // $user = 

        // if ($user) {
        //     Jawaban::create([
        //         'user_id' => $user->id,
        //         'event_id' => 
        //     ]);
        // } else {
        //     throw new Exception("User not found");
        // }



        return redirect()->back();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Helper function section
     */

}
