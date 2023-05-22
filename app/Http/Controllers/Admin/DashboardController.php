<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Visitor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $response, $title;

    public function __construct()
    {
        $this->title = 'dashboard';
    }

    public function _error($e)
    {
        $this->response = [
            'message' => $e->getMessage() . ' in file :' . $e->getFile() . ' line: ' . $e->getLine()
        ];
        return view('errors.message', ['message' => $this->response]);
    }

    public function index()
    {
        try {
            $title = $this->title;
            // Transaction persentase comparison today and yesterday 
            $transactionsToday = Transaction::whereDate('tanggal', date('Y-m-d'))->count();
            $transactionsYesterday = Transaction::whereDate('tanggal', date('Y-m-d', strtotime('-1 days')))->count();
            $transactionsTodayYesterdayPersentase = ($transactionsToday - $transactionsYesterday) / ($transactionsYesterday == 0 ? 1 : $transactionsYesterday) * 100;
            // Transaction persentase comparison week and last week
            $transactionsWeek = Transaction::whereBetween('tanggal', [date('Y-m-d', strtotime('monday this week')), date('Y-m-d', strtotime('sunday this week'))])->count();
            $transactionsLastWeek = Transaction::whereBetween('tanggal', [date('Y-m-d', strtotime('monday last week')), date('Y-m-d', strtotime('sunday last week'))])->count();
            $transactionsWeekLastWeekPersentase = ($transactionsWeek - $transactionsLastWeek) / ($transactionsLastWeek == 0 ? 1 : $transactionsLastWeek) * 100;
            // Transaction persentase comparison month and last month
            $transactionsMonth = Transaction::whereMonth('tanggal', date('m'))->count();
            $transactionsLastMonth = Transaction::whereMonth('tanggal', date('m', strtotime('-1 months')))->count();
            $transactionsMonthLastMonthPersentase = ($transactionsMonth - $transactionsLastMonth) / ($transactionsLastMonth == 0 ? 1 : $transactionsLastMonth) * 100;
            // Transaction persentase comparison year and last year
            $transactionsYear = Transaction::whereYear('tanggal', date('Y'))->count();
            $transactionsLastYear = Transaction::whereYear('tanggal', date('Y', strtotime('-1 years')))->count();
            $transactionsYearLastYearPersentase = ($transactionsYear - $transactionsLastYear) / ($transactionsLastYear == 0 ? 1 : $transactionsLastYear) * 100;

            // Visitor persentase comparison today and yesterday 
            $visitorsToday = Visitor::whereDate('tanggal', date('Y-m-d'))->count();
            $visitorsYesterday = Visitor::whereDate('tanggal', date('Y-m-d', strtotime('-1 days')))->count();
            $visitorsTodayYesterdayPersentase = ($visitorsToday - $visitorsYesterday) / ($visitorsYesterday == 0 ? 1 : $visitorsYesterday) * 100;
            // Visitor persentase comparison week and last week
            $visitorsWeek = Visitor::whereBetween('tanggal', [date('Y-m-d', strtotime('monday this week')), date('Y-m-d', strtotime('sunday this week'))])->count();
            $visitorsLastWeek = Visitor::whereBetween('tanggal', [date('Y-m-d', strtotime('monday last week')), date('Y-m-d', strtotime('sunday last week'))])->count();
            $visitorsWeekLastWeekPersentase = ($visitorsWeek - $visitorsLastWeek) / ($visitorsLastWeek == 0 ? 1 : $visitorsLastWeek) * 100;
            // Visitor persentase comparison month and last month
            $visitorsMonth = Visitor::whereMonth('tanggal', date('m'))->count();
            $visitorsLastMonth = Visitor::whereMonth('tanggal', date('m', strtotime('-1 months')))->count();
            $visitorsMonthLastMonthPersentase = ($visitorsMonth - $visitorsLastMonth) / ($visitorsLastMonth == 0 ? 1 : $visitorsLastMonth) * 100;
            // Visitor persentase comparison year and last year
            $visitorsYear = Visitor::whereYear('tanggal', date('Y'))->count();
            $visitorsLastYear = Visitor::whereYear('tanggal', date('Y', strtotime('-1 years')))->count();
            $visitorsYearLastYearPersentase = ($visitorsYear - $visitorsLastYear) / ($visitorsLastYear == 0 ? 1 : $visitorsLastYear) * 100;


            return view('admin.' . $title, compact('title', 'transactionsToday', 'transactionsWeek', 'transactionsMonth', 'transactionsYear', 'transactionsTodayYesterdayPersentase', 'transactionsWeekLastWeekPersentase', 'transactionsMonthLastMonthPersentase', 'transactionsYearLastYearPersentase', 'visitorsToday', 'visitorsWeek', 'visitorsMonth', 'visitorsYear', 'visitorsTodayYesterdayPersentase', 'visitorsWeekLastWeekPersentase', 'visitorsMonthLastMonthPersentase', 'visitorsYearLastYearPersentase'));
        } catch (\Exception $e) {
            return $this->_error($e);
        }
    }
}
