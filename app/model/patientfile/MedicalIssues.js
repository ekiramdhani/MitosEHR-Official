/**
 * Created by JetBrains PhpStorm.
 * User: Ernesto J. Rodriguez (Certun)
 * File:
 * Date: 2/18/12
 * Time: 11:09 PM
 */

Ext.define('App.model.patientfile.MedicalIssues', {
	extend: 'Ext.data.Model',
	fields: [

		{name: 'id', type: 'int'},
		{name: 'eid', type: 'int'},
		{name: 'pid', type: 'int'},
		{name: 'created_uid', type: 'int'},
		{name: 'updated_uid', type: 'int'},
		{name: 'create_date', type: 'date', dateFormat: 'c'},
		{name: 'code', type: 'string'},
		{name: 'code_text', type: 'string'},
		{name: 'begin_date', type: 'date', dateFormat: 'c'},
		{name: 'end_date', type: 'date', dateFormat: 'c'},
		{name: 'ocurrence', type: 'string'},
		{name: 'referred_by', type: 'string'},
		{name: 'outcome', type: 'string'},
        {name: 'alert', type: 'bool'}

	],
	proxy : {
		type: 'direct',
		api : {
			read  : Medical.getMedicalIssues,
			create: Medical.addMedicalIssues,
			update: Medical.updateMedicalIssues
		}
	}
});

