@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-sm-10 col-sm-offset-2">
            <h1>{{ trans('quickadmin::templates.templates-view_create-add_new') }}</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                    </ul>
                </div>
            @endif
        </div>
    </div>

    {!! Form::open(array('files' => true, 'route' => 'admin.service.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

    <div class="form-group">
        {!! Form::label('category_id', 'Category', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::select('category_id', $category, old('category_id'), array('class'=>'form-control')) !!}

        </div>
    </div>


    <div class="form-group">
        {!! Form::label('Name', 'Name', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::text('Name', old('Name'), array('class'=>'form-control')) !!}

        </div>
    </div>
    <div class="form-group">
        {!! Form::label('Image', 'Image', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::file('Image') !!}
            {!! Form::hidden('Image_w', 4096) !!}
            {!! Form::hidden('Image_h', 4096) !!}

        </div>
    </div>
    <div class="form-group">
        {!! Form::label('Description', 'Description', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::textarea('Description', old('Description'), array('class'=>'form-control')) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('provider_id', 'Provider', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::select('provider_id', $provider, old('provider_id'), array('class'=>'form-control')) !!}

        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            {!! Form::submit( trans('quickadmin::templates.templates-view_create-create') , array('class' => 'btn btn-primary')) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection