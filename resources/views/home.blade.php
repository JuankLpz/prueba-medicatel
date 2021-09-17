@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mis citas') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($schedule as $sc)

                    @if($sc->user_id == Auth::user()->id)
                    <div class="card mx-auto" style="width: 18rem;">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">{{ $sc->title }}</li>
                          <li class="list-group-item">{{$sc->start }}</li>
                          <li class="list-group-item">{{$sc->end }}</li>
                          <a href="{{route('schedule.destroy', ['id'=>$sc->id])}}" class="btn btn-sm btn-danger">
                            Eliminar</a>
                        </ul>
                      </div>

                    <hr>   
                    @endif
                    

                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
