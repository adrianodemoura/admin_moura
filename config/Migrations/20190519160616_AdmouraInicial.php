<?php
use Migrations\AbstractMigration;

class AdmouraInicial extends AbstractMigration
{
    /**
     *
     */
    public function up()
    {

        $this->table('municipios')
            ->addColumn('nome',         'string', ['default' => '-', 'limit' => 100, 'null' => false])
            ->addColumn('uf',           'string', ['default' => '-', 'limit' => 2, 'null' => false])
            ->addColumn('codi_estd',    'string', ['default' => '-', 'limit' => 2,'null' => false])
            ->addColumn('desc_estd',    'string', ['default' => '-', 'limit' => 50, 'null' => false])
            ->addIndex(['uf', 'nome'])
            ->create();

        $this->table('perfis')
            ->addColumn('nome',         'string', ['default' => '-','limit' => 100,'null' => false])
            ->addIndex(['nome'],        ['unique' => true])
            ->create();

        $this->table('usuarios')
            ->addColumn('nome',         'string', ['default' => null, 'limit' => 100, 'null' => false])
            ->addColumn('municipio_id', 'integer',['default' => 3106200, 'limit' => 11, 'null' => false])
            ->addIndex(['municipio_id'])
            ->create();

        $this->table('unidades')
            ->addColumn('nome',         'string', ['default' => '-', 'limit' => 100, 'null' => false])
            ->addColumn('cpf_cnpj',     'double', ['default' => 0, 'limit' => 14, 'null' => false])
            ->addIndex(['cpf_cnpj'],    ['unique' => true])
            ->create();

        $this->table('associacoes',     ['id' => false])
            ->addColumn('usuario_id',   'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('perfil_id',    'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('unidade_id',   'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addIndex(['perfil_id'])
            ->addIndex(['usuario_id'])
            ->addIndex(['unidade_id'])
            ->create();

        $this->table('usuarios')
            ->addForeignKey('municipio_id', 'municipios', 'id', ['update' => 'CASCADE', 'delete' => 'CASCADE'])
            ->update();

        $this->table('associacoes')
            ->addForeignKey('perfil_id', 'perfis',  'id', ['update' => 'CASCADE', 'delete' => 'CASCADE'])
            ->addForeignKey('usuario_id','usuarios','id', ['update' => 'CASCADE', 'delete' => 'CASCADE'])
            ->addForeignKey('unidade_id','unidades','id', ['update' => 'CASCADE', 'delete' => 'CASCADE'])
            ->update();
    }

    public function down()
    {
        $this->table('usuarios')->dropForeignKey('municipio_id')->save();

        $this->table('associacoes')
            ->dropForeignKey('perfil_id')
            ->dropForeignKey('usuario_id')
            ->dropForeignKey('unidade_id')
            ->save();

        $this->table('municipios')->drop()->save();
        $this->table('perfis')->drop()->save();
        $this->table('usuarios')->drop()->save();
        $this->table('unidades')->drop()->save();
        $this->table('associacoes')->drop()->save();
    }
}
