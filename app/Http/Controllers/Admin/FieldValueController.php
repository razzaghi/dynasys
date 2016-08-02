<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\FieldValue;
use App\Http\Requests\CreateFieldValueRequest;
use App\Http\Requests\UpdateFieldValueRequest;
use Illuminate\Http\Request;

use App\Service;
use App\Field;


class FieldValueController extends Controller {

	/**
	 * Display a listing of fieldvalue
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $fieldvalue = FieldValue::with("service")->with("field")->get();

		return view('admin.fieldvalue.index', compact('fieldvalue'));
	}

	/**
	 * Show the form for creating a new fieldvalue
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $service = Service::lists("Name", "id")->prepend('Please select', '');
$field = Field::lists("Name", "id")->prepend('Please select', '');

	    
	    return view('admin.fieldvalue.create', compact("service", "field"));
	}

	/**
	 * Store a newly created fieldvalue in storage.
	 *
     * @param CreateFieldValueRequest|Request $request
	 */
	public function store(CreateFieldValueRequest $request)
	{
	    
		FieldValue::create($request->all());

		return redirect()->route('admin.fieldvalue.index');
	}

	/**
	 * Show the form for editing the specified fieldvalue.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$fieldvalue = FieldValue::find($id);
	    $service = Service::lists("Name", "id")->prepend('Please select', '');
$field = Field::lists("Name", "id")->prepend('Please select', '');

	    
		return view('admin.fieldvalue.edit', compact('fieldvalue', "service", "field"));
	}

	/**
	 * Update the specified fieldvalue in storage.
     * @param UpdateFieldValueRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFieldValueRequest $request)
	{
		$fieldvalue = FieldValue::findOrFail($id);

        

		$fieldvalue->update($request->all());

		return redirect()->route('admin.fieldvalue.index');
	}

	/**
	 * Remove the specified fieldvalue from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		FieldValue::destroy($id);

		return redirect()->route('admin.fieldvalue.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            FieldValue::destroy($toDelete);
        } else {
            FieldValue::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.fieldvalue.index');
    }

}
