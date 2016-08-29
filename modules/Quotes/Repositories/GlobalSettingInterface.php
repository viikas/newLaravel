<?php namespace Modules\Quotes\Repositories;

interface GlobalSettingInterface{
    public function getAllSettings();
    public function getSingleSetting($settingID);
    public function storesettings($data);
    //public function editsettings($id);
    public function updatesettings($data);
   ///public function deletesettings($id);
  // public function getProfilesAccessories($data);
    public function getSettingsByType($type);
    public function addSetting($setting);
    public function updateSetting($setting);
}

