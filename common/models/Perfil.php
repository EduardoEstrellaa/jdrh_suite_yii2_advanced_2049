<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * This is the model class for table "perfil".
 *
 * @property int $id
 * @property int $user_id
 * @property string $nombre
 * @property string $apellido
 * @property string $fecha_nacimiento
 * @property int $genero_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Alumnos[] $alumnos
 * @property AsignacionesTutores[] $asignacionesTutores
 * @property DatosGenerales[] $datosGenerales
 * @property DatosPersonales[] $datosPersonales
 * @property DomiciliosActuales[] $domiciliosActuales
 * @property Genero $genero
 * @property LugaresNacimiento[] $lugaresNacimientos
 * @property User $user
 */
class Perfil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perfil';
    }

    /**
     * behaviors
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'nombre', 'apellido', 'fecha_nacimiento', 'genero_id'], 'required'],
            [['user_id', 'genero_id'], 'integer'],
            [['genero_id'], 'in', 'range' => array_keys($this->getGeneroLista())],
            [['nombre', 'apellido'], 'string'],
            [['fecha_nacimiento', 'created_at', 'updated_at'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['genero_id'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::class, 'targetAttribute' => ['genero_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            //'id' => 'ID',
            'user_id' => 'User ID',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'genero_id' => 'Genero ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'generoNombre' => Yii::t('app', 'Genero'),
            'userLink' => Yii::t('app', 'User'),
            'perfilIdLink' => Yii::t('app', 'Perfil'),
        ];
    }
    /**
     * Gets query for [[Genero]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenero()
    {
        return $this->hasOne(Genero::class, ['id' => 'genero_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getGeneroNombre()
    {
        return $this->genero->genero_nombre;
    }
    /**
     * get lista de generos para lista desplegable
     */

    public static function getGeneroLista()
    {
        $dropciones = Genero::find()->asArray()->all();
        return ArrayHelper::map($dropciones, 'id', 'genero_nombre');
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @get Username
     */
    public function getUsername()
    {
        return $this->user->username;
    }
    /**
     * @getUserId
     */
    public function getUserId()
    {
        return $this->user ? $this->user->id : 'ninguno';
    }

    /**
     * @getUserLink
     */

    public function getUserLink()
    {
        $url = Url::to(['user/view', 'id' => $this->UserId]);
        $opciones = [];
        return Html::a($this->getUserName(), $url, $opciones);
    }
    /**
     * @getProfileLink
     */

    public function getPerfilIdLink()
    {
        $url = Url::to(['perfil/update', 'id' => $this->id]);
        $opciones = [];
        return Html::a($this->id, $url, $opciones);
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasOne(Alumnos::class, ['perfil_id' => 'id']);
    }

    /**
     * Gets query for [[AsignacionesTutores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacionesTutores()
    {
        return $this->hasMany(AsignacionesTutores::class, ['perfil_id' => 'id']);
    }

    /**
     * Gets query for [[DatosGenerales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatosGenerales()
    {
        return $this->hasMany(DatosGenerales::class, ['perfil_id' => 'id']);
    }

    /**
     * Gets query for [[DatosPersonales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatosPersonales()
    {
        return $this->hasMany(DatosPersonales::class, ['perfil_id' => 'id']);
    }

    /**
     * Gets query for [[DomiciliosActuales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDomiciliosActuales()
    {
        return $this->hasMany(DomiciliosActuales::class, ['perfil_id' => 'id']);
    }



    /**
     * Gets query for [[LugaresNacimientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLugaresNacimientos()
    {
        return $this->hasMany(LugaresNacimiento::class, ['perfil_id' => 'id']);
    }

    /**
     * Metodo de devuelve el nombre completo del perfil del usuario
     */
    public function getNombreCompleto()
    {
        return trim($this->nombre . ' ' . $this->apellido);
    }
}
