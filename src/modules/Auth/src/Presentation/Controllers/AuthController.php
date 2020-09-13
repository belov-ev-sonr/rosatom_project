<?php
namespace Rosatom\Auth\Presentation\Controllers;

use Rosatom\Auth\App\Services\TokenService;
use Rosatom\Auth\Infrastructure\Factories\TokenRepositoryFactory;
use Rosatom\User\Infrastructure\Factories\UserRepositoryFactory;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthController
{
    public function login(Request $request, Response $response): Response
    {
        $email = $request->getParsedBodyParam('email');
        $passwordHash = $request->getParsedBodyParam('password');

        $userRepository = UserRepositoryFactory::createRepository();
        $user = $userRepository->getUserByEmail($email, $passwordHash);
        if ($user) {
            $tokenService = $this->getTokenService();
            $accessToken = $tokenService->generateAccessToken($user->getId());
            $refreshToken = $tokenService->generateRefreshToken($user->getId());
            $response = $response->withJson([
                'accessToken' => $accessToken,
                'refreshToken' => $refreshToken
            ]);
        } else {
            $response = $response
                ->withStatus(401)
                ->withJson([
                'status' => false
            ]);
        }

        return $response;
    }

    public function refresh(Request $request, Response $response): Response
    {
        $refreshToken = $request->getParam('token');

        $tokenService = $this->getTokenService();
        $userAccess = $tokenService->checkRefreshToken($refreshToken);

        if ($userAccess) {
            $accessToken = $tokenService->generateAccessToken($userAccess->getUserId());
            $refreshToken = $tokenService->generateRefreshToken($userAccess->getUserId());
            $response = $response->withJson([
                'accessToken' => $accessToken,
                'refreshToken'=>$refreshToken
            ]);
        } else {
            $response = $response
                ->withJson(['error' => 'incorrect refresh token'])
                ->withStatus(401, 'incorrect refresh token');
        }

        return $response;
    }

    private function getTokenService(): TokenService
    {
        $tokenRepository = TokenRepositoryFactory::createRepository();
        $tokenService = new TokenService($tokenRepository);

        return $tokenService;
    }
}
