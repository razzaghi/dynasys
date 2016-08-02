<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\ServiceProvider;
use App\Http\Requests\CreateServiceProviderRequest;
use App\Http\Requests\UpdateServiceProviderRequest;
use Illuminate\Http\Request;

use App\Service;
use App\Provider;


class ServiceProviderController extends Controller {

	/**
	 * Display a listing of serviceprovider
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $serviceprovider = ServiceProvider::with("service")->with("provider")->get();

		return view('admin.serviceprovider.index', compact('serviceprovider'));
	}

	/**
	 * Show the form for creating a new serviceprovider
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $service = Service::lists("Name", "id")->prepend('Please select', '');
$provider = Provider::lists("Name", "id")->prepend('Please select', '');

	    
	    return view('admin.serviceprovider.create', compact("service", "provider"));
	}

	/**
	 * Store a newly created serviceprovider in storage.
	 *
     * @param CreateServiceProviderRequest|Request $request
	 */
	public function store(CreateServiceProviderRequest $request)
	{
	    
		ServiceProvider::create($request->all());

		return redirect()->route('admin.serviceprovider.index');
	}

	/**
	 * Show the form for editing the specified serviceprovider.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$serviceprovider = ServiceProvider::find($id);
	    $service = Service::lists("Name", "id")->prepend('Please select', '');
$provider = Provider::lists("Name", "id")->prepend('Please select', '');

	    
		return view('admin.serviceprovider.edit', compact('serviceprovider', "service", "provider"));
	}

	/**
	 * Update the specified serviceprovider in storage.
     * @param UpdateServiceProviderRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateServiceProviderRequest $request)
	{
		$serviceprovider = ServiceProvider::findOrFail($id);

        

		$serviceprovider->update($request->all());

		return redirect()->route('admin.serviceprovider.index');
	}

	/**
	 * Remove the specified serviceprovider from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		ServiceProvider::destroy($id);

		return redirect()->route('admin.serviceprovider.index');
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
            ServiceProvider::destroy($toDelete);
        } else {
            ServiceProvider::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.serviceprovider.index');
    }

}
