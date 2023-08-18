<?php

namespace App\Services\API;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class ApiService
{


    public function getHolidaysData($value)
    {
        $array = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/APIHariLibur_V2/main/calendar.json"),true);

        //check tanggal merah berdasarkan libur nasional
        if(isset($array[$value]) && $array[$value]["holiday"])
        :		echo"tanggal merah\n";
                dd($array[$value]);
        
            //check tanggal merah berdasarkan hari minggu
            elseif(
        date("D",strtotime($value))==="Sun")
            :echo"tanggal merah hari minggu";
        
            //bukan tanggal merah
            else
                :echo"bukan tanggal merah";
            endif;


    }


}










