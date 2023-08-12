<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    /**
     * Repositório de usuário.
     *
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * Injeção de dependencia do repositório do usuário.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }
    /**
     * Index padrão do sistema.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('index');
    }

    /**
     * Action que retorna os usuários da API.
     */
    public function read(): \Illuminate\Http\JsonResponse
    {
        return $this->userRepository->getAll();
    }
}
