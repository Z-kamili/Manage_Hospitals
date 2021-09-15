<?php

namespace App\Interfaces\Doctors;

interface DoctorRepositoryInterface
{

    public function index();

    public function store($request);

    public function create();

    public function edit($id);

    public function update($request);

    public function destroy($request);

    public function update_password($request);

    public function update_status($request);


}