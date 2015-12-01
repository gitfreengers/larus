<?php namespace Stevemo\Cpanel\Puesto\Repo;

use Cartalyst\Sentry\Puestos\PuestoNotFoundException as SentryPuestoNotFoundException;
use Cartalyst\Sentry\Sentry;
use Illuminate\Events\Dispatcher;

class PuestoRepository implements CpanelPuestoInterface {

    /**
     * @var \Cartalyst\Sentry\Sentry
     */
    protected $sentry;

    /**
     * @var \Illuminate\Events\Dispatcher
     */
    protected  $event;

    /**
     * @param Sentry                        $sentry
     * @param \Illuminate\Events\Dispatcher $event
     */
    public function __construct(Sentry $sentry, Dispatcher $event)
    {
        $this->sentry = $sentry;
        $this->event = $event;
    }

    /**
     * Find the group by ID.
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @param  int $id
     *
     * @return \Cartalyst\Sentry\Groups\GroupInterface  $group
     *
     * @throws GroupNotFoundException
     */
    public function findById($id)
    {
        try
        {
            return $this->sentry->getPuestoProvider()->findById($id);
        }
        catch (SentryPuestoNotFoundException $e)
        {
            throw new PuestoNotFoundException($e->getMessage());
        }
    }

    /**
     * Find the group by name.
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @param  string $name
     *
     * @return \Cartalyst\Sentry\Groups\GroupInterface  $group
     *
     * @throws GroupNotFoundException
     */
    public function findByName($name)
    {
        return $this->sentry->getPuestoProvider()->findByName($name);
    }

    /**
     * Returns all groups.
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @return array  $groups
     */
    public function findAll()
    {
        return $this->sentry->getPuestoProvider()->findAll();
    }

    /**
     * Creates a group.
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @param  array $attributes
     *
     * @return \Cartalyst\Sentry\Groups\GroupInterface
     */
    public function create(array $attributes)
    {
        $puesto = $this->sentry->getPuestoProvider()->create($attributes);
        $this->event->fire('puestos.create', array($puesto));
        return $puesto;
    }

    /**
     * Update a group
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @param array $attributes
     *
     * @return bool
     */
    public function update(array $attributes)
    {
        $puesto = $this->findById($attributes['id']);
        $puesto->name = $attributes['name'];
        $puesto->permissions = $attributes['permissions'];
        $puesto->save();
        $this->event->fire('puestos.update',array($puesto));
        return true;
    }

    /**
     * Delete a group
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @param $id
     *
     * @return void
     *
     * @throws \Cartalyst\Sentry\Groups\GroupNotFoundException
     */
    public function delete($id)
    {
        $puesto = $this->findById($id);
        $old = $puesto;
        $puesto->delete();
        $this->event->fire('puestos.delete', array($old));
    }

}