<?php

namespace app\models;

use app\controllers\AlunoController;
use Yii;

/**
 * This is the model class for table "aluno".
 *
 * @property integer $id
 * @property integer $matricula
 * @property string $nome
 * @property string $sexo
 * @property integer $id_curso
 * @property integer $ano_ingresso
 *
 * @property Curso $idCurso
 */
class Aluno extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aluno';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['matricula', 'ano_ingresso', 'nome', 'sexo'], 'required','message'=>'Este campo é obrigatório.'],
            [['matricula'], 'match', 'pattern'=>'/^[0-9]{8}$/','message'=>'Matrícula inválida.'],
            [['nome'], 'string','max' => 200],
            [['sexo'], 'string', 'max' => 1],
            [['sexo'], 'in', 'range' => ['M','m','F','f'],'message'=>'Sexo inválido.'],
            [['ano_ingresso'], 'in', 'range' => range(1900, date('Y')), 'message'=>'Ano de Ingresso é inválido.'],

        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'matricula' => 'Matrícula',
            'nome' => 'Nome Completo',
            'sexo' => 'Sexo',
            'id_curso' => 'Curso de Graduação',
            'ano_ingresso' => 'Ano de Ingresso',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCurso()
    {
        return $this->hasOne(Curso::className(), ['id' => 'id_curso']);
    }

    public function beforeSave($insert) {
        $this->nome = strtoupper($this->nome);
        $this->sexo = strtoupper($this->sexo);
        return parent::beforeSave($insert);
    }
    public function beforeValidate(){

        if(Yii::$app->user->id)
        {
            return true;

        }else{
            Yii::$app->controller->redirect(array('site/login'));
            return false;
        }
        return parent::beforeValidate();

    }
    public  function afterFind(){
        if($this->sexo = "M") {
            $this->sexo = "Masculino";
        }else{
            $this->sexo = "Femino";
        }

        $this->id_curso = Curso::findOne($this->id_curso)->nome;


    }

}
