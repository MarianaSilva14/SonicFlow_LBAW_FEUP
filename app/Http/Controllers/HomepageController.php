<?php

namespace App\Http\Controllers;


class HomepageController extends Controller
{
    /**
     * Shows the homepage.
     *
     * @return Response
     */
    public function show()
    {
        return view('pages.homepage', ['data_to_put_here' => 'hello']);
    }
}