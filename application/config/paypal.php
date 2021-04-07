<?php
    /** set your paypal credential **/

    $config['client_id'] = 'ARHDcDE920CZSgNsK74CGDc79ej8Tw6x8h0LFH2_waY2JaDcnUBYJRqVjDDQenTy3149Fkgk_Frf5CSj';
    $config['secret'] = 'ELz4uOneEGwDCZ1R2FnK2G4krRWsOY5dYo3Dw5NwkqUTWgG83oe0QjrME-8G-5kwGExDUszuD1kO5lYY';

    /**
     * SDK configuration
     */
    /**
     * Available option 'sandbox' or 'live'
     */
    $config['settings'] = array(

        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 1000,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => 'application/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    );
