<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Field;
use App\Http\Requests\CreateFieldRequest;
use App\Http\Requests\UpdateFieldRequest;
use Illuminate\Http\Request;

use App\Category;


class FieldController extends Controller {

	/**
	 * Display a listing of field
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $field = Field::with("category")->get();

		return view('admin.field.index', compact('field'));
	}

	/**
	 * Show the form for creating a new field
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $category = Category::lists("Name", "id")->prepend('Please select', '');

	    
	    return view('admin.field.create', compact("category"));
	}

	/**
	 * Store a newly created field in storage.
	 *
     * @param CreateFieldRequest|Request $request
	 */
	public function store(CreateFieldRequest $request)
	{
	    
		Field::create($request->all());

		return redirect()->route('admin.field.index');
	}

	/**
	 * Show the form for editing the specified field.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$field = Field::find($id);
	    $category = Category::lists("Name", "id")->prepend('Please select', '');

	    
		return view('admin.field.edit', compact('field', "category"));
	}

	/**
	 * Update the specified field in storage.
     * @param UpdateFieldRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFieldRequest $request)
	{
		$field = Field::findOrFail($id);

        

		$field->update($request->all());

		return redirect()->route('admin.field.index');
	}

	/**
	 * Remove the specified field from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Field::destroy($id);

		return redirect()->route('admin.field.index');
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
            Field::destroy($toDelete);
        } else {
            Field::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.field.index');
    }

}
