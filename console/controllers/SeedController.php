<?php

namespace console\controllers;
use tebazil\dbseeder\Seeder;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class SeedController extends Controller {

    private function _getFileData(){
        $resourceCountryCity = Yii::getAlias('@resourceCountryCity') . DIRECTORY_SEPARATOR . 'worldcities.csv';
        if (!is_file($resourceCountryCity) && !is_readable($resourceCountryCity)) {
            exit('File doesn\'t find!');
        }

        $data = [];
        ini_set('auto_detect_line_endings',TRUE);
        $fileContent = fopen($resourceCountryCity,'r');
        while ( ($output = fgetcsv($fileContent) ) !== FALSE ) {
            if (!empty($output[1]) && !empty($output[4])) {
                $data[$output[4]][] = $output[1];
            }
        }
        ini_set('auto_detect_line_endings',FALSE);

        if (empty($data)) {
            exit('File is empty!');
        }

        if (!empty($data['country'])) {
            unset($data['country']);
        }

        return $data;
    }

    public function actionCountryAndCity() {
        $countries = $cities = [];
        $idCountry = $idCity= 0;
        $data = $this->_getFileData();

        foreach ($data as $country => $countryCities) {
            $idCountry++;
            $countries[] = [
                'id' => (int) $idCountry,
                'name' => $country
            ];
            foreach ($countryCities as $city) {
                $idCity++;
                $cities[] = [
                    'id' => $idCity,
                    'country_id' => $idCountry,
                    'city' => $city
                ];
            }
        }

        $seeder = new \tebazil\yii2seeder\Seeder();
        $seeder->table('countries')->data($countries, ['id', 'name'])->rowQuantity($idCountry);
        $seeder->table('cities')->data($cities, ['id', 'country_id', 'city'])->rowQuantity($idCity);
        $seeder->refill();
        exit('Data has been inserted successfully.!');
    }
}