<?php

namespace App\Http\Controllers;

use App\Models\Kid;
use Inertia\Inertia;
use Inertia\Response;
use App\Actions\CreateKid;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreateKidRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

        if(empty($request->query('search'))) {
            $kids = Kid::viewable($user)
                ->orderBy('name', 'ASC')
                ->paginate(10);
        } else {
            $kids = Kid::viewable($user)
                ->where('name', 'LIKE', '%' . $request->query('search') . '%')
                ->orderBy('name', 'ASC')
                ->paginate(10);
        }
        
        return Inertia::render('Kids/Index', [
            'kids' => $kids,
            'search' => $request->query('search'),
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

    public function show(Request $request, int $kidId) : Response
    {
        try {
            $kid =Kid::viewable($request->user())
                ->findOrFail($kidId);
        } catch (ModelNotFoundException $e) {
            abort(404);
        }

        return Inertia::render('Kids/Show', [
            'kid' => $kid,
        ]);
    }
}
