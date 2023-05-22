<?php

namespace App\Services;

use App\Exports\TransactionExport;
use App\Models\Stock;
use App\Models\Transaction;
use App\Services\BaseRepository;
use App\Services\Contracts\TransactionContract;
use Maatwebsite\Excel\Facades\Excel;


class TransactionService extends BaseRepository implements TransactionContract
{
    /**
     * @var
     */
    protected $model;

    public function __construct(Transaction $transaction)
    {
        $this->model = $transaction->whereNotNull('id');
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
        // insertOrUpdate
        $stock = Stock::where('product_id', $request['product_id'])->where('tanggal', $request['tanggal'])->first();
        if ($stock) {
            $stock->update([
                'volume' => $stock->volume + $request['volume'],
            ]);
        } else {
            Stock::create([
                'product_id' => $request['product_id'],
                'volume' => $request['volume'],
                'tanggal' => $request['tanggal'],
                'satuan' => $request['satuan'],
            ]);
        }

        return $this->model->create($request);
    }

    /**
     * Update Data By ID
     */
    public function update(array $request, $id)
    {
        // insertOrUpdate
        $stock = Stock::where('product_id', $request['product_id'])->where('tanggal', $request['tanggal'])->first();
        if ($stock) {
            $stock->update([
                'volume' => $stock->volume + $request['volume'] - $request['volume2'],
            ]);
        } else {
            Stock::create([
                'product_id' => $request['product_id'],
                'volume' => $request['volume'],
                'tanggal' => $request['tanggal'],
                'satuan' => $request['satuan'],
            ]);
        }

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

        return Excel::download(new TransactionExport($data_new), 'transaction.xlsx');
    }
}
