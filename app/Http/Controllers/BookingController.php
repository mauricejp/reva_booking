<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Booking;
use App\Models\Venue;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create(Request $request, $field_id)
    {
        // Obtener el campo específico por su ID
        $field = Field::findOrFail($field_id);
    
        // Validar los datos de la solicitud
        $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);
    
        // Verificar si el campo está disponible para reservar
        $isBooked = $field->bookings()
                        ->where('start_time', '<=', now()) // Verificar si la hora de inicio es menor o igual a la hora actual
                        ->where('end_time', '>', now())   // Verificar si la hora de finalización es mayor a la hora actual
                        ->exists();
    
    
        if ($isBooked) {
            // Si el campo ya está reservado, redireccionar con un mensaje de error
            return redirect()->back()->with('error', 'El campo seleccionado ya está reservado.');
        }
    
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();
    
        // Si el usuario no está autenticado, redireccionar a la página de inicio de sesión
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para reservar un campo.');
        }
    
        // Crear la reserva
        $booking = Booking::create([
            'field_id' => $field_id,
            'user_id' => $userId,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            // Otros campos de la reserva según sea necesario
        ]);
    
        // Verificar si la reserva se creó correctamente
        if ($booking) {
            // Obtener las reservas del usuario
            $bookings = auth()->user()->bookings()->get();
    
            // Redireccionar con un mensaje de éxito
            return redirect()->back()->with('success', 'Reserva creada exitosamente.')->with(compact('bookings'));
        } else {
            // Redireccionar con un mensaje de error si la reserva falló
            return redirect()->back()->with('error', 'Error al crear la reserva. Por favor, inténtalo de nuevo.');
        }
    }
    

    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'field_id' => 'required|exists:fields,id',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time',
        ]);
    
        // Obtener el campo
        $field = Field::findOrFail($request->field_id);
    
        // Verificar si el campo ya está reservado
        if ($field->is_reserved) {
            return redirect()->back()->with('error', 'El campo ya está reservado.');
        }
    
        // Crear la reserva
        $booking = Booking::create([
            'field_id' => $field->id,
            'user_id' => auth()->id(),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
    
        // Verificar si la reserva se creó correctamente
        if ($booking) {
            // Marcar el campo como reservado
            $field->update(['is_reserved' => true]);
    
            return redirect()->back()->with('success', 'Reserva creada exitosamente.');
        } else {
            return redirect()->back()->with('error', 'Error al crear la reserva. Por favor, inténtalo de nuevo.');
        }
    }
    
    
    


    public function index()
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Obtener el usuario autenticado
            $user = Auth::user();
    
            // Obtener las reservas del usuario
            $bookings = $user->bookings()->get();
    
            // Pasar las reservas a la vista
            return view('bookings.index', compact('bookings'));
        } else {
            // Si el usuario no está autenticado, redirigir a la página de inicio de sesión
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus reservas.');
        }
    }
    
    

    public function destroy(Booking $booking)
    {
        // Verificar si el usuario autenticado es el propietario de la reserva
        if ($booking->user_id != auth()->id()) {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar esta reserva.');
        }

        // Eliminar la reserva
        $booking->delete();

        // Redireccionar con un mensaje de éxito
        return redirect()->back()->with('success', 'Reserva eliminada exitosamente.');
    }

    public function venueBookings(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'venue_id' => 'required|exists:venues,id',
            'date' => 'required|date',
        ]);

        // Obtener las reservas para un venue en una fecha específica
        $venueBookings = Booking::whereHas('field', function ($query) use ($request) {
            $query->where('venue_id', $request->venue_id);
        })->whereDate('start_time', $request->date)->get();

        return view('bookings.venue_bookings', compact('venueBookings'));
    }

    public function fieldBookings(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'field_id' => 'required|exists:fields,id',
            'date' => 'required|date',
        ]);

        // Obtener las reservas para un campo específico en una fecha específica
        $fieldBookings = Booking::where('field_id', $request->field_id)
            ->whereDate('start_time', $request->date)
            ->get();

        return view('bookings.field_bookings', compact('fieldBookings'));
    }

    public function showVenueBookings($venue_id)
    {
        // Lógica para obtener las reservas del lugar con el ID $venue_id
        $bookings = Booking::where('venue_id', $venue_id)->get();

        // Pasar las reservas a la vista correspondiente
        return view('bookings.venue_bookings', compact('bookings'));
    }

    public function showReservationForm()
{
    // Obtener las reservas del usuario actual
    $bookings = auth()->user()->bookings;

    // Devolver la vista del formulario de reserva con las reservas
    return view('reservation.form', compact('bookings'));
}
}
