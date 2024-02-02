<?php

namespace App\Http\Controllers;

use App\Models\FormField;
use Illuminate\Http\Request;

class FormFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'form_id' => 'required',
            'label' => 'required',
            'field_type' => 'required',
        ]);

        $formField = new FormField();
        $formField->form_id = $request->form_id;
        $formField->label = $request->label;
        $formField->field_type = $request->field_type;
        $formField->options = json_encode($request->options);
        $formField->save();

        return redirect()->back()->with('success', 'Form Field created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FormField $formField)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $field = FormField::find($id);
        return view('frontend.formFields.edit', compact('field'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([

            'label' => 'required',
            'field_type' => 'required',
        ]);

        $formField = FormField::find($id);

        $formField->label = $request->label;
        $formField->field_type = $request->field_type;
        $formField->options = json_encode($request->options);
        $formField->save();

        return redirect()->route('forms.show', $formField->form_id)->with('success', 'Form Field updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = FormField::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Form Field deleted successfully.');
    }
}
