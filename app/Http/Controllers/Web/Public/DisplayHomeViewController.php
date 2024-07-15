<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;

class DisplayHomeViewController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function handle()
    {
        return view('web.public.index');
    }
}
