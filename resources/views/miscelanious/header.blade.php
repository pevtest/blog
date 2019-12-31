<div class="col-12">   
    @if(Route::current()->getName() != 'entry.index')
        <a href="{{asset("entries")}}" class="btn btn-primary">All Entries</a>
    @endif
    @if(Auth::check())        
        @if(Route::current()->getName() != 'entry.myentries')
            <a href="{{asset("myentries")}}" class="btn btn-primary">My Entries</a>
        @endif 
        @if(Route::current()->getName() != 'entry.create')
             <a href="{{asset("entry/create")}}" class="btn btn-primary">Create Entry</a>
        @endif
       
    @endif
</div>