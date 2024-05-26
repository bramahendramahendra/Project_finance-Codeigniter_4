<?php

namespace App\Traits;

use CodeIgniter\HTTP\ResponseInterface;

trait ErrorHandlerTrait
{
    /**
     * Show a generic error page with a specific status code and message.
     *
     * @param int $status_code
     * @param string $errors
     * @param string $message
     * @return ResponseInterface
     */
    public function showErrorPage(int $status_code, string $errors, string $message): ResponseInterface
    {
        $response = service('response');
        $response->setStatusCode($status_code);
        $response->setBody(view('v_template', [
            'judul' => $status_code. ' Error Page',
            'menu' => 'kategoriTagihan',
            'page' => 'errors/v_error',
            'status_code' => $status_code,
            'errors' => $errors,
            'message' => $message,
        ]));
        return $response;
    }
}
