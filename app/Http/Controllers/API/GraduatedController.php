<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\GraduationRepositoryInterface;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    public $graduate;
    public function __construct(GraduationRepositoryInterface $graduate)
    {
        $this->graduate = $graduate;
    }
    public function index()
    {
        return $this->graduate->index();
    }
    public function store(Request $request)
    {
        return $this->graduate->store($request);
    }
    public function update(Request $request)
    {
        return $this->graduate->update($request);
    }
    public function destroy(string  $id)
    {
        return $this->graduate->delete($id);
    }
}
