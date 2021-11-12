<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class ChangeTodoStatusController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Todo $todo, Request $request)
    {
        $todo->update([
            'done' => $request->get('status')
        ]);

        return redirect()->back();
    }
}
