CREATE TABLE IF NOT EXISTS form_mh_therapy_progress (
id bigint(20) NOT NULL auto_increment,
date datetime default NULL,
pid bigint(20) default NULL,
user varchar(255) default NULL,
groupname varchar(255) default NULL,
authorized tinyint(4) default NULL,
activity tinyint(4) default NULL,
time_in time default NULL,
time_out time default NULL,
meeting_scheduled varchar(3) NOT NULL default 'N/A',
meeting_emergency varchar(3) NOT NULL default 'N/A',
others_present longtext,
meeting_lasted tinyint(4),
number_of_units tinyint(4),
icd9 varchar(6) default NULL,
client_ontime varchar(3) NOT NULL default 'N/A',
client_late varchar(3) NOT NULL default 'N/A',
was_late_by tinyint(4),
did_not_show varchar(3) NOT NULL default 'N/A',
cancelled varchar(3) NOT NULL default 'N/A',
next_meeting datetime default NULL,
location_office varchar(3) NOT NULL default 'N/A',
location_detention varchar(3) NOT NULL default 'N/A',
location_home varchar(3) NOT NULL default 'N/A',
location_school varchar(3) NOT NULL default 'N/A',
location_hosp varchar(3) NOT NULL default 'N/A',
location_other varchar(3) NOT NULL default 'N/A',
location_other_block varchar(15) default NULL,
location_facility_code varchar(5) default NULL,
treatment_individual_therapy varchar(3) NOT NULL default 'N/A',
treatment_family varchar(3) NOT NULL default 'N/A',
treatment_group varchar(3) NOT NULL default 'N/A',
treatment_couple varchar(3) NOT NULL default 'N/A',
treatment_assessment varchar(3) NOT NULL default 'N/A',
treatment_service_code varchar(10) default NULL,
paysource_medicaid varchar(3) NOT NULL default 'N/A',
paysource_dfs varchar(3) NOT NULL default 'N/A',
paysource_private varchar(3) NOT NULL default 'N/A',
paysource_other varchar(3) NOT NULL default 'N/A',
paysource_other_block varchar(10) default NULL,
paysource_county varchar(15) default NULL,
topics_of_discussion longtext,
progress_towards_goals longtext,
medications longtext,
functioning_since_session longtext,
mood_normal varchar(3) NOT NULL default 'N/A',
mood_anxious varchar(3) NOT NULL default 'N/A',
mood_depressed varchar(3) NOT NULL default 'N/A',
mood_angry varchar(3) NOT NULL default 'N/A',
mood_euphoric varchar(3) NOT NULL default 'N/A',
affect_normal varchar(3) NOT NULL default 'N/A',
affect_intense varchar(3) NOT NULL default 'N/A',
affect_blunted varchar(3) NOT NULL default 'N/A',
affect_inappropriate varchar(3) NOT NULL default 'N/A',
affect_labile varchar(3) NOT NULL default 'N/A',
mentalstatus_normal varchar(3) NOT NULL default 'N/A',
mentalstatus_lessened_awareness varchar(3) NOT NULL default 'N/A',
mentalstatus_memory_deficiencies varchar(3) NOT NULL default 'N/A',
mentalstatus_disorientated varchar(3) NOT NULL default 'N/A',
mentalstatus_disorganized varchar(3) NOT NULL default 'N/A',
mentalstatus_vigilant varchar(3) NOT NULL default 'N/A',
mentalstatus_delusional varchar(3) NOT NULL default 'N/A',
mentalstatus_hallucinating varchar(3) NOT NULL default 'N/A',
mentalstatus_other varchar(3) NOT NULL default 'N/A',
mentalstatus_other_block varchar(20) NOT NULL default 'N/A',
suicide_violance_risk_none varchar(3) NOT NULL default 'N/A', 
suicide_violance_risk_ideation_only varchar(3) NOT NULL default 'N/A', 
suicide_violance_risk_threat varchar(3) NOT NULL default 'N/A', 
suicide_violance_risk_gesture varchar(3) NOT NULL default 'N/A', 
suicide_violance_risk_rehearsal varchar(3) NOT NULL default 'N/A', 
suicide_violance_risk_attempt varchar(3) NOT NULL default 'N/A', 
sleep_quality_normal varchar(3) NOT NULL default 'N/A', 
sleep_quality_restless varchar(3) NOT NULL default 'N/A', 
sleep_quality_insomnia varchar(3) NOT NULL default 'N/A', 
sleep_quality_nightmares varchar(3) NOT NULL default 'N/A', 
sleep_quality_oversleeps varchar(3) NOT NULL default 'N/A', 
participation_level_active varchar(3) NOT NULL default 'N/A', 
participation_level_variable varchar(3) NOT NULL default 'N/A', 
participation_level_only_responsive varchar(3) NOT NULL default 'N/A', 
participation_level_minimal varchar(3) NOT NULL default 'N/A', 
participation_level_none varchar(3) NOT NULL default 'N/A', 
participation_level_resistant varchar(3) NOT NULL default 'N/A', 
treatment_compliance_full varchar(3) NOT NULL default 'N/A', 
treatment_compliance_partial varchar(3) NOT NULL default 'N/A', 
treatment_compliance_low varchar(3) NOT NULL default 'N/A', 
response_to_treatment_as_expected varchar(3) NOT NULL default 'N/A', 
response_to_treatment_better varchar(3) NOT NULL default 'N/A', 
response_to_treatment_much varchar(3) NOT NULL default 'N/A', 
response_to_treatment_poorer varchar(3) NOT NULL default 'N/A', 
response_to_treatment_very_poor varchar(3) NOT NULL default 'N/A', 
gaf varchar(3) default NULL, 
other_observations longtext,
diagnosis_changes_none varchar(3) NOT NULL default 'N/A', 
diagnosis_changes longtext,
followups_next varchar(3) NOT NULL default 'N/A', 
followups_next_date datetime default NULL, 
followups_next_week varchar(3) NOT NULL default 'N/A', 
followups_next_month varchar(3) NOT NULL default 'N/A', 
followups_next_2_months varchar(3) NOT NULL default 'N/A', 
followups_next_3_months varchar(3) NOT NULL default 'N/A', 
followups_next_as_needed varchar(3) NOT NULL default 'N/A', 
followups_referral varchar(3) NOT NULL default 'N/A', 
followups_referral_to varchar(20) default NULL, 
followups_referral_for varchar(20) default NULL, 
followups_call varchar(3) not NULL default 'N/A', 
followups_call_to varchar(20) default NULL,
followups_call_for varchar(20) default NULL, 
PRIMARY KEY (id)
) TYPE=MyISAM;
