<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use ReflectionClass;
use ReflectionMethod;

class GenerateFullDocumentation extends Command
{
    protected $signature = 'docs:generate';
    protected $description = 'Generate documentation for views, controllers, models and routes';

    public function handle()
    {
        File::ensureDirectoryExists(base_path('docs'));

        $views = $this->viewsDoc();
        $controllers = $this->controllersDoc();
        $models = $this->modelsDoc();
        $routes = $this->routesDoc();

        File::put(base_path('docs/views.md'), $views);
        File::put(base_path('docs/controllers.md'), $controllers);
        File::put(base_path('docs/models.md'), $models);
        File::put(base_path('docs/routes.md'), $routes);

        $all = "# CampusFix - System Documentation\n\n";
        $all .= "Generated on: " . now()->toDateTimeString() . "\n\n";
        $all .= $views . "\n" . $controllers . "\n" . $models . "\n" . $routes;
        File::put(base_path('docs/documentation.md'), $all);

        $this->info('Documentation generated in the docs/ folder.');
        return 0;
    }

    // ---------- VIEWS ----------
    private function viewsDoc(): string
    {
        $doc = "# Blade Views\n\n| View | Location |\n|------|----------|\n";

        $files = collect(File::allFiles(resource_path('views')))
            ->filter(fn ($f) => str_ends_with($f->getFilename(), '.blade.php'))
            ->sortBy(fn ($f) => $f->getRelativePathname());

        foreach ($files as $file) {
            $path = str_replace('\\', '/', $file->getRelativePathname());
            $name = str_replace('.blade.php', '', $path);
            $doc .= "| {$name} | resources/views/{$path} |\n";
        }

        return $doc;
    }

    // ---------- CONTROLLERS ----------
    private function controllersDoc(): string
    {
        $doc = "# Controllers\n\n";

        $files = collect(File::allFiles(app_path('Http/Controllers')))
            ->sortBy(fn ($f) => $f->getRelativePathname());

        foreach ($files as $file) {
            $relative = str_replace('\\', '/', $file->getRelativePathname());
            $className = 'App\\Http\\Controllers\\' . str_replace(['/', '.php'], ['\\', ''], $relative);

            if (!class_exists($className)) {
                continue;
            }

            $reflection = new ReflectionClass($className);
            if ($reflection->isAbstract()) {
                continue;
            }

            $methods = collect($reflection->getMethods(ReflectionMethod::IS_PUBLIC))
                ->filter(fn ($m) => $m->class === $className && !str_starts_with($m->name, '__'))
                ->map(fn ($m) => $m->name);

            $doc .= "## " . $reflection->getShortName() . "\n\n";
            $doc .= "**Location:** app/Http/Controllers/{$relative}\n\n";
            $doc .= "**Methods:**\n";
            foreach ($methods as $method) {
                $doc .= "- `{$method}()`\n";
            }
            $doc .= "\n";
        }

        return $doc;
    }

    // ---------- MODELS / DATABASE ----------
    private function modelsDoc(): string
    {
        $doc = "# Models and Database Tables\n\n";

        $files = collect(File::allFiles(app_path('Models')))
            ->filter(fn ($f) => $f->getExtension() === 'php');

        foreach ($files as $file) {
            $className = 'App\\Models\\' . str_replace(['/', '\\', '.php'], ['\\', '\\', ''], $file->getRelativePathname());

            if (!class_exists($className) || !is_subclass_of($className, Model::class)) {
                continue;
            }

            $model = new $className;
            $table = $model->getTable();

            $doc .= "## " . (new ReflectionClass($className))->getShortName() . "\n\n";
            $doc .= "**Table:** `{$table}`\n\n";
            $doc .= "**Primary key:** `{$model->getKeyName()}`\n\n";

            try {
                $columns = DB::select("SHOW COLUMNS FROM `{$table}`");
                $count = DB::table($table)->count();

                $foreignKeys = DB::select(
                    "SELECT COLUMN_NAME AS col, REFERENCED_TABLE_NAME AS ref_table, REFERENCED_COLUMN_NAME AS ref_col
                     FROM information_schema.KEY_COLUMN_USAGE
                     WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND REFERENCED_TABLE_NAME IS NOT NULL",
                    [DB::getDatabaseName(), $table]
                );
            } catch (\Exception $e) {
                $doc .= "_Could not read table `{$table}`. Run php artisan migrate first._\n\n---\n\n";
                continue;
            }

            $doc .= "**Records in table:** {$count}\n\n";

            $doc .= "### Columns\n\n| Field | Type | Null | Default |\n|-------|------|------|---------|\n";
            foreach ($columns as $col) {
                $doc .= sprintf(
                    "| `%s` | %s | %s | %s |\n",
                    $col->Field,
                    $col->Type,
                    $col->Null,
                    $col->Default ?? 'NULL'
                );
            }

            $doc .= "\n### Foreign keys\n\n";
            if (count($foreignKeys) === 0) {
                $doc .= "None\n";
            } else {
                foreach ($foreignKeys as $fk) {
                    $doc .= "- `{$fk->col}` references `{$fk->ref_table}.{$fk->ref_col}`\n";
                }
            }

            $doc .= "\n### Fillable\n\n";
            foreach ($model->getFillable() as $field) {
                $doc .= "- `{$field}`\n";
            }

            $doc .= "\n---\n\n";
        }

        return $doc;
    }

    // ---------- ROUTES ----------
    private function routesDoc(): string
    {
        $doc = "# Routes\n\n| Method | URI | Name | Action |\n|--------|-----|------|--------|\n";

        foreach (app('router')->getRoutes() as $route) {
            $doc .= sprintf(
                "| %s | %s | %s | %s |\n",
                implode(',', $route->methods()),
                $route->uri(),
                $route->getName() ?? '-',
                $route->getActionName()
            );
        }

        return $doc;
    }
}