<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('submission_access')) {
            abort(403);
        }
        $user = Auth::user();

        $submissions = Submission::with([
            'form' => function ($query) use ($user) {
                $query->with('formOwner')->where('user_id', $user->id);
            },

        ])->get();

        return view('frontend.submissions.index', compact('submissions'));
    }

    public function show($id)
    {
        if (!Gate::allows('special_access')) {
            abort(403);
        }
        $user = Auth::user();
        $submission = Submission::find($id)->with([
            'form' => function ($query) use ($user) {
                $query->with('formOwner')->where('user_id', $user->id);
            },
        ])->find($id);

        return view('frontend.submissions.show', compact('submission'));
    }

    public function store(Request $request)
    {
        if (!Gate::allows('submission_view')) {
            abort(403);
        }

        $request->validate([
            'form_id' => 'required',
            'options' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['submission_data'] = json_encode($data['options']);
        $data['user_id'] = auth()->id();
        $data = Submission::create($data);
        return redirect()->back()->with('success', 'Form submitted successfully.');

    }

    public function destroy($id)
    {
        if (!Gate::allows('submission_delete')) {
            abort(403);
        }
        $submission = Submission::find($id);
        $submission->delete();
        return redirect()->back()->with('success', 'Submission deleted successfully.');
    }

}
