@extends('layouts.app')

@section('content')
<section class="col-9">
    <h2>My Entries:: <small>{{$user['name']}}</small></h2>
    @foreach($user['entries'] as $entry)
        <article class="entry-item">
            <h3>{{$entry['title']}}</h3>
            <p class="text-right"><a href="{{asset("entry/".$entry['id'])}}" class="btn btn-outline-primary">Edit</a></p>
            <p class="date text-right">{{date("Y-m-d", strtotime($entry['created_at']))}}</p>
            <p>{{$entry['content']}}</p>
            <hr>
        </article>
    @endforeach
    
</section>

<aside class="col-3">
   @include("miscelanious/timeline-myentries")
</aside>
@endsection

<script type="text/javascript">
    function showHide(id, hide){
        $.ajax({
            type:'POST',
            url:'/ajaxRequest',
            data:{id:id, hide:hide},
            success:function(data){
                alert(data.success);
                if(hide==1){
                    $("#div_"+id).html('<btn id="btn_"'+id+' class="btn btn-outline-primary" onclick="showHide('+id+', 0);">Hide</btn>');
                } else {
                    $("#div_"+id).html('<btn id="btn_"'+id+' class="btn btn-outline-primary" onclick="showHide('+id+', 1);">Show</btn>');
                }
                
            }
        });
    }
</script>