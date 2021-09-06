<?php

namespace App\Services;
use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        ->orderBy('package_id','DESC')
        ->get();
        return $result;

    }

    public function packageOrderByUser()
    {
        $result = User::select('p.package_name','users.package_id', 'p.package_duration', DB::raw("count(uid) as count"))
        ->join('package as p','p.package_id','users.package_id')
        ->groupBy('package_id')
        ->orderBy('package_id', 'ASC')
        ->get();

        // dd($result->toArray());

        return $result;
    }
}

?>
