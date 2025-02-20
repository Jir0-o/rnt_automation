<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(
            [
                // DesignationSeeder::class,
                // UserSeeder::class,
                // RolePermission::class,
                // ProductCategorySeeder::class,
                // ProductSubCategorySeeder::class,
                // UnitTypeSeeder::class,
                // ProductSeeder::class,
                // RequisitionTypeSeeder::class,
                // RequisitionSeeder::class,
                // RequisitionProductSeeder::class,
                // AllocationSeeder::class,
                // AllocatedProductSeeder::class,
                // CommitteeSeeder::class,
                // ProductCommitteeSeeder::class,
                InitiatorFileSeeder::class,
                FileCommitteeSeeder::class,
                InitiatorNoteSeeder::class,
                InitiatorNoteAttachmentSeeder::class,
                InitiatorNoteReviewSeeder::class,
            ]
        );
    }
}
