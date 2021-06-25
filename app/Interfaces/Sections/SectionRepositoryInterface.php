<?php
namespace App\Interfaces\Sections;

interface SectionRepositoryInterface
{
    //get all Section
    public function index();

    public function store($request);

    public function update($request);

    public function destroy($request);

    // destroy Sections
    public function show($id);


}