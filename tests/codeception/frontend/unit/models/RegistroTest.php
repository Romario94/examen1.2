<?php

namespace tests\codeception\frontend\unit\models;

use tests\codeception\frontend\unit\DbTestCase;
use tests\codeception\common\fixtures\UserFixture;
use Codeception\Specify;
use frontend\models\Registro;

class RegistroTest extends DbTestCase {

    use Specify;

    public function testCorrectRegistro() {
        $model = new Registro([
            'uid' => 5,
            'idP' => 1,
            'cantidad' => 2,
        ]);

        $registro = $model->saveRegistro();

        $this->assertInstanceOf('common\models\Registro', $registro, 'pedido deberia de ser valido');

        expect('uid should be correct', $registro->uid)->equals(5);
        expect('idP should be correct', $registro->idP)->equals(1);
        expect('cantidad should be correct', $registro->cantidad)->equals(2);
    }

    public function testNotCorrectRegistro() {
        $model = new Registro([
            'uid' => 12,
            'idP' => 3,
            'cantidad' => 2,
        ]);

       expect('uid no existe', $model->saveRegistro())->null();
    }

    public function fixtures() {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => '@tests/codeception/frontend/unit/fixtures/data/models/pedido.php',
            ],
        ];
    }

}
