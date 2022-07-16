<?php
class Validator{
    protected $errorHandler;
    protected $items;
    protected $rules = ['required', 'minlength', 'maxlength', 'email', 'unique', 'match', 'uniqueSlug'];
    public $messages =  [
        'required' => 'The :field field is required.',
        'minlength' => 'The :field field must be a minimum of :satisfier length.',
        'maxlength' => 'The :field field must be a maximum of :satisfier length.',
        'email' => 'Email address is not valid.',
        'match' => 'The :field field must match the :satisfier field.',
        'unique' => 'The :field is already taken.',
        'uniqueSlug' => 'slugTaken',
    ];
    private $db;
    public function __construct(Database $db, ErrorHandler $errorHandler)
    {
        $this->errorHandler = $errorHandler;
        $this->db = $db;
    }
    public function check($rules){
        $items = $_POST;
        $this->items = $items;
        foreach ($items as $item => $value){
            if(in_array($item, array_keys($rules))){
                $this->validate([
                    'field' => $item,
                    'value' => $value,
                    'rules' => $rules[$item]
                ]);
            }
        }
        return $this;
    }

    public function fails(){
        return $this->errorHandler->hasErrors();
    }

    public function errors(){
        return $this->errorHandler;
    }
    protected function validate($item){
        $field = $item['field'];
        foreach ($item['rules'] as $rule => $satisfier){
            if(in_array($rule, $this->rules)){
                if(!call_user_func_array([$this, $rule], [$field, $item['value'], $satisfier])){
                    $this->errorHandler->addError(
                        str_replace([':field',':satisfier'], [$field, $satisfier], $this->messages[$rule])
                        ,$field);
                }
            }
        }
    }
    protected function required($field, $value, $satisfier){
        return !empty(trim($value));
    }
    protected function minlength($field, $value, $satisfier){
        return mb_strlen($value) >= $satisfier;
    }
    protected function maxlength($field, $value, $satisfier){
        return mb_strlen($value) <= $satisfier;
    }
    protected function email($field, $value, $satisfier){
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    protected function match($field, $value, $satisfier){
        return $value === $this->items[$satisfier];
    }
    protected function unique($field, $value, $satisfier){
        return count($this->db->query("select {$field} from {$satisfier} where {$field} = '{$value}'")) == 0;
    }
    protected function uniqueSlug($field, $value, $satisfier){
        $value = generateSlug($value);
        return count($this->db->query("select slug from {$satisfier} where slug = '{$value}'")) == 0;
    }
}