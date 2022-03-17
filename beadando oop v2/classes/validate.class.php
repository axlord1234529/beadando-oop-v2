<?php
class Validate {
    private $_passed = false,
    $_errors = array(),
    $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function check($source,$items = array())
    { 
        /*  
            $item is the lable and $rules is the actual value.
            example:( ''username' => array())
        */
        foreach($items as $item =>$rules)
        {
            foreach($rules as $rule => $rule_value)
            {
                $item = escape($item);
                $value = trim($source[$item]);
                $name = $rules['name'];
                if($rule === 'required' && $rule_value === true && empty($value))
                {
                    
                    $this->addError($name,"{$name} is required!");
                    

                }else if(!empty($value))
                {
                        switch($rule)
                        {
                            case 'min':
                                if(strlen($value)<$rule_value)
                                {
                                    $this->addError($name,"{$name} must be a minimum of {$rule_value} characters!");
                                    break 2; // if you want to show one error at a time.
                                }
                            break;
                            case 'max':
                                if(strlen($value)>$rule_value)
                                {
                                    $this->addError($name,"{$name} must be a maximum of {$rule_value} characters!");
                                    break 2;
                                }
                                
                            break;
                            case 'matches':
                                if($source[$rule_value] != $value)
                                {
                                    $this->addError($name,"{$name} must match {$rule_value}!");
                                    break 2;
                                }
                            break;
                            case 'unique':
                                $c = $this->_db->get($rule_value,array($item,"=",$value));
                                
                                if($c->count())  // won't work with every database alternativ(!empty($c->first()))
                                {
                                    $this->addError($name,"This {$name} is already in use!");
                                    break 2;
                                }
                            break;
                            case 'lower_case':
                                    if($rule_value === true && 0 === preg_match("/[a-zéáűúőóüöí]+/",$value))
                                    {
                                        $this->addError($name,"{$name} must have at least one lower case character! ");
                                        break 2;
                                    }
                            break;
                            case 'upper_case':
                                if($rule_value === true && 0 === preg_match("/[A-ZÉÁŰÚŐÓÜÖÍ]+/",$value))
                                {
                                    $this->addError($name,"{$name} must have at least one upper case character! ");
                                    break 2;
                                }
                            break;
                            case 'digit':
                                if($rule_value === true && 0 === preg_match("/[\d]+/",$value))
                                {
                                    $this->addError($name,"{$name} must have at least one digit! ");
                                    break 2;
                                }
                            break;
                            case 'special_character':
                                if($rule_value === true && 0 === preg_match("/[^\wéáűúőóüöíÉÁŰÚŐÖÜÓÍ]|_+/",$value))
                                {
                                    $this->addError($name,"{$name} must have at least one special character(*&_)! ");
                                    break 2;
                                }
                            break;
                            case 'has_characters':
                                if($rule_value === true && 0 === preg_match("/[a-zA-Z]+/",$value))
                                {
                                    $this->addError($name,"{$name} must have at least one character! ");
                                    break 2;
                                }
                            break;
                        }
                }
            }
        }

        if(empty($this->_errors))
        {
            $this->_passed = true;
        }
        return $this;
    }
    private function addError($belongsTo,$error)
    {
        $this->_errors[$belongsTo] = $error; 
    }
    public function errors()
    {
        return $this->_errors;
    }
    public function passed()
    {
        return $this->_passed;
    }
}