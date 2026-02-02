<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant;
use Illuminate\Support\Facades\File;

class GenerateTenantSeederV3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:seeder-v3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate TenantSeederV3 from current database data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating TenantSeederV3...');

        $tenants = Tenant::with('category')->get();

        $content = "<?php\n\nnamespace Database\Seeders;\n\nuse App\Models\Category;\nuse App\Models\Tenant;\nuse Illuminate\Database\Seeder;\nuse Illuminate\Support\Str;\n\nclass TenantSeederV3 extends Seeder\n{\n    /**\n     * Run the database seeds.\n     */\n    public function run(): void\n    {\n        \$tenants = [\n";

        foreach ($tenants as $tenant) {
            $categoryName = $tenant->category ? $tenant->category->name : 'Uncategorized';
            $mapCoords = $tenant->map_coords ?? [];
            
            // Should valid 'x' and 'y' be present or default to empty?
            // User requested getting from database.
            $floor = $mapCoords['floor'] ?? '';
            $unit = $mapCoords['unit'] ?? '';
            $x = $mapCoords['x'] ?? '';
            $y = $mapCoords['y'] ?? '';

            $name = str_replace("'", "\'", $tenant->name);
            $type = $tenant->type ?? 'Tenant'; // Default if null?

            $content .= "            [\n";
            $content .= "                'category_id' => '$categoryName',\n";
            $content .= "                'type' => '$type',\n";
            $content .= "                'name' => '$name',\n";
            $content .= "                'map_coords' => json_encode([\n";
            $content .= "                    'floor' => '$floor',\n";
            $content .= "                    'unit' => '$unit',\n";
            $content .= "                    'x' => '$x',\n";
            $content .= "                    'y' => '$y'\n";
            $content .= "                ]),\n";
            $content .= "            ],\n";
        }

        $content .= "        ];\n\n";
        
        // Add the processing logic
        $content .= <<<'EOT'
        $categories = Category::pluck('id', 'name')->toArray();

        $data = [];
        foreach ($tenants as $tenant) {
            $data[] = [
                'uuid' => (string) Str::uuid(),
                'category_id' => $categories[$tenant['category_id']] ?? null,
                'type' => $tenant['type'],
                'isNew' => 0,
                'name' => mb_convert_case($tenant['name'], MB_CASE_TITLE, 'UTF-8'),
                'map_coords' => $tenant['map_coords'],
                'logo' => 'assets/images/tenant_logo/' . $tenant['name'] . '.png',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        // Use Insert or Update/Create? 
        // User implied "seeder baru" (new seeder), usually seeders insert data.
        // But preventing duplicates might be good. 
        // For now, I will stick to Tenant::insert because the previous seeder did that.
        // But I should truncate? No, user just wants the file.
        
        Tenant::insert($data);
    }
}
EOT;

        $path = database_path('seeders/TenantSeederV3.php');
        File::put($path, $content);

        $this->info("Seeder generated at: $path");
    }
}
