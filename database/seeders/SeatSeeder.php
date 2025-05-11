<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seat;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'user_type' => '1', //for employee
            'password' => Hash::make('admin123'),
        ]);

        // $user = User::first();

        // for ($row = 1; $row <= 10; $row++) {
        //     for ($col = 1; $col <= 12; $col++) {
        //         $type = 'regular';

        //         // VIP: front middle seats
        //         if ($row <= 2 && $col >= 4 && $col <= 9) {
        //             $type = 'vip';
        //         }

        //         // Accessible: edges and middle of even rows
        //         if ($row % 2 == 0 && ($col == 1 || $col == 12 || $col == 6)) {
        //             $type = 'accessible';
        //         }

        //         Seat::create([
        //             'row' => $row,
        //             'column' => $col,
        //             'type' => $type,
        //             'is_occupied' => false,
        //             'created_by' => $user->id
        //         ]);
        //     }
        // }
    }
}
