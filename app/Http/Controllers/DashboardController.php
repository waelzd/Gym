<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Basic totals
        $totalSubscribers = DB::table('subscribers')->count();
        $paidSubscribers = DB::table('subscribers')->where('status', 'paid')->count();
        $unpaidSubscribers = DB::table('subscribers')->where('status', 'unpaid')->count();
        $monthlyRevenue = DB::table('subscribers')->where('status', 'paid')->sum('fees');

        // Prepare chart data
        $subscribers = DB::table('subscribers')
            ->selectRaw("MONTHNAME(subscription_date) as month, status, COUNT(*) as count")
            ->whereYear('subscription_date', Carbon::now()->year)
            ->groupBy('month', 'status')
            ->orderByRaw('MONTH(subscription_date)')
            ->get();

        $months = [];
        $paidData = [];
        $unpaidData = [];

        $allMonths = collect(range(1, 12))->map(function ($m) {
            return Carbon::create()->month($m)->format('F');
        });

        foreach ($allMonths as $month) {
            $months[] = $month;
            $paid = $subscribers->firstWhere(fn($s) => $s->month === $month && $s->status === 'paid');
            $unpaid = $subscribers->firstWhere(fn($s) => $s->month === $month && $s->status === 'unpaid');

            $paidData[] = $paid ? $paid->count : 0;
            $unpaidData[] = $unpaid ? $unpaid->count : 0;
        }

        return view('pages.dashboard', compact(
            'totalSubscribers',
            'paidSubscribers',
            'unpaidSubscribers',
            'monthlyRevenue',
            'months',
            'paidData',
            'unpaidData'
        ));
    }

    public function showChart()
{
    $paidCount = Subscriber::where('status', 'paid')->count();
    $unpaidCount = Subscriber::where('status', 'unpaid')->count();

    return view('pages.subscribers_chart', compact('paidCount', 'unpaidCount'));
}
}
