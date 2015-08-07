<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $id
 * @property string $login
 * @property string $senha
 * @property string $nome
 * @property string $email
 * @property string $pagina
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','login', 'senha', 'nome', 'email'], 'required', 'message'=>'Este campo é obrigatório.'],
            [['id'], 'integer', 'message'=>'ID dever ser um inteiro.'],
            [['login'], 'string', 'max' => 20],
            ['senha', 'match', 'pattern'=>'/^[a-z0-9_-]{6,20}$/'],
            [['nome', 'pagina'], 'string', 'max' => 200],
            [['email'], 'email', 'message'=>'Informe um email válido.'],
            [['pagina'], 'url', 'message'=> 'informe uma URL válida Ex: http://dominio.com']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'senha' => 'Senha',
            'nome' => 'Nome Completo',
            'email' => 'Endereço de Email',
            'pagina' => 'Página',
        ];
    }

    public function beforeSave($insert) {

        $this->nome = strtoupper($this->nome);
        $this->senha = md5($this->senha);
        return parent::beforeSave($insert);
    }
}
