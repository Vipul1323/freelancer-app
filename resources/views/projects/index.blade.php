@extends('layouts.app')

@section('title', __('Projects') )

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	<div class="container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                		<h4 class="title">
                			{{ __('Projects') }}
                		</h4>
                        @hasrole('Client')
                		<a href="{{ url('project/new') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="false"></i> {{ __('Project') }}</a>
                        @endhasrole
                	</div>
            	</div>

                <div class="card-body">
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
                    <table id="projectsTable">
                    	<thead>
                    		<tr>
                    			<th>{{ __('Project Id') }}</th>
                    			<th>{{ __('Title') }}</th>
                    			<th>{{ __('Due Date') }}</th>
                    			<th>{{ __('Asigned To') }}</th>
                    			<th>{{ __('Created At') }}</th>
                    		</tr>
                    	</thead>
                        <tbody>
                            @if(count($projects) > 0)
                                @foreach($projects as $projectObj)
                                    <tr>
                                        <td>
                                            <a href="{{ url('project/'.$projectObj->project_id) }}" title="{{ __('View Project') }}">{{ $projectObj->project_id }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('project/'.$projectObj->project_id) }}" title="{{ __('View Project') }}">{{ $projectObj->title }}</a>
                                        </td>
                                        <td>{{ date('d F, Y',strtotime($projectObj->due_date)) }}</td>
                                        <td>{{ isset($projectObj->AssignedTo) && !empty($projectObj->AssignedTo) ?  $projectObj->AssignedTo->name : "N/A" }}</td>
                                        <td>{{ date('d F, Y',strtotime($projectObj->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    (function () {
        "use strict";
        $('#projectsTable').DataTable();
    })();
    </script>
@endsection