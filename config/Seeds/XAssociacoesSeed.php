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

        $_listaUnidades = $this->query('select id, nome from unidades order by 1')->fetchAll();
        $totUnidades    = count($_listaUnidades)-1;

        $_listaPerfis   = $this->query('select id, nome from perfis order by 1')->fetchAll();
        $totPerfis      = count($_listaPerfis)-1;

        $l = 0;
        foreach ($listaUsuarios as $_l => $_arrCmp)
        {
            $idUsuario      = $_arrCmp['id'];
            $listaPerfis    = $_listaPerfis;
            for($i=0; $i<rand(1,$totPerfis); $i++)
            {
                $idP        = rand(0, (count($listaPerfis)-1));
                $idPerfil   = $listaPerfis[$idP]['id'];
                unset($listaPerfis[$idP]);
                sort($listaPerfis);

                $listaUnidades  = $_listaUnidades;
                for($e=0; $e<rand(1,$totUnidades); $e++)
                {
                    $idN        = rand(0, (count($listaUnidades)-1));
                    $idUnidade  = $listaUnidades[$idN]['id'];
                    unset($listaUnidades[$idN]);
                    sort($listaUnidades);

                    $data[$l]   = ['usuario_id'=>(int)$idUsuario, 'perfil_id'=>(int)$idPerfil, 'unidade_id'=>(int)$idUnidade];
                    $l++;
                }
            }
        }

        $this->execute('delete from associacoes');
        $table = $this->table('associacoes');
        $table->insert($data)->save();
    }
}
