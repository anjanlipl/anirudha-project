<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => ['XSS']], function () {
	Route::middleware('auth:api')->get('/user', function (Request $request) {
	    return $request->user();
	});

	Route::post('login', 'UserController@apiLogin');
	Route::post('reset_password', 'UserController@reset_password');

	Route::group(['middleware' => ['auth:api']], function () {

		Route::post('setFinYear', 'UserController@setFinYear');
		
		Route::post('check-access-for-page', 'UserController@checkAccessForPage');
		
		Route::post('sendTicket', 'UserController@sendTicket');
		
		Route::post('offtrackIndicators', 'DashboardController@offtrackIndicators');
		
		Route::get('get_current_user_dets', 'UserController@get_current_user_dets');
		
		Route::post('logout', 'UserController@logout');
		
		Route::get('department_dashboard_links', 'DepartmentController@departmentDashboardLinks');
		
		Route::get('sector_dashboard_links', 'SectorController@sectorDashboardLinks');
		
		Route::post('createCustomDashboard', 'CustomDashboardController@create');
		
		Route::get('custom_dashboard_list', 'CustomDashboardController@index');
		
		Route::get('custom_dashboard_show', 'CustomDashboardController@show');
		
		Route::post('getCustomSchemeDetails', 'CustomDashboardController@getCustomSchemeDetails');

		Route::post('get-user-profile', 'UserController@userProfile');
		
		Route::post('update_profile', 'UserController@updateProfile');

		Route::post('ref-acc-token', 'UserController@refToken');
		
		Route::group(['middleware' => ['role:super-admin']], function () {
    		
    		Route::resource('indunits', 'IndicatorUnitController');
			
			Route::resource('roles', 'User\RoleController');
			
			Route::resource('departments', 'DepartmentController');
			
			Route::resource('tags', 'TagController');
			
			Route::resource('units', 'UnitController');
			
			Route::resource('monitoringtypes', 'MonitoringTypeController');
			
			Route::resource('sector', 'SectorController');
			
			Route::resource('evalcriteria', 'EvaluationCriteriaController');
			
			Route::resource('subsector', 'SubsectorController');
			
			Route::resource('wards', 'WardsController');
			
			Route::resource('districts', 'DistrictController');
			
			Route::resource('vidhansabhas', 'VidhansabhaController');

			Route::get('schemes/{id}/edit', 'SchemeController@edit');
			Route::get('audits', 'UserController@audits');
			
			Route::post('update_scheme/{id}', 'SchemeController@update');
			
			Route::get('get_all_request', 'RaiserequestController@index');

			Route::post('deletebe/{id}', 'FinanceController@deletebe');
			
			Route::post('deletere/{id}', 'FinanceController@deletere');
			
			Route::post('deleteexp/{id}', 'FinanceController@deleteexp');

			Route::post('delete_estab_be/{id}', 'EstablishmentController@deletebe');
			
			Route::post('delete_estab_re/{id}', 'EstablishmentController@deletere');
			
			Route::post('delete_estab_exp/{id}', 'EstablishmentController@deleteexp');


					
					Route::post('edit-establishment-estimates', 'EstablishmentController@editestablishmentestimates');

					Route::post('edit-scheme-estimates', 'FinanceController@editschemeestimates');
					Route::post('edit_scheme_objective_output', 'ObjectiveController@editschemeoutput');
					Route::post('update_outcome', 'OutcomeController@updateoutcome');
					Route::post('edit_output_indicator', 'OutputindicatorController@updateindicator');
					Route::post('edit_outcome_indicator', 'OutcomeindicatorController@updateindicator');
					Route::post('output_baseline_edit', 'OutputtargetController@baselineUpdate');
					Route::post('output_target_update', 'OutputtargetController@targetUpdate');
					Route::post('output_achievent_edit', 'OutputtargetController@achievementUpdate');
					Route::post('outcome_baseline_edit', 'OutcometargetController@baselineUpdate');
					Route::post('outcome_target_update', 'OutcometargetController@targetUpdate');
					Route::post('outcome_achievent_edit', 'OutcometargetController@achievementUpdate');
					Route::post('outcome_reviews_edit', 'OutcometargetController@reviewUpdate');
					Route::post('output_reviews_edit', 'OutputtargetController@reviewUpdate');
					Route::post('output_action_edit', 'OutputtargetController@actionUpdate');
					Route::post('outcome_action_edit', 'OutcometargetController@actionUpdate');
					Route::delete('deleteObjective/{id}', 'ObjectiveController@deleteObjective');
					Route::delete('deleteOutput/{id}', 'OutputController@deleteOutput');
					Route::delete('deleteOutcome/{id}', 'OutcomeController@deleteOutcome');
					Route::delete('deleteOutputIndicator/{id}', 'OutputindicatorController@deleteOutputIndicator');
					Route::delete('deleteOutputBaseline/{id}', 'OutputtargetController@deleteOutputBaseline');
					
					Route::delete('deleteOutputTarget/{id}', 'OutputtargetController@deleteOutputTarget');
					Route::delete('deleteOutputAchievement/{id}', 'OutputtargetController@deleteOutputAchievement');
					Route::delete('deleteOutputReview/{id}', 'OutputtargetController@deleteOutputReview');
					
					Route::delete('deleteOutputAction/{id}', 'OutputtargetController@deleteOutputAction');



					Route::delete('deleteOutcomeBaseline/{id}', 'OutcometargetController@deleteOutcomeBaseline');
					
					Route::delete('deleteOutcomeTarget/{id}', 'OutcometargetController@deleteOutcomeTarget');
					Route::delete('deleteOutcomeAchievement/{id}', 'OutcometargetController@deleteOutcomeAchievement');
					Route::delete('deleteOutcomeReview/{id}', 'OutcometargetController@deleteOutcomeReview');
					
					Route::delete('deleteOutcomeAction/{id}', 'OutcometargetController@deleteOutcomeAction');
					
					Route::delete('deleteOutcomeIndicator/{id}', 'OutcomeindicatorController@deleteOutcomeIndicator');
					Route::post('mark_output_indicator_critical/{id}', 'OutputindicatorController@markCritical');
					Route::post('mark_outcome_indicator_critical/{id}', 'OutcomeindicatorController@markCritical');

					
					

			});
		
		Route::group(['middleware' => ['role:super-admin|department-admin|hod']], function () {
	    		
	    		Route::get('userslist', 'UserController@userslist');
				Route::get('schemes_assign_list', 'SchemeController@schemeAssignList');
				Route::get('assignto_list', 'UserController@assigntolist');
	    		Route::resource('users', 'User\UserController');
				Route::post('assignScheme/submit', 'SchemeController@assignSchemeSubmit');
				Route::post('assignDept/submit', 'DepartmentController@assignDeptSubmit');
				
				Route::get('assign_departments_list', 'DepartmentController@assignDepartmentslist');
				Route::get('dept_assignto_list', 'UserController@deptAssigntolist');
				Route::resource('indicatorobj', 'IndicatorObjectsController');

				Route::post('update_Action_points_status', 'UserController@updateActionPointsStatus');
				Route::post('scheme_upload', 'SchemeController@uploadScheme');
				Route::post('scheme_data_upload', 'SchemeController@uploadSchemeData');
				Route::post('add_scheme', 'SchemeController@store');

				Route::get('scheme_objectives_output', 'ObjectiveController@outputsList');
				Route::post('add_scheme_objective_output', 'ObjectiveController@storeOutput');
				Route::get('scheme_objectives', 'ObjectiveController@objectivesList');
				Route::get('scheme_objectives_head_info', 'ObjectiveController@objectivesHeadInfo');
				Route::post('add_scheme_objective', 'ObjectiveController@store');
				Route::post('edit_scheme_objective', 'ObjectiveController@update');


						Route::get('outputs_list','ObjectiveController@outputsList');
		Route::get('outputs_head_info','ObjectiveController@outputsHeadInfo');

		Route::get('outcomes_list','OutcomeController@index');
		Route::get('outcomes_head_info', 'OutputindicatorController@outputIndicatorsHeadInfo');
		Route::post('add_outcome','OutcomeController@store');

		Route::get('outcome_indicators_list','OutcomeindicatorController@index');
		Route::get('outcome_indicators_head_info','OutcomeindicatorController@outcomeIndicatorsHeadInfo');
		Route::post('add_outcome_indicator','OutcomeindicatorController@store');

		Route::get('out_target_base_head_info','OutcomeindicatorController@outTargetBaseHeadInfo');
		Route::get('outcome_baselines_list','OutcometargetController@baselineslist');
		Route::get('outcome_targets_list','OutcometargetController@targetslist');

		Route::post('outcome_baseline_save','OutcometargetController@baselinessave');
		Route::post('outcome_target_save','OutcometargetController@targetsave');

		Route::get('output_indicators_list','OutputindicatorController@index');
		Route::get('output_indicators_head_info', 'OutputindicatorController@outputIndicatorsHeadInfo');
		Route::post('add_output_indicator','OutputindicatorController@store');

		Route::get('output_baselines_list','OutputtargetController@baselineslist');
		Route::get('output_baselines_head_info','OutputtargetController@baselinesheadinfo');
		Route::get('output_targets_list','OutputtargetController@targetslist');

		Route::post('output_baseline_save','OutputtargetController@baselinessave');
		Route::post('output_target_save','OutputtargetController@targetsave');

		Route::get('output_achievent_list','OutputtargetController@achieventlist');
		Route::get('output_achievent_head_info','OutputtargetController@achieventheadinfo');
		Route::post('output_achievent_save','OutputtargetController@achieventsave');

		Route::get('outcome_achievent_list','OutcometargetController@achieventlist');
		Route::get('outcome_achievent_head_info','OutcometargetController@achieventheadinfo');
		Route::post('outcome_achievent_save','OutcometargetController@achieventsave');

		Route::get('output_reviews_list', 'OutputtargetController@reviewslist');
		Route::get('output_reviews_head_info', 'OutputtargetController@reviewsheadinfo');
		Route::post('output_reviews_add','OutputtargetController@reviewSave');

		Route::get('outcome_reviews_list', 'OutcometargetController@reviewslist');
		Route::get('outcome_reviews_head_info', 'OutcometargetController@reviewsheadinfo');
		Route::post('outcome_reviews_add','OutcometargetController@reviewSave');

		Route::post('add-scheme-estimates','FinanceController@addEstimate');
		Route::post('add-establishment_estimate','EstablishmentController@addEstimate');
		Route::post('add-establishment-expenditure','EstablishmentController@addExpenditure');
		
		Route::post('add-scheme-expenditure','FinanceController@addExpenditure');


		Route::get('output_actions_list', 'OutputtargetController@actionlist');
		Route::get('get_action_remarks', 'UserController@getactionremarks');

		
		Route::get('output_actions_head_info', 'OutputtargetController@actionheadinfo');
		Route::post('output_action_add','OutputtargetController@actionsave');

		Route::get('outcome_actions_list', 'OutcometargetController@actionlist');
		Route::get('outcome_actions_head_info', 'OutcometargetController@actionheadinfo');
		Route::post('outcome_action_add','OutcometargetController@actionsave');

		Route::post('raiseRequestFormSubmit','RaiserequestController@submit');


		Route::get('be_history', 'FinanceController@behistory');
		Route::get('establishment_be_history', 'EstablishmentController@behistory');

		Route::get('show_scheme_indicators', 'TargetEntryController@showSchemeIndicators');
		Route::get('export_scheme_indicators', 'TargetEntryController@exportSchemeIndicators');
		
		Route::post('uploadAchieve', 'TargetEntryController@uploadAchieve');
		Route::post('add_targets_submit', 'TargetEntryController@addTargetSubmit');
		Route::post('add_achievements_submit', 'TargetEntryController@addAchievementSubmit');
		Route::post('deleteInd', 'TargetEntryController@deleteInd');

			});
		Route::group(['middleware' => ['role:super-admin|department-admin|department-user|public-viewer']], function () {
	    		
				
				Route::get('get_dashboard_counts', 'DashboardController@getDashboardCounts');
				Route::get('get_dashboard_counts_critical', 'DashboardController@getDashboardCountsCritical');
				Route::get('get_dashboard_financials', 'DashboardController@getDashboardFinancials');
				Route::get('get_dashboard_financials_sector', 'DashboardController@getDashboardFinancialsSectorwise');
				Route::get('get_dashboard_financials_scheme', 'DashboardController@getDashboardFinancialsScheme');
				
				Route::get('get_dashboard_dept_financials', 'DashboardController@getDeptFinancials');
				Route::get('get_dashboard_sector_financials', 'DashboardController@getSectorFinancials');	
				Route::get('get_chart_data_main', 'DashboardController@getChartDataMain');
				Route::get('get_chart_data_critical', 'DashboardController@getChartDataCritical');
				Route::get('get_all_sectors_dashboard', 'DashboardController@getAllSectorsDashboard');
				Route::get('get_chart_data_alldeptmain', 'DashboardController@getChartDataAllDeptMain');
				Route::get('get_scheme_indicators_list', 'DashboardController@getSchemeIndicatorsList');
				Route::get('get_schemes_home', 'DashboardController@getSchemesHome');
				Route::get('get_schemes_home/{dept_id}', 'DashboardController@getSchemesHome');
	    		
	    		

			});
		
			
	    Route::get('check_dept_access/{id}', 'DepartmentController@checkDeptAccess');

		Route::post('add_user_remark', 'UserController@addUserRemark');

		Route::post('assign_action_submit', 'UserController@assignActionSubmit');
		Route::get('assigned_actions', 'UserController@assignedActions');
		Route::get('getWardDetails/{id}', 'WardsController@getWardDetails');

		

		

		Route::get('best_performing_dash', 'DashboardController@bestPerformingDash');
		Route::get('best_performing_dash_ind', 'DashboardController@bestPerformingDashInd');
		Route::get('best_performing_dash_ind_cri', 'DashboardController@bestPerformingDashIndCri');


		Route::get('best_performing_dash_dept', 'DashboardController@bestPerformingDashDept');
		Route::get('best_performing_dash_ind_dept', 'DashboardController@bestPerformingDashIndDept');
		Route::get('best_performing_dash_ind_cri_dept', 'DashboardController@bestPerformingDashIndCriDept');

		Route::get('get_dashboard_sector_financials_deptwise', 'DashboardController@getDashboardFinancialsDeptwise');
		Route::get('get_dashboard_sector_financials_schemewise', 'DashboardController@getDashboardFinancialsSchemewise');
		
		
		Route::get('raiseRequestSchemeList', 'SchemeController@raiseRequestSchemeList');

		Route::get('get_schemes_dept_home', 'DashboardController@getSchemesDeptHome');

		Route::get('get_dashboard_counts_sector', 'DashboardController@getDashboardCountsSector');
		Route::get('get_dashboard_counts_sector_critical', 'DashboardController@getDashboardCountsSectorCritical');
		
	
		

		Route::get('get_dashboard_counts_dept', 'DashboardController@getDashboardCountsDepart');
		Route::get('get_dashboard_counts_scheme', 'DashboardController@getDashboardCountsScheme');
		Route::get('get_dashboard_counts_dept_critical', 'DashboardController@getDashboardCountsDepartCritical');
		Route::get('get_dashboard_counts_scheme_critical', 'DashboardController@getDashboardCountsSchemeCritical');
		
		Route::get('get_chart_data_dept', 'DashboardController@getChartDataDept');
		Route::get('get_chart_data_scheme', 'DashboardController@getChartDataScheme');
		Route::get('get_chart_data_dept_critical', 'DashboardController@getChartDataDeptCritical');
		Route::get('get_chart_data_scheme_critical', 'DashboardController@getChartDataSchemeCritical');
		Route::get('get_criteria_details', 'EvaluationCriteriaController@getCriteriaDetails');
		Route::get('get_chart_data_Establishment', 'EstablishmentController@getChartDataEstablishment');
		Route::get('get_chart_data_dept_Establishment', 'EstablishmentController@getChartDataDepartEstablishment');
		Route::get('get_chart_data_scheme_Establishment', 'EstablishmentController@getChartDataSchemeEstablishment');

		Route::get('get_chart_data_sector_Establishment', 'EstablishmentController@getChartDataSectorEstablishment');

		Route::get('getNotifications', 'NotificationController@getNotifications');
		Route::post('markNoteRead', 'NotificationController@markNoteRead');
		Route::post('change_password', 'UserController@change_password');



		Route::get('output_baseline_target_name', 'OutputtargetController@baselinenameAutogenerate');
		Route::get('outcome_baseline_target_name', 'OutcometargetController@baselinenameAutogenerate');

		


		Route::get('user_role', 'UserController@currentUserRoles');
		Route::get('current_user_role', 'UserController@getCurrentuserRole');

		Route::get('getusertypes', 'UserController@getusertypes');

		Route::post('schemelist', 'SchemeController@getSchemeForUnit');

		Route::post('del-scheme', 'SchemeController@delScheme');
		

		Route::get('getDepartmentById', 'DepartmentController@getDepartmentById');
		Route::get('getObjectiveById', 'ObjectiveController@getObjectiveById');



		Route::get('sectorlist', 'SectorController@getSectorList');
		Route::get('wardslist', 'WardsController@getWardList');
		Route::get('districtslist', 'DistrictController@getDistrictList');
		Route::get('vidhanshabhalist', 'VidhansabhaController@getVidhanshabhaList');


		Route::get('indicator_units_list', 'IndicatorUnitController@getIndUnitList');

		Route::post('get_parent_output_indicators', 'OutputindicatorController@parentinds');

		Route::get('subsectorlist', 'SubsectorController@getsubsectorlist');
		Route::post('subsectorlist', 'SubsectorController@getsubsectorlist');
		Route::get('departmentlist', 'DepartmentController@getdepartmentlist');
		Route::post('departmentlist', 'DepartmentController@getdepartmentlist');
		Route::post('getdepartmentschemes', 'DepartmentController@getDepartmentSchemes');
		Route::post('getschemeobjective', 'DepartmentController@getSchemeObjective');
		Route::post('getobjectiveoutput', 'DepartmentController@getObjectiveOutput');
		Route::post('unitlist', 'UnitController@getUnitList');
		Route::get('taglist', 'TagController@TagList');
		Route::get('montypelist', 'MonitoringTypeController@montypeList');
		Route::get('schemes', 'SchemeController@index');
		

		



		
		Route::post('getSchemeReports', 'ReportController@getSchemeRep');


		Route::post('getCustomSchemeReports', 'ReportController@getCustomSchemeReports');

		
		

		



		Route::get('actionpoint_main', 'DashboardController@actionpointMain');
		Route::get('actionpoint_sector', 'DashboardController@actionpointSector');
		Route::get('actionpoint_dept', 'DashboardController@actionpointDept');
		Route::get('actionpoint_scheme', 'DashboardController@actionpointScheme');
		Route::get('get-department-users', 'SendNotificationController@getDepartmentUsers');
		Route::post('send-notification', 'SendNotificationController@send');
		Route::get('indicator_data_main', 'DashboardController@getIndicatorDataMain');
		Route::post('compareSchemes', 'SchemeController@compareSchemes');
	});
});