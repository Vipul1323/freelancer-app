@extends('layouts.app')

@section('title', __('New Project') )

@section('css')
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: 'textarea#description',
    skin: 'bootstrap',
    plugins: 'lists, link, image, media',
    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image | removeformat',
    menubar: false
  });
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	<div class="container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                		<h4 class="title">
                			{{ __('New Project') }}
                		</h4>
                	</div>
            	</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {!! Form::open(['url' => 'project/new', 'method' => 'post','autocompleted'=>false,'enctype'=>'multipart/form-data']) !!}
                    	<div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-6">
                            	{{ Form::text("title", old('title'),array('required'=>true,'class' => 'form-control form-input', 'id' => 'title','placeholder' => __('Title'))) }}

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                            	{{ Form::textarea("description", old('description'),array('class' => 'form-control form-input','rows'=>3, 'id' => 'description','placeholder' => __('Description'))) }}

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="due_date" class="col-md-2 col-form-label text-md-right">{{ __('Due Date') }}</label>
                            <div class="col-md-6">
                            	{{ Form::date("due_date", old('due_date'),array('required'=>true,'class' => 'form-control form-input', 'id' => 'due_date','placeholder' => __('Due Date'))) }}

                                @if ($errors->has('due_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('due_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="files" class="col-md-2 col-form-label text-md-right">{{ __('Files') }}</label>
                            <div class="col-md-6">
                            	{{ Form::file("files[]",array('class' => 'form-control form-input', 'id' => 'files','multiple'=>true,'placeholder' => __('Files'))) }}

                                @if ($errors->has('files'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('files') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="assigned_to" class="col-md-2 col-form-label text-md-right">{{ __('Assign To') }}</label>
                            <div class="col-md-6">
                            	{{ Form::select("assigned_to", $users ,old('assigned_to'),array('required'=>true,'class' => 'form-control form-select', 'id' => 'assigned_to','placeholder' => __('Assign To'))) }}

                                @if ($errors->has('assigned_to'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('assigned_to') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-md-8 offset-md-2">
                                {!! Form::submit(__('Add'), array('class' => 'btn btn-primary mr-2','id'=>"add" )) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection