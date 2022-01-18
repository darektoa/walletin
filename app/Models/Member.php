<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $guarded  = ['id'];

    
    public function user() {
        return $this->belongsTo(User::class);
    }


    public function school() {
        return $this->belongsTo(School::class);
    }


    public function role() {
        return $this->belongsTo(MemberRole::class);
    }


    public function scopeJoinSchool($query, $user, $school) {
        $member = $query->firstOrCreate(
            ['user_id' => $user->id, 'school_id' => $school->id], 
            ['role_id' => 1], // Student
        );

        Member::where('user_id', $user->id)
            ->where('school_id', '!=', $school->id)
            ->delete();

        return $member;
    }
}
