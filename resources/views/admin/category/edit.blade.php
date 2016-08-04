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

{!! Form::model($category, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.category.update', $category->id))) !!}

<div class="form-group">
    {!! Form::label('Name', 'نام *', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('Name', old('Name',$category->Name), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('Description', 'توضیحات', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('Description', old('Description',$category->Description), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('parent_id', 'پدر دسته', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('parent_id', $parentList, old('parent_id',$category->parent_id), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.category.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection