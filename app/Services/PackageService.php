<?php

namespace App\Services;
use App\Models\Package;

class PackageService
{
    public function getAllPackages($data)
    {
        $result = Package::when(isset($data['package_name']) && $data['package_name'] != '', function($q) use($data) {
            return $q->where('package.package_name', $data['package_name']);
        })
        ->when(isset($data['package_duration']) && $data['package_duration'] != '', function($q) use($data) {
            return $q->where('package.package_duration', $data['package_duration']);
        })
        ->when(isset($data['package_price']) && $data['package_price'] != '', function($q) use($data) {
            return $q->where('package.package_price', $data['package_price']);
        })
        ->get();
        return $result;

    }
}

?>
