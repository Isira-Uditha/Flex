<?php

namespace App\Services;
use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;
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

    public function packageOrderByUser($data)
    {
        $result = User::select('p.package_name','users.package_id', 'p.package_duration', 'p.package_price', DB::raw("count(uid) as count"))
        ->join('package as p','p.package_id','users.package_id')

        ->when(!isset($data['sts_date']), function($q) use($data) {
            return $q->when(isset($data['from']) && $data['from'] != '', function($q) use($data) {
                return $q->where(DB::raw("date(users.updated_at)"),'>=', Carbon::createFromFormat('m/d/Y',$data['from'])->format('Y-m-d'));
            })
            ->when(isset($data['to']) && $data['to'] != '', function($q) use($data) {
                return $q->where(DB::raw("date(users.updated_at)"),'<=',  Carbon::createFromFormat('m/d/Y',$data['to'])->format('Y-m-d'));
            });
        })
        ->groupBy('package_id')
        ->orderBy('package_id', 'ASC')
        ->get();

        return $result;
    }
}

?>
