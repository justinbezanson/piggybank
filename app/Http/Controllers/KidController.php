<?php

namespace App\Http\Controllers;

use App\Models\Kid;
use Inertia\Inertia;
use Inertia\Response;
use App\Actions\CreateKid;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreateKidRequest;

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

    public function store(CreateKidRequest $request) : RedirectResponse
    {
        $action = new CreateKid();
        $action->handle($request);
        
        return to_route('kids.index');
    }
}
