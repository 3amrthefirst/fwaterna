<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
    public function index()
    {
        return view('admin.backup.index');
    }

    private function getTables()
    {
        $tables = DB::select('SHOW TABLES');

        $tables = array_map('current', $tables);

        return $tables;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws FileNotFoundException
     */
    public function download()
    {
        \Schema::dropIfExists('migrations');
        $tables = $this->getTables();
        $connect = DB::connection()->getPdo();
        $output = '';
        foreach ($tables as $table) {
            $select_query = "SELECT * FROM " . $table . " ";
            $statement = $connect->prepare($select_query);
            $statement->execute();
            $total_row = $statement->rowCount();

            for ($count = 0; $count < $total_row; $count++) {
                $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
                $table_column_array = array_keys($single_result);
                $table_column_array = array_map(function ($record) {
                    return '`' . $record . '`';
                }, $table_column_array);
                $table_value_array = array_values($single_result);
                $buildRow = $count == 0 ? "" : "\n";
                $buildRow .= "INSERT INTO $table (";
                $buildRow .= "" . implode(", ", $table_column_array) . ") VALUES (";
                $buildRow .= "'" . implode("','", $table_value_array) . "');";
                $buildRow = str_replace("''", 'NULL', $buildRow);
                $buildRow = str_replace("\\", '\\\\', $buildRow);
                $output .= $buildRow;
            }
        }

        $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
//        unlink($file_name);

        return response()->download($file_name)->deleteFileAfterSend(true);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $this->drop_tables();
            $sql = file_get_contents($request->file('upload'));
            DB::unprepared($sql);
            session()->flash('success', __('تم الاضافة بنجاح'));
            return view('admin.backup.index');
        } else {
            flash()->success(__('حدث خطأ'));
            return view('admin.backup.index');
        }
    }

    public function drop_tables()
    {
        Artisan::call('migrate:fresh');
    }
}
