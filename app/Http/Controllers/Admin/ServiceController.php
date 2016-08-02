<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Service;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Category;


class ServiceController extends Controller {

	/**
	 * Display a listing of service
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $service = Service::with("category")->get();

		return view('admin.service.index', compact('service'));
	}

	/**
	 * Show the form for creating a new service
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $category = Category::lists("Name", "id")->prepend('Please select', '');

	    
	    return view('admin.service.create', compact("category"));
	}

	/**
	 * Store a newly created service in storage.
	 *
     * @param CreateServiceRequest|Request $request
	 */
	public function store(CreateServiceRequest $request)
	{
	    $request = $this->saveFiles($request);
		Service::create($request->all());

		return redirect()->route('admin.service.index');
	}

	/**
	 * Show the form for editing the specified service.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$service = Service::find($id);
	    $category = Category::lists("Name", "id")->prepend('Please select', '');

	    
		return view('admin.service.edit', compact('service', "category"));
	}

	/**
	 * Update the specified service in storage.
     * @param UpdateServiceRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateServiceRequest $request)
	{
		$service = Service::findOrFail($id);

        $request = $this->saveFiles($request);

		$service->update($request->all());

		return redirect()->route('admin.service.index');
	}

	/**
	 * Remove the specified service from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Service::destroy($id);

		return redirect()->route('admin.service.index');
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
            Service::destroy($toDelete);
        } else {
            Service::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.service.index');
    }

}
