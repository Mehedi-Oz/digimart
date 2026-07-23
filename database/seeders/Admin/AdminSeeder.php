<?php

namespace Database\Seeders\Admin;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Super Admin
        $admin = new Admin();
        $admin->name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = '12345678';
        $admin->save();
        $admin->assignRole('super admin');

        //Reviewer
        $reviewer = new Admin();
        $reviewer->name = 'Reviewer';
        $reviewer->email = 'reviewer@gmail.com';
        $reviewer->password = '12345678';
        $reviewer->save();
        $reviewer->assignRole('reviewer');
    }
}
