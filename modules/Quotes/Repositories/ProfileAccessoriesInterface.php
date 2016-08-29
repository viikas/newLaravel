<?php

namespace Modules\Quotes\Repositories;

interface ProfileAccessoriesInterface {

    public function getProfileAccessory();

    public function getProfilePriceRevision();

    public function getAccessoryPrice();

    public function getLatestProfilePrice();

    public function getlatestProfilePriceRevision();

    public function getProfiles();

    public function getProfilePriceRevisionDates();

    public function getProfilePriceRevisionByDate($date);

    public function getProfileLatestRevision();

    public function addBulkProfilePriceRevision($revision);

    public function updateProfilePriceRevision($profileprice);

    public function getLatestAccessoryPrice();

    public function getPriceRevisionByDate($date);

    public function getAccessoryDate();

    public function getAccessoryInventPrice();

    public function addNewPriceRevision($data);

    public function addBulkPriceRevision($revision);

    public function updatePriceRevision($pricerevision);

    public function listAdditionalProfiles();

    public function addAdditionalProfiles($data);

    public function updateAdditionalProfiles($profile);

    public function deleteAdditionalProfiles($id);

    public function listAdditionalAccessories();

    public function addAdditionalAccessories($data);

    public function updateAdditionalAccessories($accessory);

    public function deleteAdditionalAccessories($id);

    public function getLatestAdditionalProfilePriceRevision();

    public function addAdditionalProfilePriceRevision($revision);

    public function getLatestAdditionalAccessoryPriceRevision();

    public function addAdditionalAccessoriesPriceRevision($revision);

    public function getLatestAdditionalProfilePriceRevisionByDate($date);

    public function updateAdditionalProfilePriceRevisionModel($addprofile);

    public function updateAdditionalAccessoriesPriceRevisionModel($addaccessories);

    public function getAddProfileLatestRevision();

    public function getLatestAdditionalAccessoryPriceRevisionByDate($date);

    public function getAddAccessoryLatestRevision();

    public function getByCategory($category);

    public function updatecms($cms);

    public function getInfillingProfileUnitCost($infillType, $thickness_id, $profile_id);

    public function getQuotesSetting();

    public function addQuoteItemTemplateProfile($templateProfile);

    public function updateQuoteItemTemplateProfile($templateProfile);

    public function addQuoteTemplateProfile($profile);

    public function updateQuoteTemplateProfile($profile);

    public function updateQuoteTemplates($templates);

    public function updatecmsData($cmsd);
    //public function addImage($image);
 //    public function createUniqueFilename($filename);
 // public function original( $photo, $filename );
// public function delete( $originalFilename);
    public function postAdd();
}
