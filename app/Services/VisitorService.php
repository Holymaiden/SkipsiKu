<?php

namespace App\Services;

use App\Models\Visitor;
use App\Services\BaseRepository;
use App\Services\Contracts\VisitorContract;


class VisitorService extends BaseRepository implements VisitorContract
{
    /**
     * @var
     */
    protected $model;

    public function __construct(Visitor $visitor)
    {
        $this->model = $visitor->whereNotNull('id');
    }

    public function paginated(array $criteria)
    {
        $perPage = $criteria['jml'] ?? 5;
        $search = $criteria['cari'] ?? '';
        return $this->model->when($search, function ($query) use ($search) {
            $query->where('value', 'like', "%{$search}%")
                ->orWhere("tanggal", "like", "%{$search}%");
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
