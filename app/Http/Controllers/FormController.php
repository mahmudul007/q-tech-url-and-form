<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = Form::all();
        return view('frontend.form.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('form_create')) {
            abort(403);
        }
        $categories = Category::all();

        return view('frontend.form.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('form_create')) {
            abort(403);
        }

        $request->validate([
            'title' => 'required ',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        $form = new Form();
        $form->title = $request->title;
        $form->description = $request->description;
        $form->category_id = $request->category_id;
        $form->user_id = auth()->user()->id;
        $form->save();

        return redirect()->route('forms.index')
            ->with('success', 'Form created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $form = Form::find($id);
        $questions = FormField::where('form_id', $id)->get();
        return view('frontend.form.show', compact('form', 'questions'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        if (!Gate::allows('form_edit')) {
            abort(403);
        }
        $form = Form::find($form->id);
        $categories = Category::all();
        return view('frontend.form.edit', compact('form', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form)
    {
        if (!Gate::allows('form_edit')) {
            abort(403);
        }

        $request->validate([
            'title' => 'required ',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        $form = Form::find($form->id);
        $form->title = $request->title;
        $form->description = $request->description;
        $form->category_id = $request->category_id;

        $form->save();
        $questions = FormField::where('form_id', $form->id)->get();

        return redirect()->route('forms.show', $form->id)->with('form', 'questions')
            ->with('success', 'Form updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!Gate::allows('form_delete')) {
            abort(403);
        }

        $form = Form::find($id);
        $form->delete();
        return redirect()->route('frontend.forms.index')
            ->with('success', 'Form deleted successfully.');
    }

}
