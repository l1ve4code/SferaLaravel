<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "fio", "phone", 'email', "position_id", 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUsers($search = array())
    {

        $columns = ["users.fio", "users.email", "position_name", "skill.name"];

        $users = User::leftJoin("position", "users.position_id", "=", "position.id")
            ->select("users.id as user_id", "users.fio", "users.phone", "users.email", "position.name as position_name", "users.created_at")
            ->when(isset($search["alphabet"]), function ($query) use ($search) {
                return $query->orderBy("users.fio", $search["alphabet"]);
            })
            ->when(isset($search["creation"]), function ($query) use ($search) {
                return $query->orderBy("users.created_at", $search["creation"]);
            })
            ->when(isset($search["position"]), function ($query) use ($search) {
                return $query->where("users.position_id", "=", $search["position"]);
            })
            ->when(isset($search["skill"]), function ($query) use ($search) {
                return $query->leftJoin("skill", "skill.user_id", "=", "users.id")
                    ->where("skill.name", "=", $search["skill"]);
            })
            ->when(isset($search["label"]), function ($query) use ($search, $columns) {
                $query->leftJoin("skill", "skill.user_id", "=", "users.id");
                foreach ($columns as $column) {
                    $query->orWhere($column, "LIKE", "%".$search["label"]."%");
                }
                return $query;
            })
            ->distinct()->get();

        foreach ($users as $user) {

            $skills = Skill::where("user_id", "=", $user["user_id"])->get();
            if (count($skills) > 0) $user["skills"] = $skills;

        }

        return $users;

    }

}
