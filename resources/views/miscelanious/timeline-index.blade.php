 @php $user_id= $user->id; @endphp

@foreach ($json[$user->id] as $json_user)
        @if($loop->first)
            <div class="entry-title">
               <h3>
                   Tweets <small> by <a href="https://twitter.com/{{$json_user->user->screen_name}}" title="{{$json_user->user->name}} on Twitter">&#64;{!! $json_user->user->screen_name!!}</a></small>
               </h3>
           </div>
        @endif
       
    <article class="entry-item">
            <div class="entry-head">
               <img src="{{$json_user->user->profile_image_url_https}}" class="img"/>
               <p> 
                   <a href="https://twitter.com/{{$json_user->user->screen_name}}" title="{{$json_user->user->name}} ">{!! $json_user->user->name!!}</a>
                   @if($json_user->user->verified == true)
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                   @endif
               </p>
               <p>
                   <a href="https://twitter.com/{{$json_user->user->screen_name}}" title="{{$json_user->user->name}}">&#64;{!! $json_user->user->screen_name!!}</a>
               </p>
             </div>
             <div class="entry-body">
                 <p><a href="https://twitter.com/{{$json_user->in_reply_to_screen_name}}" title="Replying to {{$json_user->in_reply_to_screen_name}}">Replying to &#64;{!! $json_user->in_reply_to_screen_name!!}</a></p>
                 <p>{{$json_user->text}}</p>

                 <p class="entry-date">
                     <strong>Created at:</strong> {{date("Y-m-d h:m", strtotime($json_user->created_at))}}
                 </p>

             </div>

             <div class="entry-footer">
                 <p class="entry-like"><i class="fa fa-heart" aria-hidden="true"></i> {{$json_user->favorite_count}}</p>
                 <p class="entry-share"><i class="fa fa-retweet" aria-hidden="true"></i> {{$json_user->retweet_count}}</p>
            </div>
             <hr>

        </article>

@endforeach

