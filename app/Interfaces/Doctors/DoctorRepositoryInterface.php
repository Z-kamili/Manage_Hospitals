<?php

namespace App\Interfaces\Doctors;

interface DoctorRepositoryInterface
{

    public function index();

    public function store($request);

    public function create();

    public function edit($request);

    public function update($request);

    public function destroy($request);

}