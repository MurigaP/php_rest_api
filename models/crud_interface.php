<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/25/17
 * Time: 3:53 PM
 */

interface ApiCrud {
    public function create();
    public function update($id);
    public static function delete($id);
    public static function getId($id);
    public static function all();
}