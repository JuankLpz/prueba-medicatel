@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Nuestros Veterinarios</div>
            

            <div class="card-body">


                @foreach ($vets as $vet)
                
                <div class="card" style="width:400px">
                    <img class="card-img-top" src="{{ route('vet.avatar', ['file' => $vet->image]) }}" alt="Card image">
                    <div class="card-body">
                      <h4 class="card-title">{{ $vet->name }}</h4>
                    </div>
                  </div>

                  <hr>
                
                @endforeach
                

            </div>
        </div>
            
        </div>
    </div>
</div>

@endsection