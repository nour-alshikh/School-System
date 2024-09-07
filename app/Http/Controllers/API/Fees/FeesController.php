<?php

namespace App\Http\Controllers\Api\Fees;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fees\StoreFeesRequest;
use App\Http\Requests\Fees\UpdateFeesRequest;
use App\Interfaces\FeeRepositoryInterface;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    public $fee;
    public function __construct(FeeRepositoryInterface $fee)
    {
        $this->fee = $fee;
    }

    public function index()
    {
        return $this->fee->index();
    }
    public function store(StoreFeesRequest $request)
    {
        return $this->fee->store($request);
    }
    public function show($id)
    {
        return $this->fee->show($id);
    }
    public function update(UpdateFeesRequest $request)
    {
        return $this->fee->update($request);
    }

    public function destroy($id)
    {
        return $this->fee->delete($id);
    }
}
