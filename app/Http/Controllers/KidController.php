<?php

namespace App\Http\Controllers;

use App\Models\Kid;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class KidController extends Controller
{
    /**
     * Display the list of kids.    
     * 
     * @return Response
     */
    public function index(Request $request) : Response
    {
        $user = $request->user();
        
        return Inertia::render('Kids/Index', [
            'kids' => Kid::viewable($user)
                ->orderBy('name', 'ASC')
                ->paginate(10),
        ]);
    }

    public function create(Request $request) : Response
    {
        $user = $request->user();

        return Inertia::render('Kids/Create', [
            'user' => $user,
        ]);
    }
}
