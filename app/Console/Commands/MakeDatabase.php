<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a database based on information in env.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->db_host = env('DB_HOST');
        $this->db_database = env('DB_DATABASE');
        $this->db_user = env('DB_USERNAME');
        $this->db_pass = env('DB_PASSWORD');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {

        //Creates a PDO connection using the specified host, and root as user.
        try{
            $db = new \PDO ("mysql: host=$this->db_host; charset=utf8", 'root', '');
        } catch(PDOException $e){
            die ("Error(Could not connect): ".$e->getMessage());
        };

        //checks if a database with name $db_database exists, if it does then deletes it
        $query = "DROP DATABASE IF EXISTS $this->db_database";
        if ($db->exec($query)===false){
            die('Query failed(1):' . $db->errorInfo()[2]);
        };

        //checks if a database with name $db_database exsists, if it doesnt then creates it
        $query = "CREATE DATABASE IF NOT EXISTS $this->db_database";
        if ($db->exec($query)===false){
            die('Query failed(1):' . $db->errorInfo()[2]);
        };

        //Grants all privileges on the created database for the user specified in env.
        $query = "GRANT ALL ON $this->db_database.* TO '".$this->db_user."'@'".$this->db_host."' IDENTIFIED BY '".$this->db_pass."'";
        if ($db->exec($query)===false){
            die('Query failed:' . $db->errorInfo()[2]);
        };

        $db = null;

        $this->info('Database successfully created. Running migrations...');
        $this->call('migrate:refresh');
    }
}
