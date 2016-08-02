<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Provider;
use App\Http\Requests\CreateProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use Illuminate\Http\Request;



class ProviderController extends Controller {

	/**
	 * Display a listing of provider
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $provider = Provider::all();

		return view('admin.provider.index', compact('provider'));
	}

	/**
	 * Show the form for creating a new provider
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.provider.create');
	}

	/**
	 * Store a newly created provider in storage.
	 *
     * @param CreateProviderRequest|Request $request
	 */
	public function store(CreateProviderRequest $request)
	{
	    
		Provider::create($request->all());

		return redirect()->route('admin.provider.index');
	}

	/**
	 * Show the form for editing the specified provider.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$provider = Provider::find($id);
	    
	    
		return view('admin.provider.edit', compact('provider'));
	}

	/**
	 * Update the specified provider in storage.
     * @param UpdateProviderRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateProviderRequest $request)
	{
		$provider = Provider::findOrFail($id);

        

		$provider->update($request->all());

		return redirect()->route('admin.provider.index');
	}

	/**
	 * Remove the specified provider from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Provider::destroy($id);

		return redirect()->route('admin.provider.index');
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
            Provider::destroy($toDelete);
        } else {
            Provider::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.provider.index');
    }

}
