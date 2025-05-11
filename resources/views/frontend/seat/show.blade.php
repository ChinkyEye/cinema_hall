@extends('frontend.app')
@section('content')
@include('frontend.header');
<section class="breadcrumb-section set-bg" data-setbg="{{URL::to('/')}}/frontend/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Booking Tickets/Seat Booking</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Tickets</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@auth
<div class="container">
    <h2 class="mb-4 text-center"></h2>
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
    <div class="text-left mt-4">
            <span class="badge badge-warning">VIP Seats</span><br>
            <span class="badge badge-info text-white">Accessible Seats</span><br>
            <span class="badge badge-dark">Occupied Seats</span><br>
            <span class="badge badge-light border border-dark text-dark">Available Seats</span>
    </div>
    <div class="text-center mt-4">
        <button id="bookSelected" class="btn btn-success" disabled>Book Selected Seats</button>
    </div>
</div>
@endauth
@guest
    <div class="alert alert-warning text-center">
        Please log in first to access this content.
    </div>
@endguest

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

             // Check if selecting this seat would leave a single gap
            if (leavesSingleGap(seatId)) {
                alert('You cannot leave a single seat gap.');
                return;
            }

            selectedSeats.push(seatId);
            this.classList.add('btn-primary');
        }

        // Enable or disable the "Book" button
        document.getElementById('bookSelected').disabled = selectedSeats.length === 0;
    });
});

document.getElementById('bookSelected').addEventListener('click', function() {
    axios.post('/book-seats', {
       user_id: "{{ Auth::user()->id }}",
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

// Function to check if seat selection leaves a single gap
function leavesSingleGap(seatId) {
    const allSeats = Array.from(document.querySelectorAll('.seat:not(.disabled)'));
    const seatIndexes = allSeats.map(seat => parseInt(seat.dataset.seatId, 10));

    const selectedIndexes = selectedSeats.map(id => parseInt(id, 10));
    const currentIndex = parseInt(seatId, 10);

    // Ensure sequential selection without leaving gaps
    selectedIndexes.push(currentIndex);
    selectedIndexes.sort((a, b) => a - b);

    for (let i = 0; i < selectedIndexes.length - 1; i++) {
        if (selectedIndexes[i + 1] - selectedIndexes[i] === 2) {
            return true; // A single gap is found
        }
    }

    return false;
}

</script>

@endsection

