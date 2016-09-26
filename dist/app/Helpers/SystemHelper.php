<?php
    /**
     * Send Email Message
     *
     * @return instance
     */
    function sendMail($From = '',$To,$Subject,$Content = '',$cc = '') {

        $post['content'] = $Content;
        $post['to'] = $To;
        $post['subject'] = $Subject;

        if (!empty($cc)) {
            $post['cc'] = $cc;
        }

        if (!is_array($To)) {
            Mail::send('emails.mail', $post, function ($message) use ($post) {
                $message->from(config('app.Email'),Sys::$title);
                $message->to(getObjectValue($post,'to'));

                if (!empty($post['cc'])) {
                    foreach($post['cc'] as $cc) {
                        $message->to($cc);
                    }
                }
                
                $message->subject(getObjectValue($post,'subject'));
            });
        }
    }
     /**
     * get Notification instance
     *
     * @return instance
     */
    function notification() {
        return new App\Notifications\Services;
    }

    /**
     * get User Table
     *
     * @return string
     */
    function userTable() {   
        return config('auth.table');
    }

     /**
     * get Model Class User
     *
     * @return Class
     */
    function userModel() {   
        $model = config('auth.model');
        return new $model;
    }

    /**
     * get User Model Joins Foreign Tables
     *
     * @return Class
     */
    function userJoins() {   
        $model = config('auth.model');
        return $model::data();
    }

    /**
     * get User Model Joins Foreign Tables
     *
     * @return Class
     */
    function userLogs() {   
        $model = config('app.AuditTrails');
        return new $model;
    }

    /**
     * get System Date
     *
     * @return DateTime
     */
    function systemDate() {
        return date('Y-m-d H:i:s');
    }

    /**
     * get Administrator Code
     *
     * @return string
     */
    function getAdminCode() {
        return 'ADMIN';
    }

    /**
     * page permission
     *
     * @param string $page
     * @return class
     */
    function pagePermission($page) {
       return new Permission($page);
    }

    /**
     * Is Login user has Permission to access page
     *
     * @param string $page, string $action
     * @return string
     */
    function isPermissionHas($page,$action) {
        $permission = new Permission($page);
        return property_exists($permission, $action) ? $permission->$action : false;
    }

    /**
     * token length
     *
     * @var define
     */
    define('token_length','20');

    /**
     * encode token to base64
     *
     * @param string $token
     * @return string
     */
    function encodeToken($token) {
        if (!$token) return;
        $key = sha1('ab$6*1hVmkLd^0.');
        $code1 = substr($key,0,strlen($key)-constant('token_length'));       
        $code2 = substr($key,strlen($key)-constant('token_length'),constant('token_length'));
        $key = $code1.$token.$code2.'|'.base64_encode(strlen($code2.$token));

        return base64_encode($key);
    }

     /**
     * decode token to base64
     *
     * @param string $token
     * @return string
     */
    function decodeToken($token) {
        if (!$token) return;
        $token_ = base64_decode($token);
        $token_ = explode('|',$token_);
        if (count( $token_) < 2) {
            return '';
        }
        $tokenLeftLength = base64_decode($token_[1]);
        $token_ = $token_[0];

        $key = substr($token_, -$tokenLeftLength);

        return substr($key,0,strlen($key)-constant('token_length'));
    }

     /**
     * validate token
     *
     * @param string $token
     * @return string
     */
    function isValidToken($token)
    {
        if ($token) {
            if (count(explode('|',base64_decode($token))) > 1) {
                return true;
            }
        }
        return false;
    }

    /**
     * get System Config
     *
     * @return string
     */
    function AppConfig() {   
        return new \App\Config\Config;
    }

     /**
     * get System Config
     *
     * @return string
     */
    function AppValidation() {   
        return new \App\Config\Validation;
    }

    /**
     * get System Config Storage Patj
     *
     * @return string
     */
    function AppPath(&$path) {   
        return $path = storage_path('app/'.$path);
    }

    /**
     * get User agent
     *
     * @return array
     */
    function getBrowser() 
    { 
        $u_agent = $_SERVER['HTTP_USER_AGENT']; 
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Internet Explorer'; 
            $ub = "MSIE"; 
        } 
        elseif(preg_match('/Firefox/i',$u_agent)) 
        { 
            $bname = 'Mozilla Firefox'; 
            $ub = "Firefox"; 
        } 
        elseif(preg_match('/Chrome/i',$u_agent)) 
        { 
            $bname = 'Google Chrome'; 
            $ub = "Chrome"; 
        } 
        elseif(preg_match('/Safari/i',$u_agent)) 
        { 
            $bname = 'Apple Safari'; 
            $ub = "Safari"; 
        } 
        elseif(preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Opera'; 
            $ub = "Opera"; 
        } 
        elseif(preg_match('/Netscape/i',$u_agent)) 
        { 
            $bname = 'Netscape'; 
            $ub = "Netscape"; 
        } 

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    } 

    /**
     * Add Call back function
     *
     * @callback function
     */
    function it($desc,$it) {
        $it();
    }

    /**
     * Set System Auditrails logs
     *
     * @param string $module, string $controller, string $method
     * @param string $action, string/array $parameter, string/array $message
     */
    function SystemLog($module, $controller, $method, $action = '', $parameter = '', $message = '', $UserID = '')
    {
        $module = trimmed($module);
        $controller = trimmed($controller);
        $method = trimmed($method);
        $action = trimmed($action);

        $message = is_array($message) ? json_encode($message) : $message;
        $parameter = is_array($parameter) ? json_encode($parameter) : $parameter;
        return
        DB::table('auditrails')
            ->insert([
                'module' => $module,
                'controller' => $controller ,
                'method' => $method,
                'action' => $action,
                'parameter' => $parameter,
                'message' => $message,
                'browser' => json_encode(getBrowser()),
                'device' => gethostname(),
                'ip_address' => Request::ip(),
                'created_date' => systemDate(),
                'created_by' => !$UserID ? getUserID() : $UserID
            ]);
    }
    
    function err_log($exception){
        Log::error($exception);
    }
