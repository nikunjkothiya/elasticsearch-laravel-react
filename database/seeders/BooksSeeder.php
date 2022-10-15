<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($n = 0; $n < 15; $n++) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://fakerapi.it/api/v1/books?_quantity=1000',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $res = json_decode($response);
            if (isset($res->data) && count($res->data) > 0) {
                foreach ($res->data as $key => $value) {
                    Book::create([
                        'title' => $value->title,
                        'author' => $value->author,
                        'genre' => $value->genre,
                        'description' => $value->description,
                        'isbn' => $value->isbn,
                        'image' => $value->image,
                        'published' => $value->published,
                        'publisher' => $value->publisher
                    ]);
                }
            }
            sleep(10);
        }
    }
}
