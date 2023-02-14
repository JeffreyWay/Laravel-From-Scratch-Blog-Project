<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExportContacts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:contacts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exporting all contact data to a .csv file.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = DB::select('SELECT id, email, first_name, last_name, bday, additional_text FROM contacts WHERE exported_at IS NULL');
        $headers = [["id", "email", "first_name", "last_name", "bday", "additional_text"]];
        $filename = "export-" . date("Y-m-d H:i:s") . ".csv";

        if (!$data) {
            return 1;
        }

        $this->createFile($data, $headers, $filename);

        // moving file to the public folder
        rename($filename, "public/$filename");

        $exportedIds = array_column($data, 'id');
        foreach ($exportedIds as $exportedId) {
            DB::update('UPDATE contacts SET exported_at = (?) WHERE id = (?)',
                [
                    date("Y-m-d H:i:s"),
                    $exportedId
                ]
            );
        }

        return 0;
    }

    /**
     * @param array $data
     * @param array $headers
     * @param string $filename
     * @return void
     *
     * Creates the CSV File
     */
    private function createFile(array $data, array $headers, string $filename): void
    {
        $csv = fopen($filename, 'w');

        // Write headers to file
        foreach ($headers as $header) {
            fputcsv($csv, $header);
        }

        // Insert content
        foreach ($data as $fields) {
            fputcsv($csv, get_object_vars($fields));
        }

        fclose($csv);
    }
}
