<?php

namespace App\Services;

use App\Models\Service;

class ServiceCatalogService
{
    public function getActive()
    {
        return Service::where('is_active', true)->orderBy('order')->get();
    }

    public function getAll()
    {
        return Service::orderBy('order')->get();
    }

    public function create(array $data)
    {
        return Service::create($data);
    }

    public function update(Service $service, array $data)
    {
        $service->update($data);
        return $service;
    }

    public function delete(Service $service)
    {
        return $service->delete();
    }
}
