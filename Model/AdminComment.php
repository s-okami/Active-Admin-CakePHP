<?php
App::uses('PolymorphicBehavior', 'active_admin.Model/Behaviour');
App::uses('ActiveAdminAppModel', "ActiveAdmin.Model");
/**
 * AdminComments Model
 *
 * @author Jared Bowles (jaredb7)
 * @package active_admin
 * @version 0.2.1
 */
class AdminComment extends ActiveAdminAppModel
{
    public $useTable = 'admin_comments';
    /** Default sort order **/
    public $order = array("AdminComment.created DESC");

    public $virtualFields = array(
        'resource_name' => 'CONCAT(AdminComment.class, " ", AdminComment.foreign_id)'
    );

    //Additional filter fields
    public $aaFilter = array('class', 'author', 'body');

    //  public $actsAs = array('Polymorphic');

    //http://bakery.cakephp.org/articles/AD7six/2008/03/13/polymorphic-behavior
    //https://github.com/Theaxiom/Polymorphic2.0

    //https://github.com/gregbell/active_admin/blob/cc687d7d1615d76ef75c61ce4b9de47bde98035b/lib/active_admin/comments/comment.rb

    /**
     * Finds comment for the specified Class and Foreign_id
     *
     * @param $class_name
     * @param $foreign_id
     * @return array results
     */
    public function findComments($class_name, $foreign_id)
    {
        if (isset($class_name) && isset($foreign_id)) {

            return $this->find('all', array(
                    'conditions' => array(
                        $this->alias . ".class" => $this->fixClassName($class_name),
                        $this->alias . ".foreign_id" => $foreign_id,
                    ),
                )
            );
        }
        return false;
    }

    /**
     * Removes all admin comment entries for the specified resource
     * @param $class_name string The name of the class
     * @param $foreign_id int The ID of the row in the class specified
     * @return boolean Delete success state
     */
    public function removeComments($class_name, $foreign_id)
    {
        if (isset($class_name) && isset($foreign_id)) {
            //No need to modify the classname as it's the models alias, and already the camelCase model name (retrieved by $this->alias
            $result = $this->deleteAll(array('class' => $class_name, 'foreign_id' => $foreign_id));
            return $result;
        }
        return false;
    }

    /**
     * For fixing the class_name, it'll convert underscored names to singularized CamelCase
     * or the reverse, CamelCase to underscored + pluralized (if reverse==true)
     *
     * @param $class_name
     * @param bool $reverse
     * @return string
     */
    private function fixClassName($class_name, $reverse = false)
    {
        if ($reverse == false) {
            //Correct the class_name so we have a name that can be matched to a model ($class_name is actually the controller_name)
            //we want to save it as the name of the model so delete operations work fluidly
            return Inflector::camelize(Inflector::singularize($class_name));
        } else {
            //Reverse the procedure so we have a class_name that can match a controller,
            //only used so we can link directly back to the item/resource that this comment is for via a the class_name+foreign_id
            return Inflector::underscore(Inflector::pluralize($class_name));
        }
    }

    /**
     * Override before modify data as necessary
     **/
    public function beforeSave($option = array())
    {
        parent::beforeSave($option);
        if (Configure::read('ActiveAdmin.allow_comments') == true) {
            if (empty($this->data[$this->alias]['author'])) {
                $this->data[$this->alias]['author'] = "anonymous";
            }
            $this->data[$this->alias]['class'] = $this->fixClassName($this->data[$this->alias]['class']);
            return true;
        }
        return false;
    }

    /**
     *  Override our afterFind method so we can modify
     *
     * @param mixed $results
     * @param bool $primary
     * @return mixed|void
     */
    public function afterFind($results, $primary = false)
    {
        if (!empty($results)) {
            //loop over the result and modify the class_name
            foreach ($results as $id => &$result) {
                if (array_key_exists($this->alias, $result) && isset($result['class'])) {
                    $result[$this->alias]['class'] = $this->fixClassName($result[$this->alias]['class'], true);
                }
            }
        }
        return $results;
    }

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'class' => array(
            'numeric' => array(
                'rule' => array('notempty'),
                'message' => 'Class name must be supplied and must be a string.',
                'allowEmpty' => false,
                'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'foreign_id' => array(
            'numeric' => array(
                'rule' => array('notempty'),
                'message' => 'Foreign key must be supplied.',
                'allowEmpty' => false,
                'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'body' => array(
            'numeric' => array(
                'rule' => array('notempty'),
                'message' => 'Comments must not be empty.',
                'allowEmpty' => false,
                'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
}