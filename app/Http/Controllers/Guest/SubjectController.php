<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubjectController extends Controller
{

    public function index(Request $request)
    {
        $subjects = Subject::query();
        if ($request->has('search')) {
            $subjects->where('title', 'LIKE', "%" . $request->search . "%");
            $subjects->orWhere('slug', 'LIKE', "%" . $request->search . "%");
        }
        return Inertia::render('Guest/Subject', [
            'title'     => "Materi",
            'filters'   => $request->all(['search', 'field', 'order']),
            'subjects'   => $subjects->where('grade_id', auth()->guard('member')->user()->grade_id)->with('user', 'comments', 'comments.user', 'comments.member')->latest()->paginate(6)->onEachSide(0),
        ]);
    }

    public function detail($slug)
    {
        $subject = Subject::with('user', 'comments', 'comments.user', 'comments.member')->where(['slug' => $slug])->firstOrFail();
        return Inertia::render('Guest/SubjectDetail', [
            'title' => $subject->title,
            'subject'  => $subject,
            'moreSubject' => Subject::where('slug', '!=', $slug)->take(6)->latest()->get()
        ]);
    }
}
