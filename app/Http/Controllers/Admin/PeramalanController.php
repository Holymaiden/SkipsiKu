<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PeramalanExport;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class PeramalanController extends Controller
{
    protected  $response, $title;

    public function __construct()
    {
        $this->title = 'peramalan';
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
            return view('admin.' . $title . '.index', compact('title'));
        } catch (\Exception $e) {
            return $this->_error($e);
        }
    }

    public function data(Request $request)
    {
        try {
            $title = $this->title;
            $perPage = $request->jml == '' ? 5 : $request->jml;
            $perPage2 = $request->jml2 == '' ? 5 : $request->jml2;
            $cari = $request->cari == '' ? '' : $request->cari;
            $product_id = $request->product == '' ? 1 : $request->product;

            # Get From API
            $data = Http::get('http://127.0.0.1:5000?jumlah_data=' . $perPage . '&product_id=' . $product_id . '&year=' . $request->year . '&month=' . Helper::getBulan($request->month) . '&range=' . $request->range);
            $data = $data->object();
            // dd($request->all());
            $table2 = $data->table2;
            $table3 = $data->table3;
            # table 3 value to string

            $predict_2 = $data->predict;
            $predict_2 = collect($predict_2);
            $predict_2 = $predict_2->map(function ($item, $key) {
                $item->date = date('D, d M Y', strtotime($item->date));
                return $item;
            });
            $predict = $predict_2->forPage($request->input('page2', 1), $perPage2);

            $table1_2 = $data->table1;
            $table1_2 = collect($table1_2);
            $table1_2 = $table1_2->map(function ($item, $key) {
                $item->tanggal = date('D, d M Y', strtotime($item->tanggal));
                return $item;
            });
            $table1 = $table1_2->forPage($request->input('page', 1), $perPage);

            // Get total data
            $total_data = $table1_2->count();
            $total_data2 = $predict_2->count();

            // get total page
            $total_page = ceil($total_data / $perPage);
            $total_page2 = ceil($total_data2 / $perPage2);

            $view = view('admin.' . $title . '.data', compact('table1',  'title'))->with('i', ($request->input('page', 1) -
                1) * $perPage)->render();
            $view2 = view('admin.' . $title . '.data2', compact('table2', 'title'))->render();
            $view3 = view('admin.' . $title . '.data3', compact('table3', 'title'))->render();
            $view4 = view('admin.' . $title . '.data4', compact('predict', 'title'))->with('i', ($request->input('page2', 1) -
                1) * $perPage2)->render();
            return response()->json([
                "total_page" => $total_page == 0 ? 1 : $total_page,
                "total_data" => $total_data,
                "total_page2" => $total_page2 == 0 ? 1 : $total_page2,
                "total_data2" => $total_data2,
                "html"       => $view,
                "html2"       => $view2,
                "html3"       => $view3,
                "html4"       => $view4,
            ]);
        } catch (\Exception $e) {
            $this->response['message'] = $e->getMessage() . ' in file :' . $e->getFile() . ' line: ' . $e->getLine();
            return response()->json($this->response);
        }
    }

    public function export(Request $request)
    {
        try {
            $perPage = $request->jml == '' ? 5 : $request->jml;
            $product_id = $request->product == '' ? 1 : $request->product;

            $product_name = Helper::get_data('products')->where('id', $product_id)->first();

            # Get From API
            $data = Http::get('http://127.0.0.1:5000?jumlah_data=' . $perPage . '&product_id=' . $product_id . '&year=' . $request->year . '&month=' . Helper::getBulan($request->month) . '&range=' . $request->range);
            $data = $data->object();
            // dd($request->all());
            $table2 = $data->table2;
            $table3 = $data->table3;
            # table 3 value to string

            $predict_2 = $data->predict;
            $predict_2 = collect($predict_2);
            $predict_2 = $predict_2->map(function ($item, $key) {
                $item->date = date('D, d M Y', strtotime($item->date));
                return $item;
            });

            $data_new = [];
            for ($i = 0; $i < count($predict_2); $i++) {
                $data_new[$i]['id'] = $i + 1;
                $data_new[$i]['product'] = $product_name == null ? '' : $product_name->name;
                $data_new[$i]['Tanggal'] = $predict_2[$i]->date;
                $data_new[$i]['Peramalan'] = $predict_2[$i]->stock;
            }

            return Excel::download(new PeramalanExport($data_new), 'peramalan.xlsx');
        } catch (\Exception $e) {
            $message = $e->getMessage() . ' in file :' . $e->getFile() . ' line: ' . $e->getLine();
            return response()->json($message);
        }
    }
}
