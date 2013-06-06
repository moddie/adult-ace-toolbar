<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-05-29 07:25:48 --- EMERGENCY: Kohana_Exception [ 0 ]: A valid cookie salt is required. Please set Cookie::$salt. ~ SYSPATH/classes/Kohana/Cookie.php [ 152 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Cookie.php:67
2013-05-29 07:25:48 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Cookie.php(67): Kohana_Cookie::salt('__utma', NULL)
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(155): Kohana_Cookie::get('__utma')
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(117): Kohana_Request::factory(true, Array, false)
#3 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Cookie.php:67
2013-05-29 07:25:51 --- EMERGENCY: Kohana_Exception [ 0 ]: A valid cookie salt is required. Please set Cookie::$salt. ~ SYSPATH/classes/Kohana/Cookie.php [ 152 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Cookie.php:67
2013-05-29 07:25:51 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Cookie.php(67): Kohana_Cookie::salt('__utma', NULL)
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(155): Kohana_Cookie::get('__utma')
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(117): Kohana_Request::factory(true, Array, false)
#3 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Cookie.php:67
2013-05-29 07:25:54 --- EMERGENCY: Kohana_Exception [ 0 ]: A valid cookie salt is required. Please set Cookie::$salt. ~ SYSPATH/classes/Kohana/Cookie.php [ 152 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Cookie.php:67
2013-05-29 07:25:54 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Cookie.php(67): Kohana_Cookie::salt('__utma', NULL)
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(155): Kohana_Cookie::get('__utma')
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(117): Kohana_Request::factory(true, Array, false)
#3 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Cookie.php:67
2013-05-29 07:25:57 --- EMERGENCY: Kohana_Exception [ 0 ]: A valid cookie salt is required. Please set Cookie::$salt. ~ SYSPATH/classes/Kohana/Cookie.php [ 152 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Cookie.php:67
2013-05-29 07:25:57 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Cookie.php(67): Kohana_Cookie::salt('__utma', NULL)
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(155): Kohana_Cookie::get('__utma')
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(117): Kohana_Request::factory(true, Array, false)
#3 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Cookie.php:67
2013-05-29 07:51:45 --- EMERGENCY: ErrorException [ 1 ]: Class 'Controller_Base' not found ~ APPPATH/classes/Controller/Catalog.php [ 3 ] in :
2013-05-29 07:51:45 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 07:55:00 --- EMERGENCY: View_Exception [ 0 ]: The requested view scripts/catalog/index could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php:137
2013-05-29 07:55:00 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(137): Kohana_View->set_filename('scripts/catalog...')
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(30): Kohana_View->__construct('scripts/catalog...', NULL)
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Controller/Catalog.php(9): Kohana_View::factory('scripts/catalog...')
#3 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(84): Controller_Catalog->action_index()
#4 [internal function]: Kohana_Controller->execute()
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#9 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php:137
2013-05-29 07:55:04 --- EMERGENCY: View_Exception [ 0 ]: The requested view scripts/catalog/index could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php:137
2013-05-29 07:55:04 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(137): Kohana_View->set_filename('scripts/catalog...')
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(30): Kohana_View->__construct('scripts/catalog...', NULL)
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Controller/Catalog.php(9): Kohana_View::factory('scripts/catalog...')
#3 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(84): Controller_Catalog->action_index()
#4 [internal function]: Kohana_Controller->execute()
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#9 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php:137
2013-05-29 07:56:31 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Controller_Catalog::display() ~ APPPATH/classes/Controller/Catalog.php [ 13 ] in :
2013-05-29 07:56:31 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 07:58:47 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Controller_Catalog::display() ~ APPPATH/classes/Controller/Catalog.php [ 13 ] in :
2013-05-29 07:58:47 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 07:58:50 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Controller_Catalog::display() ~ APPPATH/classes/Controller/Catalog.php [ 13 ] in :
2013-05-29 07:58:50 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 07:59:01 --- EMERGENCY: View_Exception [ 0 ]: The requested view layouts/common could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php:137
2013-05-29 07:59:01 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(137): Kohana_View->set_filename('layouts/common')
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(30): Kohana_View->__construct('layouts/common', NULL)
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller/Template.php(33): Kohana_View::factory('layouts/common')
#3 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(69): Kohana_Controller_Template->before()
#4 [internal function]: Kohana_Controller->execute()
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#9 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php:137
2013-05-29 08:01:25 --- EMERGENCY: ErrorException [ 8 ]: Undefined index:  site_name ~ APPPATH/classes/Controller/Base.php [ 12 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Controller/Base.php:12
2013-05-29 08:01:25 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Controller/Base.php(12): Kohana_Core::error_handler(8, 'Undefined index...', '/mnt/homes/evge...', 12, Array)
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Controller/Catalog.php(13): Controller_Base->display(Object(View))
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(84): Controller_Catalog->action_index()
#3 [internal function]: Kohana_Controller->execute()
#4 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#8 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Controller/Base.php:12
2013-05-29 08:09:51 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_firms' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-29 08:09:51 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 08:11:18 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_firms' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-29 08:11:18 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 08:11:27 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_firms' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-29 08:11:27 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 08:11:32 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_firms' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-29 08:11:32 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 08:11:39 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_firms' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-29 08:11:39 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 08:12:06 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_firms' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-29 08:12:06 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 08:12:19 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_firms' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-29 08:12:19 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 08:12:22 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_firms' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-29 08:12:22 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 08:12:35 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_firms' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-29 08:12:35 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 08:12:40 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_firms' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-29 08:12:40 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 08:13:19 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_firms' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-29 08:13:19 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 08:13:37 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_firms' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-29 08:13:37 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 08:14:37 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_firms' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-29 08:14:37 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 08:22:18 --- EMERGENCY: Kohana_Exception [ 0 ]: The requested route does not exist: catalog ~ SYSPATH/classes/Kohana/Route.php [ 106 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/index.php:6
2013-05-29 08:22:18 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/index.php(6): Kohana_Route::get('catalog')
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(61): include('/mnt/homes/evge...')
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(348): Kohana_View::capture('/mnt/homes/evge...', Array)
#3 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(228): Kohana_View->render()
#4 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/layouts/common.php(15): Kohana_View->__toString()
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(61): include('/mnt/homes/evge...')
#6 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(348): Kohana_View::capture('/mnt/homes/evge...', Array)
#7 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#8 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(87): Kohana_Controller_Template->after()
#9 [internal function]: Kohana_Controller->execute()
#10 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#12 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#13 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#14 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/index.php:6
2013-05-29 08:26:56 --- EMERGENCY: Kohana_Exception [ 0 ]: Required route parameter not passed: firm ~ SYSPATH/classes/Kohana/Route.php [ 568 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/index.php:6
2013-05-29 08:26:56 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/index.php(6): Kohana_Route->uri(Array)
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(61): include('/mnt/homes/evge...')
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(348): Kohana_View::capture('/mnt/homes/evge...', Array)
#3 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(228): Kohana_View->render()
#4 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/layouts/common.php(15): Kohana_View->__toString()
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(61): include('/mnt/homes/evge...')
#6 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(348): Kohana_View::capture('/mnt/homes/evge...', Array)
#7 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#8 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(87): Kohana_Controller_Template->after()
#9 [internal function]: Kohana_Controller->execute()
#10 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#12 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#13 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#14 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/index.php:6
2013-05-29 08:53:53 --- EMERGENCY: View_Exception [ 0 ]: The requested view scripts/catalog/firm could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php:137
2013-05-29 08:53:53 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(137): Kohana_View->set_filename('scripts/catalog...')
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(30): Kohana_View->__construct('scripts/catalog...', NULL)
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Controller/Catalog.php(13): Kohana_View::factory('scripts/catalog...')
#3 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(84): Controller_Catalog->action_index()
#4 [internal function]: Kohana_Controller->execute()
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#9 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php:137
2013-05-29 08:54:02 --- EMERGENCY: View_Exception [ 0 ]: The requested view scripts/catalog/firm could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php:137
2013-05-29 08:54:02 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(137): Kohana_View->set_filename('scripts/catalog...')
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(30): Kohana_View->__construct('scripts/catalog...', NULL)
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Controller/Catalog.php(13): Kohana_View::factory('scripts/catalog...')
#3 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(84): Controller_Catalog->action_index()
#4 [internal function]: Kohana_Controller->execute()
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#9 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php:137
2013-05-29 08:57:17 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_Models' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-29 08:57:17 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-29 08:57:45 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: firm ~ APPPATH/views/scripts/catalog/firm.php [ 6 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/firm.php:6
2013-05-29 08:57:45 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/firm.php(6): Kohana_Core::error_handler(8, 'Undefined varia...', '/mnt/homes/evge...', 6, Array)
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(61): include('/mnt/homes/evge...')
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(348): Kohana_View::capture('/mnt/homes/evge...', Array)
#3 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(228): Kohana_View->render()
#4 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/layouts/common.php(15): Kohana_View->__toString()
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(61): include('/mnt/homes/evge...')
#6 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(348): Kohana_View::capture('/mnt/homes/evge...', Array)
#7 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#8 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(87): Kohana_Controller_Template->after()
#9 [internal function]: Kohana_Controller->execute()
#10 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#12 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#13 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#14 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/firm.php:6
2013-05-29 09:06:12 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: firm ~ APPPATH/views/scripts/catalog/firm.php [ 6 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/firm.php:6
2013-05-29 09:06:12 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/firm.php(6): Kohana_Core::error_handler(8, 'Undefined varia...', '/mnt/homes/evge...', 6, Array)
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(61): include('/mnt/homes/evge...')
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(348): Kohana_View::capture('/mnt/homes/evge...', Array)
#3 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(228): Kohana_View->render()
#4 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/layouts/common.php(15): Kohana_View->__toString()
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(61): include('/mnt/homes/evge...')
#6 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(348): Kohana_View::capture('/mnt/homes/evge...', Array)
#7 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#8 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(87): Kohana_Controller_Template->after()
#9 [internal function]: Kohana_Controller->execute()
#10 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#12 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#13 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#14 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/firm.php:6
2013-05-29 09:06:29 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: firm ~ APPPATH/views/scripts/catalog/firm.php [ 6 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/firm.php:6
2013-05-29 09:06:29 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/firm.php(6): Kohana_Core::error_handler(8, 'Undefined varia...', '/mnt/homes/evge...', 6, Array)
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(61): include('/mnt/homes/evge...')
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(348): Kohana_View::capture('/mnt/homes/evge...', Array)
#3 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(228): Kohana_View->render()
#4 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/layouts/common.php(15): Kohana_View->__toString()
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(61): include('/mnt/homes/evge...')
#6 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(348): Kohana_View::capture('/mnt/homes/evge...', Array)
#7 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#8 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(87): Kohana_Controller_Template->after()
#9 [internal function]: Kohana_Controller->execute()
#10 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#12 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#13 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#14 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/firm.php:6
2013-05-29 09:10:19 --- EMERGENCY: Kohana_Exception [ 0 ]: The model property does not exist in the Model_Models class ~ MODPATH/orm/classes/Kohana/ORM.php [ 684 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/modules/orm/classes/Kohana/ORM.php:600
2013-05-29 09:10:19 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/modules/orm/classes/Kohana/ORM.php(600): Kohana_ORM->get('model')
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/firm.php(6): Kohana_ORM->__get('model')
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(61): include('/mnt/homes/evge...')
#3 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(348): Kohana_View::capture('/mnt/homes/evge...', Array)
#4 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(228): Kohana_View->render()
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/layouts/common.php(15): Kohana_View->__toString()
#6 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(61): include('/mnt/homes/evge...')
#7 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(348): Kohana_View::capture('/mnt/homes/evge...', Array)
#8 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#9 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(87): Kohana_Controller_Template->after()
#10 [internal function]: Kohana_Controller->execute()
#11 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#12 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#15 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/modules/orm/classes/Kohana/ORM.php:600
2013-05-29 09:19:29 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_models_years' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-29 09:19:29 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :