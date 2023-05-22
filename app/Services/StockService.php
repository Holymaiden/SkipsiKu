<?php

namespace App\Services;

use App\Exports\StockExport;
use App\Models\Stock;
use App\Services\BaseRepository;
use App\Services\Contracts\StockContract;
use Maatwebsite\Excel\Facades\Excel;


class StockService extends BaseRepository implements StockContract
{
    /**
     * @var
     */
    protected $model;

    public function __construct(Stock $stock)
    {
        $this->model = $stock->whereNotNull('id');
    }

    public function paginated(array $criteria)
    {
        $perPage = $criteria['jml'] ?? 5;
        $search = $criteria['cari'] ?? '';
        $product = $criteria['product'] == '' ? 'is not null' : '="' . $criteria['product'] . '"';
        $range = $criteria['range'] ?? '';
        if ($range != '') {
            $range = explode(' - ', $range);
            $range[0] = date('Y-m-d', strtotime($range[0]));
            $range[1] = date('Y-m-d', strtotime($range[1]));
            $range = [$range[0], $range[1]];
        }
        return $this->model->whereRaw('product_id ' . $product)->when($search, function ($query) use ($search) {
            $query->where('satuan', 'like', "%{$search}%")
                ->orWhere("volume", "like", "%{$search}%")
                ->orWhere("tanggal", "like", "%{$search}%");
        })->when($range, function ($query) use ($range) {
            $query->whereBetween('tanggal', $range);
        })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    /**
     * Store Data
     */
    public function store(array $request)
    {
        return $this->model->create($request);
    }

    /**
     * Update Data By ID
     */
    public function update(array $request, $id)
    {
        return $this->model->find($id)->update($request);
    }

    public function export(array $criteria)
    {
        $search = $criteria['cari'] ?? '';
        $product = $criteria['product'] == '' ? 'is not null' : '="' . $criteria['product'] . '"';
        $range = $criteria['range'] ?? '';
        if ($range != '') {
            $range = explode(' - ', $range);
            $range[0] = date('Y-m-d', strtotime($range[0]));
            $range[1] = date('Y-m-d', strtotime($range[1]));
            $range = [$range[0], $range[1]];
        }
        $data = $this->model->with('product')->whereRaw('product_id ' . $product)->when($search, function ($query) use ($search) {
            $query->where('satuan', 'like', "%{$search}%")
                ->orWhere("volume", "like", "%{$search}%")
                ->orWhere("tanggal", "like", "%{$search}%");
        })->when($range, function ($query) use ($range) {
            $query->whereBetween('tanggal', $range);
        })
            ->orderBy('id', 'asc')
            ->get()->toArray();

        $data_new = [];
        for ($i = 0; $i < count($data); $i++) {
            $data_new[$i]['id'] = $i + 1;
            $data_new[$i]['product'] = $data[$i]['product']['name'];
            $data_new[$i]['satuan'] = $data[$i]['satuan'];
            $data_new[$i]['volume'] = $data[$i]['volume'];
            $data_new[$i]['tanggal'] = $data[$i]['tanggal'];
        }

        return Excel::download(new StockExport($data_new), 'stock.xlsx');
    }
}
