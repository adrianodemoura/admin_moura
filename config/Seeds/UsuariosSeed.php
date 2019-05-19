<?php
use Migrations\AbstractSeed;

/**
 * Usuarios seed.
 */
class UsuariosSeed extends AbstractSeed
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

        $listaMunicipio = $this->query('select id, nome from municipios order by 1')->fetchAll();
        $totM           = count($listaMunicipio);

        for($i=0; $i<rand(100,200); $i++)
        {
            $totM       = (count($listaMunicipio)-1);
            $idM        = rand(0,$totM);
            if (isset($listaMunicipio[$idM]))
            {
                $idMunicipio= (int) $listaMunicipio[$idM]['id'];
                unset($listaMunicipio[$idM]);
                sort($listaMunicipio);
            }

            $id = substr(str_repeat('0', 3).($i+1), -3);

            $data[$i] = ['id'=>(int) $id, 'nome'=>"Usuário ".$id, 'municipio_id'=>$idMunicipio];
        }

        $this->execute('delete from usuarios');
        $table = $this->table('usuarios');
        $table->insert($data)->save();
    }
}
