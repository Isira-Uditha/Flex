<?php

namespace App\Services;
use App\Models\Package;

class PackageService
{
    public function getAllPackages($data)
    {
        $result = Package::when(isset($data['package_duration']) && $data['package_duration'] != '', function($q) use($data) {
            return $q->where('package.package_duration', $data['package_duration']);
        })
        ->when(isset($data['package_duration']) && $data['package_duration'] != '', function($q) use($data) {
            return $q->where('package.package_duration', $data['package_duration']);
        })
        ->get();
        return $result;

    }
}

?>
