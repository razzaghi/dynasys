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

{!! Form::model($field, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.field.update', $field->id))) !!}

<div class="form-group">
    {!! Form::label('Name', 'نام *', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('Name', old('Name',$field->Name), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('category_id', 'دسته *', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('category_id', $category, old('category_id',$field->category_id), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('Description', 'توضیحات', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('Description', old('Description',$field->Description), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('IsInFiltering', 'در فیلترینگ بیاید؟', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('IsInFiltering','') !!}
        {!! Form::checkbox('IsInFiltering', 1, $field->IsInFiltering == 1) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('IsRequirement', 'لازم است کاربر وارد نماید؟', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('IsRequirement','') !!}
        {!! Form::checkbox('IsRequirement', 1, $field->IsRequirement == 1) !!}

    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.field.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection