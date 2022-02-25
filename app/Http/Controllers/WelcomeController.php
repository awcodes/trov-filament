<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Trov\MediaLibrary\Models\Media;

class WelcomeController extends Controller
{
    public function show()
    {
        $heroImage = Media::first();

        return view('welcome', [
            'layout' => 'default',
            'hero_image' => $heroImage,
            'hero_content' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatibus officia dolorem architecto porro molestias fuga iure culpa reprehenderit perferendis ullam neque rem repellat inventore magni, maxime officiis quaerat!',
            'meta' => [
                'title' => 'Welcome',
                'description' => 'Trov is a starter for TMX Fianance Family of Companies marketing websites because WordPress really does suck.',
                'robots' => 'index,follow',
            ],
        ]);
    }
}
