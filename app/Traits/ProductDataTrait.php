<?php
namespace App\Traits;
use Illuminate\Support\Str;
use Ramsey\Uuid\Nonstandard\Uuid;
trait ProductDataTrait
{
    public function preperData($data)
    {

        $data['slug'] = Str::slug($data['name']);
        $data['uuid'] = Uuid::uuid4()->toString();
        $data['categorizable_type'] = $this->getCategoryClass($data['categorizable_type']);

        return $data;
    }
}
