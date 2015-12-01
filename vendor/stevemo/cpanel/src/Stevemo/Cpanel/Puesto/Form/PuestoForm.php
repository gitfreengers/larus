<?php  namespace Stevemo\Cpanel\Puesto\Form;

use Stevemo\Cpanel\Services\Validation\ValidableInterface;
use Stevemo\Cpanel\Puesto\Repo\CpanelPuestoInterface;
use Cartalyst\Sentry\Puestos\NameRequiredException;
use Cartalyst\Sentry\Puestos\PuestoExistsException;

class PuestoForm implements PuestoFormInterface {


    /**
     * @var \Stevemo\Cpanel\Services\Validation\ValidableInterface
     */
    protected  $validator;

    /**
     * @var \Stevemo\Cpanel\Group\Repo\CpanelGroupInterface
     */
    protected $puestos;

    /**
     * @param ValidableInterface                              $validator
     * @param \Stevemo\Cpanel\Group\Repo\CpanelGroupInterface $groups
     */
    public function __construct(ValidableInterface $validator, CpanelPuestoInterface $puestos)
    {
        $this->validator = $validator;
        $this->puestos = $puestos;
    }

    /**
     * Create a new Group
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data)
    {
        try
        {
            if ($this->validator->with($data)->passes())
            {
                $this->puestos->create($data);
                return true;
            }
        }
        catch (PuestoExistsException $e)
        {
            $this->validator->add('PuestoExistsException', $e->getMessage());
        }
        catch (NameRequiredException $e)
        {
            $this->validator->add('NameRequiredException', $e->getMessage());
        }

        return false;
    }

    /**
     * Update a group
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @param array $data
     *
     * @return Bool
     */
    public function update(array $data)
    {
        try
        {
            if ($this->validator->with($data)->validForUpdate())
            {
                $this->puestos->update($data);
                return true;
            }
        }
        catch (PuestoExistsException $e)
        {
            $this->validator->add('PuestoExistsException', $e->getMessage());
        }
        catch (NameRequiredException $e)
        {
            $this->validator->add('NameRequiredException', $e->getMessage());
        }

        return false;
    }

    /**
     * Get the validator error
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getErrors()
    {
        return $this->validator->errors();
    }
}