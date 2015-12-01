<?php namespace Stevemo\Cpanel\Controllers;

use View, Redirect, Input, Lang, Config;
use Stevemo\Cpanel\Puesto\Repo\CpanelPuestoInterface;
use Stevemo\Cpanel\Puesto\Form\PuestoFormInterface;
use Stevemo\Cpanel\Permission\Repo\PermissionInterface;
use Stevemo\Cpanel\Puesto\Repo\PuestoNotFoundException;

class PuestosController extends BaseController {

    /**
     * @var \Stevemo\Cpanel\Group\Repo\CpanelGroupInterface
     */
    protected $puestos;

    /**
     * @var \Stevemo\Cpanel\Group\Form\GroupFormInterface
     */
    protected $form;

    /**
     * @var \Stevemo\Cpanel\Permission\Repo\PermissionInterface
     */
    protected $permissions;

    /**
     * @param \Stevemo\Cpanel\Group\Repo\CpanelGroupInterface     $groups
     * @param \Stevemo\Cpanel\Group\Form\GroupFormInterface       $form
     * @param \Stevemo\Cpanel\Permission\Repo\PermissionInterface $permissions
     */
    public function __construct(
        CpanelPuestoInterface $puestos,
        PuestoFormInterface $form,
        PermissionInterface $permissions
    )
    {
        $this->puestos = $puestos;
        $this->form = $form;
        $this->permissions = $permissions;
    }


    /**
     * Display all the groups
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $puestos = $this->puestos->findAll();
        return View::make('cpanel::puestos.index', compact('puestos'));
    }

    /**
     * Display create a new group form
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $genericPermissions = $this->permissions->generic();
        $modulePermissions = $this->permissions->module();
        $puestoPermissions = array();

        return View::make('cpanel::puestos.create')
            ->with('genericPermissions',$genericPermissions)
            ->with('modulePermissions',$modulePermissions)
            ->with('puestoPermissions',$puestoPermissions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        try
        {
            $puesto = $this->puestos->findById($id);

            $puestoPermissions = $puesto->getPermissions();
            $genericPermissions = $this->permissions->generic();
            $modulePermissions = $this->permissions->module();


            return View::make('cpanel::puestos.edit')
                ->with('puesto',$puesto)
                ->with('genericPermissions',$genericPermissions)
                ->with('modulePermissions',$modulePermissions)
                ->with('puestoPermissions',$puestoPermissions);
        }
        catch ( PuestoNotFoundException $e)
        {
            return Redirect::route('admin.puestos.index')->with('error', $e->getMessage());
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        if ( $this->form->create(Input::all()) )
        {
            return Redirect::route('cpanel.puestos.index')
                ->with('success', Lang::get('cpanel::puestos.create_success'));
        }

        return Redirect::back()
            ->withInput()
            ->withErrors($this->form->getErrors());
    }

    /**
     * Update the specified resource in storage.
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        try
        {
            $inputs = Input::all();
            $inputs['id'] = $id;

            if ( $this->form->update($inputs) )
            {
                return Redirect::route('cpanel.puestos.index')
                    ->with('success', Lang::get('cpanel::puestos.update_success') );
            }

            return Redirect::back()
                ->withInput()
                ->withErrors($this->form->getErrors());
        }
        catch (PuestoNotFoundException $e)
        {
            return Redirect::route('cpanel.puestos.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try
        {
            $this->puestos->delete($id);

            return Redirect::route('cpanel.puestos.index')
                ->with('success', Lang::get('cpanel::puestos.delete_success'));
        }
        catch (PuestoNotFoundException $e)
        {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

}
