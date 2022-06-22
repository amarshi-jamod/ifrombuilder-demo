<?php
    /**
     * Allow api from all Origins. We can change this for production.
     */
    header('Access-Control-Allow-Headers: *');
    header('Access-Control-Allow-Origin: *');
    
    /**
     * Set content type to application/json for api response.
     */
    header('Content-Type: application/json; charset=utf-8');

    /**
     * Get action from api and set allowed actions.
     */
    $action = isset($_GET['action'])?$_GET['action']:'';
    $allowedActions = ['create', 'get'];

    /**
     * Default response for api.
     */
    $response = [
        'status' => false,
        'Message' => 'Something went wrong!',
        'data' => [],
    ];

    /**
     * Check if the action is allowed or not
     */
    if(in_array($action, $allowedActions)) {
        include 'config/config.php';
        include 'services/IFormBuilder.php';

        /**
         * Create new object of IFormBuilder. This will generate also generate token.
         */
        $iFormBuilder = new IFormBuilder();

        /**
         * Create new record
         */
        if($action=='create') {
            $fields = json_decode(file_get_contents('php://input'), TRUE);
            $iform = $iFormBuilder->create($fields);
            $response = [
                'status' => TRUE,
                'message' => 'Record created successfully.',
                'data' => $iform['response'],
            ];
        }
        /**
         * Get all records
         */
        else if($action=='get') {
            $iform = $iFormBuilder->get();
            $response = [
                'status' => TRUE,
                'message' => 'Record listed successfully.',
                'data' => $iform['response'],
            ];
        }
    }
    /**
     * Retrun response
     */
    die(json_encode($response));
?>    