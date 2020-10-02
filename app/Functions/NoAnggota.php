<?php


namespace App\Functions;


class NoAnggota
{
    public function generate($lastID)
    {
        $no_id = $lastID["id"];
        if ($no_id < 10){
            $get_id = substr($lastID, -2);
        }
        elseif ($no_id >= 10 and $no_id < 99){
            $get_id = substr($lastID, -3);
        }
        else
        {
            $get_id = substr($lastID, -4);
        }

        $id_increment = (int) $get_id;
        $id_increment++;

        return $id_increment;
    }

}