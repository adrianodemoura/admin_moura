<?php
use Migrations\AbstractSeed;

/**
 * Perfis seed.
 */
class PerfisSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for($i=0; $i<rand(70,80); $i++)
        {
            $id = substr(str_repeat('0', 2).($i+1), -2);
            $data[$i] = ['id'=>($i+1), 'nome'=> 'Perfil '.$id];
        }

        $this->execute('delete from perfis');
        $table = $this->table('perfis');
        $table->insert($data)->save();
    }
}
