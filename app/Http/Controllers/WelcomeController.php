<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function show()
    {
        return view('welcome', [
            'layout' => 'default',
            'meta' => [
                'title' => 'Welcome',
                'description' => 'Trov is a starter for TMX Fianance Family of Companies marketing websites because WordPress really does suck.',
                'robots' => 'index,follow',
            ],
        ]);
    }
}
