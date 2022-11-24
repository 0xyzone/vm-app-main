<?php

namespace App\Http\Controllers;

use App\Models\Tables;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    //View Tables
    public function viewTable(){
        $tables = Tables::all();
        return view('public.tables', [
            'tables' => $tables,
            'public' => 'pub',
        ]);
    }

    // Ajax - Fetch Tables
    public function fetch(){
        $tables = Tables::all();
        $output = "";

        foreach ($tables as $table){
            if ($table['availability'] == 'Occupied') {
                $aclass = 'bg-gray-600';
                $iclassBig = 'fa-duotone fa-lock fa-4x !hidden lg:!inline-block';
                $iclassSmall = 'fa-duotone fa-lock fa-2x lg:!hidden';
                $style = '#B71C1C;';
                $pclass = "text-gray-200";
                $divclass = "text-gray-500";
            } elseif ($table['availability'] == 'Reserved') {
                $aclass = 'bg-amber-500';
                $iclassBig = 'fa-solid fa-book-bookmark fa-4x !hidden lg:!inline-block text-amber-800 group-hover:text-amber-500 smooth';
                $iclassSmall = 'fa-solid fa-book-bookmark fa-2x lg:!hidden text-amber-800 group-hover:text-amber-500 smooth';
                $style = '';
                $pclass = "smooth";
                $divclass = "text-amber-800 smooth";
            } elseif ($table['availability'] == 'Available') {
                $aclass = '';
                $iclassBig = 'fa-duotone fa-lock-open fa-4x !hidden lg:!inline-block';
                $iclassSmall = 'fa-duotone fa-lock-open fa-3x lg:!hidden';
                $style = '#4CAF50';
                $pclass = "";
                $divclass = "";
            }

            $output.=
            '
            <div
                class="bg-gray-200 rounded-lg flex gap-4 items-center p-4 '. $aclass .' smooth group">
                <i class="'. $iclassBig .'"
                    style="--fa-primary-color: '. $style .'"></i>
                <i class="'. $iclassSmall .'" style="--fa-primary-color: '. $style .'"></i>
                <div class="flex flex-col h-full w-full justify-center gap-1">
                    <p
                        class="lg:text-4xl font-thin '. $pclass .'">
                        '. $table['name'] .'</p>
                    <div
                        class="text-xs '. $divclass .' text-gray-400 lg:pl-1.5">
                        Floor:
                        <span class="font-bold">'. $table['floor'] .'</span>
                        <span class="gap-1 text-xs font-thin inline-flex">
                            <i class="fa-solid fa-loveseat lg:pl-1.5 text-gray-700 smooth"></i>
                        </span><span class="font-bold"> '. $table['seats'] .' </span> seats
                    </div>

                </div>
            </div>
            ';
        }
        return response($output);
    }
}
