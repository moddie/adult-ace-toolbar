<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-05-30 00:44:39 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_modelsyears' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-30 00:44:39 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-30 00:45:10 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'name' in 'where clause' [ SELECT `modelsyears`.`id_model_year` AS `id_model_year`, `modelsyears`.`id_model` AS `id_model`, `modelsyears`.`year` AS `year`, `modelsyears`.`mdl` AS `mdl` FROM `models_years` AS `modelsyears` WHERE `name` = '88500000' LIMIT 1 ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/modules/database/classes/Kohana/Database/Query.php:251
2013-05-30 00:45:10 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `modelsy...', false, Array)
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/modules/orm/classes/Kohana/ORM.php(1069): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/modules/orm/classes/Kohana/ORM.php(976): Kohana_ORM->_load_result(false)
#3 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Model/ModelsYears.php(16): Kohana_ORM->find()
#4 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Controller/Catalog.php(47): Model_ModelsYears->find_by_mdl('88500000')
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(84): Controller_Catalog->action_groups()
#6 [internal function]: Kohana_Controller->execute()
#7 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#8 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#11 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/modules/database/classes/Kohana/Database/Query.php:251
2013-05-30 00:45:36 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: name ~ APPPATH/classes/Model/ModelsYears.php [ 16 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Model/ModelsYears.php:16
2013-05-30 00:45:36 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Model/ModelsYears.php(16): Kohana_Core::error_handler(8, 'Undefined varia...', '/mnt/homes/evge...', 16, Array)
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Controller/Catalog.php(47): Model_ModelsYears->find_by_mdl('88500000')
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(84): Controller_Catalog->action_groups()
#3 [internal function]: Kohana_Controller->execute()
#4 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#8 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Model/ModelsYears.php:16
2013-05-30 00:45:46 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_groups' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-30 00:45:46 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-30 00:46:05 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_groups' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-30 00:46:05 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-30 00:46:08 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_groups' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-30 00:46:08 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-30 00:47:39 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_groups' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-30 00:47:39 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-30 00:47:50 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_groups' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-30 00:47:50 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-30 00:48:18 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_groups' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-30 00:48:18 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-30 00:48:32 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_groups' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-30 00:48:32 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-30 00:49:02 --- EMERGENCY: Kohana_Exception [ 0 ]: The model property does not exist in the Model_ModelsYears class ~ MODPATH/orm/classes/Kohana/ORM.php [ 684 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/modules/orm/classes/Kohana/ORM.php:600
2013-05-30 00:49:02 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/modules/orm/classes/Kohana/ORM.php(600): Kohana_ORM->get('model')
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/groups.php(3): Kohana_ORM->__get('model')
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
2013-05-30 00:50:39 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: firm ~ APPPATH/views/scripts/catalog/groups.php [ 3 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/groups.php:3
2013-05-30 00:50:39 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/groups.php(3): Kohana_Core::error_handler(8, 'Undefined varia...', '/mnt/homes/evge...', 3, Array)
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
#14 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/groups.php:3
2013-05-30 00:56:28 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Model_Subgroups::find_by_mdl_group() ~ APPPATH/classes/Controller/Catalog.php [ 86 ] in :
2013-05-30 00:56:28 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-30 00:57:57 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: groups ~ APPPATH/views/scripts/catalog/groups.php [ 1 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/groups.php:1
2013-05-30 00:57:57 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/groups.php(1): Kohana_Core::error_handler(8, 'Undefined varia...', '/mnt/homes/evge...', 1, Array)
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
#14 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/groups.php:1
2013-05-30 00:58:16 --- EMERGENCY: View_Exception [ 0 ]: The requested view scripts/catalog/subgroups could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php:137
2013-05-30 00:58:16 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(137): Kohana_View->set_filename('scripts/catalog...')
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(30): Kohana_View->__construct('scripts/catalog...', NULL)
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Controller/Catalog.php(62): Kohana_View::factory('scripts/catalog...')
#3 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(84): Controller_Catalog->action_subgroups()
#4 [internal function]: Kohana_Controller->execute()
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#9 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php:137
2013-05-30 01:07:12 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::pk() ~ APPPATH/classes/Model/Subgroups.php [ 17 ] in :
2013-05-30 01:07:12 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-30 01:13:15 --- EMERGENCY: View_Exception [ 0 ]: The requested view scripts/catalog/details could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php:137
2013-05-30 01:13:15 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(137): Kohana_View->set_filename('scripts/catalog...')
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php(30): Kohana_View->__construct('scripts/catalog...', NULL)
#2 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Controller/Catalog.php(93): Kohana_View::factory('scripts/catalog...')
#3 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(84): Controller_Catalog->action_details()
#4 [internal function]: Kohana_Controller->execute()
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#6 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#9 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/View.php:137
2013-05-30 01:19:31 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_Categories' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in :
2013-05-30 01:19:31 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-05-30 01:25:40 --- EMERGENCY: ErrorException [ 4096 ]: Object of class Database_MySQL_Result could not be converted to string ~ APPPATH/classes/Controller/Catalog.php [ 117 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Controller/Catalog.php:117
2013-05-30 01:25:40 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Controller/Catalog.php(117): Kohana_Core::error_handler(4096, 'Object of class...', '/mnt/homes/evge...', 117, Array)
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Controller.php(84): Controller_Catalog->action_details()
#2 [internal function]: Kohana_Controller->execute()
#3 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Catalog))
#4 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/index.php(118): Kohana_Request->execute()
#7 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/classes/Controller/Catalog.php:117
2013-05-30 01:28:13 --- EMERGENCY: Kohana_Exception [ 0 ]: The details property does not exist in the Model_Categories class ~ MODPATH/orm/classes/Kohana/ORM.php [ 684 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/modules/orm/classes/Kohana/ORM.php:600
2013-05-30 01:28:13 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/modules/orm/classes/Kohana/ORM.php(600): Kohana_ORM->get('details')
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/details.php(15): Kohana_ORM->__get('details')
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
2013-05-30 01:28:21 --- EMERGENCY: Kohana_Exception [ 0 ]: The details property does not exist in the Model_Categories class ~ MODPATH/orm/classes/Kohana/ORM.php [ 684 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/modules/orm/classes/Kohana/ORM.php:600
2013-05-30 01:28:21 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/modules/orm/classes/Kohana/ORM.php(600): Kohana_ORM->get('details')
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/details.php(15): Kohana_ORM->__get('details')
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
2013-05-30 01:29:57 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: subgroup ~ APPPATH/views/scripts/catalog/details.php [ 20 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/details.php:20
2013-05-30 01:29:57 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/details.php(20): Kohana_Core::error_handler(8, 'Undefined varia...', '/mnt/homes/evge...', 20, Array)
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
#14 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/details.php:20
2013-05-30 02:22:54 --- EMERGENCY: Kohana_Exception [ 0 ]: The mdl property does not exist in the Model_Models class ~ MODPATH/orm/classes/Kohana/ORM.php [ 684 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/modules/orm/classes/Kohana/ORM.php:600
2013-05-30 02:22:54 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/modules/orm/classes/Kohana/ORM.php(600): Kohana_ORM->get('mdl')
#1 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/firm.php(9): Kohana_ORM->__get('mdl')
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
2013-05-30 02:25:56 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: model ~ APPPATH/views/scripts/catalog/subgroups.php [ 10 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/subgroups.php:10
2013-05-30 02:25:56 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/subgroups.php(10): Kohana_Core::error_handler(8, 'Undefined varia...', '/mnt/homes/evge...', 10, Array)
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
#14 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/subgroups.php:10
2013-05-30 02:26:20 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: model ~ APPPATH/views/scripts/catalog/subgroups.php [ 10 ] in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/subgroups.php:10
2013-05-30 02:26:20 --- DEBUG: #0 /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/subgroups.php(10): Kohana_Core::error_handler(8, 'Undefined varia...', '/mnt/homes/evge...', 10, Array)
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
#14 {main} in /mnt/homes/evgeniy/htdocs/htdocs/elcats_parser/kohana/application/views/scripts/catalog/subgroups.php:10