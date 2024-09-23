<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\EventRepositoryInterface;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public $event;
    public function __construct(EventRepositoryInterface $event)
    {
        $this->event = $event;
    }

    public function index()
    {
        return $this->event->index();
    }
    public function store(Request $request)
    {
        return $this->event->store($request);
    }

    public function update(Request $request)
    {
        return $this->event->update($request);
    }

    public function destroy($id)
    {
        return $this->event->delete($id);
    }
}
