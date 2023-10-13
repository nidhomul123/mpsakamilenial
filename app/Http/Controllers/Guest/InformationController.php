<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InformationController extends Controller
{
    public function index(Request $request)
    {
        $information = Information::query();
        if ($request->has('search')) {
            $information->where('title', 'LIKE', "%" . $request->search . "%");
            $information->orWhere('slug', 'LIKE', "%" . $request->search . "%");
            $information->orWhere('date', 'LIKE', "%" . $request->search . "%");
        }
        return Inertia::render('Guest/Information', [
            'title'     => "Informasi",
            'filters'   => $request->all(['search', 'field', 'order']),
            'information'   => $information->with('user')->where('published', 1)->orderBy('date', 'desc')->paginate(6)->onEachSide(0),
        ]);
    }

    public function detail($slug)
    {
        $information = Information::with('user')->where(['slug' => $slug, 'published' => 1])->firstOrFail();
        return Inertia::render('Guest/InformationDetail', [
            'title' => $information->title,
            'information'  => $information,
            'moreInformation' => Information::where(['published' => 1])->where('slug', '!=', $slug)->take(6)->get()
        ]);
    }
}
