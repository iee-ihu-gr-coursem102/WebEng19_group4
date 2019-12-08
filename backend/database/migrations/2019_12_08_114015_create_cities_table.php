<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->string("country");
            $table->float("lon",10,7);
            $table->float("lat",10,7);

            $table->index(['name']);
            $table->index(['lon']);
            $table->index(['lat']);
        });

        $this->insertCities();        
    }

    /**
     * Insert cities from json file provided by openweathermap.
     *
     * @return void
     */
    private function insertCities()
    {
        if(!Storage::exists('city.list.json'))
            throw new FileNotFoundException("Cities json file not found", 404);

        $contents = Storage::get('city.list.json');  
        $contents = json_decode($contents,true);

        foreach($contents as &$city)
        {
            $city['lon'] = $city['coord']['lon'];
            $city['lat'] = $city['coord']['lat'];
            unset($city['coord']);
            DB::table('cities')->insert($city);     
        }        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
