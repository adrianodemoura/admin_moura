<?php
use Migrations\AbstractSeed;

/**
 * Unidades seed.
 */
class UnidadesSeed extends AbstractSeed
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
        $cnpj = 12345678901234;

        for($i=0; $i<rand(60,99); $i++)
        {
            $id = substr(str_repeat('0', 2).($i+1), -2);
            $data[$i] = ['id'=>($i+1), 'nome'=> 'Unidade '.$id, 'cpf_cnpj' => ($cnpj + $i)];
        }

        $this->execute('delete from unidades');
        $table = $this->table('unidades');
        $table->insert($data)->save();
    }
}
