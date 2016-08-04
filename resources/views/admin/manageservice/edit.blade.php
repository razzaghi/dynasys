@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-sm-10 col-sm-offset-2">
            <h1>{{ trans('quickadmin::templates.templates-view_edit-edit') }}</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                    </ul>
                </div>
            @endif
        </div>
    </div>

{{--    {!! Form::model($service, array('files' => true, 'class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.manageservice.update', $service->id))) !!}--}}

    {!! Form::open(array('files' => true, 'route' => array('admin.manageservice.update', $service->id), 'method' => 'PATCH', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

    <div class="form-group">
        {!! Form::label('category_id', 'Category', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::select('category_id', $category, old('category_id',$service->category_id), array('class'=>'form-control')) !!}

        </div>
    </div>

    <div class="form-group">
        {!! Form::label('Name', 'Name', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::text('Name', old('Name',$service->Name), array('class'=>'form-control')) !!}

        </div>
    </div>
    <div class="form-group">
        {!! Form::label('Image', 'Image', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-2">
            {!! Form::file('Image') !!}
            {!! Form::hidden('Image_w', 4096) !!}
            {!! Form::hidden('Image_h', 4096) !!}
        </div>
        <div class="col-sm-3">
            <img src="/uploads/thumb/{{ $service->Image }}" />
        </div>


    </div>

    <div class="form-group">
        {!! Form::label('provider_id', 'Provider', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::select('provider_id', $provider, old('provider_id',$service->provider_id), array('class'=>'form-control')) !!}

        </div>
    </div>

    @foreach($fieldValue as $field)

        <div class="form-group">
            {!! Form::label('Name', $field->field->Name, array('class'=>'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!! Form::text("fields[".$field->field->id."]", old('Name',$field->Value), array('class'=>'form-control')) !!}

            </div>
        </div>

    @endforeach
    <div class="row serviceFields">

    </div>

    <div class="form-group">
        {!! Form::label('Description', 'Description', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::textarea('Description', old('Description',$service->Description), array('class'=>'form-control')) !!}
        </div>
    </div>




    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
            {!! link_to_route('admin.manageservice.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection