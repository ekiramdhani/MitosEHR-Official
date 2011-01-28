CREATE TABLE IF NOT EXISTS `form_Forms_Cardiology` (
id bigint(20) NOT NULL auto_increment,
date datetime default NULL,
pid bigint(20) default NULL,
user varchar(255) default NULL,
groupname varchar(255) default NULL,
authorized tinyint(4) default NULL,
activity tinyint(4) default NULL,
_first_name TEXT,
_middle_name TEXT,
_last_name TEXT,
_nick_name TEXT,
_street_address_number TEXT,
_street_name TEXT,
_street_name_apt TEXT,
_street_name_space TEXT,
_po_box_address_number TEXT,
_po_box_street TEXT,
_po_box_apt TEXT,
_po_box_space TEXT,
_city TEXT,
_state TEXT,
_zip_code TEXT,
_social_security TEXT,
_home_phone TEXT,
_email_address TEXT,
_cell_phone TEXT,
_date_of_birth DATE,
_age TEXT,
_sex TEXT,
_marital_status TEXT,
_occupation TEXT,
_employer_name TEXT,
_employer_street_address TEXT,
_employer_city TEXT,
_employer_state TEXT,
_employer_zip_code TEXT,
_business_phone TEXT,
_extension TEXT,
_drivers_license TEXT,
_drivers_license_state TEXT,
_spg_refers_to_spouse_parents_guarantors TEXT,
_spg_first_name TEXT,
_spg_middle_name TEXT,
_spg_last_name TEXT,
_spg_occupation TEXT,
_spg_address_if_different_than_above TEXT,
_spg_city TEXT,
_spg_state TEXT,
_spg_zip_code TEXT,
_spg_home_phone TEXT,
_spg_employer_street_address TEXT,
_spg_employer_city TEXT,
_spg_employer_state TEXT,
_spg_employer_zip_code TEXT,
_spg_employer_business_phone TEXT,
_spg_employer_extension TEXT,
_concerning_insurance_deatils TEXT,
_date_of_injury DATE,
_primary_insurance_co_here TEXT,
_primary_insurance_group_number TEXT,
_primary_insurance_id_number TEXT,
_primary_insurance_insured_name TEXT,
_primary_insurance_insured_date_of_birth DATE,
_primary_insurance_insured_address TEXT,
_secondary_insurance_co_name TEXT,
_secondary_insurance_group_number TEXT,
_secondary_insurance_id_number TEXT,
_secondary_insurance_insureds_name TEXT,
_secondary_insurance_insureds_date_of_birth DATE,
_secondary_insurance_insureds_col_address TEXT,
_person_to_notify_in_case_of_emergency_not_leaving_with_you TEXT,
_relationship TEXT,
_person_address TEXT,
_person_street TEXT,
_person_apt TEXT,
_person_space TEXT,
_person_city TEXT,
_person_state TEXT,
_person_zip_code TEXT,
_person_home_phone TEXT,
heart_problems_or_symptoms TEXT,
have_you_ever_had TEXT,
check_if_you_have TEXT,
close_family_member_with TEXT,
if_a_woman_have_you TEXT,
menopause_passed_on_what_age TEXT,
have_you_take_estrogen_replacement TEXT,
please_tell_us_anything_else_about_heart TEXT,
medicine_detail1 TEXT,
medicine_detail2 TEXT,
medicine_detail3 TEXT,
medicine_detail4 TEXT,
medicine_detail5 TEXT,
medicine_detail6 TEXT,
medicine_detail7 TEXT,
medicine_detail8 TEXT,
are_you_allergic_to_any_medications TEXT,
lis_medicine_to_which_you_are_allergic TEXT,
what_kind_of_reaction_did_you_have TEXT,
constitutional TEXT,
heent TEXT,
respiratory TEXT,
digestive TEXT,
urinary TEXT,
musculoskeletal TEXT,
dermatological TEXT,
men TEXT,
women TEXT,
female_reproductive TEXT,
neurological TEXT,
psychiatric TEXT,
endocrinology TEXT,
hematological TEXT,
have_you_had_any_operations TEXT,
are_you_being_treated_now_or_have_been_treated_for_any_illness TEXT,
marital_status TEXT,
do_you_smoke TEXT,
occupation TEXT,
how_many_packs_per_day TEXT,
leisure_activities TEXT,
for_how_many_years TEXT,
educational_level TEXT,
how_much_alcohol_do_you_drink TEXT,
do_you_use_any_drugs TEXT,
heart_problems TEXT,
high_blood_pressure TEXT,
diabetes TEXT,
_cancer TEXT,
year TEXT,
hospital TEXT,
reason TEXT,

PRIMARY KEY (id)
) TYPE=MyISAM;
