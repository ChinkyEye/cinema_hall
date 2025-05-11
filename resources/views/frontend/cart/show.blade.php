@extends('frontend.app')
@section('content')
@include('frontend.header');

<div class="container">
    <h2 class="mb-4 text-center">Seat Booking</h2>

    @foreach($seats as $row => $cols)
    <div class="d-flex justify-content-center mb-2">
        @foreach($cols as $seat)
        @php
        $classes = 'seat btn mx-1';
        if ($seat->is_occupied) $classes .= ' btn-dark disabled';
        elseif ($seat->type == 'vip') $classes .= ' btn-warning';
        elseif ($seat->type == 'accessible') $classes .= ' btn-info text-white';
        else $classes .= ' btn-outline-secondary';
        @endphp

        <button class="{{ $classes }}" data-seat-id="{{ $seat->id }}" {{ $seat->is_occupied ? 'disabled' : '' }}>
            R{{ $seat->row }}C{{ $seat->column }}
        </button>
        @endforeach
    </div>
    @endforeach
    <div class="text-center mt-4">
        <button id="bookSelected" class="btn btn-success" disabled>Book Selected Seats</button>
    </div>
</div>

@endsection
@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
let selectedSeats = [];

document.querySelectorAll('.seat:not(.disabled)').forEach(button => {
    button.addEventListener('click', function() {
        const seatId = this.dataset.seatId;

        if (selectedSeats.includes(seatId)) {
            selectedSeats = selectedSeats.filter(id => id !== seatId);
            this.classList.remove('btn-primary');
        } else {
            selectedSeats.push(seatId);
            this.classList.add('btn-primary');
        }

        // Enable or disable the "Book" button
        document.getElementById('bookSelected').disabled = selectedSeats.length === 0;
    });
});

document.getElementById('bookSelected').addEventListener('click', function() {
    axios.post('/book-seats', {
        seat_ids: selectedSeats,
        _token: '{{ csrf_token() }}'
    })
    .then(response => {
        alert(response.data.message);
        location.reload();
    })
    .catch(error => {
        alert(error.response.data.message || 'Booking failed');
    });
});
</script>
@endsection

