<?php

namespace Antoinecorbin\Nova2fa\Http\Controllers;

use Antoinecorbin\Nova2fa\Services\TwoFactorManager;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Nova\Http\Controllers\LoginController as NovaLoginController;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends NovaLoginController
{
    protected $twoFactorManager;

    public function __construct(TwoFactorManager $twoFactorManager)
    {
        parent::__construct();
        $this->twoFactorManager = $twoFactorManager;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws ValidationException
     * @throws Exception
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if (Auth::once($request->only('email', 'password'))) {
            $user = auth()->user();

            $this->sendTwoFactorCode($user);
            $this->attemptLogin($request);

            $redirect = redirect()->route('nova.2fa.verify');

            return $request->wantsJson()
                ? new JsonResponse(['redirect' => $redirect->getTargetUrl()], 200)
                : $redirect;
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Envoie le code de vérification 2FA.
     *
     * @param $user
     * @throws Exception
     */
    public function sendTwoFactorCode($user): void
    {
        try {
            $this->twoFactorManager->driver()->sendCode($user);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
