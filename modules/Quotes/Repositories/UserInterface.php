<?php namespace Modules\Quotes\Repositories;

interface UserInterface{

public function getPermission();

public function getRoles();
public function addNewRole($data);
public function editRoles($data);


public function getUsers();
public function addUser($data);
public function editUser($data);

}