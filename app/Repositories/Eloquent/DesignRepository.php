<?php
namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\IDesign;
use App\Models\Design;


class DesignRepository extends BaseRepository implements IDesign 
{

    public function model()
    {
        return Design::class;
    }

    public function applyTags($id, array $data)
    {
        $design = $this->find($id);
        $design->retag($data);
    }

}