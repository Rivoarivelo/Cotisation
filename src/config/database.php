<?php
class Database {
    public static function site() {
        return new PDO(
            "mysql:host=localhost;dbname=sartmmg_site;charset=utf8",
            "root",
            "",
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    public static function compta() {
        return new PDO(
            "mysql:host=localhost;dbname=sartmmg_compta;charset=utf8",
            "root",
            "",
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}