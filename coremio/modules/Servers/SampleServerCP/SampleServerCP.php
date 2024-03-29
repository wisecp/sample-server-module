<?php
    class SampleServerCP_Module extends ServerModule
    {
        private $api;
        function __construct($server,$options=[])
        {
            $this->_name = __CLASS__;
            parent::__construct($server,$options);
        }

        protected function define_server_info($server=[])
        {
            /*
            if(!class_exists("SampleApi")) include __DIR__.DS."api.class.php";
            $this->api = new SampleApi(
                $server["name"],
                $server["ip"],
                $server["username"],
                $server["password"],
                $server["access_hash"],
                $server["port"],
                $server["secure"],
                $server["port"]
            );
            */
        }

        public function testConnect(){

            try
            {
                $connect    = 'OK';  #$this->api->checkConnect();
            }
            catch(Exception $e){
                $this->error = $e->getMessage();
                return false;
            }

            if($connect != 'OK'){
                $this->error = $connect;
                return false;
            }

            return true;
        }

        public function config_options($data=[])
        {
            return [
                'example1'          => [
                    'name'              => "Text Box",
                    'description'       => "Text Box Description",
                    'type'              => "text",
                    'width'             => "50",
                    'value'             => isset($data["example1"]) ? $data["example1"] : "sample",
                    'placeholder'       => "sample placeholder",
                ],
                'example2'          => [
                    'name'              => "Password Box",
                    'description'       => "Password Box Description",
                    'type'              => "password",
                    'width'             => "50",
                    'value'             => isset($data["example2"]) ? $data["example2"] : "sample",
                    'placeholder'       => "sample placeholder",
                ],
                'example3'          => [
                    'name'              => "Approval Button",
                    'description'       => "Approval Button Description",
                    'type'              => "approval",
                    'checked'           => isset($data["example3"]) && $data["example3"] ? true : false,
                ],
                'example4'          => [
                    'name'              => "Dropdown Menu 1",
                    'description'       => "Dropdown Menu 1 Description",
                    'type'              => "dropdown",
                    'options'           => "Option 1,Option 2,Option 3,Option 4",
                    'value'             => isset($data["example4"]) ? $data["example4"] : "Option 2",
                ],
                'example5'          => [
                    'name'              => "Dropdown Menu 2",
                    'description'       => "Dropdown Menu 2 Description",
                    'type'              => "dropdown",
                    'options'           => [
                        'opt1'     => "Option 1",
                        'opt2'     => "Option 2",
                        'opt3'     => "Option 3",
                        'opt4'     => "Option 4",
                    ],
                    'value'             => isset($data["example5"]) ? $data["example5"] : "opt2",
                ],
                'example6'          => [
                    'name'              => "Circular(Radio) Button 1",
                    'description'       => "Circular(Radio) Button 1",
                    'width'             => 40,
                    'description_pos'   => 'L',
                    'is_tooltip'        => true,
                    'type'              => "radio",
                    'options'           => "Option 1,Option 2,Option 3,Option 4",
                    'value'             => isset($data["example6"]) ? $data["example6"] : "Option 2",
                ],
                'example7'          => [
                    'name'              => "Circular(Radio) Button 2",
                    'description'       => "Circular(Radio) Button 2 Description",
                    'description_pos'   => 'L',
                    'is_tooltip'        => true,
                    'type'              => "radio",
                    'options'           => [
                        'opt1'     => "Option 1",
                        'opt2'     => "Option 2",
                        'opt3'     => "Option 3",
                        'opt4'     => "Option 4",
                    ],
                    'value'             => isset($data["example7"]) ? $data["example7"] : "opt2",
                ],
                'example8'          => [
                    'name'              => "Text Area",
                    'description'       => "Text Area Description",
                    'rows'              => "3",
                    'type'              => "textarea",
                    'value'             => isset($data["example8"]) ? $data["example8"] : "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
                    'placeholder'       => "sample placeholder",
                ],
            ];
        }

        public function create(array $order_options=[])
        {

            try
            {
                /*
                 * $order_options or $this->order["options"]
                * for parameters: https://docs.wisecp.com/en/kb/parameters
                * Here are the codes to be sent to the API...
                */
                $result = "OK|101"; #$this->api->create();
            }
            catch (Exception $e){
                $this->error = $e->getMessage();
                self::save_log(
                    'Servers',
                    $this->_name,
                    __FUNCTION__,
                    ['order' => $this->order],
                    $e->getMessage(),
                    $e->getTraceAsString()
                );
                return false;
            }

            /*
            * Error Result:
            * $result             = "Failed to create server, something went wrong.";
            */
            if(substr($result,0,2) == 'OK')
                return [
                    'ip'                => '192.168.1.1',
                    'assigned_ips'      => ['192.168.1.2','192.168.1.3'],
                    'login' => [
                        'username' => 'root',
                        'password' => 'test123',
                    ],
                    'config' => [$this->entity_id_name => substr($result,3)],
                ];
            else
            {
                $this->error = $result;
                return false;
            }
        }

        public function suspend()
        {
            try
            {
                /*
                 * $this->order["options"]
                * for parameters: https://docs.wisecp.com/en/kb/parameters
                * Here are the codes to be sent to the API...
                */
                $result             = "OK"; #$this->api->suspend();
            }
            catch (Exception $e){
                $this->error = $e->getMessage();
                self::save_log(
                    'Servers',
                    $this->_name,
                    __FUNCTION__,
                    ['order' => $this->order],
                    $e->getMessage(),
                    $e->getTraceAsString()
                );
                return false;
            }
            /*
            * Error Result:
            * $result             = "Error Message";
            */

            if($result == 'OK')
                return true;
            else
            {
                $this->error = $result;
                return false;
            }
        }

        public function unsuspend()
        {
            try
            {
                /*
                 * $this->order["options"]
                * for parameters: https://docs.wisecp.com/en/kb/parameters
                * Here are the codes to be sent to the API...
                */
                $result = "OK"; #$this->api->unsuspend();
            }
            catch (Exception $e){
                $this->error = $e->getMessage();
                self::save_log(
                    'Servers',
                    $this->_name,
                    __FUNCTION__,
                    ['order' => $this->order],
                    $e->getMessage(),
                    $e->getTraceAsString()
                );
                return false;
            }

            /*
            * Error Result:
            * $result             = "Error Message";
            */

            if($result == 'OK')
                return true;
            else
            {
                $this->error = $result;
                return false;
            }
        }

        public function terminate()
        {
            try
            {
                /*
                 * $this->order["options"]
                * for parameters: https://docs.wisecp.com/en/kb/parameters
                * Here are the codes to be sent to the API...
                */
                $result = "OK"; # $this->api->terminate();
            }
            catch (Exception $e){
                $this->error = $e->getMessage();
                self::save_log(
                    'Servers',
                    $this->_name,
                    __FUNCTION__,
                    ['order' => $this->order],
                    $e->getMessage(),
                    $e->getTraceAsString()
                );
                return false;
            }

            /*
            * Error Result:
            * $result             = "Error Message";
            */

            if($result == 'OK')
                return true;
            else
            {
                $this->error = $result;
                return false;
            }
        }

        /**
         * (Not Required) When a product addon is purchased, you can use this function if you need to perform an action on the module according to the purchased addon.
         * @param array $addon Transmits the data of the linked row in the users_products_addons table in the database.
         * @param array $args Will be deprecated after 3.2.
         * @return bool|array If you return an array as a return value, it stores this array as JSON in the "module_data" column of the corresponding row in the "users_products_addons" table in the database. If you don't need to store data, you can return bool data depending on the transaction state.
         */
        /*
        public function addon_create($addon=[], $args=[]):bool|array
        {
            $entity_id  = $this->config[$this->entity_id_name] ?? 0;

            if(!$entity_id)
            {
                $this->error = "The connected service is not yet established.";
                return false;
            }

            $values = $this->id_of_conf_opt[$addon['id']] ?? [];

            // Sample: Buy Backup
            if(($values["Backup"] ?? []))
            {
                #$value = $values["Backup"]; // Ex: "Daily" or "Weekly"
                #$response = $this->api->EnableBackup($entity_id,$value);
                $response    = ['status' => "successful"];
                if(!$response)
                {
                    $this->error = $this->api->error;
                    return false;
                }
                return true;
            }

            // Sample: Buy Extra IP Address
            elseif(($values["ExtraIP"] ?? []))
            {

                #$value = $values["ExtraIP"]; //  Ex: "5","10","15"
                #$response = $this->api->AddExtraIPAddress($value,$entity_id);
                $response    = [
                    'id' => 123,
                    'status' => "successful",
                    'data' => [
                        '192.168.1.1',
                        '192.168.1.2',
                        '192.168.1.3',
                    ],
                ];

                if(!$response)
                {
                    $this->error = $this->api->error;
                    return false;
                }

                // Updating the IP addresses assigned to the order
                $assigned_ips = explode("\n",$this->options["assigned_ips"] ?? '');
                foreach($response["data"] AS $ip) $assigned_ips[] = $ip;
                $this->options["assigned_ips"] = implode("\n",$assigned_ips);
                Orders::set($this->order["id"],['options' => Utility::jencode($this->options)]);

                // Return addon module_data
                return [
                    'id' => $response["id"]
                ];
            }

            return true;
        }
        */
        /**
         * (Not Required) Use this function if you also want to take action on the module when the status of the ordered product addon is suspended.
         * @param array $addon Transmits the data of the linked row in the users_products_addons table in the database.
         * @param array $args Will be deprecated after 3.2.
         * @return bool|array If you return an array as a return value, it stores this array as JSON in the "module_data" column of the corresponding row in the "users_products_addons" table in the database. If you don't need to store data, you can return bool data depending on the transaction state.
         */
        /*
        public function addon_suspend($addon=[],$args=[])
        {
            $entity_id  = $this->config[$this->entity_id_name] ?? 0;
            if(!$entity_id) return true;

            $values         = $this->id_of_conf_opt[$addon['id']] ?? [];
            $module_data    = [];

            // Sample: Suspend Backup
            if(($values["Backup"] ?? []))
            {
                #$response = $this->api->DisableBackup($entity_id);
                $response    = ['status' => "successful"];
                if(!$response)
                {
                    $this->error = $this->api->error;
                    return false;
                }
                return true;
            }

            // Sample: Suspend Extra IP Address
            elseif(($values["ExtraIP"] ?? []))
            {
                #$id = $module_data["id"] ?? 0;
                #$response = $this->api->DisableExtraIPAddress($id);
                $response    = [
                    'status' => "successful",
                ];

                if(!$response)
                {
                    $this->error = $this->api->error;
                    return false;
                }
                return true;
            }

            return true;
        }
        */
        /**
         * (Not Required) Use this function if you also want to take action on the module when the status of the ordered product addon is unsuspended.
         * @param array $addon Transmits the data of the linked row in the users_products_addons table in the database.
         * @param array $args Will be deprecated after 3.2.
         * @return bool|array If you return an array as a return value, it stores this array as JSON in the "module_data" column of the corresponding row in the "users_products_addons" table in the database. If you don't need to store data, you can return bool data depending on the transaction state.
         */
        /*
        public function addon_unsuspend($addon=[],$args=[])
        {
            $entity_id  = $this->config[$this->entity_id_name] ?? 0;
            if(!$entity_id) return true;

            $values         = $this->id_of_conf_opt[$addon['id']] ?? [];
            $module_data    = [];

            // Sample: Unsuspend Backup
            if(($values["Backup"] ?? []))
            {
                #$response = $this->api->EnableBackup($entity_id);
                $response    = ['status' => "successful"];
                if(!$response)
                {
                    $this->error = $this->api->error;
                    return false;
                }
                return true;
            }

            // Sample: Unsuspend Extra IP Address
            elseif(($values["ExtraIP"] ?? []))
            {
                #$id = $module_data["id"] ?? 0;
                #$response = $this->api->EnableExtraIPAddress($id);
                $response    = [
                    'status' => "successful",
                ];

                if(!$response)
                {
                    $this->error = $this->api->error;
                    return false;
                }
                return true;
            }

            return true;
        }
        */
        /**
         * (Not Required) Use this function if you also want to take action on the module when the status of the ordered product addon is cancelled.
         * @param array $addon Transmits the data of the linked row in the users_products_addons table in the database.
         * @param array $args Will be deprecated after 3.2.
         * @return bool|array If you return an array as a return value, it stores this array as JSON in the "module_data" column of the corresponding row in the "users_products_addons" table in the database. If you don't need to store data, you can return bool data depending on the transaction state.
         */
        /*
        public function addon_cancelled($addon=[],$params=[])
        {
            $entity_id  = $this->config[$this->entity_id_name] ?? 0;
            if(!$entity_id) return true;

            $values         = $this->id_of_conf_opt[$addon['id']] ?? [];
            $module_data    = [];

            // Sample: Cancel Backup
            if(($values["Backup"] ?? []))
            {
                #$response = $this->api->CancelBackup($entity_id);
                $response    = ['status' => "successful"];
                if(!$response)
                {
                    $this->error = $this->api->error;
                    return false;
                }
                return true;
            }

            // Sample: Cancel Extra IP Address
            elseif(($values["ExtraIP"] ?? []))
            {
                #$id = $module_data["id"] ?? 0;
                #$response = $this->api->CancelExtraIPAddress($id);
                $response    = [
                    'status' => "successful",
                ];

                if(!$response)
                {
                    $this->error = $this->api->error;
                    return false;
                }
                return [];
            }

            return true;
        }
        */
        /**
         * (Not Required) Use this function if you also want to take action on the module when the details of the ordered product addon is changed.
         * @param array $addon Transmits the data of the linked row in the users_products_addons table in the database.
         * @param array $args Database "users_products_addons" table after modification of the related row
         * @return bool|array If you return an array as a return value, it stores this array as JSON in the "module_data" column of the corresponding row in the "users_products_addons" table in the database. If you don't need to store data, you can return bool data depending on the transaction state.
         */
        /*
        public function addon_change($addon=[],$args=[])
        {
            $entity_id  = $this->config[$this->entity_id_name] ?? 0;
            if(!$entity_id) return true;

            $values         = $this->id_of_conf_opt[$addon['id']] ?? [];
            $module_data    = [];


            // Sample: Change Extra IP Address
            if(($values["ExtraIP"] ?? []))
            {
                $q      = (int) $args["option_quantity"] ?? 0;
                #$id = $module_data["id"] ?? 0;
                #$response = $this->api->ChangeIPAddressCount($id,$q);
                $response    = [
                    'status' => "successful",
                    'data' => [
                        '192.168.1.1',
                        '192.168.1.2',
                        '192.168.1.3',
                    ],
                ];

                if(!$response)
                {
                    $this->error = $this->api->error;
                    return false;
                }

                // Updating the IP addresses assigned to the order
                $assigned_ips = explode("\n",$this->options["assigned_ips"] ?? '');
                foreach($response["data"] AS $ip) if(!in_array($ip,$assigned_ips)) $assigned_ips[] = $ip;
                $this->options["assigned_ips"] = implode("\n",$assigned_ips);
                Orders::set($this->order["id"],['options' => Utility::jencode($this->options)]);

                return true;
            }

            return true;
        }
        */

        public function apply_updowngrade($params=[])
        {
            // You can use it to delete the previous virtual server and create the virtual server with new features.
            // return parent::udgrade(); 
            
            
            // Or upgrade the service according to the features of the new product package as in the code example below.
            
            try
            {
                
                $disk_limit     = $params["creation_info"]["example1"] ?? -1;
                $memory_limit   = $params["creation_info"]["example2"] ?? -1;
                
                /*
                 * $this->order["options"]
                * for parameters: https://docs.wisecp.com/en/kb/parameters
                * Here are the codes to be sent to the API...
                */
                $result             = "OK"; #$this->api->upgrade($disk_limit,$memory_limit);
            }
            catch (Exception $e){
                $this->error = $e->getMessage();
                self::save_log(
                    'Servers',
                    $this->_name,
                    __FUNCTION__,
                    ['order' => $this->order],
                    $e->getMessage(),
                    $e->getTraceAsString()
                );
                return false;
            }
            /*
            * Error Result:
            * $result             = "Error Message";
            */

            if($result == 'OK')
                return true;
            else
            {
                $this->error = $result;
                return false;
            }
        }

        public function get_status()
        {
            try
            {
                /*
                 * $this->order["options"]
                * for parameters: https://docs.wisecp.com/en/kb/parameters
                * Here are the codes to be sent to the API...
                */
                $result = "running"; # $this->api->status();
                //$result = "stopped"; # $this->api->status();
            }
            catch (Exception $e){
                $this->error = $e->getMessage();
                self::save_log(
                    'Servers',
                    $this->_name,
                    __FUNCTION__,
                    ['order' => $this->order],
                    $e->getMessage(),
                    $e->getTraceAsString()
                );
                return false;
            }

            /*
            * Error Result:
            * $result             = "Error Message";
            */

            if($result == 'running')
                return true;
            elseif($result == 'stopped')
                return false;
            else
            {
                $this->error = $result;
                return false;
            }
        }

        public function list_vps()
        {

            $list = [];

            try
            {
                #$data = $this->api->accounts();
                $data = [
                    'status' => "OK",
                    'result' => [
                         [
                            'id'            => 123,
                            'hostname'      => "server2e4.example.com",
                            'primary_ip'    => '192.168.1.1',
                            'is_suspended'  => false,
                            'ip_addresses'  => ['192.168.1.1','192.168.1.2','192.168.1.3','192.168.1.4'],
                            'hostname'      => "server-123",
                            'user'          => [
                                'id'     => 100,
                                'email'  => 'your@example.com',
                            ],
                        ]
                    ]
                ];
            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
                self::save_log(
                    'Servers',
                    $this->_name,
                    __FUNCTION__,
                    ['order' => $this->order],
                    $e->getMessage(),
                    $e->getTraceAsString()
                );
                return false;
            }

            if($data['status'] != 'OK'){
                $this->error = $data['message'];
                return false;
            }

            if(isset($data['result']) && $data['result']){
                $entity_id_name     = $this->entity_id_name; // "vm_id" (Virtual machine ID)
                foreach($data['result'] AS $account){
                    $hostname       = $account['hostname'];
                    $primary_ip     = $account["primary_ip"];

                    $list[$account["id"]] = [
                        'cdate'             => $account["created"], # Format: Y-m-d H:i:s
                        'status'            => $account['is_suspended'] ? "suspended" : "active",
                        'hostname'          => $hostname,
                        'ip'                => $primary_ip,
                        'assigned_ips'      => implode("\n",$account["ip_addresses"]),
                        'login'             => ['username' => $account["user"]["email"]],
                        'sync_terms'        => [
                            [
                                'column'    => "JSON_UNQUOTE(JSON_EXTRACT(options,'$.config.".$this->entity_id_name."'))",
                                'mark'      => "LIKE",
                                'value'     => $account["id"], // Exasample VPS ID
                                'logical'   => "", // Required for a second field OR  ||  AND
                            ]
                        ],
                        'access_data'       => [ // options.config array values
                            $entity_id_name => $account["id"] // VPS identity id
                        ],
                         'add_options'       => [ // adding extra data to options column
                            'custom1' => "test1",
                            'custom2' => "test2",
                        ],
                    ];
                }
            }
            return $list;
        }

        public function clientArea()
        {
            $content    = '';
            $_page      = $this->page;
            $_data      = [];

            if(!$_page) $_page = 'home';
            
            if($_page == "home")
            {
                $_data = ['test1' => 'hello world', 'test2' => 'sample var'];
            }
            
            $content .= $this->clientArea_buttons_output();
            
            $content .= $this->get_page('clientArea-'.$_page,$_data);
            return  $content;
        }

        public function clientArea_buttons()
        {
            $buttons    = [];

            if($this->page && $this->page != "home")
            {
                $buttons['home'] = [
                    'text' => $this->lang["turn-back"],
                    'type' => 'page-loader',
                ];
            }
            else
            {
                $status     = 'running'; # With API, status information is obtained from the server.

                if($status == 'running')
                {
                    $buttons['restart']     = [
                        'text'  => $this->lang["restart"],
                        'type'  => 'transaction',
                    ];

                    $buttons['reboot']      = [
                        'text'  => $this->lang["reboot"],
                        'type'  => 'transaction',
                    ];
                    $buttons['stop']      = [
                        'text'  => $this->lang["stop"],
                        'type'  => 'transaction',
                    ];
                }
                elseif($status == 'stop')
                {
                    $buttons['start']      = [
                        'text'  => $this->lang["start"],
                        'type'  => 'transaction',
                    ];
                }

                $buttons['change-password'] = [
                    'text'  => $this->lang["change-password"],
                    'type'  => 'page-loader',
                ];

                $buttons['another-page'] = [
                    'text'  => 'Another Page',
                    'type'  => 'page',
                ];

                $buttons['custom_function'] = [
                    'text'  => 'Open Function',
                    'type'  => 'function',
                    'target_blank' => true,
                ];

                $buttons['another-link'] = [
                    'text'      => 'Another link',
                    'type'      => 'link',
                    'url'       => 'https://www.google.com',
                    'target_blank' => true,
                ];
            }

            return $buttons;
        }

        public function use_clientArea_SingleSignOn()
        {
            $api_result     = 'OK|bmd5d0p384ax7t26zr9wlwo4f62cf8g6z0ld';

            if(substr($api_result,0,2) != 'OK'){
                echo "An error has occurred, unable to access.";
                return false;
            }

            $token          = substr($api_result,2);
            $url            = 'https://modulewebsite.com/api/access/'.$token;

            Utility::redirect($url);

            echo "Redirecting...";
        }

        public function use_adminArea_SingleSignOn()
        {
            $api_result     = 'OK|bmd5d0p384ax7t26zr9wlwo4f62cf8g6z0ld';

            if(substr($api_result,0,2) != 'OK'){
                echo "An error has occurred, unable to access.";
                return false;
            }

            $token          = substr($api_result,2);
            $url            = 'https://modulewebsite.com/api/access/'.$token;

            Utility::redirect($url);

            echo "Redirecting...";
        }

        public function use_adminArea_root_SingleSignOn()
        {
            $api_result     = 'OK|bmd5d0p384ax7t26zr9wlwo4f62cf8g6z0ld';

            if(substr($api_result,0,2) != 'OK'){
                echo "An error has occurred, unable to access.";
                return false;
            }

            $token          = substr($api_result,2);
            $url            = 'https://modulewebsite.com/api/access/'.$token;

            Utility::redirect($url);

            echo "Redirecting...";
        }


        public function use_clientArea_change_password()
        {
            if(!Filter::isPOST()) return false;
            $password       = Filter::init("POST/password","password");

            if(!$password){
                echo Utility::jencode([
                    'status' => "error",
                    'message' => $this->lang["error"],
                ]);
                return false;
            }

            $result = 'OK';  /* API request result */
            if($result != 'OK'){
                $this->error = $result;
                return false;
            }

            $password_e         = $this->encode_str($password);

            if(!isset($this->options["login"])) $this->options["login"] = [];

            $this->options["login"]["password"] = $password_e;

            # users_products.options save data
            Orders::set($this->order["id"],['options' => Utility::jencode($this->options)]);

            // Save Action Log
            $u_data     = UserManager::LoginData("member");
            $user_id    = $u_data["id"];
            User::addAction($user_id,'transaction','"Chane Server Password" Command sent for service #'.$this->order["id"]);
            Orders::add_history($user_id,$this->order["id"],'server-order-password-changed');

            // Save Module Log
            self::save_log('Servers',$this->_name,__FUNCTION__,['order' => $this->order],['api_result' => $result]);

            echo Utility::jencode([
                'status'    => "successful",
                'message'   => $this->lang["successful"],
                'timeRedirect' => ['url' => $this->area_link, 'duration' => 3000],
            ]);

            return true;
        }

        public function use_clientArea_start()
        {
            if($this->start()){
                $u_data     = UserManager::LoginData('member');
                $user_id    = $u_data['id'];
                User::addAction($user_id,'transaction','"Start" Command sent for service #'.$this->order["id"]);
                Orders::add_history($user_id,$this->order["id"],'server-order-start');
                return true;
            }
            return false;
        }
        public function use_clientArea_stop()
        {
            if($this->stop()){
                $u_data     = UserManager::LoginData('member');
                $user_id    = $u_data['id'];
                User::addAction($user_id,'transaction','"Stop" Command sent for service #'.$this->order["id"]);
                Orders::add_history($user_id,$this->order["id"],'server-order-stop');
                return true;
            }
            return false;
        }
        public function use_clientArea_restart()
        {
            if($this->restart()){
                $u_data     = UserManager::LoginData('member');
                $user_id    = $u_data['id'];
                User::addAction($user_id,'transaction','"Restart" Command sent for service #'.$this->order["id"]);
                Orders::add_history($user_id,$this->order["id"],'server-order-restart');
                return true;
            }
            return false;
        }
        public function use_clientArea_reboot()
        {
            if($this->reboot()){
                $u_data     = UserManager::LoginData('member');
                $user_id    = $u_data['id'];
                User::addAction($user_id,'transaction','"Reboot" Command sent for service #'.$this->order["id"]);
                Orders::add_history($user_id,$this->order["id"],'server-order-reboot');
                return true;
            }
            return false;
        }

        public function use_clientArea_custom_function()
        {
            if(Filter::POST("var2"))
            {
                echo  Utility::jencode([
                    'status' => "successful",
                    'message' => 'Successful message',
                ]);
            }
            else
            {
                echo "Content Here...";
            }

            return true;
        }

        public function use_adminArea_custom_function()
        {
            if(Filter::POST("var2"))
            {
                echo  Utility::jencode([
                    'status' => "successful",
                    'message' => 'Successful message',
                ]);
            }
            else
            {
                echo "Content Here...";
            }

            return true;
        }

        public function adminArea_service_fields(){
            $c_info                 = $this->options["creation_info"];
            $field1                 = isset($c_info["field1"]) ? $c_info["field1"] : NULL;
            $field2                 = isset($c_info["field2"]) ? $c_info["field2"] : NULL;

            return [
                'field1'                => [
                    'name'              => "Field 1",
                    'description'       => "Field 1 Description",
                    'type'              => "text",
                    'value'             => $field1,
                    'placeholder'       => "sample placeholder",
                ],
                'field2'                => [
                    'wrap_width'        => 100,
                    'name'              => "Field 2",
                    'type'              => "output",
                    'value'             => '<input type="text" name="creation_info[field2]" value="'.$field2.'">',
                ],
            ];
        }


        public function save_adminArea_service_fields($data=[])
        {
            $login          = $this->options["login"];
            $c_info         = $data['creation_info'];
            $config         = $data['config'];

            if(isset($c_info["new_password"]) && $c_info["new_password"] != '')
            {
                $new_password = $c_info["new_password"];

                unset($c_info["new_password"]);

                if(strlen($new_password) < 5)
                {
                    $this->error = 'Password is too short!';
                    return false;
                }
                /*
                *  Place the codes to be transmitted to the api here.
                */

                $login["password"] = $this->encode_str($new_password);
            }

            return [
                'creation_info'     => $c_info,
                'config'            => $config,
                'login'             => $login,
            ];
        }

        public function adminArea_buttons()
        {
            $buttons = [];

            $status     = 'running'; # With API, status information is obtained from the server.

            if($status == 'running')
            {
                $buttons['restart']     = [
                    'text'  => $this->lang["restart"],
                    'type'  => 'transaction',
                ];

                $buttons['reboot']      = [
                    'text'  => $this->lang["reboot"],
                    'type'  => 'transaction',
                ];
                $buttons['stop']      = [
                    'text'  => $this->lang["stop"],
                    'type'  => 'transaction',
                ];
            }
            elseif($status == 'stop')
            {
                $buttons['start']      = [
                    'text'  => $this->lang["start"],
                    'type'  => 'transaction',
                ];
            }

            $buttons['custom_function'] = [
                'text'  => 'Open Function',
                'type'  => 'function',
                'target_blank' => true,
            ];

            $buttons['another-link'] = [
                'text'      => 'Another link',
                'type'      => 'link',
                'url'       => 'https://www.google.com',
                'target_blank' => true,
            ];

            return $buttons;
        }

        public function use_adminArea_start()
        {
            $this->area_link .= '?content=automation';
            if($this->start()){
                $u_data     = UserManager::LoginData('admin');
                $user_id    = $u_data['id'];
                User::addAction($user_id,'transaction','"Start" Command sent for service #'.$this->order["id"]);
                Orders::add_history($user_id,$this->order["id"],'server-order-start');
                return true;
            }
            return false;
        }
        public function use_adminArea_stop()
        {
            $this->area_link .= '?content=automation';
            if($this->stop()){
                $u_data     = UserManager::LoginData('admin');
                $user_id    = $u_data['id'];
                User::addAction($user_id,'transaction','"Stop" Command sent for service #'.$this->order["id"]);
                Orders::add_history($user_id,$this->order["id"],'server-order-stop');
                return true;
            }
            return false;
        }
        public function use_adminArea_restart()
        {
            $this->area_link .= '?content=automation';
            if($this->restart()){
                $u_data     = UserManager::LoginData('admin');
                $user_id    = $u_data['id'];
                User::addAction($user_id,'transaction','"Restart" Command sent for service #'.$this->order["id"]);
                Orders::add_history($user_id,$this->order["id"],'server-order-restart');
                return true;
            }
            return false;
        }
        public function use_adminArea_reboot()
        {
            $this->area_link .= '?content=automation';
            if($this->reboot()){
                $u_data     = UserManager::LoginData('admin');
                $user_id    = $u_data['id'];
                User::addAction($user_id,'transaction','"Reboot" Command sent for service #'.$this->order["id"]);
                Orders::add_history($user_id,$this->order["id"],'server-order-reboot');
                return true;
            }
            return false;
        }
        

        public function start()
        {
            try
            {
                $result             = "OK"; #$this->api->start();
            }
            catch (Exception $e){
                $this->error = $e->getMessage();
                self::save_log(
                    'Servers',
                    $this->_name,
                    __FUNCTION__,
                    ['order' => $this->order],
                    $e->getMessage(),
                    $e->getTraceAsString()
                );
                echo Utility::jencode([
                    'status' => "error",
                    'message' => $this->error,
                ]);
                return false;
            }
            /*
            * Error Result:
            * $result             = "Error Message";
            */

            if($result == 'OK')
            {
                echo Utility::jencode([
                    'status' => "successful",
                    'message' => $this->lang["successful"],
                    'timeRedirect' => [
                        'url' => $this->area_link,
                        'duration' => 1000
                    ],
                ]);
                return true;
            }
            else
            {
                $this->error = $result;
                echo Utility::jencode([
                    'status' => "error",
                    'message' => $this->error,
                ]);
                return false;
            }

        }

        public function stop()
        {
            try
            {
                $result             = "OK"; #$this->api->stop();
            }
            catch (Exception $e){
                $this->error = $e->getMessage();
                self::save_log(
                    'Servers',
                    $this->_name,
                    __FUNCTION__,
                    ['order' => $this->order],
                    $e->getMessage(),
                    $e->getTraceAsString()
                );
                echo Utility::jencode([
                    'status' => "error",
                    'message' => $this->error,
                ]);
                return false;
            }
            /*
            * Error Result:
            * $result             = "Error Message";
            */

            if($result == 'OK')
            {
                echo Utility::jencode([
                    'status' => "successful",
                    'message' => $this->lang["successful"],
                    'timeRedirect' => [
                        'url' => $this->area_link,
                        'duration' => 1000
                    ],
                ]);
                return true;
            }
            else
            {
                $this->error = $result;
                echo Utility::jencode([
                    'status' => "error",
                    'message' => $this->error,
                ]);
                return false;
            }
        }

        public function restart()
        {
            try
            {
                $result             = "OK"; #$this->api->restart();
            }
            catch (Exception $e){
                $this->error = $e->getMessage();
                self::save_log(
                    'Servers',
                    $this->_name,
                    __FUNCTION__,
                    ['order' => $this->order],
                    $e->getMessage(),
                    $e->getTraceAsString()
                );
                echo Utility::jencode([
                    'status' => "error",
                    'message' => $this->error,
                ]);
                return false;
            }
            /*
            * Error Result:
            * $result             = "Error Message";
            */

            if($result == 'OK')
            {
                echo Utility::jencode([
                    'status' => "successful",
                    'message' => $this->lang["successful"],
                    'timeRedirect' => [
                        'url' => $this->area_link,
                        'duration' => 1000
                    ],
                ]);
                return true;
            }
            else
            {
                $this->error = $result;
                echo Utility::jencode([
                    'status' => "error",
                    'message' => $this->error,
                ]);
                return false;
            }

        }

        public function reboot()
        {
            try
            {
                $result             = "OK"; #$this->api->reboot();
            }
            catch (Exception $e){
                $this->error = $e->getMessage();
                self::save_log(
                    'Servers',
                    $this->_name,
                    __FUNCTION__,
                    ['order' => $this->order],
                    $e->getMessage(),
                    $e->getTraceAsString()
                );
                echo Utility::jencode([
                    'status' => "error",
                    'message' => $this->error,
                ]);
                return false;
            }
            /*
            * Error Result:
            * $result             = "Error Message";
            */

            if($result == 'OK')
            {
                echo Utility::jencode([
                    'status' => "successful",
                    'message' => $this->lang["successful"],
                    'timeRedirect' => [
                        'url' => $this->area_link,
                        'duration' => 1000
                    ],
                ]);
                return true;
            }
            else
            {
                $this->error = $result;
                echo Utility::jencode([
                    'status' => "error",
                    'message' => $this->error,
                ]);
                return false;
            }
        }


    }
