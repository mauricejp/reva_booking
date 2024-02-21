@extends('app')

@section('content')

<div class="container w-64 border p-4 mt-4">
    <h2>Venues Disponibles</h2>
    @if(session('success'))
    <div class="alert alert-success mt-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger mt-4">
        {{ session('error') }}
    </div>
@endif
    @foreach($venues as $venue)
        <div class="mb-4">
            <h3>{{ $venue->name }}</h3>
            @if($venue->fields->isEmpty())
                <p>No hay fields disponibles.</p>
            @else
                <ul class="list-group">
                    @foreach($venue->fields as $field)
                        <li class="list-group-item @if($field->is_reserved) text-danger @endif">
                            @if(!$field->is_reserved)
                                {{ $field->name }}
                                @auth <!-- Verificar si el usuario está autenticado -->
                                <form method="POST" action="{{ route('bookings.store', ['field_id' => $field->id]) }}">
                                    @csrf
                                    <input type="hidden" name="field_id" value="{{ $field->id }}">
                                    <div class="form-group">
                                        <label for="start_time">Hora de inicio:</label>
                                        <input type="time" id="start_time" name="start_time" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="end_time">Hora de fin:</label>
                                        <input type="time" id="end_time" name="end_time" class="form-control">
                                    </div>                                    
                                    <button type="submit" class="btn btn-success">Reservar</button>
                                </form>
                                @else
                                <a href="{{ route('login') }}" class="btn btn-primary">Inicia sesión para reservar</a>
                                @endauth
                            @else
                                {{ $field->name }} - Ya reservada
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endforeach
</div>

@endsection
