<?php
/**
 * Created Raphael Barboza - Braver Innovation
 */

namespace App\Traits;

trait ApiResponseTrait
{

    /**
     * Force the Response?
     */
    private $forceResponse = false;

    /**
     * Force the data response, and die();
     */
    protected function forceResponse(){
        $this->forceResponse = true;
    }

    /**
     * Default Api Response
     */
    protected function apiResponse($success, $message, $data = [], $statusCode = 200)
    {
        if ($this->forceResponse) {
            response()->json([
                'success' => $success,
                'message' => $message,
                'data' => $data
            ], $statusCode)->send();
            die();
        } else {
            return response()->json([
                'success' => $success,
                'message' => $message,
                'data' => $data
            ], $statusCode);
        }
    }

    /**
     * Return a single message with success info.
     */

    protected function respondSuccess($message = "Ok")
    {
        return $this->apiResponse(true, $message);
    }

    /**
     * Return success and data with the 201 created http code
     */

    protected function respondCreated($data, $message = "created")
    {
        return $this->apiResponse(true, $message, $data, 201);
    }

    /**
     * Return success with requested data
     */
    protected function respondWithData($data, $message = "Requested Data")
    {
        return $this->apiResponse(true, $message, $data, 200);
    }

    /**
     * Return "accepted" http code, with no returning data
     */
    protected function respondAccepted()
    {
        return $this->apiResponse(true, "Request Accepdted", [], 202);
    }

    /**
     * Return no-content with empty data
     */
    protected function respondNoContent($message = "No Content Found")
    {
        return $this->apiResponse(false, $message, [], 204);
    }

    /**
     * Return not found
     */
    protected function respondNotFound($message = "API Endpoint Not Found")
    {
        return $this->apiResponse(false, $message, [], 404);
    }

    /**
     * Return Unauthorized
     */
    protected function respondUnauthorized($message = "Unauthorized")
    {
        return $this->apiResponse(false, $message, [], 401);
    }

    /**
     * Return Forbidden
     */
    protected function respondForbidden($message = "Forbidden")
    {
        return $this->apiResponse(false, $message, [], 403);
    }

    /**
     * Return TimeOut
     */
    protected function respondTimeOut($limit = 60)
    {
        return $this->apiResponse(false, "Request Exceeded " . $limit . " seconds.", [], 408);
    }

    /**
     * Return I'm a Teapot
     */
    protected function respondTeaPot()
    {
        return $this->apiResponse(false, "I'm a teapot", [], 418);
    }

    /**
     * Return a general error
     */
    protected function respondError($message = "Something terrible happened with this request", $data = [])
    {
        return $this->apiResponse(false, $message, $data, 400);
    }

    /**
     * When the code Crashes
     */

    protected function respondInternalError($message = 'Internal Error', $data = [])
    {
        return $this->apiResponse(false, $message, $data, 500);
    }

    /**
     * Return validation error
     */
    protected function respondValidationErrors($message = "Some data can't be validated", $data = [])
    {
        return $this->apiResponse(false, $message, $data, 422);
    }

}
