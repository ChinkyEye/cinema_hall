<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Seat;
use App\Models\Booking;
use Auth;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function seating($id)
    {
        $movie_id = $id;
        $seats = Seat::where('movie_id',$movie_id)->get();
        $seats_count = count($seats);
        // dd($seats_count);
        return view('user.seat.index', compact('movie_id','seats','seats_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSeat($movie_id)
    {
        $movie = Movie::findOrFail($movie_id);
        $user = Auth::user();

        for ($row = 1; $row <= 10; $row++) {
            for ($col = 1; $col <= 12; $col++) {
                $type = 'regular';

                if ($row <= 2 && $col >= 4 && $col <= 9) {
                    $type = 'vip';
                }

                if ($row % 2 == 0 && ($col == 1 || $col == 12 || $col == 6)) {
                    $type = 'accessible';
                }

                Seat::create([
                    'movie_id' => $movie->id,
                    'row' => $row,
                    'column' => $col,
                    'type' => $type,
                    'is_occupied' => false,
                    'created_by' => $user->id,
                ]);
            }
        }

        return redirect()->back()->with('alert-success', 'Seats generated for ' . $movie->name);
        // return redirect()->route('user.seat.index')->with($pass);



    }
    public function create()
    {
        dd("milan");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function isActive(Request $request,$id)
    {
        $get_is_occupied = Seat::where('id',$id)
                        ->value('is_occupied');
        $isoccupied = Seat::find($id);
        if($get_is_occupied == 0){
            $isoccupied->is_occupied = 1;
            $bookings = new Booking;
            $bookings->seat_id = $id;
            $bookings->user_id = Auth::user()->id;
            $bookings->save();
            $notification = array(
              'message' => $isoccupied->name.' is Booked!',
              'alert-type' => 'success'
          );
        }
        else {
            $isoccupied->is_occupied = 0;
            $seats = Booking::where('seat_id',$id)->first();
            $seats->delete();
            $notification = array(
              'message' => $isoccupied->name.' is Cancel!',
              'alert-type' => 'error'
          );
        }
        if(!($isoccupied->update())){
            $notification = array(
              'message' => 'data could not be changed!',
              'alert-type' => 'error'
          );
        }
        return back()->with($notification)->withInput();
    }
}
