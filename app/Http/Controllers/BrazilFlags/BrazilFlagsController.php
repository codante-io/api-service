<?php

namespace App\Http\Controllers\BrazilFlags;

use App\Http\Controllers\Controller;

class BrazilFlagsController extends Controller
{
    protected $ufs = [
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins',
    ];

    public function index()
    {
        $imageEndpoint = 'https://assets.codante.io/codante-apis/bandeiras-dos-estados/';
        $res = array_map(function ($uf) use ($imageEndpoint) {
            return [
                'uf' => $uf,
                'name' => $this->ufs[$uf],
                'flag_url' => $imageEndpoint.strtolower($uf).'-full.svg',
                'flag_url_rounded' => $imageEndpoint.strtolower($uf).'-rounded.svg',
                'flag_url_square' => $imageEndpoint.strtolower($uf).'-square-rounded.svg',
                'flag_url_circle' => $imageEndpoint.strtolower($uf).'-circle.svg',
            ];
        }, array_keys($this->ufs));

        return response()->json($res);
    }
}
