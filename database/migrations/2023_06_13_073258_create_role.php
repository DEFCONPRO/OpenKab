<?php

use App\Enums\Modul;
use App\Models\Team;
use App\Models\User;
use App\Models\UserTeam;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $team = Team::create([
            'name' => 'administrator',
            'menu' => Modul::Menu,
        ]);
        setPermissionsTeamId($team->id);

        $user = User::where('username', 'admin')->first();
        $user->guard_name = 'web';

        UserTeam::create([
            'id_user' => $user->id,
            'id_team' => $team->id,
        ]);

        foreach (Modul::Data as $value) {
            $role = Role::create(
                [
                    'name' => $value,
                    'team_id' => $team->id,
                    'guard_name' => 'web',
                ]
            );
            $user->assignRole($role->id);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
