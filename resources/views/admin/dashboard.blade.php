@extends(((Auth::user()->privileges == 'A') ? 'layouts.master_admin' : 'layouts.master_dataEntry'))

@section('content')
    <div class="page-header col-12">
            <div class="row">
                @if(Auth::user()->privileges == 'A')
                    <h2>Admin Dashboard</h2>
                @elseif(Auth::user()->privileges == 'D')
                    <h2>Data-Entry Dashboard</h2>
                @endif
                
                <p>All information you want to know about website</p>
            </div>
        </div>
        <div class="page-content col-12">
            <div class="row">
                
            </div>
        </div>
@endsection