<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Http;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Método que faz a requisição na API dos usuários.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(): \Illuminate\Http\JsonResponse
    {
        //Fazendo a requisição
        $response = Http::get('https://random-data-api.com/api/v2/users?size=100');

        //Recuperando os dados
        if($response->successful()){
            return response()->json([
                'users' => $response->json()
            ]);
        }

        return response()->json([
            'message' => 'Falha na comunicação com a API!'
        ],404);
    }
}
