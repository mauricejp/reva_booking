@extends('app')

@section('content')

<div class="container media:w-5 border p-4 mt-4">
    <h2>Mis reservas</h2>

    @if($bookings->isEmpty())
        <p>No tienes reservas realizadas.</p>
    @else
        <ul>
            @foreach($bookings as $booking)
                <li>{{ $booking->id }} - {{ $booking->field->name }} - {{ $booking->start_time }} - {{ $booking->end_time }}
                    <form method="POST" action="{{ route('bookings.destroy', ['booking' => $booking->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</div>

@endsection
