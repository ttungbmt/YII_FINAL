<?php
namespace pcd;

trait HomeTrait
{
    public function getLink(){
        $a = collect([]);
        $b = $a->merge([1, 2, 3]);
        return $b;
    }

    public function getHome(){
        $a = [1, 2, 3];
        $a[1] = [10];
        return $a;
    }
}