<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class HelpersController extends Controller
{
    public function convertDateFormat($dateString)
    {
        try {
            $date = new DateTime($dateString);
            return $date->format('d/m/Y');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid date format'], 400);
        }
    }
}
