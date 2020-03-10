<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_chats')->insert([
            [
          'room_name' => '1',
          'id_room' => '70a9824d-c0fa-4129-8932-4d940dc28972',
          'id_user_create_room' => 'CoderLAT'
            ],
            [
          'room_name' => '2',
          'id_room' => 'c63b174e-05ca-40b9-8234-52557de527d9',
          'id_user_create_room' => 'CoderLAT'
            ],
            [
          'room_name' => '3',
          'id_room' => '299a9ccf-475b-4319-88c0-5d8a1740f3b0',
          'id_user_create_room' => 'CoderLAT'
            ],
            [
          'room_name' => '4',
          'id_room' => 'af88fd67-8bd4-4ccf-97a6-c237a8862105',
          'id_user_create_room' => 'CoderLAT'
            ],
        ]);
    }
}
