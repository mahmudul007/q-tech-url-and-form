<?php

namespace App\Http\Controllers;

use App\Models\FormField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FormFieldController extends Controller
{
    
    public function store(Request $request)
    {
        if (!Gate::allows('form_create')) {
            abort(403);
        }

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
        if (!Gate::allows('form_edit')) {
            abort(403);
        }
        $field = FormField::find($id);
        return view('frontend.formFields.edit', compact('field'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!Gate::allows('form_edit')) {
            abort(403);
        }

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
        if (!Gate::allows('form_delete')) {
            abort(403);
        }
        $data = FormField::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Form Field deleted successfully.');
    }
}
