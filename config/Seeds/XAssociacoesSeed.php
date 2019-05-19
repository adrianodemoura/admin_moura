<?php
use Migrations\AbstractSeed;

/**
 * XAssociacoes seed.
 */
class XAssociacoesSeed extends AbstractSeed
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

        $listaUsuarios  = $this->query('select id, nome from usuarios order by 1')->fetchAll();

        $listaUnidades  = $this->query('select id, nome from unidades order by 1')->fetchAll();

        $listaPerfis    = $this->query('select id, nome from perfis order by 1')->fetchAll();
        $totA           = count($listaPerfis)-2;

        for($i=0; $i<rand($totA-10,$totA); $i++)
        {
            $idU        = rand(0, (count($listaUsuarios)-1));
            $idUsuario  = $listaUsuarios[$idU]['id'];
            unset($listaUsuarios[$idU]);
            sort($listaUsuarios);

            $idN        = rand(0,(count($listaUnidades)-1));
            $idUnidade  = $listaUsuarios[$idN]['id'];
            unset($listaUnidades[$idN]);
            sort($listaUnidades);

            $idP        = rand(0,(count($listaPerfis)-1));
            $idPerfil   = $listaPerfis[$idN]['id'];
            unset($listaPerfis[$idN]);
            sort($listaPerfis);

            $data[$i]   = ['usuario_id'=>(int)$idUsuario, 'perfil_id'=>(int)$idPerfil, 'unidade_id'=>(int)$idUnidade];
        }

        $this->execute('delete from associacoes');
        $table = $this->table('associacoes');
        $table->insert($data)->save();
    }
}
