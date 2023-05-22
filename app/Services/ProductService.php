<?php

namespace App\Services;

use App\Models\Product;
use App\Services\BaseRepository;
use App\Services\Contracts\ProductContract;


class ProductService extends BaseRepository implements ProductContract
{
    /**
     * @var
     */
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product->whereNotNull('id');
    }

    public function paginated(array $criteria)
    {
        $perPage = $criteria['jml'] ?? 5;
        $search = $criteria['cari'] ?? '';
        return $this->model->when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere("code", "like", "%{$search}%")
                ->orWhere("merk", "like", "%{$search}%")
                ->orWhere("jenis", "like", "%{$search}%");
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
}
