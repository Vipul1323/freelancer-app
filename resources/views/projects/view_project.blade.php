@extends('layouts.app')

@section('title', $projectObj->title )


@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	<div class="container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                		<h4 class="title">
                			{{ __('Project Details') }}
                		</h4>
                        @if(isset($projectObj->User) && !empty($projectObj->User->name))
                            <div>
                                <span class="font-weight-600">{{ __('Created By:') }}</span>
                                <span>{{ $projectObj->User->name }}</span>
                            </div>
                        @endif
                	</div>
            	</div>

                <div class="card-body">
                    <div class="container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                        <h2 class="title">{{ $projectObj->title }}</h2>
                        <div class="text-right">
                            @if(!empty($projectObj->due_date))
                                <span class="font-weight-600">{{ __('Due Date:') }}</span>
                                <span>{{ date('d F, Y',strtotime($projectObj->due_date)) }}</span>
                            @endif
                            <br>
                            @if(isset($projectObj->AssignedTo) && !empty($projectObj->AssignedTo->name))
                                <span class="font-weight-600">{{ __('Assigned To:') }}</span>
                                <span>{{ $projectObj->AssignedTo->name }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="container-fluid">
                        {!! $projectObj->description !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-1">
            <div class="card">
                <div class="card-header">
                    <div class="container-fluid  d-flex align-items-center flex-wrap flex-sm-nowrap">
                        <h4 class="title">
                            {{ __('Files') }}
                        </h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('File Name') }}</th>
                                    <th>{{ __('Uploaded By') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($projectObj->ProjectHasFiles) && $projectObj->ProjectHasFiles->count() > 0)
                                    @foreach($projectObj->ProjectHasFiles as $fileObj)
                                        @if(file_exists(public_path('uploads/projects/'.$fileObj->file_name)))
                                        <tr>
                                            <td>
                                                <a href="{{ url('public/uploads/projects/'.$fileObj->file_name) }}" target="_blank"> {{ $fileObj->file_name }}</a>
                                            </td>
                                            <td>{{ isset($fileObj->User->name) && !empty($fileObj->User->name) ? $fileObj->User->name : 'N/A' }}</td>
                                            <td>
                                                <a href="{{ url('public/uploads/projects/'.$fileObj->file_name) }}" target="_blank"> {{ __('View') }}</a>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2">{{ __('No any notes Yet') }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection