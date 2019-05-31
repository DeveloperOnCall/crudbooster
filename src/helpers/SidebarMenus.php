<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/24/2019
 * Time: 11:22 PM
 */

namespace crocodicstudio\crudbooster\helpers;


use crocodicstudio\crudbooster\controllers\CBController;
use crocodicstudio\crudbooster\models\SidebarModel;
use Illuminate\Support\Facades\DB;

class SidebarMenus
{
    /**
     * @param $menu
     * @return SidebarModel
     */
    private function assignToModel($menu) {
        $model = new SidebarModel();
        $model->setId($menu->id);
        if($menu->type == "url") {
            $model->setUrl($menu->path);
            $model->setIcon($menu->icon);
            $model->setName($menu->name);
            $model->setBasepath(basename($model->getUrl()));
        }elseif ($menu->type == "module") {
            $module = cb()->find("cb_modules", $menu->cb_modules_id);
            $className = '\App\Http\Controllers\\'.$module->controller;
            $controllerClass = new $className();
            /** @var CBController $controllerClass */
            $model->setUrl(cb()->getAdminUrl($controllerClass->getData("permalink")));
            $model->setIcon($module->icon);
            $model->setName($module->name);
            $model->setBasepath(config('crudbooster.ADMIN_PATH').'/'.basename($model->getUrl()));
        }elseif ($menu->type == "path") {
            $model->setUrl(cb()->getAdminUrl($menu->path));
            $model->setIcon($menu->icon);
            $model->setName($menu->name);
            $model->setBasepath(config('crudbooster.ADMIN_PATH').'/'.basename($model->getUrl()));
        }

        if(request()->is($model->getBasepath()."*")) {
            $model->setIsActive(true);
        }else{
            $model->setIsActive(false);
        }

        return $model;
    }

    private function loadData($parent_id = null) {
        $menus = DB::table("cb_menus");
        if($parent_id) {
            $menus->where("parent_cb_menus_id",$parent_id);
        }else{
            $menus->whereNull("parent_cb_menus_id");
        }
        return $menus->orderBy("sort_number","asc")->get();
    }

    private function rolePrivilege($cb_roles_id, $cb_menus_id) {
        return cb()->find("cb_role_privileges",['cb_roles_id'=>$cb_roles_id,'cb_menus_id'=>$cb_menus_id]);
    }

    private function checkPrivilege($roles_id,$menu) {
        if($roles_id) {
            $privilege = $this->rolePrivilege($roles_id, $menu->id);
            if($privilege && !$privilege->can_browse) {
                return false;
            }
        }

        return true;
    }

    public function all($withPrivilege = true) {
        $roles_id = ($withPrivilege)?cb()->session()->roleId():null;
        $menus = $this->loadData();
        $result = [];
        $menus_active = false;
        foreach($menus as $menu) {

            if($withPrivilege && !$this->checkPrivilege($roles_id, $menu)) continue;

            $sidebarModel = $this->assignToModel($menu);
            if($sidebarModel->getisActive()) $menus_active = true;
            if($menus2 = $this->loadData($menu->id)) {
                $sub1 = [];
                $menus2_active = false;
                foreach ($menus2 as $menu2) {

                    if($withPrivilege && !$this->checkPrivilege($roles_id, $menu2)) continue;

                    $sidebarModel2 = $this->assignToModel($menu2);
                    if($sidebarModel2->getisActive()) $menus2_active = true;

                    if($menus3 = $this->loadData($menu2->id)) {
                        $sub2 = [];
                        $menus3_active = false;
                        foreach ($menus3 as $menu3) {

                            if($withPrivilege && !$this->checkPrivilege($roles_id, $menu3)) continue;

                            $sidebarModel3 = $this->assignToModel($menu3);

                            if($sidebarModel3->getisActive()) {
                                $menus3_active = true;
                            }

                            $sub2[] = $sidebarModel3;
                        }
                        $sidebarModel2->setSub($sub2);
                        $sidebarModel2->setSubActive($menus3_active);
                    }
                    $sub1[] = $sidebarModel2;
                }
                $sidebarModel->setSub($sub1);
                $sidebarModel->setSubActive($menus2_active);
            }
            $result[] = $sidebarModel;
        }
        return $result;
    }

}