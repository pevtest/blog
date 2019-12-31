@extends('layouts.app')


@section('content')
<div class="col-6 offset-3">
    {!!Form::open(['route' => 'entry.store', 'method' => 'post'])!!}
        <h2>Edit Entry</h2>
        <!-- Control Title -->
        <div class="form-group" id="title_wrapper">
           {{Form::label('title', 'Title')}}
           {{Form::text('title', old('title') ? old('title') : $title , array('class' => 'form-control', "id"=>"title")) }}
           @if($errors->first('title')!="")
           <span class="alert alert-danger" id="title-alert"><i class="fa fa-times-circle" aria-hidden="true"></i> {{$errors->first('title')}}</span>
           @endif
        </div>

        <!-- Control Content -->
        <div class="form-group" id="content_wrapper">
           {{Form::label('content', 'Content')}}
           {{ Form::textarea('content', old('content') ? old('content') : $content , array('class' => 'form-control', "id"=>"content")) }}
           @if($errors->first('content')!="")
           <span class="alert alert-danger" id="content-alert"><i class="fa fa-times-circle" aria-hidden="true"></i> {{$errors->first('content')}}</span>
           @endif
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Submit">
            <a class="btn btn-primary" href="{{asset("myentries")}}" role="button">Cancel</a>
        </div>
            
    {!! Form::close() !!}
        </div>


@endsection

