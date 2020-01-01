 @for($i=0; $i< count($json); $i++)
        @if($i == 0)
            <div class="entry-title">
               <h3>
                   Tweets <small> by <a href="https://twitter.com/{{$json[$i]->user->screen_name}}" title="{{$json[$i]->user->name}} on Twitter">&#64;{!! $json[$i]->user->screen_name!!}</a></small>
               </h3>
           </div>
        @endif
        <article class="entry-item">
            <div class="entry-head">
               <img src="{{$json[$i]->user->profile_image_url_https}}" class="img"/>
               <p> 
                   <a href="https://twitter.com/{{$json[$i]->user->screen_name}}" title="{{$json[$i]->user->name}} ">{!! $json[$i]->user->name!!}</a>
                   @if($json[$i]->user->verified == true)
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                   @endif
               </p>
               <p>
                   <a href="https://twitter.com/{{$json[$i]->user->screen_name}}" title="{{$json[$i]->user->name}}">&#64;{!! $json[$i]->user->screen_name!!}</a>
               </p>
             </div>
             <div class="entry-body">
                 <p><a href="https://twitter.com/{{$json[$i]->in_reply_to_screen_name}}" title="Replying to {{$json[$i]->in_reply_to_screen_name}}">Replying to &#64;{!! $json[$i]->in_reply_to_screen_name!!}</a></p>
                 <p>{{$json[$i]->text}}</p>

                 <p class="entry-date">
                     <strong>Created at:</strong> {{date("Y-m-d h:m", strtotime($json[$i]->created_at))}}
                 </p>

             </div>

             <div class="entry-footer">
                 <p class="entry-like"><i class="fa fa-heart" aria-hidden="true"></i> {{$json[$i]->favorite_count}}</p>
                 <p class="entry-share"><i class="fa fa-retweet" aria-hidden="true"></i> {{$json[$i]->retweet_count}}</p>
                 @if($json[$i]->show)
                 <div id="div_{{$json[$i]->iddb}}"><btn id="btn_{{$json[$i]->iddb}}" class="btn btn-outline-primary" onclick="showHide({{$json[$i] -> iddb}}, 0);">Hide</btn></div>
                 @else
                 <div id="div_{{$json[$i]->iddb}}"><btn id="btn_{{$json[$i]->iddb}}" class="btn btn-outline-primary" onclick="showHide({{$json[$i] -> iddb}}, 1);">Show</btn></div>
                 @endif
             </div>
             <hr>

        </article>


@endfor
