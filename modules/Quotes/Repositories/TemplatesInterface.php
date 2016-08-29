<?php namespace Modules\Quotes\Repositories;

interface TemplatesInterface{
    public function getAllTemplates();
    public function getActiveTemplates();
    public function getSingleTemplate($templateID);
    public function getSingleActiveTemplate($templateID);
    public function getActiveTemplatesByIDs($ids);
    public function createTemplate($data);
    public function updateTemplate($data);
    public function copy($data);
    public function getProducts();

    public function getActiveTemplatesByOppId($oppId);
    //public function deleteTemplate($id);
}

