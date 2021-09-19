<?php

namespace App\Services;
use App\Models\User;

class UserService
{
    public function getAllMembers($data)
    {
        $result = User::where('role','Member')
        ->when(isset($data['first_name']) && $data['first_name'] != '', function($q) use($data) {
            return $q->where('users.first_name', $data['first_name']);
        })
        ->when(isset($data['last_name']) && $data['last_name'] != '', function($q) use($data) {
            return $q->where('users.last_name', $data['last_name']);
        })
        ->when(isset($data['uid']) && $data['uid'] != '', function($q) use($data) {
            return $q->where('users.uid', $data['uid']);
        })
        ->when(isset($data['gender']) && $data['gender'] != '', function($q) use($data) {
            return $q->where('users.gender', $data['gender']);
        })
        ->orderBy('uid', 'DESC')
        ->get();
        return $result;
    }

    public function getAllEmployees($data)
    {
        $result = User::where('role', '<>', 'Member')
        ->when(isset($data['first_name']) && $data['first_name'] != '', function($q) use($data) {
            return $q->where('users.first_name', $data['first_name']);
        })
        ->when(isset($data['last_name']) && $data['last_name'] != '', function($q) use($data) {
            return $q->where('users.last_name', $data['last_name']);
        })
        ->when(isset($data['uid']) && $data['uid'] != '', function($q) use($data) {
            return $q->where('users.uid', $data['uid']);
        })
        ->when(isset($data['gender']) && $data['gender'] != '', function($q) use($data) {
            return $q->where('users.gender', $data['gender']);
        })
        ->when(isset($data['role']) && $data['role'] != '', function($q) use($data) {
            return $q->where('users.role', $data['role']);
        })
        ->orderBy('uid', 'DESC')
        ->get();
        return $result;
    }

}

?>
