<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class)->create(['email' => 'team@nulisec.com']);
        $user->assignRole('administrator');

        $this->generateOauthClients($user);
    }

    private function generateOauthClients(User $user)
    {
        $oauth = app(ClientRepository::class);

        $oauth->create($user->id, 'Nulisec Dev', 'http://jumbojet.test/admin/store/skytrade-connect/callback');
        $oauth->create($user->id, 'Nulisec Prod', 'https://nulisec.com/admin/store/skytrade-connect/callback');
    }
}
