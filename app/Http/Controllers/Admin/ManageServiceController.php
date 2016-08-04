<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\FieldValue;
use App\Http\Controllers\Controller;
use App\Provider;
use Redirect;
use Schema;
use App\ManageService;
use App\Http\Requests\CreateManageServiceRequest;
use App\Http\Requests\UpdateManageServiceRequest;
use Illuminate\Http\Request;

use App\Service;
use App\Field;


class ManageServiceController extends Controller
{

    /**
     * Display a listing of manageservice
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $service = Service::with("provider")->get();

        return view('admin.manageservice.index', compact('service'));
    }

    /**
     * Show the form for creating a new manageservice
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $service = Service::lists("Name", "id")->prepend('Please select', '');
        $category = Category::lists("Name", "id")->prepend('Please select', '');
        $provider = Provider::lists("Name", "id")->prepend('Please select', '');


        $field = Field::lists("Name", "id")->prepend('Please select', '');


        return view('admin.manageservice.create', compact("service", "field", "category", "provider"));
    }

    public function getServiceFields($id)
    {

        $fields = Field::where('category_id', '=', $id)->get();

        return $fields;


    }

    /**
     * Store a newly created manageservice in storage.
     *
     * @param CreateManageServiceRequest|Request $request
     */
    public function store(CreateManageServiceRequest $request)
    {

        $request = $this->saveFiles($request);

        $serviceArray = array("Name"=>$request->get("Name"),"Description"=>$request->get("Description"),"Image"=>$request->get("Image"),"category_id"=>$request->get("category_id"),"provider_id"=>$request->get("provider_id"));

        $service = Service::create($serviceArray);

        $serviceId = $service->id;

        foreach ($request->get("fields") as $key => $value) {

            $serviceValue = array("service_id"=>$serviceId,"field_id"=>$key,"Value"=>$value);

            FieldValue::create($serviceValue);

        }

        return redirect()->route('admin.manageservice.index');
    }

    /**
     * Show the form for editing the specified manageservice.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $service = Service::find($id);

        $provider = Provider::lists("Name", "id")->prepend('Please select', '');
        $category = Category::lists("Name", "id")->prepend('Please select', '');

        $fieldValue = FieldValue::where("service_id","=",$service->id)->get();



        return view('admin.manageservice.edit', compact('category', "service", "fieldValue", "provider"));
    }

    /**
     * Update the specified manageservice in storage.
     * @param UpdateManageServiceRequest|Request $request
     *
     * @param  int $id
     */
    public function update($id, UpdateManageServiceRequest $request)
    {
        $service = Service::findOrFail($id);


        $img = $request->get("Image");

//        print_r($request->all());

//        print_r($img);

//        die("SDFs");

        $request = $this->saveFiles($request);

        $img = $request->get("Image");

        if((isset($img))&&(!empty($img))){

            $serviceArray = array("Name"=>$request->get("Name"),"Description"=>$request->get("Description"),"Image"=>$img,"category_id"=>$request->get("category_id"),"provider_id"=>$request->get("provider_id"));
            $service->update($serviceArray);
        }else{
            $serviceArray = array("Name"=>$request->get("Name"),"Description"=>$request->get("Description"),"Image"=>$service->Image,"category_id"=>$request->get("category_id"),"provider_id"=>$request->get("provider_id"));
            $service->update($serviceArray);
        }



        $serviceId = $service->id;

        FieldValue::where("service_id","=",$serviceId)->delete();

        foreach ($request->get("fields") as $key => $value) {

            $serviceValue = array("service_id"=>$serviceId,"field_id"=>$key,"Value"=>$value);

            FieldValue::create($serviceValue);

        }


        return redirect()->route('admin.manageservice.index');
    }

    /**
     * Remove the specified manageservice from storage.
     *
     * @param  int $id
     */
    public function destroy($id)
    {
        Service::destroy($id);
        FieldValue::where("service_id","=",$id)->delete();



        return redirect()->route('admin.manageservice.index');
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
            FieldValue::where("service_id","=",$toDelete)->delete();

        } else {
            Service::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.manageservice.index');
    }

}
