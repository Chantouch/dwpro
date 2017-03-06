<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
//         $this->call(AdminTableSeeder::class);
//         $this->call(EmployeeTableSeeder::class);
//         $this->call(UserTableSeeder::class);
//         $this->call(BusinessTypeTableSeeder::class);
//         $this->call(CityProvinceTableSeeder::class);
//         $this->call(ContractTermTableSeeder::class);
//         $this->call(DepartmentTableSeeder::class);
//         $this->call(FunctionTableSeeder::class);
//         $this->call(IndustryTableSeeder::class);
//         $this->call(LanguageTableSeeder::class);
//         $this->call(PositionTableSeeder::class);
//         $this->call(QualificationTableSeeder::class);
//         $this->call(LevelTableSeeder::class);
        $this->call(CompanyProfileTableSeeder::class);
    }
}
