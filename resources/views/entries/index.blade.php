@extends('layouts.app')

@section('content')
@foreach($users as $user)
@if(count($user->entries) > 0)
<section class="col-9">
    <h2>{{$user->name}}</h2>
    @php 
        $i=0;
    @endphp
    @foreach($user->entries as $entry)
        @if($i<3)
        <article class="entry-item">
            <p class="date text-right">{{date("Y-m-d", strtotime($entry->created_at)) }}</p>
            <h3>{{$entry->title}}</h3>
            <p>{{substr($entry->content, 0, 100).'...'}}</p>    
            <p class="text-right"><a class="btn btn-outline-primary" href="{{asset('entry/show/'.$entry->id)}}">Read the full article</a></p>
        </article>
            @php $i++; @endphp
        @endif
    @endforeach
    <hr>
</section>


<aside class="col-3">
    @include("miscelanious/timeline-index")
</aside>   
@endif
@endforeach
<div class="d-flex">
<div class="mx-auto">
{{$users->links("pagination::bootstrap-4")}} 
</div>
</div>
@endsection


