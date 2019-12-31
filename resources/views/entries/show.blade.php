@extends('layouts.app')

@section('content')
<div class="col-6 offset-3">

        <div class="entry-item">
            <h2>{{$entry['title']}}</h2>
            <h5>By {{$user['name']}}</h5>
            <p class="text-right"><a href="{{asset(url()->previous())}}" class="btn btn-outline-primary">Back</a></p>
            <p class="date text-right">{{date("Y-m-d", strtotime($entry['created_at']))}}</p>
            <p>{{$entry['content']}}</p>
            <hr>
        </div>

     <hr>
</div>
@endsection
