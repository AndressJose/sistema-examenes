<?php
/**
 * This is the model class for table "Users".
 *
 * The followings are the available columns in table 'Users':
 * @property string $id
 * @property string $password
 * @property integer $role
 */
class Users extends CActiveRecord
{
    const ROLE_PROFESOR = 0;
    const ROLE_ADMIN = 1;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Users';
    }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'id',
                'required',
                'message' => '{attribute} no puede ser vacío.'
                ),
            array(
                'password',
                'required',
                'message' => '{attribute} no puede ser vacío.'
                ),
            array(
                'role',
                'numerical',
                'integerOnly' => true
                ),
            array(
                'id',
                'length',
                'max' => 10
                ),
            array(
                'password',
                'length',
                'max' => 128
                ),
             array(
                'id',
                'unique'
                ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id, password, role',
                'safe',
                'on' => 'search'
                )
            );
    }
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Usuario',
            'password' => 'Contraseña',
            'role' => 'Rol'
            );
    }
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.
        //Muestra los usuarios del sistema sin mostrar el usuario admin
        $criteria            = new CDbCriteria;
        $criteria->condition = 'id!=:arg1';
        $criteria->params    = array(
            ':arg1' => 'admin'
            );
        $criteria->compare('id', $this->id, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'id ASC'
                )
            ));
    }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
    public function beforeSave()
    {
        $this->password = md5($this->password);
        return true;
    }

       
}
