<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;

class ReportsController extends Controller
{
public function showChart()
{
    $paidCount = Subscriber::where('status', 'paid')->count();
    $unpaidCount = Subscriber::where('status', 'unpaid')->count();

    $maleCount = Subscriber::where('gender', 'male')->count();
    $femaleCount = Subscriber::where('gender', 'female')->count();

    return view('pages.reports', compact('paidCount', 'unpaidCount', 'maleCount', 'femaleCount'));
}

}
