<?php
use Migrations\AbstractSeed;

/**
 * Municipios seed.
 */
class MunicipiosSeed extends AbstractSeed
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
        $data   = [];

        //$arq    = ROOT . DS . 'plugins' . DS . 'Admoura' . DS . 'municipios2.csv';
        $arq    = ROOT . DS . 'plugins' . DS . 'Admoura' . DS . 'municipios.csv';

        $csvFile= file($arq);

        foreach ($csvFile as $_l => $_linha)
        {
            if ($_l)
            {
                $arrCmps = str_getcsv($_linha);
                $data[] = 
                [
                    'id'        => (int)$arrCmps[0], 
                    'nome'      => trim($arrCmps[1]), 
                    'uf'        => trim($arrCmps[2]), 
                    'codi_estd' => (int)$arrCmps[3], 
                    'desc_estd' => trim($arrCmps[4])
                ];
            }
        }

        $this->execute('delete from municipios');
        $table = $this->table('municipios');
        $table->insert($data)->save();
    }
}
