<?php
/**
 * Filter component
 * Benefits:
 * 1. Keep the filter criteria in the Session
 * 2. Give ability to customize the search wrapper of the field types
 **
 * @author  Nik Chankov
 * @website http://nik.chankov.net
 * @version 1.0.0
 *
 */

class FilterComponent extends Component
{
    /**
     * fields which will replace the regular syntax in where i.e. field = 'value'
     */
    var $fieldFormatting = array(
        "string" => array("%1\$s LIKE", "%%%2\$s%%"),
        "text" => array("%1\$s LIKE", "%%%2\$s%%"),
        "checkbox" => array("%1\$s =>", "%2\$s%%"),
        "date" => array("DATE_FORMAT(%1\$s, '%%d-%%m-%%Y')", "%2\$s"),
        "datetime" => array("DATE_FORMAT(%1\$s, '%%d-%%m-%%Y')", "%2\$s")
    );

    /**
     * extra identifier (if needed to specify extra location (like requestAction))
     */
    var $identifier = '';

    /**
     * Function which will change controller->data array
     * @access public
     * @param object $controller the class of the controller which call this component
     * @return array Generated filter array
     */
    public function process(&$controller)
    {
        $this->_prepareFilter($controller);
        $ret = $this->generateCondition($controller, $controller->data);
        return $ret;
    }

    /**
     * Function which loop the provided data and generate the proper where clause
     * @param $object object Controller or The model in the controller which has been provided in the post
     * @param $data array|boolean which is posted from the filter
     * @return array Filter array
     */
    public function generateCondition($object, $data = false)
    {
        $ret = array();
        if (isset($data) && is_array($data)) {
            //Loop for models
            foreach ($data as $model => $filter) {
                if ($model == 'OR') {
                    $ret = am($ret, array('OR' => $this->generateCondition($object, $filter)));
                    unset($data[$model]);
                }
                if (isset($object->{$model})) { //This is object under current object.
                    $columns = $object->{$model}->getColumnTypes();
                    foreach ($filter as $field => $value) {
                        if (is_array($value)) { //Possible that this node is another model
                            if (in_array($field, array_keys($columns))) { //The field is from the model, but it has special formatting
                                if (isset($value['BETWEEN'])) { //BETWEEN case
                                    if ($value['BETWEEN'][0] != '' && $value['BETWEEN'][1] != '') {
                                        $ret[$model . '.' . $field . ' BETWEEN ? AND ?'] = $value['BETWEEN'];
                                    }
                                }
                            } else {
                                $ret = am($ret, $this->generateCondition($object->{$model}, array($field => $value)));
                            }
                            unset($value);
                        } else {
                            if ($value != '') {
                                //Trim the value
                                $value = trim($value);
                                //Check if there are some fieldFormatting set
                                if (isset($this->fieldFormatting[$columns[$field]])) {
                                    if (isset($this->fieldFormatting[$columns[$field]][1])) {
                                        $ret[sprintf($this->fieldFormatting[$columns[$field]][0], $model . '.' . $field, $value)] = sprintf($this->fieldFormatting[$columns[$field]][1], $model . '.' . $field, $value);
                                    } else {
                                        $ret[] = sprintf($this->fieldFormatting[$columns[$field]][0], $model . '.' . $field, $value);
                                    }
                                } else {
                                    $ret[$model . '.' . $field] = $value;
                                }
                            }
                        }
                    }
                    //unsetting the empty forms
                    if (count($filter) == 0) {
                        unset($object->data[$model]);
                    }
                }
            }

            //Support for 'scopes' using custom model findTypes
            if (isset($object->passedArgs) && is_array($object->passedArgs)) {
                //Check if passedArgs exist
                $passedArgs = $object->passedArgs;
                $scope = 'all';
                //get the scope
                if (array_key_exists('scope', $passedArgs)) {
                    $scope = $passedArgs['scope'];
                    //Set the find type
                    $object->Paginator->settings['findType'] = $scope;
                }
            }
        }
        return $ret;
    }

    /**
     * function which will take care of the storing the filter data and loading after this from the Session
     * @param object $controller
     * @return void
     */
    public function _prepareFilter(&$controller)
    {
        if (isset($controller->data)) {
            $thisController = $controller->data;
            //use the supplied query string if post data is empty
            if (empty($thisController) && (isset($controller->params->query) && !empty($controller->params->query))) {
                //Data needs to be keyed under the singularized model name, eg. ['Book'] => array(...)
                $controller_nam = Inflector::singularize($controller->name);
                $thisController = array($controller_nam => $controller->params->query);
            }
            foreach ($thisController as $model => $fields) {
                foreach ($fields as $key => $field) {
                    if ($field == '') {
                        unset($thisController[$model][$key]);
                    }
                }
            }
            $controller->Session->write($controller->name . '.' . $controller->params['action'] . $this->identifier, $thisController);
        }
        $filter = $controller->Session->read($controller->name . '.' . $controller->params['action'] . $this->identifier);
        $controller->data = $filter;
    }
}