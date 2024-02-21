@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Reservas del lugar</h2>
        @if ($bookings->isEmpty())
            <p>No hay reservas para este lugar.</p>
        @else
            <ul>
                @foreach ($bookings as $booking)
                    <li>{{ $booking->id }} - {{ $booking->field->name }} - {{ $booking->start_time }} - {{ $booking->end_time }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
