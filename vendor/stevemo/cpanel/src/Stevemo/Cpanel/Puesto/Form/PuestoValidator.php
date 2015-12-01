<?php  namespace Stevemo\Cpanel\Puesto\Form;

use Stevemo\Cpanel\Services\Validation\AbstractValidator;

class PuestoValidator extends AbstractValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'name' => 'required|unique:puestos'
    );


    /**
     * Test if validation passes before update
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @return bool
     */
    public function validForUpdate()
    {
        $this->rules['name'] .= ',name,' . $this->data['id'];
        return parent::passes();
    }
} 